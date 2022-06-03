<body>
    <div id="main-wrap-inner">
        <!-- <form id="tab0Form">
            <div class="add-offer-head">
                <div class="row no-margin">
                    <div class="col no-padding">
                        <label>Add Supplier</label>
                        <div class="dropdown" name="addCapacity" id="addCapacity">
                            <select required>
                                <option value="" disabled selected>Add Supplier</option>
                                <option value="home">Home</option>
                                <option value="who-we-are">Who-We-Are</option>
                                <option value="what-we-do">What-We-Do</option>
                                <option value="contact-us">Contact-Us</option>
                                <option value="get-involved">Get-Involved</option>
                            </select>
                        </div>
                    </div>
                    <div class="col no-padding ml-2">
                        <label size="5">Status</label>
                        <div class="dropdown" name="status" id="status">
                            <select required>
                                <option value="" disabled selected>status</option>
                                <option value="1">Active</option>
                                <option value="2">Pending</option>
                                <option value="3">Banned</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form> -->
        <!-- Form Header -->

        <!-- Form Body -->
        <div class="add-offer-body add-nightlife-body" style="margin-top: 40px;">

           <!--  <ul class="nav nav-tabs event-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#home1" role="tab" aria-controls="home1" aria-selected="true">Timing</a>
                </li>
            </ul> -->
            <div class="tab-content" id="myTabContent">

                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <!-- <div class="form-body photos">
                        <div class="form-cont add-offer-image">
                            <label>Upload Image</label>
                            <form name="dropzone1" class="dropzone" id="eventPhotos"></form>
                        </div>
                    </div> -->
                    <div class="form-body" style="margin-top: 20px;">
                        <form id="tab1Form" autocomplete="off">
                            <input type="hidden" autocomplete="false" />
                            <input placeholder="id" type="hidden" maxlength="3" id="Nid" value=""/>
                            <input placeholder="id" type="hidden"  id="sessionEmail" value="<?=$this->session->userdata('adminLoggedIn')?>"/>
                           
                        
                            <div class="form-cont" style="margin-top: 5vh;padding-top: 20px;">
                                <label>Available Bottle</label>
                                <input placeholder="Enter the Available Bottle No" type="number" maxlength="30" class="availableBottle" name="availableBottle" id="availableBottle" required />
                            </div>

                            <button type="button" class="btn btn-success pt-3 pb-3 pl-4 pr-4" id="addData100" onclick="AddData100()">+100</button>
                            
                            <button type="button" class="btn btn-success pt-3 pb-3 pl-4 pr-4 ml-2" id="addData200" onclick="AddData200()">+200</button>

                            <button type="button" class="btn btn-success pt-3 pb-3 pl-4 pr-4 ml-4" id="reduceData100" onclick="ReduceData100()">-100</button>
                            <button type="button" class="btn btn-success pt-3 pb-3 pl-4 pr-4 ml-2" id="reduceData200" onclick="ReduceData200()">-200</button>



                            <div class="form-cont d-flex" style="margin-top: 5vh;padding-top: 20px;">
                                <div>
                                    <label>Bottle Reserved</label>
                                    <h3 class="availableBottle" id="reserved_Bottle">234</h3>
                                </div>
                                <div class="float-right ml-4 pl-4">        
                                    <label>Stock Issues</label>
                                    <h3 class="text-danger">10</h3>
                                </div>    
                            </div>
                                                          
                                         </div>   



                            <div class="pb-4">
                            </div>

                    </div>


                        
                            <!-- Tab 2 -->
              <!--   <div class="tab-pane fade show" id="home1" role="tabpanel" aria-labelledby="home-tab1">
               
                    <div class="form-body" style="margin-top: 10px;">
                        <form id="tab1Form" autocomplete="off">

                            <div class="d-flex">
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Mon</label>
                                </div>
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Tue</label>
                                </div>
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Wed</label>
                                </div>
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Thu</label>
                                </div>
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Fri</label>
                                </div>
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Sat</label>
                                </div>
                                <div class="form-check ml-4">
                                   <input type="checkbox" class="form-check-input filled-in" id="new3">
                                   <label class="form-check-label small text-uppercase card-link-secondary" for="new3">Sun</label>
                                </div>
                                
                            </div>
                           
                            <div class="d-flex mt-4">
                                <div class="md-form md-outline">
                                  <input type="time" id="default-picker" class="form-control" placeholder="Select time">
                                  <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4">
                                  <input type="time" id="default-picker" class="form-control" placeholder="Select time">
                                  <label for="default-picker">End Time</label>
                                </div>
                           </div>

                          

                           



                            
                                         </div>   



                            <div class="pb-4">
                            </div>

                    </div>   -->


                    </form>

                </div>

            </div>
             <div class="add-offer-foot">
            <button type="button" class="btn btn-default grey-btn" onclick="window.location.href ='viewCapacity'">Back</button>
            <button type="button" class="btn btn-default float-right" id="saveButton" onclick="validateData()">Save</button>
            <button type="button" class="btn btn-default float-right buttonload disabled" style="display: none;" id="loadingButton"><i class="fa fa-circle-o-notch fa-spin"></i>Loading...</button>
        </div>
        </div>



       

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
    <script type="text/javascript">


            function AddData100(){
                var availableBottle = Number(document.getElementById("availableBottle").value);
                console.log(availableBottle);
                var availableBottleNew=availableBottle+100;
                document.getElementById("availableBottle").value= availableBottleNew;
                console.log(availableBottleNew);
            }
            function AddData200(){
                var availableBottle = Number(document.getElementById("availableBottle").value);
                console.log(availableBottle);
                var availableBottleNew=availableBottle+200;
                document.getElementById("availableBottle").value= availableBottleNew;
                console.log(availableBottleNew);
            }


            function ReduceData100(){
                var availableBottle = Number(document.getElementById("availableBottle").value);
                console.log(availableBottle);
                if(availableBottle>100)
                    var availableBottleNew=availableBottle-100;
                    document.getElementById("availableBottle").value= availableBottleNew;
                    console.log(availableBottleNew);
            }
            function ReduceData200(){
                var availableBottle = Number(document.getElementById("availableBottle").value);
                console.log(availableBottle);
                if(availableBottle>200)
                    var availableBottleNew=availableBottle-200;
                    document.getElementById("availableBottle").value= availableBottleNew;
                    console.log(availableBottleNew);
            }



     function initMap() {
            var uluru = {
                lat: 28.633071,
                lng: 77.219714
            };
             $("input[name='clubLocation']").val(28.633071+","+77.219714);
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });
            var input = document.getElementById('pac-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
      
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                console.log(place.geometry.location.lat() + ":::" + place.geometry.location.lng());
                 $("input[name='clubLocation']").val(place.geometry.location.lat()+","+place.geometry.location.lng());
                 
                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindowContent.children['place-icon'].src = place.icon;
                infowindowContent.children['place-name'].textContent = place.name;
                infowindowContent.children['place-address'].textContent = address;
                infowindow.open(map, marker);
            });

            google.maps.event.addListener(marker, 'dragend', function(evt) {
                $("input[name='clubLocation']").val(evt.latLng.lat() + "," + evt.latLng.lng());
            });
        }
