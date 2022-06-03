<?php 
   class Login extends My_Controller {
      function __construct() { 
         parent::__construct(); 
         $this->load->helper('url'); 
         $this->load->database();
         $this->load->model('Login_model');
 
      }  
      public function index() { 
         $data = array();
			$head = array();
         $headerWhite=array();
         $this->load->view('templates/webview/_parts/head', $head);
         $this->load->view('templates/webview/_parts/headerWhite', $headerWhite);
         $this->load->view('templates/webview/Login',$data); 
      } 
   } 
?>