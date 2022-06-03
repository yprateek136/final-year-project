<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class seviceApi extends REST_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->database();
      $this->load->model('Api_model');
      $this->load->library('session');
      $this->load->library("form_validation");
      
    //   if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    //     header('Access-Control-Allow-Origin: *');
    //     header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    //     header('Access-Control-Allow-Headers: token, Content-Type');
    //     die();
    // }
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
   }

public function getData_get(){
    $data = $this->Api_model->getCommonRecords(NULL, 'user');
    $message = array(
       'status' => TRUE,
       'data' => $data,
    );
    $this->set_response($message, REST_Controller::HTTP_OK);
}

// public function login_post()
// 	{
// 	// 	$this->form_validation->set_rules('email', 'email', 'trim|required');
// 	// 	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
// 	 	if ($this->form_validation->run()) {
// 			if ($result = $this->Login_model->loginCheck($_GET)) {
// 				if ($result['status'] == 1) {
// 					//$this->session->set_userdata('adminLoggedIn', $result['email']);
// 					//$this->session->set_userdata('password', $result['password']);
// 					// Get Assigned Module Name
// 					// $moduleArray = $this->Login_model->getModuleList($result['moduleIds']);
// 					// $this->session->set_userdata('moduleList', serialize($moduleArray));
// 					// $this->Login_model->saveHistory('User logged in', $result['email']);
// 					$message = array(
// 						'status' => "N200",
// 						'message' => 'Successfully login',
// 						'data' => $result,
// 					);
// 					$this->set_response($message, REST_Controller::HTTP_OK);
// 				} else {
// 					$message = array(
// 						'status' => FALSE,
// 						'message' => 'You are banned by admin!!',
// 					);
// 					$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
// 					// $this->Login_model->saveHistory('Banned login attempt', $_POST['email']);
// 				}
// 			} else {
// 				// $this->Login_model->saveHistory('Cant login User: ', $_POST['email']);
// 				$message = array(
// 					'status' => "N100",
// 					'message' => 'Incorrect Credentials',
// 				);
// 				$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
// 			}
// 		} 
// 		else {
// 			//$this->api->saveHistory('Cant login User: ', $_POST['email']);
// 			$message = array(
// 				'status' => FALSE,
// 				'message' => 'Invalid Credentials',
// 			);
// 			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
// 		}
// 	}


}