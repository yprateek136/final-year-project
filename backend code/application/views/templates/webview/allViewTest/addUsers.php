
<body>
    <div id="main-wrap-inner">
        <!-- Form Header -->
        <div class="add-offer-head">

            <div class="row no-margin">
               
            </div>
        </div>

        <!-- Form Body -->
        <div class="add-offer-body add-nightlife-body" style="margin-top: 40px;">
      
            <ul class="nav nav-tabs event-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Details</a>
                </li>    
                <li class="nav-item">    
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true">Reward Point</a>
                </li>
                <li class="nav-item">    
                    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Aqua Coin</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-body photos">
                        <div class="form-cont add-offer-image">
                            <label>Upload Image</label>
                            <form name="dropzone1" class="dropzone" id="eventPhotos"></form>
                        </div>
                    </div>
                    <div class="form-body" style="    margin-top: -70px;">
                        <form id="tab0Form" autocomplete="off" >
                        <input type="hidden" autocomplete="false"/>
                        <input placeholder="id" type="hidden" maxlength="3" id="Nid" />

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Name</label>
                                <input placeholder="Enter the Name" type="text" maxlength="30" name="name" id="name"  required />
                            </div>

                            <div class="form-cont">
                                <label>Mobile No.</label>
                                <input placeholder="Enter the Mobile Number" type="number" maxlength="125" name="mobileNo" id="mobileNo" minlength="10" required />
                            </div>
                            <div class="pb-4">
                            </div>
                           </form>   
                    </div>
                </div>


                    <!-- Tab 1 -->
                <div class="tab-pane fade show" id="home1" role="tabpanel" aria-labelledby="home-tab1">
                 
                    <div class="form-body" style="    margin-top: 10px;">
                        <form id="tab1Form" name="tab1Form" autocomplete="off" >
                                
                             <div class="form-cont" style="margin-top: 5vh">
                                <label>Add Reward Point</label>
                                <input placeholder="Add Reward Point" type="number" maxlength="30" name="rewardPoint" id="rewardPoint"  required />
                            </div>
                            <div class="pb-4">
                            </div>  
                    </form>
                </div>
            </div>

                 <!-- Tab 2 -->
              <div class="tab-pane fade show" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                 
                    <div class="form-body" style="    margin-top: 10px;">
                        <form id="tab2Form" name="tab2Form" autocomplete="off" >

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Add Aqua Coin</label>
                                <input placeholder="Add Aqua Coin" type="number" maxlength="30" name="aquaCoin" id="aquaCoin"  required />
                            </div>
                            

                            <div class="pb-4">
                         
                            </div>  
                   
                    </form>
                </div>
            </div>
