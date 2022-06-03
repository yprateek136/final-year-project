<?php
//startModel
defined('BASEPATH') or exit('No direct script access allowed');
class Login_model extends CI_Model
{
   function __construct()
   {
      parent::__construct();
	  $this->load->helper('url');
      $this->load->database();
	  
   }
	
   public function loginCheck($data,$table_name) {
	   //print_r($data);

	// $updateData = [
	// 	'otp' => $data['otp'],
	// ];
	$this->db->set('otp',$data['otp']);
	//$this->db->select("*");
	$this->db->where('mobileNo',$data['mobileNo']);
	$query = $this->db->get($table_name);
	
	//$query->row();
	  if($query->num_rows() > 0){
			$this->db->where('mobileNo',$data['mobileNo']);
			if($this->db->update($table_name))
			return true;
		}else {
			return false;
	}
		// $mobileNumber = $data['mobileNo'];
		// $this->db->where("mobileNo",$mobileNumber);
		// if($this->db->update($table_name,array('otp' => $data['otp'])))
		// {
		// 	return true;
		// }
		// else 
		// {
		// 	return false;
		// }


		// $this->db->select("*");
		// $this->db->where($data);
		// $this->db->from('admin_login');
		// $result = $this->db->get();
		// $resultArray = $result->row_array();
		// if ($result->num_rows() > 0) {
		// 	$this->db->where('id', $resultArray['id']);
		// 	$this->db->update('admin_login', array('lastLogin' => date('Y-m-d H:i:s')));
		// }
		// return $resultArray;
	}


	public function loginOtpCheck($data,$table_name) {
		$this->db->select("*");
		$this->db->where('mobileNo',$data['mobileNo']);
		$this->db->where('otp',$data['otp']);
		$query = $this->db->get($table_name);
		$resultArray = $query->row_array();
		$query->row();
		if($query->row_array()){
			return $resultArray;
		}
	}


	 public function signupCheck($data,$table_name) {
		$this->db->select("*");
		$this->db->where('mobileNo',$data['mobileNo']);
		$query = $this->db->get($table_name);
		$query->row();
		if($query->row_array() == 0){
				if ($this->db->insert($table_name,$data))
				return true;
			}else {
				return false;
			}

	 	}

	
	
		 public function userDataFetch($data,$table_name) {
			$this->db->select("*");
			//$this->db->from($table_name);
		    $this->db->where('id',$data['id']);
			$result = $this->db->get($table_name);
		    $resultArray = $result->row_array();
		    if ($result->num_rows() > 0) {
		    	//$this->db->where($whr);
		    }
		   return $resultArray;
		}


		public function userUpdateProfile($data,$table_name) {
			$this->db->set('name',$data['name']);
			$this->db->where('mobileNo',$data['mobileNo']);
			$query = $this->db->get($table_name);
	   	    if($query->num_rows() > 0){
					$this->db->where('mobileNo',$data['mobileNo']);
					if($this->db->update($table_name))
					return true;
				}else {
					return false;
			}
		
		////print_r($data);
		//  $this->db->select("*");
		//   $this->db->where('mobileNo',$data['mobileNo']);
		// 	$result = $this->db->get($table_name);
		//     $resultArray = $result->row_array();
		//     if ($result->num_rows() > 0) {
		// 		$this->db->where('mobileNo',$data['mobileNo']);
		// 		 if($this->db->update($table_name,$data));
		// 		 return true;
		// 	 }else {
		// 		 return false;
		//  	}

		}

		public function userAddressCreated($data,$table_name) {
            $this->db->select("*");
            $this->db->where('userId',$data['userId']);
            $this->db->where('isDeleted',0);
            $update_rows = array('selectedAddress' => 0);
            $this->db->update('address', $update_rows);
            $result = $this->db->get('address');
		    if($result->num_rows() > 0)
            {
				if($this->db->insert($table_name,$data)){
                    $insertId = $this->db->insert_id();
                    return $insertId;
                }
			}    
		}

