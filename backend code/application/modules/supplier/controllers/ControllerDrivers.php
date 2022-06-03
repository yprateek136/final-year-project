<?php 
   class ControllerDrivers extends My_Controller 
   {
      function __construct() { 
         parent::__construct(); 
         $this->load->helper('url'); 
         $this->load->database(); 
      } 
  /*    public function selectBanner() {
         $data = array();
		 $head = array();
         $headerWhite=array();
         $this->load->view('templates/webview/_parts/head', $head);
         $this->load->view('templates/webview/_parts/headerWhite', $headerWhite);
         $this->load->view('templates/webview/selectBanner',$data);  
     }*/  
      //first View
      public function addDrivers() {
         $data = array();
		   $head = array();
         $headerWhite=array();
         $headerPurple=array();
         $this->load->view('templates/webview/_parts/head',$head);
         $this->load->view('templates/webview/_parts/headerWhite', $headerWhite);
         $this->load->view('templates/webview/_parts/headerPurple',$headerPurple);
         $this->load->view('templates/webview/addDrivers',$data);   
      } 
      public function viewDrivers() {
         $data = array();
		 $head = array();
         $headerWhite=array();
         $this->load->view('templates/webview/_parts/head', $head);
         $this->load->view('templates/webview/_parts/headerWhite', $headerWhite);
         $this->load->view('templates/webview/viewDrivers',$data);  
     }   
  
   }
