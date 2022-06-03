<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function getSignupFields() {
	return "signup.username,signup.slug,signup.profileimage,signup.bio";
}

//generic
function getProfilePic($pic) {
	if (!empty($pic)) {
		return "/attachments/profilepic/" . $pic;
	} else {
		return "/attachments/profilepic/avatar-default-icon.png";
	}
}

function getCommPic($pic) {
	if (!empty($pic)) {
		return "/attachments/communityimages/" . $pic;
	} else {
		return "/attachments/communityimages/fintech.png";
	}
}

function isValidEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL)
	&& preg_match('/@.+\./', $email);
}

function isValidPhone($phone) {
	return preg_match('/^[6-9][0-9]{9}$/', $phone);
}

function getcommunityfollowdetails($userId, $commId) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('*');
	$CI->db->where(array('userId' => $userId, 'commId' => $commId));
	$row = $CI->db->get('tbl_community_follow')->row_array();
	return $row;
}

//get [dest] communities by user
function getDestCommunities($userId) {
	if (!$userId) {
		$userId = 0;
	}
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$query = $ci->db->query('SELECT * from communitymaster where is_deleted="0" AND communitytype="1"');
	$results = $query->result_array();
	return $results;
}

//get all communities
function getPopularCommunities() {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$query = $ci->db->query('SELECT * from communitymaster where status="1" AND is_deleted="0" order by id desc limit 5');
	$results = $query->result_array();
	return $results;
}

//get [unliked] communities by user
function getcommunityFollowAccordingToUserid($userId) {
	if (!$userId) {$userId = 0;}
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$query = $ci->db->query('SELECT * from communitymaster where is_deleted="0" AND id not in (select commId from tbl_community_follow where userId = ' . $userId . ') order by id desc limit 5');
	$results = $query->result_array();
	return $results;
}
//get [liked] communities by user
function getUserFollowedCommunities($userId) {
	if (!$userId) {
		$userId = 0;
	}
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$query = $ci->db->query('SELECT * from communitymaster where is_deleted="0" AND id in (select commId from tbl_community_follow where userId = ' . $userId . ') order by id desc limit 5');
	//return $ci->db->last_query();
	$results = $query->result_array();
	return $results;
}
//get [created] communities by user
function getCommunitiesById($table_name = '', $id = '', $field = 'user_id') {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	if (!empty($table_name)) {
		$ci->db->select('*');
		if ($field != '' && $id > 0) {
			$ci->db->where($field, $id);
		}
		$ci->db->where('is_deleted', '0');
		$ci->db->order_by('id', 'desc');
		$ci->db->limit(3);
		$query = $ci->db->get($table_name);
		$results = $query->result_array();
	}
	return $results;
}

function getAlldata($table_name, $limit = '', $order_by = '', $condition = '') {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();

	$ci->db->select('*');
	$ci->db->from($table_name);
	if ($order_by) {
		$ci->db->order_by($order_by);
	}
	if ($limit) {
		$ci->db->limit($limit);
	}
	if ($condition) {
		foreach ($condition as $key) {
			$ci->db->where('id !=', $key);
		}
	}
	$query = $ci->db->get();
	$results = $query->result_array();
	return $results;
}
/*
 * community profile
 */
function getTotalcommunitypostByslug($id) {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$query = $ci->db->query("SELECT count(id) as totalcount from community_posts where communityId = '" . $id . "'");
	$results = $query->row_array();
	$total = $results['totalcount'];
	return $total;

}

function getTotalPostlikesOfCommunity($id) {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();

	$query = $ci->db->query("SELECT id , likes from community_posts where is_deleted = '0' and communityId = '" . $id . "'");
	$total = 0;
	$results = $query->result_array();
	foreach ($results as $result) {
		$total = $total + $result['likes'];
	}
	return $total;
}

function getdefaultuserimage($imagepath) {
	$imagewithpath = '';

	if (empty($imagepath)) {
		$imagewithpath = 'avatar-default-icon.png';
	} else {
		$imagewithpath = $imagepath;
	}
	return $imagewithpath;
}

function gpiPost($pic) {
	$img = "/assets/images/pennydia.png";
	if ($pic) {
		$img = "/attachments/postimages/" . $pic;
	}
	return base_url($img);
}