		public function getUserAddressLatLng($addressId,$tableName) {
			$this->db->select("*");
		    $this->db->where('id',$addressId);
			$this->db->where('isDeleted',"0");
			$result = $this->db->get($tableName);
			return $result->row_array();

			// if($result->num_rows() > 0){
			// 	$this->db->where('id',$addressId);
			// 	$this->db->where('isDeleted',"0");
			// 	return $this->db->get()->row()->latLng;
			// }
		}
		
		public function userAddressFetchAll($data) {
			$this->db->select("*");
		    $this->db->where('userId',$data['userId']);
			$this->db->where('isDeleted',"0");
			$result = $this->db->get($data['tableName']);
			if($result->num_rows() > 0){
				$this->db->where('userId',$data['userId']);
				$this->db->where('isDeleted',"0");
				$resultArray = $result->result_array();
				return $resultArray;
			}
		}

		
		public function deleteRecyclerViewItem($data) {
			$this->db->set('isDeleted',"1");
			//$this->db->select("*");
			$this->db->where('id',$data['id']);
			$query = $this->db->get($data['tableName']);
			if($query->num_rows() > 0){
					$this->db->where('id',$data['id']);
					if($this->db->update($data['tableName']))
					return true;
				}else {
					return false;
			}
		}

		
		public function updateRecyclerViewItem($data) {
			$this->db->set('houseNo',$data['houseNo']);
			$this->db->set('roadArea',$data['roadArea']);
			$this->db->set('nearRingRoad',$data['nearRingRoad']);
			$this->db->set('homeType',$data['homeType']);
			//$this->db->select("*");
			$this->db->where('id',$data['id']);
			$query = $this->db->get($data['tableName']);
			if($query->num_rows() > 0){
					$this->db->where('id',$data['id']);
					if($this->db->update($data['tableName']))
					return true;
				}else {
					return false;
			}
		}


        public function setSelectedAddress($data) {
			$this->db->select("*");
            $this->db->where('userId',$data['userId']);
            //$this->db->where('isDeleted',0);
            //$this->db->set('selectedAddress',0);
            $update_rows = array('selectedAddress' => 0);
            $this->db->update('address', $update_rows);
			//$this->db->update($data['tableName']);
            $result = $this->db->get($data['tableName']);
		    if($result->num_rows() > 0)
            {
				$this->db->where('id',$data['addressId']);
                $this->db->set('selectedAddress',1);
				if($this->db->update($data['tableName']))
                    $resultArray = $result->result_array();
                    return $resultArray;
			}
		}


        public function selectedAddress($data) {
			$this->db->select("*");
            $this->db->where('userId',$data['userId']);
            $this->db->where('selectedAddress',1);
			$result = $this->db->get($data['tableName']);
		    if($result->num_rows() > 0)
            {
                $resultArray = $result->result_array();
				return $resultArray;
			}
		}


		
		public function userDataFetchById($data) {
			$this->db->select("*");
			//$this->db->from($table_name);
		    $this->db->where('id',$data['id']);
			$result = $this->db->get($data['tableName']);
		    $resultArray = $result->row_array();
		    if ($result->num_rows() > 0) {
		    	//$this->db->where($whr);
		    }
		   return $resultArray;
		}
	 
	
		// public function userOrder($data,$table_name) {
		
		// 	if($this->db->insert($table_name,$data)){
		// 	$userData=$this->getCommonRecords($data['userId'],'users')[0];
		// 		$aquaCo=$userData['aquaCoin']-$data['amount'];
		// 		$this->db->where("id",$data['userId']);
		// 		$this->db->update('users',array("aquaCoin"=>$aquaCo));
		// 	}
		// 	return true;		
		// }

			public function userOrderSuccessfully($data,$table_name) {
				if($this->db->insert($table_name,$data)){
					$walletData = array(
						'userId' => $data['userId'],
						'amount' => $data['amount'],
						'transactionId' => "2344242",
						'status' => "debit",
						'currency' => "INR",
					);
					if($this->db->insert('wallet',$walletData))
					{
						$userData=$this->getCommonRecords($data['userId'],'users')[0];
						$aquaCo=($userData['aquaCoin']-$data['amount']);
						$this->db->where("id",$data['userId']);
						$this->db->update('users',array("aquaCoin"=>$aquaCo));
					}		
				}
				return true;		
			}


