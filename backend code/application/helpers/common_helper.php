<?php

//generate otp

function generate_otp() {
	return rand(111111, 999999);
}

function send_sms($mob, $msg = '') {
	if (ENVIRONMENT == 'development') {
		//return TRUE;
	}
	//$mob='91'.$mob;
	$msg = urlencode($msg);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "feedid=363901&username=9015129267&password=wgtpt&To=" . $mob . "&Text=" . $msg . "&time=&senderid=shardacom_trans");
	$buffer = curl_exec($ch);
	//$err = curl_error($ch);
	//echo $err;
	curl_close($ch);
}

function send_email_pepipost($to_emails, $subject, $message, $fromname = '', $fromemail = '', $replyto = '') {
	$fromname = $fromname ? $fromname : 'Pennydia';
	$fromemail = $fromemail ? $fromemail : 'enquiry@shardahospital.org'; //'info@shardauniversity.com';
	$replyto = $replyto ? $replyto : 'enquiry@shardahospital.org'; //'info@shardauniversity.com';

	if (!$to_emails) {
		return;
	}
	if (is_string($to_emails)) {
		$to_emails = explode(",", $to_emails);
	}
	foreach ($to_emails as $to) {
		$d = array(
			'personalizations' => array(0 => array('recipient' => $to)),
			'from' => array('fromEmail' => $fromemail, 'fromName' => $fromname),
			'replyToId' => $replyto,
			'subject' => $subject,
			'content' => $message,
		);
		$email_jason_data = json_encode($d);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $email_jason_data,
			CURLOPT_HTTPHEADER => array(
				//"api_key: c77184012dcf9bd5cd1886b4e0a2bb89",
				"api_key: aab3f77715e90569034f0c6e5d912714",
				"content-type: application/json",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			//echo "cURL Error #:" . $err;
		} else {
			//echo $response;
		}
	}
}

function send_email($to, $subject, $message, $attachments = array(), $smtp = TRUE, $smtpdtl = array()) {
	//if (ENVIRONMENT == 'development') {
	//return TRUE;
	//}
	// send_email_pepipost($to, $subject, $message);
	// return 1;

	if (!$smtpdtl) {
		$smtpdtl = array(
			'host' => 'smtpout.secureserver.net',
			'user' => 'invite@pennydia.com', //'admissions@sharda.ac.in',
			'pass' => 'Pennydia110', //'SU@lp2015',
			'port' => '465',
		);
	}

	$fromname = "Pennydia";
	$fromemail = "invite@pennydia.com";

	$CI = &get_instance();
	$CI->load->library('email');
//	$mail=$CI->email;
	$CI->email->clear();

	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';

	if ($smtp) {
		$config['protocol'] = "smtp";
		$config['smtp_host'] = $smtpdtl['host'];
		$config['smtp_user'] = $smtpdtl['user'];
		$config['smtp_pass'] = $smtpdtl['pass'];
		$config['smtp_port'] = $smtpdtl['port'];
		$config['smtp_crypto'] = 'ssl';
		$config['_auth_smtp'] = TRUE;
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
	}

	$CI->email->initialize($config);

	$CI->email->from($fromemail, $fromname);
	$CI->email->to($to);
	$CI->email->reply_to('hello@pennydia.com', $fromname);

	$CI->email->subject($subject);
	$CI->email->message($message);

	if ($attachments and is_array($attachments)) {
		foreach ($attachments as $f) {
			$CI->email->attach($f);
		}
	}

	$res = $CI->email->send();
	//echo $mail->print_debugger();
	return $res;
}

// public function getAllPosts(){
// 	$this->db->select('signup.*,userPosts.*');
// 	$this->db->from('signup');
// //	$this->db->join('userPosts', 'signup.id = userPosts.user_id');
// 	$this->db->join('userPosts', 'userPosts.user_id = signup.id');
// 	$this->db->order_by('userPosts.postID','DESC');
// 	$this->db->limit(10);
// 	$query = $this->db->get();

// 	return $query->result_array();
// }

