<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Banner_Ajaxcontroller extends REST_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->database();
      $this->load->model('Banner_model');
   }

   // public function sendData_post()
   // {
   //    // $this->set_response($_POST, REST_Controller::HTTP_OK);
   //    if ($_POST['add'] == 'home') {
   //       unset($_POST['add']);
   //       if ($_POST['id'] != '0') {
   //          $this->Banner_model->edit($_POST, 'homebanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data updated successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       } else {
   //          unset($_POST['add']);
   //          unset($_POST['id']);
   //          $this->Banner_model->insertData($_POST, 'homebanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data created successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       }
   //    } 
      
   //    else if ($_POST['add'] == 'who-we-are') {
   //       unset($_POST['add']);
   //       if ($_POST['id'] != '0') {
   //          $this->Banner_model->edit($_POST, 'whowearebanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data updated successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       } else {
   //          unset($_POST['add']);
   //          unset($_POST['id']);
   //          $this->Banner_model->insertData($_POST, 'whowearebanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data created successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       }
   //    } else  if ($_POST['add'] == 'what-we-do') {
   //       unset($_POST['add']);
   //       if ($_POST['id'] != '0') {
   //          $this->Banner_model->edit($_POST, 'whatwedobanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data updated successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       } else {
   //          unset($_POST['add']);
   //          unset($_POST['id']);
   //          $this->Banner_model->insertData($_POST, 'whatwedobanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data created successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       }
   //    } else  if ($_POST['add'] == 'contact-us') {
   //       unset($_POST['add']);
   //       if ($_POST['id'] != '0') {
   //          $this->Banner_model->edit($_POST, 'contactusbanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data updated successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       } else {
   //          unset($_POST['add']);
   //          unset($_POST['id']);
   //          $this->Banner_model->insertData($_POST, 'contactusbanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data created successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       }
   //    } else if ($_POST['add'] == 'get-involved') {
   //       unset($_POST['add']);
   //       if ($_POST['id'] != '0') {
   //          $this->Banner_model->edit($_POST, 'getinvolvedbanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data updated successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       } else {
   //          unset($_POST['add']);
   //          unset($_POST['id']);
   //          $this->Banner_model->insertData($_POST, 'getinvolvedbanner');
   //          $message = array(
   //             'status' => true,
   //             'message' => 'Data created successfully.',
   //          );
   //          $this->set_response($message, REST_Controller::HTTP_OK);
   //       }
   //    }
   // }

   public function sendData_post()
   {
      if ($_POST['pagename']) {
         if ($_POST['id'] != '0') {
            $this->Banner_model->edit($_POST, 'banner');
            $message = array(
               'status' => true,
               'message' => 'Data updated successfully.',
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
         } else {
               unset($_POST['id']);
            $this->Banner_model->insertData($_POST, 'banner');
            $message = array(
               'status' => true,
               'message' => 'Data created successfully.',
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
         }
      } 
      
   }
   public function fetch_get()
   {
      if ($_GET['pagename'])
       {
         $pagename = $_GET['pagename'];
      }
      $id = $_GET['id'];
      $result = $this->Banner_model->show($pagename, $id);
      $message = array(
         'status' => true,
         'data' => $result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

   public function fetchAll_get()
   {

      if ($_GET['pagename'])
       {

         $table_name = $_GET['pagename'];
   
      }

      $result = $this->Banner_model->showAll($table_name);
      $message = array(
         'status' => true,
         'data' => $result,
         'message' => 'Data successfully fetched',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

   public function removeData_get()
   {

      if ($_GET['pagename'])
      {

        $pagename = $_GET['pagename'];
  
     }

      $id = $_GET['id'];
      $data = ['isDeleted' => 1];
      $result = $this->Banner_model->remove($pagename, $data, $id);
      $message = array(
         'status' => true,
         'data' => $result,
         'message' => 'Data delete successfully ',
      );
      $this->set_response($message, REST_Controller::HTTP_OK);
   }

   public function upload_post()
   {
      $targetFolder = "foundation_images/";
      $config['upload_path']          = $targetFolder;
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
}