		public function userOrder($data,$table_name) {
			// print_r($data);
			// die;
			// $tb1=$data['orderTableName'];
			// $tb2=$data['addressTableName'];
			// $tb1C=$data['orderId'];
			// $tb2C=$data['addressId'];
			$tb1="order";
			$tb2="address";
			$tb1C="addressId";
			$tb2C="id";
			$id = NULL;
			$order='id';

					//	, $tb1C,, $tb2C,$id = NULL,$order='id'

			$this->db->select($tb1 . ".*, " . $tb2 . ".*");
			$this->db->from($tb1);
			$this->db->join($tb2, $tb1 . '.' . $tb1C . '=' . $tb2 . '.' . $tb2C.' AND ' .$tb1. '.id="8"');
			//$this->db->join('address', 'order.addressId = address.id');
			if ($id > 0) {
				$this->db->where($tb1 . '.id', $id);
			}
			$this->db->order_by($tb1.'.'.$order);
			$queryResult = $this->db->get();
			 //return $this->db->last_query();
			return $queryResult->result_array();
		}


		 
		function getCommonRecords($id = NULL, $tbl_name = 'su_videos', $limit = 0, $order_by = '') {
			$this->db->select('*');
			$this->db->where('isDeleted', '0');
			$this->db->where('status', '1');
			if ($id > 0) {
				$this->db->where('id', $id);
			}
			if ($order_by != '') {
				foreach ($order_by as $key => $val) {
					$this->db->order_by($key, $val);
				}
			}
			if ($limit > 0) {
				$this->db->limit($limit);
			}
			$queryResult = $this->db->get($tbl_name);
			//return $this->db->last_query();
			return $queryResult->result_array();
		}
	
		public function orderDataFetchByUserId($data) {
			$this->db->select("*");
		    //$this->db->where('address.id',$data['userId']);
			//$this->db->where('users.isDeleted',"0");
			// $result = $this->db->get($data['tableName']);
			// if($result->num_rows() > 0){
			// 	$this->db->where('userId',$data['userId']);
			// 	$this->db->where('isDeleted',"0");
			// 	$resultArray = $result->result_array();
			// 	return $resultArray;
			// }

			//$this->db->select('order.id, order.status,order.quantity, order.amount, order.orderNo,order.date, users.id as userId,users.name,users.mobileNo');
			$this->db->from('address');
			$this->db->join('order','order.addressId=address.id AND order.isDeleted="0"');
			$this->db->where('order.userId',$data['userId']);
			$this->db->where('address.isDeleted',"0");
			$queryResult = $this->db->get();
			return $queryResult->result_array();


		// 	$result = $this->db->get($data['tableName']);
		//     $resultArray = $result->row_array();
		//     // if ($result->num_rows() > 0) {
		//     // 	//$this->db->where($whr);
		//     // }
		//    return $resultArray;
		}


		public function getCommonRecordsJoin($data) {
			// print_r($data);
			// die;
			// $tb1=$data['orderTableName'];
			// $tb2=$data['addressTableName'];
			// $tb1C=$data['orderId'];
			// $tb2C=$data['addressId'];
			$tb1="order";
			$tb2="address";
			$tb1C="addressId";
			$tb2C="id";
			$id = NULL;
			$order='id';

					//	, $tb1C,, $tb2C,$id = NULL,$order='id'

			$this->db->select($tb1 . ".*, " . $tb2 . ".*");
			$this->db->from($tb1);
			$this->db->join($tb2, $tb1 . '.' . $tb1C . '=' . $tb2 . '.' . $tb2C.' AND ' .$tb1. '.id="8"');
			//$this->db->join('address', 'order.addressId = address.id');
			if ($id > 0) {
				$this->db->where($tb1 . '.id', $id);
			}
			$this->db->order_by($tb1.'.'.$order);
			$queryResult = $this->db->get();
			 //return $this->db->last_query();
			return $queryResult->result_array();
		}

		
		public function userDataFetchByRefferralCode($data) {
			$this->db->select("*");
		    $this->db->where('referralCode',$data['referralCode']);
			$this->db->where('isDeleted',"0");
			$result = $this->db->get($data['tableName']);
			if($result->num_rows() > 0){
				$this->db->where('referralCode',$data['referralCode']);
				$this->db->where('isDeleted',"0");
				$resultArray = $result->row_array();
				return $resultArray;
			}
		// 	$resultArray = $result->row_array();
		//     if ($result->num_rows() > 0) {
		//     	//$this->db->where($whr);
		//     }
		//    return $resultArray;
		}


