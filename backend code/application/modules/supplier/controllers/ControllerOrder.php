<?php 
   class ControllerOrder extends My_Controller  {
      function __construct() { 
         parent::__construct(); 
         $this->load->helper('url'); 
         $this->load->database(); 
      } 
  
     /*
        //CONTRIBUTORS View
        public function addContributors() {
         $data = array();
			$head = array();
         $headerWhite=array();
         $headerPurple=array();
         $this->load->view('_parts/head',$head);
         $this->load->view('_parts/headerWhite', $headerWhite);
         $this->load->view('_parts/headerPurple',$headerPurple);
         $this->load->view('addContributors',$data);
        
      } */
      public function viewOrders() {
         $data = array();
			$head = array();
         $headerWhite=array();
         $this->load->view('templates/webview/_parts/head', $head);
         $this->load->view('templates/webview/_parts/headerWhite', $headerWhite);
         $this->load->view('templates/webview/viewOrders',$data);
       
     }  
     /*public function upload_post()
     {
        $targetFolder = "foundation_images/";
        $config['upload_path']          = './' . $targetFolder;
        $config['allowed_types']        = 'gif|jpg|png|svg';
        $config['max_size']             = 1024; //1MB
        $config['encrypt_name'] = true;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
  
        $this->load->library('upload', $config);
  
        if (!$this->upload->do_upload('file')) {
           $error = array('error' => $this->upload->display_errors());
           $this->set_response($error, REST_Controller::HTTP_BAD_REQUEST);
        } else {
           $message = array("status" => true, 'name' => $this->upload->data()['file_name'], 'url' => $targetFolder . $this->upload->data()['file_name']);
           $this->set_response($message, REST_Controller::HTTP_OK);
        }
     }*/
   } 
?>