</script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArlskABeuY6tOnXnYwrCRhoky3rIRt-E0&libraries=places&callback=initMap"></script>

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
        // if (id != 0) {
            prefill();
        // } else {
        //     // validateData();
        // }

        function prefill() {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('supplier/Api_Ajaxcontroller/fetchByEmail'); ?>",
                data: {
                    emailId:$("#sessionEmail").val(),
                    table_name:'suppliers',
                },
                dataType: 'json',
                success: function(data, status, xhr, response) {
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");
                    if (status == "success") {
                        if (data.status) {
                            console.log(data.data);
                            var res = data.data;
                            $("#Nid").val(res.id);
                            $("#availableBottle").val(res.availableBottle);
                            //$("#reserved_Bottle").val(res.availableBottle);
                            // $("#fName").val(res.fName);

                            // $("#driversNo").val(res.driversNo), 
                            // $("#mobileNo").val(res.mobileNo),
                            // $("#emailId").val(res.emailId),
                            // $("#adharCardNo").val(res.adharCardNo),
                            // $("#bottleNo").val(res.bottleNo),

                            // //$("input[name='clubLocation']").val(res.location),


                            // // $("#hideAddCapacity").hide();
                            // $('#addCapacity option[value="' + edit + '"]').attr("selected", "selected");
                            // $('#status option[value="' + res.status + '"]').attr("selected", "selected");

                            // if (res.image != "null" && res.image != "") {
                            //     var mockFile = {
                            //         size: 1000000,
                            //         accepted: true,
                            //         sName: res.image,
                            //         sUrl: "../../../ci/Suppliers_image/" + res.image
                            //     };
                            //     addFileDZ("eventPhotos", mockFile);
                            // }
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
        
        $("#tab1Form").validate();

        function validateData() {
            if ($("#tab1Form").valid()) {
            
               
                    sendData();
               
            } else {
                $('.nav-tabs a[href="#home"]').tab('show');
                console.log("Form 0 invalid");

            }
        }

        // dropzone 1
        Dropzone.options.eventPhotos = {
            url: "<?= base_url('supplier/Api_Ajaxcontroller/upload'); ?>",
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

        // $("#tab0Form").validate();

        // function validateData() {
        //     if ($("#tab0Form").valid()&& $("#tab1Form").valid()) {
        //         var dp = Dropzone.forElement("#eventPhotos").getAcceptedFiles();
        //         photos = [];
        //         for (var i = 0; i < dp.length; i++) {
        //             photos.push(dp[i].sName);
        //             console.log(dp[i].sName);
        //         }
        //         if (photos.length == true) {
        //             sendData();
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
                url: "<?= base_url('supplier/Api_Ajaxcontroller/sendData'); ?>",
                data: {
                  
    
                    id:$("#sessionEmail").val(),
                
                    table_name:'suppliers',

                    availableBottle:$("#availableBottle").val(), 
                
                  
    


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
                    alert("Upload Failed");
                    console.log('Error' + errorMessage);
                }
            });
        }
    </script>