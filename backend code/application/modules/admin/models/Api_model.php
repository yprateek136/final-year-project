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
   {    $query =  $this->db->where('isDeleted',0);
       $query = $this->db->get($table_name);
		return $query->result();
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


   public function remove($table_name,$data,$id)
   {
       $this->db->where('id', $id);
      $this->db->update($table_name,$data);
      return true;
   }


   function getCommonRecords($id = NULL, $tbl_name = 'modulelist', $limit = 0, $order_by = '')
   {
      $this->db->select('*');
      $this->db->where('isDeleted', '0');

      if ($id < 0) {
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
      return $queryResult->result_array();
   }
}
