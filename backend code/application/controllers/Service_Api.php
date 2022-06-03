<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

//composer require razorpay/razorpay:2.*;
require APPPATH. 'helpers/razorpay-php/razorpay-php/Razorpay.php';
//use Razorpay\Api\Api;


//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Razorpay\Api\Api;
//use Illuminate\Support\Str;
use Razorpay\Api\Errors\SignatureVerificationError;

//use Razorpay\Api\Errors\SignatureVerificationError;
//use Razorpay\Api\Api;

class Service_Api extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Login_model');
		$this->load->library('session');
		$this->load->library("form_validation");


		if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type');
            die();
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
		
	}
	public function login_post()
	{
		// $message = array(
		// 	'status' => TRUE,
		// 	'number' => 1,
		// 	'message' => 'Successfully login',
		// 	'data' => $_POST,
		// );
		// $this->set_response($message, REST_Controller::HTTP_OK);

		//$this->form_validation->set_rules('mobileNo', 'mobileNo', 'trim|required');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
	
		//unset($_POST['id']);
		//unset($_POST['table_name']);
		$digits = 4;
		$randomNumer=rand(pow(10, $digits-1), pow(10, $digits)-1);
		//print_r ($randomNumer);

		$table_name='users';
		$data =[
			'mobileNo' => $this->input->post('mobileNo'),
			'otp' => $randomNumer,
		];
		//print_r($data);
		if($result = $this->Login_model->loginCheck($data,$table_name)) {
			$this->otpSend($_POST['mobileNo'],$randomNumer);
			$message = array(
			'status' => true,
			'message' => 'Login successfully.',
			'number' => 1,
			//'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'Incorrect Mobile Number',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}	


		//if ($this->form_validation->run()) {
			// if ($result = $this->Login_model->loginCheck($_POST)) {
			// 	if ($result['status'] == 1) {
			// 		$this->session->set_userdata('adminLoggedIn', $result['email']);
			// 		$this->session->set_userdata('password', $result['password']);
			// 		// Get Assigned Module Name
			// 		// $moduleArray = $this->Login_model->getModuleList($result['moduleIds']);
			// 		// $this->session->set_userdata('moduleList', serialize($moduleArray));
			// 		// $this->Login_model->saveHistory('User logged in', $result['email']);
			// 		$message = array(
			// 			'status' => TRUE,
			// 			'number' => 1,
			// 			'message' => 'Successfully login',
			// 			'data' => $result,
			// 		);
			// 		$this->set_response($message, REST_Controller::HTTP_OK);
			// 	} else {
			// 		$message = array(
			// 			'status' => FALSE,
			// 			'number' => 2,
			// 			'message' => 'You are banned by admin!!',
			// 		);
			// 		$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
			// 		// $this->Login_model->saveHistory('Banned login attempt', $_POST['email']);
			// 	}
			// } else {
			// 	// $this->Login_model->saveHistory('Cant login User: ', $_POST['email']);
			// 	$message = array(
			// 		'status' => FALSE,
			// 		'number' => 3,
			// 		'message' => 'Incorrect Credentials',
			// 	);
			// 	$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
			// }
		// } 
		// else {
		// 	//$this->api->saveHistory('Cant login User: ', $_POST['email']);
		// 	$message = array(
		// 		'status' => FALSE,
		// 		'message' => 'Invalid Credentials',
		// 	);
		// 	$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		// }
	}




	// public function logintest_post()
	// {
	// 	$digits = 4;
	// 	$randomNumer=rand(pow(10, $digits-1), pow(10, $digits)-1);
	// 	$table_name='users';
	// 	$data =[
	// 		'mobileNo' => $this->input->post('mobileNo'),
	// 		'otp' => $randomNumer,
	// 	];
	// 	if($result = $this->Login_model->loginCheck($data,$table_name)) {
	// 		$this->otpSend($_POST['mobileNo'],$randomNumer);

	// 		$message = array(
	// 		'status' => true,
	// 		'message' => 'Login successfully.',
	// 		'number' => 1,
	// 		//'data' => $result,
	// 		);
	// 		$this->set_response($message, REST_Controller::HTTP_OK);
	// 	}else {
	// 		$message = array(
	// 			'status' => FALSE,
	// 			'number' => 2,
	// 			'message' => 'Incorrect Mobile Number',
	// 		);
	// 		$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
	// 	}	
	// }



	public function otpSend($mobileNo,$otp){
		//$apiKey = urlencode('Your apiKey');
		$apiKey = urlencode('ZvH4+r8YRX4-7PT4kyvc4AtPoOrhk8nx8bhwxZZrU2');
	
		$mobile = 910000000000+$mobileNo;
		// Message details
	
		//$numbers = array(918123456789, 918987654321);
		
		$numbers = array($mobile);
		$sender = urlencode('BROOME');
		//$message = rawurlencode('This is your Aqua Van Login OTP '.$otp.' message.');
		$message = rawurlencode("Your OTP for registering on BROOMEES is $otp. Do not share this with anyone.");
		
		$numbers = implode(',', $numbers);
	
		// Prepare data for POST request
		$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	
		// Send the POST request with cURL
		$ch = curl_init('https://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		// Process your response here
		echo $response;
	}



	public function loginOtpVerify_post()
	{
		$table_name='users';
		$data =[
			'mobileNo' => $this->input->post('mobileNo'),
			'otp' => $this->input->post('otp'),
		];
		if($result = $this->Login_model->loginOtpCheck($data,$table_name)) {
			$message = array(
			'status' => true,
			'message' => 'Login successfully.',
			'number' => 1,
			'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'Incorrect Mobile Number',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}	
	}





	public function signup_post()
	{
		$digits = 4;
		$randomNumer=rand(pow(10, $digits-1), pow(10, $digits)-1);
		//print_r ($randomNumer);

		$this->load->helper('string');
		$referralCode = random_string('alnum',5);

		$table_name='users';
		//unset($_POST['id']);
		//unset($_POST['table_name']);
		$data =[
			'name' => $this->input->post('name'),
			'mobileNo' => $this->input->post('mobileNo'),
			'userReferralId' => $this->input->post('userReferralId'),
			'otp' => $randomNumer,
			'referralCode' => $referralCode,
			
		];
		//print_r($data);

		if($result = $this->Login_model->signupCheck($data,$table_name)) {	
			$this->otpSend($_POST['mobileNo'],$randomNumer);
			$message = array(
			'status' => true,
			'message' => 'Data created successfully.',
			'number' => 1,
			//'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}
		else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'Mobile Numer Already Exist.',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	


		// if ($_POST['id'] != '0') { 
		//    $tableName=$_POST['table_name'];
		// 		unset($_POST['table_name']);
		// 	  $this->Api_model->editData($_POST, $tableName);
		// 	  $message = array(
		// 		 'status' => true,
		// 		 'message' => 'Data updated successfully.',
		// 	  );
		// 	  $this->set_response($message, REST_Controller::HTTP_OK);  
		// } 
		// else {
		// 	  unset($_POST['id']);
		// 	  unset($_POST['table_name']);
		// 	  $this->Api_model->insertData($_POST,$table_name);
		// 	  $message = array(
		// 		 'status' => true,
		// 		 'message' => 'Data created successfully.',
		// 	  );
		// 	  $this->set_response($message, REST_Controller::HTTP_OK);
		// }
  
	 }


	 public function userprofile_post()
	 {
		$table_name='users';
		$data =[
			'id' => $this->input->post('id'),
		];
		//print_r($data);
		if($result = $this->Login_model->userDataFetch($data,$table_name)) {
			$message = array(
			'status' => true,
			'message' => 'User Data Fetch Successfully.',
			'number' => 1,
			'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'User Data Not Fetch',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}	
	}


	public function userupdateprofile_post()
	{
		$table_name='users';
		$data =[
			'name' => $this->input->post('name'),
			'mobileNo' => $this->input->post('mobileNo'),
		];
		if($result = $this->Login_model->userUpdateProfile($data,$table_name)) {	
			$message = array(
			'status' => true,
			'message' => 'Data updated successfully.',
			'number' => 1,
			//'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}
		else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'Mobile Numer Already Exist.',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	 }

	 
	 public function useraddress_post()
	 {
		 $table_name='address';
		 $data =[
			 'userId' => $this->input->post('userId'),
			 'streetAddress' => $this->input->post('streetAddress'),
			 'houseNo' => $this->input->post('houseNo'),
			 'roadArea' => $this->input->post('roadArea'),
			 'nearRingRoad' => $this->input->post('nearRingRoad'),
			 'homeType' => $this->input->post('homeType'),
			 'latLng' => $this->input->post('latLng'),
			 'selectedAddress' => 1,
		 ];
		 if($result = $this->Login_model->userAddressCreated($data,$table_name)) {	
			 $message = array(
			 'status' => true,
			 'message' => 'Address created successfully.',
			 'number' => 1,
			 'id' => $result,
			 );
			 $this->set_response($message, REST_Controller::HTTP_OK);
		 }

		 else {
			 $message = array(
				 'status' => FALSE,
				 'number' => 2,
				 'message' => 'error',
			 );
			 $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		 }
	  }

	  
	  public function addressfetch_post()
	  {
		  $data =[
			  'tableName' => $this->input->post('tableName'),
			  'userId' => $this->input->post('userId'),
			//   'tableName' => "address",
			//   'id' => 47,
		  ];
		  if($result = $this->Login_model->userAddressFetchAll($data)) {	
			  $message = array(
			  'status' => true,
			  'message' => 'Address fetch successfully.',
			  'number' => 1,
			  'data' => $result,
			  );
			  $this->set_response($message, REST_Controller::HTTP_OK);
		  }
		  else {
			  $message = array(
				  'status' => FALSE,
				  'number' => 2,
				  'message' => 'error',
			  );
			  $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		  }
	   }

	   

	  public function deleterecyclerviewitem_post()
	  {
		  $data =[
			  'id' => $this->input->post('id'),
			  'tableName' => $this->input->post('tableName'),
		  ];
		  if($result = $this->Login_model->deleteRecyclerViewItem($data)) {	
			  $message = array(
			  'status' => true,
			  'message' => 'Recycler View Item Deleted successfully.',
			  'number' => 1,
			  //'data' => $result,
			  );
			  $this->set_response($message, REST_Controller::HTTP_OK);
		  }
		  else {
			  $message = array(
				  'status' => FALSE,
				  'number' => 2,
				  'message' => 'error',
			  );
			  $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		  }
	   }

	   
	   public function updaterecyclerviewitem_post()
	   {
		   $data =[
			   'id' => $this->input->post('id'),
			   'tableName' => $this->input->post('tableName'),
			   'houseNo' => $this->input->post('houseNo'),
			   'roadArea' => $this->input->post('roadArea'),
			   'nearRingRoad' => $this->input->post('nearRingRoad'),
			   'homeType' => $this->input->post('homeType'),
		   ];

		   if($result = $this->Login_model->updateRecyclerViewItem($data)) {	
			   $message = array(
			   'status' => true,
			   'message' => 'Address Updated successfully.',
			   'number' => 1,
			   //'data' => $result,
			   );
			   $this->set_response($message, REST_Controller::HTTP_OK);
		   }
		   else {
			   $message = array(
				   'status' => FALSE,
				   'number' => 2,
				   'message' => 'error',
			   );
			   $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		   }
		}


		// public function orderplace_post()
		// {
		// 	$digits = 6;
		// 	$orderNumer=rand(pow(10, $digits-1), pow(10, $digits)-1);

		// 	$table_name='order';
		// 	$data =[
		// 		'userId' => $this->input->post('userId'),
		// 		'addressId' => $this->input->post('addressId'),
		// 		'amount' => $this->input->post('amount'),
		// 		'quantity' => $this->input->post('quantity'),
		// 		'orderNo' => $orderNumer,
		// 	];
			
		// 	if($result = $this->Login_model->userOrder($data,$table_name)) {	
		// 		$message = array(
		// 		'status' => true,
		// 		'message' => 'Order Successfull.',
		// 		'number' => 1,
		// 		//'data' => $result,
		// 		);
		// 		$this->set_response($message, REST_Controller::HTTP_OK);
		// 	}
		// 	else {
		// 		$message = array(
		// 			'status' => FALSE,
		// 			'number' => 2,
		// 			'message' => 'Order Not Successfull.',
		// 		);
		// 		$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		// 	}
		//  }





		//  public function orderplace_post(){
		// 	//$workerLatLng=$_GET['workerlatlng'];
		// 	//$data = [];
			
		// 	$digits = 6;
		// 	$orderNumer=rand(pow(10, $digits-1), pow(10, $digits)-1);
		// 	$table_name='order';
		// 	$data =[
		// 		'userId' => $this->input->post('userId'),
		// 		'addressId' => $this->input->post('addressId'),
		// 		'amount' => $this->input->post('amount'),
		// 		'quantity' => $this->input->post('quantity'),
		// 		'orderNo' => $orderNumer,
		// 	];

		// 	//$result = $this->api->getBookingsRecordsForWorkerApply($_GET['workerId'],$_GET['serviceId']);
		// 	$result = $this->Login_model->userOrder($data,$table_name)
			
		// 	if($result){
		// 	   foreach ($result as $row){
		// 		  $bookingAddress=json_decode($row['address'],true);
		// 		  if(isset($bookingAddress['latlng']) && $bookingAddress['latlng']!=","){
		// 			  $distance = $this->distanceBooking(explode(",",$workerLatLng)[0],explode(",",$workerLatLng)[1],explode(",",$bookingAddress['latlng'])[0],explode(",",$bookingAddress['latlng'])[1],'K');
		// 			 if($distance<100){
		// 			   $row['distance'] =$distance;
		// 			   array_push($data,$row);
		// 			  }
		// 		  }
		// 	   }
		// 	   array_multisort(array_column($data, 'distance'), SORT_ASC, $data);
		// 	   $message = array(
		// 		  'status' => true,
		// 		  'data'=>$data,
		// 		  'message' => 'Data successfully fetched',
		// 	   );
		// 	   $this->set_response($message, REST_Controller::HTTP_OK);
		// 	}else{
		// 	   $message = array(
		// 		  'status' => false,
		// 		  'message' => 'No Data Found',
		// 	   );
		// 	   $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		// 	}
		//  }


		public function orderplace_post() {
			//$userAddressLatLng = '28.474388,77.503990';
			$userAddressLL = $this->Login_model->getUserAddressLatLng( $_POST['addressId'], 'address' );
			$userAddressLatLng = $userAddressLL['latLng'];
			// print_r($userAddressLatLng);
			// die;
			$res = [];
			$result = $this->Login_model->getCommonRecords( null, 'suppliers' );
			$min = 100000;
			$minId = 0;
			//print_r(explode( ',', $userAddressLatLng )[ 0 ]);
			//print_r(explode( ',', $userAddressLatLng )[ 1 ]);
			//die;
			foreach ( $result as $r ) {
				if ( $r[ 'availableBottle' ] > $_POST[ 'quantity' ]) {
					// print_r(explode( ',', $r[ 'location' ] )[ 0 ]);
					// print_r(explode( ',', $r[ 'location' ] )[ 1 ]);
					// die;
					////&& $r[ 'rangeLocation' ] == 15 
					$distance = $this->distanceBooking( explode( ',', $userAddressLatLng )[ 0 ], explode( ',', $userAddressLatLng )[ 1 ], explode( ',', $r[ 'location' ] )[ 0 ], explode( ',', $r[ 'location' ] )[ 1 ], 'K' );
					// print_r($distance);
				    // die;
					array_push( $res, $r[ 'id' ]);
					if($distance < $min){
						$min = $distance;
						$minId = $r[ 'id' ];   
					
					}    			 
				}
			}
			// print_r($res);
            // print_r($minId);
			// die;
			

			if($minId != 0)
			{
				$digits = 6;
				$orderNumer = rand( pow( 10, $digits-1 ), pow( 10, $digits )-1 );
				$data =[
					'userId' => $this->input->post('userId'),
					'addressId' => $this->input->post('addressId'),
					'amount' => $this->input->post('amount'),
					'quantity' => $this->input->post('quantity'),
					'orderNo' => $orderNumer,
					'supplierId' => $minId,
				];
                // print_r($data);
			    // die;
			
				if($result = $this->Login_model->userOrderSuccessfully($data,'order')) {	
					$message = array(
					'status' => true,
					'message' => 'Order Successfull.',
					'number' => 1,
					//'data' => $result,
					);
					$this->set_response($message, REST_Controller::HTTP_OK);
				}
				else {
					$message = array(
						'status' => FALSE,
						'number' => 2,
						'message' => 'Order Not Successfull.',
					);
					$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
				}
                // print_r($data);
			    // die;
			}	
		}



	 // 5:32
	  public function distanceBooking($lat1, $lon1, $lat2, $lon2, $unit) {
		  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
			return 0;
		  }
		  else {
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$unit = strtoupper($unit);
			if ($unit == "K") {
			  return ($miles * 1.609344);
			} else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
			  return $miles;
			}
		  }
		}




		
		public function userwallet_post()
		{
		   $data =[
			   'id' => $this->input->post('id'),
			   'tableName' => $this->input->post('tableName'),
		   ];
		   //print_r($data);
		   if($result = $this->Login_model->userDataFetchById($data)) {
			   $message = array(
			   'status' => true,
			   'message' => 'User Data Fetch Successfully.',
			   'number' => 1,
			   'data' => $result,
			   );
			   $this->set_response($message, REST_Controller::HTTP_OK);
		   }else {
			   $message = array(
				   'status' => FALSE,
				   'number' => 2,
				   'message' => 'User Data Not Fetch',
			   );
			   $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		   }	
	   }


	   public function orderfetch_post()
	   {
			$data =[
				'userId' => $this->input->post('userId'),
				'tableName' => $this->input->post('tableName'),
			];
			//print_r($data);
			if($result = $this->Login_model->orderDataFetchByUserId($data)) {
				$message = array(
				'status' => true,
				'message' => 'Your All Order Fetch Successfully.',
				'number' => 1,
				'data' => $result,
				);
				$this->set_response($message, REST_Controller::HTTP_OK);
			}else {
				$message = array(
					'status' => FALSE,
					'number' => 2,
					'message' => 'User Data Not Fetch',
				);
				$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
			}	
		}


		
		public function fetchordersummary_post()
		{
			$data =[
				'orderId' => $this->input->post('orderId'),
				'addressId' => $this->input->post('addressId'),
				'orderTableName' => $this->input->post('orderTableName'),
				'addressTableName' => $this->input->post('addressTableName'),
			];
			//print_r($data);
			if($result = $this->Login_model->getCommonRecordsJoin($data)) {
				$message = array(
				'status' => true,
				'message' => 'Your All Order Fetch Successfully.',
				'number' => 1,
				'data' => $result,
				);
				$this->set_response($message, REST_Controller::HTTP_OK);
			}else {
				$message = array(
					'status' => FALSE,
					'number' => 2,
					'message' => 'User Data Not Fetch',
				);
				$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
			}	

		}


		
		public function checkreferralcode_post()
		{
		   $data =[
			    'tableName' => $this->input->post('tableName'),
			    'referralCode' => $this->input->post('referralCode'),
			    // 'tableName' => "users",
			    // 'referralCode' => "JG71Z",
		   ];
		   if($result = $this->Login_model->userDataFetchByRefferralCode($data)) {
			   unset($result['userReferralId']);
			   $message = array(
			   'status' => true,
			   'message' => 'User Data Fetch Successfully.',
			   'number' => 1,
			   'data' => $result,
			   );
			  // $response = '200';
			   $this->set_response($message, REST_Controller::HTTP_OK);
		   }else {
			   $message = array(
				   'status' => FALSE,
				   'number' => 2,
				   'message' => 'User Data Not Fetch',
			   );
			   $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		   }	
	   }


	   public function referralstatusfetch_post()
	   {
		   $data =[
			   'tableName' => $this->input->post('tableName'),
			   'userId' => $this->input->post('userId'),
			     //'tableName' => "users",
			     //'userId' => 47,
		   ];
		   if($result = $this->Login_model->referralStatusFetch($data)) {	
			   $message = array(
			   'status' => true,
			   'message' => 'Data updated successfully.',
			   'number' => 1,
			   'data' => $result,
			   );
			   $this->set_response($message, REST_Controller::HTTP_OK);
		   }
		   else {
			   $message = array(
				   'status' => FALSE,
				   'number' => 2,
				   'message' => 'Mobile Numer Already Exist.',
			   );
			   $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		   }
		}


		
		public function userRazorpayOrder_post()
		{
			$data =[
				'amount' => $this->input->post('amount'),
			];
			$api_key = 'rzp_test_dAP0orCNqNnBd4';
			$api_secret = 'LMKQyieQ4iFQE2xovFvvqfyA';
			$api = new Api($api_key, $api_secret);
			
			//$result = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'rzp_test_dAP0orCNqNnBd4','key2'=> 'LMKQyieQ4iFQE2xovFvvqfyA')));
			$orderData = [
				'receipt'         => '123',
				'amount'          => 1000, // 39900 rupees in paise
				'currency'        => 'INR'
			];
			
			$razorpayOrder = $api->order->create($orderData);
			// print_r($razorpayOrder);
			// die;
			$id=$razorpayOrder['id'];
			$entity=$razorpayOrder['entity'];
			$amount=$razorpayOrder['amount'];

			//print_r($order_id);
			//die;
			//$json = json_encode($razorpayOrder);
			//echo $json;
			//die;
			if($razorpayOrder) {	
				$message = array(
				'status' => true,
				'message' => 'Razorpay order id genrated',
				'number' => 1,
				'id' => $id,
				'entity' => $entity,
				'amount' => $amount,
				);
				$this->set_response($message, REST_Controller::HTTP_OK);
			}
			else {
				$message = array(
					'status' => FALSE,
					'number' => 2,
					'message' => 'Mobile Numer Already Exist.',
				);
				$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
			}
		 }



		 
		public function userRazorpayPayment_post()
	    {
			$tableName='transactions';
		    $data =[
			   'userId' => $this->input->post('userId'),
			   'amount' => $this->input->post('razorpayAmount'),
			   'orderId' => $this->input->post('razorpayOrderId'),
			   'paymentId' => $this->input->post('razorpayPaymentId'),
			   'status' => $this->input->post('status'),
			   'currency' => $this->input->post('currency'),
			
		    ];
			
		   if($this->Login_model->userPaymentCreated($data,$tableName)) {	
			   $message = array(
			   'status' => true,
			   'message' => 'Transaction Data Added Successfully.',
			   'number' => 1,
			   //'data' => $result,
			   );
			   $this->set_response($message, REST_Controller::HTTP_OK);
		   }
		   else {
			   $message = array(
				   'status' => FALSE,
				   'number' => 2,
				   'message' => 'Transaction Dat Not Added Successfully.',
			   );
			   $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		   }
		}


	public function fetchSelectedAddress_post()
	{
		
		$data =[
			'tableName' => $this->input->post('tableName'),
			'userId' => $this->input->post('userId'),
		];
		if($result = $this->Login_model->selectedAddress($data)) {
			$message = array(
			'status' => true,
			'message' => 'Fetch Selected Address Successfully.',
			'number' => 1,
			'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'Not Fetch Selected Address.',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}	
	}


	public function setSelectedAddress_post()
	{
		
		$data =[
			'tableName' => $this->input->post('tableName'),
			'userId' => $this->input->post('userId'),
			'addressId' => $this->input->post('addressId'),
		];
		if($result = $this->Login_model->setSelectedAddress($data)) {
			$message = array(
			'status' => true,
			'message' => 'Set Selected Address Successfully.',
			'number' => 1,
			//'data' => $result,
			);
			$this->set_response($message, REST_Controller::HTTP_OK);
		}else {
			$message = array(
				'status' => FALSE,
				'number' => 2,
				'message' => 'Not Fetch Selected Address.',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}	
	}

	











}