function gdiPost($pic, $from) {
	$img = "/attachments/profilepic/avatar-default-icon.png";
	if ($from == 1) {
		if ($pic) {
			$img = "/attachments/communityimages/" . $pic;
		} else {
			$img = "/attachments/communityimages/fintech.png";
		}
	} else {
		if ($pic) {
			$img = "/attachments/profilepic/" . $pic;
		} else {
			$img = "/attachments/profilepic/avatar-default-icon.png";
		}
	}
	return base_url($img);
}

function savefile($file, $info) {
	$file = fopen($file, "w");
	fwrite($file, $info);
	fclose($file);
}

// User Profile
function getfollowdetails($follower_id, $follow_id) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('*');
	$CI->db->where(array('follower_id' => $follower_id, 'follow_id' => $follow_id));
	$row = $CI->db->get('tbl_people_follow')->row_array();
	return $row;

}

/*
 * Function :  getMenuItems
 */
function getMenuItems() {
	$ci = &get_instance();
	$ci->load->database();
	$ci->db->select('*');
	$ci->db->where('status', '1');
	$ci->db->where('is_deleted', '0');
	$ci->db->order_by('display_order', 'asc');
	$query = $ci->db->get('tbl_main_menu');
	return $query->result_array();

}

/*
 * Function :  mysavedPost
 */
function mysavedPost($userId) {
	$ci = &get_instance();
	$ci->load->database();
	$ci->db->select('userPosts.id,userPosts.postDescription ,userPosts.created_date,userPosts.userId, signup.profileimage');
	$ci->db->from('tbl_saved_user_posts');
	$ci->db->join('userPosts', 'userPosts.id = tbl_saved_user_posts.post_id');
	$ci->db->join('signup', 'signup.id = userPosts.userId');
	$ci->db->where('tbl_saved_user_posts.user_id', $userId);
	$ci->db->where('tbl_saved_user_posts.status', '1');
	$ci->db->where('tbl_saved_user_posts.is_deleted', '0');
	$ci->db->order_by('tbl_saved_user_posts.id', 'desc');
	$ci->db->limit(4);
	$query = $ci->db->get();
	//echo $ci->db->last_query(); die;
	$results = $query->result_array();

	return $results;
}

function getUserdataById($table_name = '', $id = '', $field = 'id') {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	if (!empty($table_name) && $id > 0) {
		$ci->db->select('*');
		$ci->db->where($field, $id);
		$query = $ci->db->get($table_name);
		$results = $query->row_array();
	}
	return $results;
}

function getDomain() {
	$CI = &get_instance();
	return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/", "$1", $CI->config->slash_item('base_url'));
}

function array_chunks_fixed($array, $segmentCount) {
	$dataCount = count($array);
	if ($dataCount == 0) {
		return false;
	}

	$segmentLimit = 1;
	//if($segmentCount > $segmentLimit)
	//  $segmentLimit = $segmentCount;
	$outputArray = array();
	$i = 0;
	while ($dataCount >= $segmentLimit) {

		if ($segmentCount == $i) {
			$i = 0;
		}

		if (!array_key_exists($i, $outputArray)) {
			$outputArray[$i] = array();
		}

		$outputArray[$i][] = array_splice($array, 0, $segmentLimit)[0];
		$dataCount = count($array);
		$i++;
	}
	if ($dataCount > 0) {
		$outputArray[] = $array;
	}

	return $outputArray;
}

/*
 * Function :  buildCommonArray
 */
function buildCommonArray($commonArray) {
	$results = array();
	foreach ($commonArray as $val) {
		$results[] = $val['id'];
	}
	return $results;
}

function getcommunitypostsbyid1($id = '0', $user_id = 0) {
	//pre SLUG
	if (!$user_id) {
		$user_id = 0;
	}
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	if (!empty($id)) {
		$ci->db->select('signup.username,signup.profileimage,signup.qualification,signup.address,signup.name,community_posts.*,tbl_saved_communityposts.status as savedstatus');
		$ci->db->from('signup');
		$ci->db->join('community_posts', 'community_posts.userId = signup.id AND community_posts.is_deleted="0"');
		$ci->db->join('tbl_saved_communityposts', 'community_posts.id = tbl_saved_communityposts.post_id AND tbl_saved_communityposts.user_id=' . $user_id, 'left');
		$ci->db->where('community_posts.communityId', $id);
		$ci->db->order_by('community_posts.id', 'desc');
		//	$ci->db->limit(3);
		$query = $ci->db->get();
		$results = $query->result_array();
	}
	return $results;
}

