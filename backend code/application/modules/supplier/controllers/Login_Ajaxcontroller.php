
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Login_Ajaxcontroller extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Login_model');
		$this->load->library('session');
		$this->load->library("form_validation");
		
	}
	public function login_post()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		if ($this->form_validation->run()) {
			if ($result = $this->Login_model->loginCheck($_POST)) {
				if ($result['status'] == 1) {
					$this->session->set_userdata('adminLoggedIn', $result['email']);
					$this->session->set_userdata('password', $result['password']);
					// Get Assigned Module Name
					// $moduleArray = $this->Login_model->getModuleList($result['moduleIds']);
					// $this->session->set_userdata('moduleList', serialize($moduleArray));
					// $this->Login_model->saveHistory('User logged in', $result['email']);
					$message = array(
						'status' => TRUE,
						'message' => 'Successfully login',
						'data' => $result,
					);
					$this->set_response($message, REST_Controller::HTTP_OK);
				} else {
					$message = array(
						'status' => FALSE,
						'message' => 'You are banned by admin!!',
					);
					$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
					// $this->Login_model->saveHistory('Banned login attempt', $_POST['email']);
				}
			} else {
				// $this->Login_model->saveHistory('Cant login User: ', $_POST['email']);
				$message = array(
					'status' => FALSE,
					'message' => 'Incorrect Credentials',
				);
				$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
			}
		} 
		else {
			//$this->api->saveHistory('Cant login User: ', $_POST['email']);
			$message = array(
				'status' => FALSE,
				'message' => 'Invalid Credentials',
			);
			$this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