function activepageurl() {
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
		$url = "https://";
	} else {
		$url = "http://";
	}
	// Append the host(domain name, ip) to the URL.
	$url .= $_SERVER['HTTP_HOST'];
	// Append the requested resource location to the URL
	$url .= $_SERVER['REQUEST_URI'];
	return $url;
}

function getTheDay($date) {
	$curr_date = strtotime(date("Y-m-d H:i:s"));
	$the_date = strtotime($date);
	$diff = floor(($curr_date - $the_date) / (60 * 60 * 24));
	switch ($diff) {
	case 0:
		return date('H:i:s', $the_date);
		break;
	case 1:
		return "Yesterday";
		break;
	default:
		return $diff . " Days ago";
	}
}

//get ago
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) {
		$string = array_slice($string, 0, 1);
	}

	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

//[Rewritten using left join]
function getlikesDetails($user_id, $postID) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('*');
	$CI->db->where(array('userId' => $user_id, 'postId' => $postID));
	$row = $CI->db->get('likes')->row_array();
	return $row;
}

//[Rewritten using left join]
function getCommentlikesDetails($user_id, $comment_id) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('*');
	$CI->db->where(array('user_id' => $user_id, 'comment_id' => $comment_id));
	$row = $CI->db->get('tbl_likes_comments_userposts')->row_array();
	return $row;
}

function getCommentlikesDetailscommunity($user_id, $comment_id) {
	$CI = &get_instance();
	$CI->load->database();
	$result = $CI->db->select('*');
	$CI->db->where(array('user_id' => $user_id, 'comment_id' => $comment_id));
	$row = $CI->db->get('tbl_likes_comments_communityposts')->row_array();
	return $row;
}

function FORGOTOTPSMS($mobile_num, $otp) {
	$mobile = '91' . $mobile_num;
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.msg91.com/api/v5/otp?authkey=307460AvXGlfGNIqz5debd07c&template_id=5e9d6626d6fc054266009732&extra_param=&mobile=$mobile&invisible=1&otp=$otp&userip=IPV4%20User%20IP&email=Email%20ID&otp_length=&otp_expiry=",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_HTTPHEADER => array(
			"content-type: application/json",
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$response = "cURL Error #:" . $err;
	}
	return $response;

}

function DEMOSMS($mobile_num, $otp) {
	$mobile = '91' . $mobile_num;
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.msg91.com/api/v5/otp?authkey=307460AvXGlfGNIqz5debd07c&template_id=5f3e5899d6fc05270c49db67&extra_param=&mobile=$mobile&invisible=1&otp=$otp&userip=IPV4%20User%20IP&email=Email%20ID&otp_length=&otp_expiry=",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_HTTPHEADER => array(
			"content-type: application/json",
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$response = "cURL Error #:" . $err;
	}
	return $response;
}

function SIGNUPOTPSMS($mobile, $message) {
	// "9af9d1aad6f0c8cad1b16bf944599e940ab655bef62ed246ca2b0a1d543658cc"
	// "ZvH4+r8YRX4-7PT4kyvc4AtPoOrhk8nx8bhwxZZrU2"
	// Authorisation details.
	$username = "broomees@gmail.com";
	$hash = "9af9d1aad6f0c8cad1b16bf944599e940ab655bef62ed246ca2b0a1d543658cc";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers = $mobile; // A single number or a comma-seperated list of numbers
	//$message = "This is a test message from the PHP API script.";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	$err = curl_error($ch);
	curl_close($ch);

	if ($err) {
		$result = "cURL Error #:" . $err;
	}
	return $result;
}

function INVITESMS($mobile_num) {
	$mobile = '91' . $mobile_num;
	# Setup request to send json via POST.
	$payload = json_encode(array("flow_id" => "5f411650d6fc0521ab6775c9", "sender" => "SMSIND", "recipients" => array(array("mobiles" => $mobile))));

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $payload,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_HTTPHEADER => array(
			"authkey: 307460AvXGlfGNIqz5debd07c",
			"content-type: application/json",
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$response = "cURL Error #:" . $err;
	}
	return $response;
	//return $payload;
}

?>