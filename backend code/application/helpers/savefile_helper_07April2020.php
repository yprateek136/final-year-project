<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
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

function savefile($file, $info)
{
    $file = fopen($file, "w");
    fwrite($file, $info);
    fclose($file);
}

	/*
	* Function :  getMenuItems
	*/
	function getMenuItems()
	{
		$ci =& get_instance();
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
function mysavedPost($userId)
{
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select('userPosts.postID,userPosts.postDescription ,userPosts.created_date,userPosts.user_id, signup.profileimage');
	$ci->db->from('tbl_saved_user_posts');
	$ci->db->join('userPosts', 'userPosts.postID = tbl_saved_user_posts.post_id');
	$ci->db->join('signup', 'signup.id = userPosts.user_id');
	$ci->db->where('tbl_saved_user_posts.user_id', $userId);
	$ci->db->where('tbl_saved_user_posts.status', '1');
	$ci->db->where('tbl_saved_user_posts.is_deleted', '0');
	$ci->db->order_by('tbl_saved_user_posts.id','desc');
	$ci->db->limit(4);
	$query = $ci->db->get();
	//echo $ci->db->last_query(); die;
	$results =  $query->result_array();
	
	return $results;
}

	
	function getUserdataById($table_name='',$id = '', $field = 'id'){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();
		if(!empty($table_name) && $id>0)
		{
			$ci->db->select('*');
			$ci->db->where($field,$id);
			$query = $ci->db->get($table_name);
			$results =  $query->row_array();
		}
		return $results;
	}
	
	function getDomain()
	{
		$CI =& get_instance();
		return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $CI->config->slash_item('base_url'));
	}
	

	function array_chunks_fixed($array, $segmentCount) {
		$dataCount = count($array);
		if ($dataCount == 0) return false;
		$segmentLimit = 1;
		//if($segmentCount > $segmentLimit)
		  //  $segmentLimit = $segmentCount;
		$outputArray = array();
		$i = 0;
		while($dataCount >= $segmentLimit) {

			if( $segmentCount  == $i)
				$i = 0;
			if(!array_key_exists($i, $outputArray))
				$outputArray[$i] = array();
			$outputArray[$i][] =  array_splice($array,0,$segmentLimit)[0] ;
			$dataCount = count($array);
		    $i++;
		}
		if($dataCount > 0) $outputArray[] = $array;

		return $outputArray;
	}

	   
   	/*
	* Function :  buildCommonArray
	*/
	function buildCommonArray($commonArray)
	{
		$results = array();
		foreach($commonArray as $val)
		{
			$results[] = $val['id'];
		}
		return $results;
	}



	function getCommunitiesById($table_name='',$id = '', $field = 'user_id'){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();
		if(!empty($table_name))
		{
			$ci->db->select('*');
			if($field!='' && $id>0){
			$ci->db->where($field,$id);
			}
			$ci->db->order_by('id','desc');
			$ci->db->limit(3);
			$query = $ci->db->get($table_name);
			$results =  $query->result_array();
		}
		return $results;
	}


	function getcommunitypostsbyslug($id = ''){
		
		$ci =& get_instance();
		$ci->load->database();
		$results = array();
		if(!empty($id)){
			$ci->db->select('signup.*,community_posts.*');
			$ci->db->from('signup');
			$ci->db->join('community_posts', 'community_posts.user_id = signup.id AND community_posts.is_deleted="0"');
			$ci->db->where('community_posts.slug',$id);
			$ci->db->order_by('community_posts.id','desc');
		//	$ci->db->limit(3);
			$query = $ci->db->get();
			$results =  $query->result_array();
	}
		return $results;
	}

	
	function getcommunitypostsbyid($id = ''){
		
		$ci =& get_instance();
		$ci->load->database();
		$results = array();
		if(!empty($id)){
			$ci->db->select('signup.*,community_posts.*');
			$ci->db->from('signup');
			$ci->db->join('community_posts', 'community_posts.user_id = signup.id AND community_posts.is_deleted="0"');
			$ci->db->where('community_posts.id',$id);
			$ci->db->order_by('community_posts.id','desc');
		//	$ci->db->limit(3);
			$query = $ci->db->get();
			$results =  $query->result_array();
	}
		return $results;
	}


	function getAlldata($table_name , $limit='', $order_by='',$condition=''){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$ci->db->select('*');
		$ci->db->from($table_name);
		if($order_by){
			$ci->db->order_by($order_by);
		}	
		if($limit){
			$ci->db->limit($limit);
		}	
		if($condition){
			$ci->db->where('slug !=', $condition);
		}				
		$query = $ci->db->get();
		$results =  $query->result_array();
		return $results;
	}

	function getPeopleFollowAccordingToUserid($follower_id){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$query = $ci->db->query('SELECT * from signup where id not in (select follow_id from tbl_people_follow where follower_id = ' .$follower_id . ') order by id desc limit 4');
	
		$results =  $query->result_array();
		return $results;
	}

	function getcommunityFollowAccordingToUserid($follower_id){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$query = $ci->db->query('SELECT * from communitymaster where slug not in (select slug from tbl_community_follow where follower_id = ' .$follower_id . ') order by id desc limit 5');
	
		$results =  $query->result_array();
		return $results;
	}

	function getAdsBanner($ads_position = '',$limit = '3'){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();
		$ci->db->select('*');
		if($ads_position!='') {
		 $ci->db->where('ads_position',$ads_position);	
		}
		$ci->db->where('status','1');
		$ci->db->where('is_deleted','0');
		$ci->db->order_by('display_order','asc');
		$ci->db->limit($limit);
		$query = $ci->db->get('tbl_promotionaladvertising_msater');
		$results =  $query->result_array();
		return $results;
	}


	function getUserFollowedCommunities($follower_id){
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$query = $ci->db->query('SELECT * from communitymaster where slug in (select slug from tbl_community_follow where follower_id = ' .$follower_id . ') order by id desc limit 5');
	
		$results =  $query->result_array();
		return $results;
	}


	function getTotalPostlikesOfUser($user_id){
	
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$query = $ci->db->query('SELECT postID , likes from userPosts where user_id = ' .$user_id);
		$total = 0;
		$results =  $query->result_array();
        foreach($results as $result){
			$total = $total + $result['likes'];			
		}
		$response =  '';
		$response = $total>1 ? $total.' Likes' : $total.' Like';
		return $response;
	//	return $total;
	
	}

	function getTotalInvites($user_id){
	
		$ci =& get_instance();
		$ci->load->database();
		$results = array();
		$query = $ci->db->query('SELECT count(id) as totalCount from tbl_send_invites where status="1" AND is_deleted="0" AND user_id = ' .$user_id);
		$results =  $query->row_array();
		$total =  $results['totalCount'];
		$response =  '';
		$response = $total>1 ? $total.' Invites' : $total.' Invite';
		return $response;
	}


	function mynotifications($user_id){
	
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$ci->db->select('signup.*,tbl_notifications.*');
		$ci->db->from('tbl_notifications');
		$ci->db->join('signup' ,'signup.id = tbl_notifications.sender_id');
		$ci->db->where('tbl_notifications.receiver_id' , $user_id);
		$ci->db->where('tbl_notifications.sender_id !=' , $user_id);
		// if($order_by){
		$ci->db->order_by('tbl_notifications.created','DESC');
		// }	
		// if($limit){
		// 	$ci->db->limit($limit);
		// }	
		// if($condition){
		// 	$ci->db->where($condition);
		// }				
		$query = $ci->db->get();
		$results =  $query->result_array();
		return $results;
		
	}

	function getTotalcommunitypostByslug($slug){
	
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$query = $ci->db->query("SELECT count(id) as totalcount from community_posts where slug = '" .$slug. "'" );
	
		$results =  $query->row_array();

		$total = $results['totalcount'];
		
		return $total;
		
	}

	function getTotalPostlikesOfCommunity($slug){
	
		$ci =& get_instance();
		$ci->load->database();
		$results = array();

		$query = $ci->db->query("SELECT id , likes from community_posts where slug = '" .$slug."'");
		$total = 0;
		$results =  $query->result_array();
        foreach($results as $result){
			$total = $total + $result['likes'];			
		}
		
		return $total;
	//	return $total;
	
	}


function getlikesDetailsOfcommunityPosts($user_id,$postID)
{
   $CI =& get_instance();
   $CI->load->database();
   $result = $CI->db->select('*');
   $CI->db->where(array('user_id' => $user_id , 'postID' => $postID));;
   $row = $CI->db->get('likes_communityposts')->row_array();

   return $row;
    

}

function getuserpostcomments($user_id,$postID)
{
   $CI =& get_instance();
   $CI->load->database();
   $result = $CI->db->select('signup.*,tbl_comments_userposts.*');
   $CI->db->from('signup');
   $CI->db->join('tbl_comments_userposts','signup.id=tbl_comments_userposts.user_id');
   $CI->db->where(array('tbl_comments_userposts.postID' => $postID ,'tbl_comments_userposts.user_id' => $user_id));
   $CI->db->order_by('tbl_comments_userposts.id' , 'DESC');
   $CI->db->limit(1);
   $row = $CI->db->get()->row_array();

   return $row;
    

}


