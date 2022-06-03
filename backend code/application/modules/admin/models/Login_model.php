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
	
   public function loginCheck($data) {
		$this->db->select("*");
		$this->db->where($data);
		$this->db->from('admin_login');
		$result = $this->db->get();
		$resultArray = $result->row_array();
		if ($result->num_rows() > 0) {
			$this->db->where('id', $resultArray['id']);
			$this->db->update('admin_login', array('lastLogin' => date('Y-m-d H:i:s')));
		}
		return $resultArray;
	}

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
