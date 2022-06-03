<?php
//startModel
defined('BASEPATH') or exit('No direct script access allowed');
class Api_model extends CI_Model
{
   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }
    public function insertData($data,$table_name)
   {
      if ($this->db->insert($table_name, $data)) {
         return true;
      }
   }
   
   public function showAll($table_name)
   {   
      $query =  $this->db->where('isDeleted',0);
      $query = $this->db->get($table_name);
		return $query->result();
   }


   public function showAllOrder($id)
   {   
      $this->db->select('order.id, order.status,order.quantity, order.amount, order.orderNo,order.date, users.id as userId,users.name,users.mobileNo');
      $this->db->from('order');
      $this->db->join('users','users.id=order.userId AND users.isDeleted="0"');
      $this->db->where('order.supplierId',$id);
      $this->db->where('order.isDeleted',"0");
      $queryResult = $this->db->get();
      return $queryResult->result_array();
   }
  
   public function show($table_name,$id)
   {
      $query = $this->db->select("*");
      $query = $this->db->where("id", $id);
      $query = $this->db->get($table_name);
      return $query->row();
   }
   

   public function showByEmail($table_name,$id)
   {
      $query = $this->db->select("*");
      $query = $this->db->where("emailId", $id);
      $query = $this->db->get($table_name);
      return $query->row();
   }
   

   public function showByEmailDashboard($table_name,$emailId)
   {
      $query = $this->db->select("*");
      $query = $this->db->where("emailId", $emailId);
      $query = $this->db->get($table_name);
      return $query->row();
   }


   // public function getCommonRecordsJoin($supplierId) {
   //    $tb1="order";
   //    $tb2="users";
   //    $tb1C="addressId";
   //    $tb2C="id";
   //    $id = NULL;
   //    $order='id';
   //    $this->db->select($tb1 . ".*, " . $tb2 . ".*");
   //    $this->db->from($tb1);
   //    $this->db->join($tb2, $tb1 . '.' . $tb1C . '=' . $tb2 . '.' . $tb2C.' AND ' .$tb1. '.isDeleted="0"');
   //    if ($id > 0) {
   //       $this->db->where($tb1 . '.id', $id);
   //    }
   //    $this->db->order_by($tb1.'.'.$order);
   //    $queryResult = $this->db->get();
   //    return $queryResult->result_array();
   // }

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



		public function getsupplierEmailId($emailId,$tableName) {
			$this->db->select("*");
		    $this->db->where('emailId',$emailId);
			$this->db->where('isDeleted',"0");
			$result = $this->db->get($tableName);
			return $result->row_array();
		}
		

      public function edit($data,$tbl_name= 'NULL')
      {  
         $this->db->where('emailId', $data['id']);
         unset($data['emailId']);
         // $this->db->where('id', $id);
         if ($this->db->update($tbl_name, $data)) {
            return true;
         } else {
            return false;
         }
   }
   public function editData($data,$tbl_name= 'NULL')
      {  
         $this->db->where('id', $data['id']);
       
         if ($this->db->update($tbl_name, $data)) {
            return true;
         } else {
            return false;
         }
   }

  /* public function updateData($data,$table_name)
   {
      $query = $this->db->where("emailId", $sessionEmail);
       if ($this->db->update($table_name, $data)) {
         return true;
      }
   }*/


   public function remove($table_name,$data,$id)
   {
       $this->db->where('id', $id);
      $this->db->update($table_name,$data);
      return true;
   }
    public function statusUpdate($table_name,$data,$id)
   {
       $this->db->where('id', $id);
      $this->db->update($table_name,$data);
      return true;
   }
}