function getcommunitypostsbyid($id = '') {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	if (!empty($id)) {
		$ci->db->select('signup.username,signup.profileimage,signup.qualification,signup.address,signup.name,community_posts.*');
		$ci->db->from('signup');
		$ci->db->join('community_posts', 'community_posts.user_id = signup.id AND community_posts.is_deleted="0"');
		$ci->db->where('community_posts.id', $id);
		$ci->db->order_by('community_posts.id', 'desc');
		//	$ci->db->limit(3);
		$query = $ci->db->get();
		$results = $query->result_array();
	}
	return $results;
}

function getPeopleFollowAccordingToUserid($follower_id) {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();

	$query = $ci->db->query('SELECT * from signup where id not in (select follow_id from tbl_people_follow where follower_id = ' . $follower_id . ') order by id desc limit 4');

	$results = $query->result_array();
	return $results;
}

function getAdsBanner($ads_position = '', $limit = '3') {
	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$ci->db->select('*');
	if ($ads_position != '') {
		$ci->db->where('ads_position', $ads_position);
	}
	$ci->db->where('status', '1');
	$ci->db->where('is_deleted', '0');
	$ci->db->order_by('display_order', 'asc');
	$ci->db->limit($limit);
	$query = $ci->db->get('tbl_promotionaladvertising_msater');
	$results = $query->result_array();
	return $results;
}

function getTotalPostlikesOfUser($user_id) {

	$ci = &get_instance();
	$ci->load->database();
	$results = array();

	$query = $ci->db->query('SELECT id , likes from userPosts where is_deleted = "0" and userId = ' . $user_id);
	$total = 0;
	$results = $query->result_array();
	foreach ($results as $result) {
		$total = $total + $result['likes'];
	}
	$response = '';
	$response = $total > 1 ? $total . ' Upvotes' : $total . ' Upvotes';
	return $response;
	//	return $total;

}

function getTotalInvites($user_id) {

	$ci = &get_instance();
	$ci->load->database();
	$results = array();
	$query = $ci->db->query('SELECT count(id) as totalCount from tbl_send_invites where status="1" AND is_deleted="0" AND user_id = ' . $user_id);
	$results = $query->row_array();
	$total = $results['totalCount'];
	$response = '';
	$response = $total > 1 ? $total . ' Invites' : $total . ' Invite';
	return $response;
}

function getlikesDetailsOfcommunityPosts($user_id, $postID) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('*');
	$CI->db->where(array('userId' => $user_id, 'postId' => $postID));
	$row = $CI->db->get('likes_communityposts')->row_array();

	return $row;

}

function getuserpostcomments($user_id, $postID) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('signup.username,signup.profileimage,signup.qualification,signup.address,signup.name,tbl_comments_userposts.*');
	$CI->db->from('signup');
	$CI->db->join('tbl_comments_userposts', 'signup.id=tbl_comments_userposts.user_id');
	$CI->db->where(array('tbl_comments_userposts.postID' => $postID, 'tbl_comments_userposts.user_id' => $user_id));
	$CI->db->order_by('tbl_comments_userposts.id', 'DESC');
	$CI->db->limit(1);
	$row = $CI->db->get()->row_array();

	return $row;
}

function logincheckredirect($user_id) {
	if ($user_id > 0) {

	} else {
		redirect('login');
	}
}

function unseenusernotifications($user_id) {

	$ci = &get_instance();
	$ci->load->database();
	$results = array();

	$ci->db->select('count(id) as totalcount');
	$ci->db->from('tbl_notifications');
	$ci->db->where('tbl_notifications.receiver_id', $user_id);
	$ci->db->where('tbl_notifications.sender_id !=', $user_id);
	$ci->db->where('tbl_notifications.is_viewed !=', '1');
	$query = $ci->db->get();
	$results = $query->row_array();
	$total = $results['totalcount'];

	return $total;

}

function getalltopicsofposts() {

	$ci = &get_instance();
	$ci->load->database();
	$results = array();

	$ci->db->select('*');
	$ci->db->from('tbl_addtopic_posts');
	$ci->db->where('is_deleted', '0');
	$ci->db->where('status', '1');
	$query = $ci->db->get();
	$results = $query->result_array();

	return $results;

}
