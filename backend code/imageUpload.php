<?php

  if(isset($_FILES['file']['name'])){
        //file name
        $filename = $_FILES['file']['name'];
        
        // Location
        // $location = 'img/'.$filename;
        $location = '/uploadimages/'.$filename;
        echo $location;
       // $location = 'img/'.$filename;
        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        //Valid extensions
        $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
        $response = 0;
        if(in_array($file_extension,$valid_ext)){
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$location)) {
               //  $this->load->model('image_model');
               //  $data = array( 
               //  'image' => $location, 
               //  );
               // $this->image_model->insert($data); 
               // $query = $this->db->get("Image");
               // if($query->result()) {
               // echo "image inserted";
               // }
               echo "The file ". htmlspecialchars(basename( $_FILES["file"]["name"])). "has been uploaded.";
            } else {
                    echo "Not uploaded because of error #".$_FILES["file"]["error"];


              // echo " Sorry, there was an error uploading your file.";
            }
           }
        }
?>