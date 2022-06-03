<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Api_Ajaxcontroller extends REST_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->database();
      $this->load->model('Api_model');
   }

  public function sendData_post()
  {
      // $this->set_response($_POST, REST_Controller::HTTP_OK);
      // if($_POST['add'] == 'active')
      // {   unset($_POST['add']);
        /* if ($_POST['id'] != '0') {
         $this->Api_model->edit($_POST,'suppliers');
         $message = array(
            'status' => true,
            'message' => 'Data updated successfully.',
         );
         $this->set_response($message, REST_Controller::HTTP_OK);
        }else {
         unset($_POST['add']);
            unset($_POST['id']);
            $this->Api_model->insertData($_POST,'suppliers');
            $message = array(
               'status' => true,
               'message' => 'Data created successfully.',
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
         }*/

      $id = $_POST['id'];
      $table_name=$_POST['table_name'];
      if ($_POST['id'] != '0') { 
         $tableName=$_POST['table_name'];
              unset($_POST['table_name']);
            $this->Api_model->editData($_POST, $tableName);
            $message = array(
               'status' => true,
               'message' => 'Data updated successfully.',
            );
            $this->set_response($message, REST_Controller::HTTP_OK);  
      } 
      else {
            unset($_POST['id']);
            unset($_POST['table_name']);
            $this->Api_model->insertData($_POST,$table_name);
            $message = array(
               'status' => true,
               'message' => 'Data created successfully.',
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
      }

   //////}
  // else if($_POST['add'] == 'pending')
  //  { unset($_POST['add']);
  //     if ($_POST['id'] != '0') {
  //     $this->Api_model->edit($_POST,'suppliers');
  //     $message = array(
  //        'status' => true,
  //        'message' => 'Data updated successfully.',
  //     );
  //     $this->set_response($message, REST_Controller::HTTP_OK);
  //    }else {
  //     unset($_POST['add']);
  //        unset($_POST['id']);
  //        $this->Api_model->insertData($_POST,'suppliers');
  //        $message = array(
  //           'status' => true,
  //           'message' => 'Data created successfully.',
  //        );
  //        $this->set_response($message, REST_Controller::HTTP_OK);
  //     }
  //  }
  //  else  if($_POST['add'] == 'banned')
  //  { unset($_POST['add']);
  //     if ($_POST['id'] != '0') {
  //     $this->Api_model->edit($_POST,'suppliers');
  //     $message = array(
  //        'status' => true,
  //        'message' => 'Data updated successfully.',
  //     );
  //     $this->set_response($message, REST_Controller::HTTP_OK);
  //    }else {
  //     unset($_POST['add']);
  //        unset($_POST['id']);
  //        $this->Api_model->insertData($_POST,'suppliers');
  //        $message = array(
  //           'status' => true,
  //           'message' => 'Data created successfully.',
  //        );
  //        $this->set_response($message, REST_Controller::HTTP_OK);
  //     }
  //  }
  /* else  if($_POST['add'] == 'contact-us')
   { unset($_POST['add']);
      if ($_POST['id'] != '0') {
      $this->Api_model->edit($_POST,'contactusSuppliers');
      $message = array(
         'status' => true,
         'message' => 'Data updated successfully.',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
     }else {
      unset($_POST['add']);
         unset($_POST['id']);
         $this->Api_model->insertData($_POST,'contactusSuppliers');
         $message = array(
            'status' => true,
            'message' => 'Data created successfully.',
         );
         $this->set_response($message, REST_Controller::HTTP_OK);
      }
   }
   else if($_POST['add'] == 'get-involved')
   { unset($_POST['add']);
      if ($_POST['id'] != '0') {
      $this->Api_model->edit($_POST,'getinvolvedSuppliers');
      $message = array(
         'status' => true,
         'message' => 'Data updated successfully.',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
     }else {
      unset($_POST['add']);
         unset($_POST['id']);
         $this->Api_model->insertData($_POST,'getinvolvedSuppliers');
         $message = array(
            'status' => true,
            'message' => 'Data created successfully.',
         );
         $this->set_response($message, REST_Controller::HTTP_OK);
      }
   }*/
   }
 
   public function fetch_get()
   {
      if($_GET['edit']=="home"){

         $table_name=$_GET['table_name'];    
     }
     /*else if($_GET['edit']=="who-we-are"){
      $table_name='suppliers';

     }
     else if($_GET['edit']=="what-we-do"){
      $table_name="whatwedoSuppliers";

     }
     else if($_GET['edit']=="contact-us"){
      $table_name="contactusSuppliers";

     }
     else if($_GET['edit']=="get-involved"){
      $table_name="getinvolvedSuppliers";
         
     }*/
     // $id = $_GET['id'];
      $table_name=$_GET['table_name'];  
      $emailId = $adminLoggedIn;
      $result = $this->Api_model->show($table_name,$id);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

   public function fetchSupplier_get()
   {
      if($_GET['edit']=="home"){

         $table_name=$_GET['table_name'];    
     }
     /*else if($_GET['edit']=="who-we-are"){
      $table_name='suppliers';

     }
     else if($_GET['edit']=="what-we-do"){
      $table_name="whatwedoSuppliers";

     }
     else if($_GET['edit']=="contact-us"){
      $table_name="contactusSuppliers";

     }
     else if($_GET['edit']=="get-involved"){
      $table_name="getinvolvedSuppliers";
         
     }*/
      $id = $_GET['id'];
      $table_name=$_GET['table_name'];  
      $result = $this->Api_model->show($table_name,$id);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

    public function fetchAllUsers_get()
   {

      $table_name='users';   
      $result = $this->Api_model->showAll($table_name);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

    public function fetchUser_get()
   {
      /*if($_GET['edit']=="home"){

         $table_name=$_GET['table_name'];    
     }*/
     /*else if($_GET['edit']=="who-we-are"){
      $table_name='suppliers';

     }
     else if($_GET['edit']=="what-we-do"){
      $table_name="whatwedoSuppliers";

     }
     else if($_GET['edit']=="contact-us"){
      $table_name="contactusSuppliers";

     }
     else if($_GET['edit']=="get-involved"){
      $table_name="getinvolvedSuppliers";
         
     }*/
      $id = $_GET['id'];
      $table_name=$_GET['table_name'];  
      $result = $this->Api_model->show($table_name,$id);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }
   
   public function fetchAll_get()
   {  

      if($_GET['view']=="home"){

         $table_name=$_GET['table_name'];     
     }
     /*else if($_GET['view']=="who-we-are"){
      $table_name='suppliers';

     }
     else if($_GET['view']=="what-we-do"){
      $table_name="whatwedoSuppliers";

     }
     else if($_GET['view']=="contact-us"){
      $table_name="contactusSuppliers";

     }
     else if($_GET['view']=="get-involved"){
      $table_name="getinvolvedSuppliers";
         
     }*/
   
      $result = $this->Api_model->showAll($table_name);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

   public function removeData_get()
   {
      
   //    if($_GET['view']=="home"){
     
   //   }
    /* else if($_GET['view']=="who-we-are"){
      $table_name='suppliers';

     }
     else if($_GET['view']=="what-we-do"){
      $table_name="whatwedoSuppliers";

     }
     else if($_GET['view']=="contact-us"){
      $table_name="contactusSuppliers";

     }
     else if($_GET['view']=="get-involved"){
      $table_name="getinvolvedSuppliers";
         
     }*/

      $id = $_GET['id'];
      $table_name = $_GET['table_name'];
      $data=['isDeleted'=>1];
      $result = $this->Api_model->remove($table_name,$data,$id);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data delete successfully ',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

   public function upload_post()
   {
      $targetFolder = "suppliers_image/";
      $config['upload_path']          = './' . $targetFolder;
      $config['allowed_types']        = 'gif|jpg|png|svg|jpeg';
      $config['max_size']             = 2048; //1MB
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
   }

   public function fetchByEmail_get()
   {
      
      $table_name=$_GET['table_name'];
      $result = $this->Api_model->showByEmail($table_name,$_GET['emailId']);
      $message = array(
         'status' => true,
         'data'=>$result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }
}