		public function referralStatusFetch($data) {
			$this->db->select("*");
		    $this->db->where('userReferralId',$data['userId']);
			$this->db->where('isDeleted',"0");
			$result = $this->db->get($data['tableName']);
			if($result->num_rows() > 0){
				$this->db->where('userReferralId',$data['userId']);
				$this->db->where('isDeleted',"0");
				$resultArray = $result->result_array();
				return $resultArray;
			}
		}	


		public function userPaymentCreated($data,$table_name) {
			//$this->db->set($data);
			//$this->db->where('mobileNo',$data['mobileNo']);
			//$query = $this->db->get('users');
	   	    //if($query->num_rows() > 0){
			//		$this->db->where('mobileNo',$data['mobileNo']);
			if($this->db->insert($table_name,$data)){
				//$insertId = $this->db->insert_id();
				//return $insertId;
				if($data['status']== 'success')
				{
					$walletData = array(
						'userId' => $data['userId'],
						'amount' => $data['amount'],
						'transactionId' => "2344242",
						'status' => "credit",
						'currency' => $data['currency'],
					  );
					if($this->db->insert('wallet',$walletData))
					{
						$userData=$this->getCommonRecords($data['userId'],'users')[0];
						$aquaCo=$userData['aquaCoin']+$data['amount'];
						$this->db->where("id",$data['userId']);
						$this->db->update('users',array("aquaCoin"=>$aquaCo));
					}
				}
				return true;
			}
		}
	
	
	
		// function getCommonRecordsJoin($tb1, $tb1C, $tb2, $tb2C,$id = NULL,$order='id') {
		// 	$this->db->select($tb1 . ".*, " . $tb2 . ".name AS categoryName");
		// 	$this->db->from($tb1);
		// 	$this->db->join($tb2, $tb1 . '.' . $tb1C . '=' . $tb2 . '.' . $tb2C.' AND ' .$tb1. '.isDeleted="0"');
		// 	if ($id > 0) {
		// 		$this->db->where($tb1 . '.id', $id);
		// 	}
		// 	$this->db->order_by($tb1.'.'.$order);
		// 	$queryResult = $this->db->get();
		// 	 //return $this->db->last_query();
		// 	return $queryResult->result_array();
		// }

		

	// public function insertData($data,$table_name)
    // {
	// 	if ($this->db->insert($table_name,$data)) {
    //      return true;
    //     }
    // }

   function getModuleList($assignModule) {
		$this->db->select('id, moduleName,displayIcon, displayName');
		$this->db->where('status', '1');
		$this->db->where('isDeleted', '0');
		if (trim($assignModule) != '0') {
			$assignArray = explode(",", $assignModule);
			$whereArray = array();
			foreach (array_filter($assignArray) as $assign) {
				if ($assign != '') {
					$whereArray[] = " FIND_IN_SET('" . $assign . "', id) ";
				}
			}
			if (!empty($whereArray)) {
				$where = implode(" OR ", $whereArray);
			}
			$this->db->where($where);
		}
		$queryResult = $this->db->get('moduleList');
		$results = array();
		foreach ($queryResult->result_array() as $value) {
			$results[$value['moduleName']] = $value['displayName'] . '+' . $value['displayIcon'];
		}
		return $results;
	}
   public function saveHistory($activity, $user) {
		if (!$this->db->insert('history', array(
			'activity' => $activity,
			'email' => $user,
			'createdon' => date('Y-m-d H:i:s'))
		)) {
			log_message('error', print_r($this->db->error(), true));
			show_error(lang('database_error'));
		}
	}
  
}