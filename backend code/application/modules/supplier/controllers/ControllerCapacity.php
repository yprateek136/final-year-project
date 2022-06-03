<?php 
   class ControllerCapacity extends My_Controller  {
      function __construct() { 
         parent::__construct(); 
         $this->load->helper('url'); 
         $this->load->database(); 
      } 
        //latest Updates View
   /*     public function viewCapacity() {
         $data = array();
			$head = array();
         $headerWhite=array();
         $headerPurple=array();
         $this->load->view('_parts/head',$head);
         $this->load->view('_parts/headerWhite', $headerWhite);
         $this->load->view('_parts/headerPurple',$headerPurple);
         $this->load->view('addUpdates',$data);
      }*/ 
      public function viewCapacity() {
         $data = array();
			$head = array();
         //$headerWhite=array();
         $headerPurple=array();
         $this->load->view('templates/webview/_parts/head', $head);
         $this->load->view('templates/webview/_parts/headerPurple',$headerPurple);
         $this->load->view('templates/webview/viewCapacity',$data);
     }  
       
   } 
?>