</div>
</div>
        <div class="add-offer-foot">
            <button type="button" class="btn btn-default grey-btn"onclick="window.location.href ='viewUsers'">Back</button>
            <button type="button" class="btn btn-default float-right" onclick="validateData()" id="saveButton">Add</button>
            <button type="button" class="btn btn-default float-right buttonload disabled" style="display: none;" id="loadingButton"><i class="fa fa-circle-o-notch fa-spin"></i>Loading...</button>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="check"><i class="fa fa-check"></i></div>
                    <div class="msg" id="opMsg">
                        Congratulations!!! Data Successfully Added.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    $this->load->view('templates/webview/_parts/foot');
    ?>
    <script>
  //dropzone image
  function addFileDZ(from, mf) {
            let currDZ = Dropzone.forElement("#" + from);
            currDZ.emit("addedfile", mf);
            currDZ.emit("thumbnail", mf, mf.sUrl);
            currDZ.emit("complete", mf);
            //currDZ.options.maxFiles = 0;
            currDZ.files[0] = mf;
            currDZ.accepted = true;
        }
         //prefillData
        let id = "<?= isset($_GET['id']) ? $_GET['id'] : '0' ?>";

        
        if (id != 0) {
            prefill();
        }
        else{}
        function prefill() {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('Api_Ajaxcontroller/fetchUser'); ?>",
                data: {
                    id: id,
                    table_name:'users',
                },
                dataType: 'json',
                success: function(data, status, xhr, response) {
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");
                    if (status == "success") {
                        if (data.status) {
                            console.log(data.data);
                            var res = data.data;
                            $("#Nid").val(res.id);
                            $("#name").val(res.name);
                            $("#mobileNo").val(res.mobileNo);
                            $("#rewardPoint").val(res.rewardPoint);
                            $("#aquaCoin").val(res.aquaCoin);
                            
                           
                            if (res.image != "null" && res.image != "") {
                                var mockFile = {
                                    size: 1000000,
                                    accepted: true,
                                    sName: res.image,
                                    sUrl: "../../ci/suppliers_image/" + res.image
                                };
                                addFileDZ("eventPhotos", mockFile);
                            }                           
                                                   
                        }
                    } else {
                        alert("Data Fetching Failed");
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    console.log('Error' + errorMessage);

                }
            });
        }

       /* $("#tab0Form").validate();
        $("#tab1Form").validate();
        $("#tab2Form").validate();

        function validateData(){
            if ($("#tab0Form").valid()) {
                var dp = Dropzone.forElement("#eventPhotos").getAcceptedFiles();
                photos = [];
                photosX = [];
                for (var i = 0; i < dp.length; i++) {
                    photos.push(dp[i].sName);
                    console.log(dp[i].sName);
                }
           
                if (photos.length != 0) {
                  
                } else {
                    $('.nav-tabs a[href="#home"]').tab('show');
                    alert("Select at least 1 photo for view");
                }
            } else {
                $('.nav-tabs a[href="#home"]').tab('show');
                console.log("Form 0 invalid");
            }

            if ($("#tab0Form").valid()) {
                var dp = Dropzone.forElement("#eventPhotos").getAcceptedFiles();
                photos = [];
                photosX = [];
                for (var i = 0; i < dp.length; i++) {
                    photos.push(dp[i].sName);
                    console.log(dp[i].sName);
                }
           
                if (photos.length != 0) {
                  
                } else {
                    $('.nav-tabs a[href="#home"]').tab('show');
                    alert("Select at least 1 photo for view");
                }
            } else {
                $('.nav-tabs a[href="#home"]').tab('show');
                console.log("Form 0 invalid");
            }


        }

        function userTab_1() {
            //var rewardPoint=document.tab1Form.rewardPoint.value;   
            var rewardPoint=document.getElementById("rewardPoint").value;  
            if (rewardPoint==null){
                console.log(rewardPoint);
              alert("Reward Point can't be blank");  
              return false;  
            }  
        }
        function userTab_2(){
           // var aquaCoin=document.tab2Form.aquaCoin.value;
            var aquaCoin=document.getElementById("aquaCoin").value;        
            if (aquaCoin==null){  
              alert("Reward Point can't be blank");  
              return false;  
          }
            else{
                sendData();
                    
            }
          
        }*/

        $("#tab0Form").validate();
        $("#tab1Form").validate();

        function validateData() {
            if ($("#tab0Form").valid() && $("#tab1Form").valid()) {
                var dp = Dropzone.forElement("#eventPhotos").getAcceptedFiles();
                photos = [];
                for (var i = 0; i < dp.length; i++) {
                    photos.push(dp[i].sName);
                    console.log(dp[i].sName);
                }
                if (photos.length != 0) {
                    userTab_1();
                } else {
                    $('.nav-tabs a[href="#home"]').tab('show');
                    alert("Select at least 1 photo for view");
                }
            } else {
                $('.nav-tabs a[href="#home"]').tab('show');
                console.log("Form 0 invalid");

            }

        }
        function userTab_1() {
                var rewardPoint=document.getElementById("rewardPoint").value;  
                if (rewardPoint!=''){
                    userTab_2();
                } else {
                    $('.nav-tabs a[href="#home1"]').tab('show');
                    alert("Reward Point can't be blank");  
                }
        }
           function userTab_2() {
                var aquaCoin=document.getElementById("aquaCoin").value;  
                if (aquaCoin!=''){
                    sendData();
                } else {
                    $('.nav-tabs a[href="#home2"]').tab('show');
                    alert("Aqua Coin can't be blank");  
                }
        }


        // dropzone 1
        Dropzone.options.eventPhotos = {
            url: "<?= base_url('Api_Ajaxcontroller/upload'); ?>",
            addRemoveLinks: true,
            dictRemoveFileConfirmation: 'Are you sure that you want to remove this file?',
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 1, // MB
            maxFiles: 1,
            ProcessQueue: false,
            acceptedFiles: 'image/*',
            init: function() {
                var dz = this;
                dz.on("removedfile", function(file) {
                    console.log(file);
                    console.log('file ' + file.name + ' was removed from front-end  ...');
                    doAjaxCall(file.sUrl).then(
                        function() {
                            console.log('file ' + file.name + ' was removed from back-end  ...');
                        },
                        function() {
                            console.log('failed to remove file ' + file.name + ' from back-end  ...');

                        });
                });
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            },
            success: function(file, response) {
                console.log(file, response);
                file.previewElement.classList.add("dz-success");
                // var res = JSON.parse(response);
                if (response.status) {
                    file.sName = response.name;
                    file.sUrl = response.url;
                }
                console.log(file);
            },
            error: function(file, response) {
                file.previewElement.classList.add("dz-error");
            }
        };

        // function validateData() {
        //     if ($("#tab0Form").valid() || $("#tab1Form").valid()) {
        //         var dp = Dropzone.forElement("#eventPhotos").getAcceptedFiles();
             
        //         photos = [];
        //         for (var i = 0; i < dp.length; i++) {
        //             photos.push(dp[i].sName);
        //             console.log(dp[i].sName);
        //         }

        //         if (photos.length  == true) {
        //             userTab_1();
        //         } else {
        //             $('.nav-tabs a[href="#home"]').tab('show');
        //             alert("Select at least 1 photo");
        //         }
        //     }
        // }
// send data to db 
        function sendData() {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('Api_Ajaxcontroller/sendData'); ?>",
                data: {
                    name: $("#name").val(),
                    image: photos[0],
                    mobileNo: $("#mobileNo").val(),
                    rewardPoint: $("#rewardPoint").val(),
                    aquaCoin: $("#aquaCoin").val(),
                    id:id,
                    table_name:'users',
                },
                dataType: 'json',
                success: function(data, status, xhr) {
                    $("#loadingButton").hide();
                    $("#saveButton").show();
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");
                    if (status == "success") {
                        if (data.status == "N200") {
                            $("#opMsg").html(data.message);
                            $('#exampleModal').modal('show');
                            // $('#tab0Form')[0].reset();
                        } else {
                            $("#opMsg").html(data.message);
                            $('#exampleModal').modal('show');
                            // $('#tab0Form')[0].reset();
                            console.log(data.log);
                        }
                    } else {
                        alert("Upload Failed");
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    $("#loadingButton").hide();
                    $("#saveButton").show();
                    console.log('Error' + errorMessage);
                }
            });
        }
   
    </script>