<body>
    <div id="main-wrap-inner">
        <form id="tab0Form">
            <div class="add-offer-head">
                <div class="row no-margin">
                    <!--                     <div class="col no-padding">
                        <label>Add Supplier</label>
                        <div class="dropdown" name="addSuppliers" id="addSuppliers">
                            <select required>
                                <option value="" disabled selected>Add Supplier</option>
                                <option value="home">Home</option>
                                <option value="who-we-are">Who-We-Are</option>
                                <option value="what-we-do">What-We-Do</option>
                                <option value="contact-us">Contact-Us</option>
                                <option value="get-involved">Get-Involved</option>
                            </select>
                        </div>
                    </div> -->
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
        </form>
        <!-- Form Header -->

        <!-- Form Body -->
        <div class="add-offer-body add-nightlife-body" style="margin-top: 40px;">

            <ul class="nav nav-tabs event-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#home1" role="tab" aria-controls="home1" aria-selected="true">Timing</a>
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
                    <div class="form-body" style="margin-top: -70px;">
                        <form id="tab1Form" autocomplete="off">
                            <input type="hidden" autocomplete="false" />
                            <input placeholder="id" type="hidden" maxlength="3" id="Nid" />
                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Water Supplier Shop Name</label>
                                <input placeholder="Enter the Water Supplier Shop Name" type="text" maxlength="30" name="shopName" id="shopName" required />
                            </div>
                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Full Name</label>
                                <input placeholder="Enter the Name" type="text" maxlength="30" name="fName" id="fName" required />
                            </div>

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Mobile No.</label>
                                <input placeholder="Enter the Mobile No" type="number" maxlength="30" name="mobileNo" id="mobileNo" required />
                            </div>

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Alternative Mobile No.</label>
                                <input placeholder="Enter the Mobile No" type="number" maxlength="30" name="alternativeMobileNo" id="alternativeMobileNo" required />
                            </div>

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Email Id</label>
                                <input placeholder="Enter the Email Id" type="text" maxlength="30" name="emailId" id="emailId" required />
                            </div>


                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Adhar Card No.</label>
                                <input placeholder="Enter the Adhar Card No" type="number" maxlength="30" name="adharCardNo" id="adharCardNo" required />
                            </div>

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Number of Drivers</label>
                                <input placeholder="Enter the Number of Drivers" type="number" maxlength="30" name="driversNo" id="driversNo" required />
                            </div>

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Number of Vehicle</label>
                                <input placeholder="Enter the Number of Vehicle" type="number" maxlength="30" name="vehicleNo" id="vehicleNo" required />
                            </div>

                            <div class="form-cont" style="margin-top: 5vh">
                                <label>Number of Bottle Capacity</label>
                                <input placeholder="Enter the Number of Bottle Capacity" type="number" maxlength="30" name="bottleNo" id="bottleNo" required />
                            </div>



                            <div class="form-cont">
                                <form id="tab1Form">
                                    <div class="row contact-details">
                                        <div class="col-12 col-lg-6" style="margin-bottom: 5vh">
                                            <div class="form-cont location">
                                                <label>Location</label>
                                                <input id="pac-input" style="margin-top: 1px;" type="text" placeholder="Enter a location" required>
                                            </div>
                                            <div class="map-cont">
                                                <div id="map"> </div>
                                                <div id="infowindow-content">
                                                    <img src="" width="16" height="16" id="place-icon">
                                                    <span id="place-name" class="title"></span><br>
                                                    <span id="place-address"></span>
                                                </div>
                                                <input type="hidden" name="clubLocation">

                                            </div>
                                            <!-- <div class="md-checkbox checkbox-inline" style="margin-top:5vh;">
                                                <input id="l_status" type="checkbox" value="1" name="l_status" required>
                                                <label for="l_status">Location is Mandatory</label>
                                            </div> -->
                                        </div>




                                        <div class="col-12 col-lg-6" style="margin-bottom: 5vh">
                                            <div class="form-cont location">
                                                <label>Delivery Location Radius</label>
                                                <!-- <input id="pac-input" style="margin-top: 1px;" type="text" placeholder="Enter a delivery location Radius(Km)" required> -->
                                                <div class="slidecontainer">
                                                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange" onclick="othername();">
                                                    <p>Radius(km): <span id="demo" name="demo" class="demo">50</span></p>
                                                </div>
                                            </div>
                                            <div class="map-cont">
                                                <div id="map1" style="position: relative;overflow: hidden;height: 330px;"> </div>
                                                <div id="infowindow-content1">
                                                    <img src="" width="16" height="16" id="place-icon1">
                                                    <span id="place-name1" class="title"></span><br>
                                                    <span id="place-address1"></span>
                                                </div>
                                                <input type="hidden" name="clubLocation1">

                                            </div>
                                            <!-- <div class="md-checkbox checkbox-inline" style="margin-top:5vh;">
                                                <input id="l_status" type="checkbox" value="1" name="l_status" required>
                                                <label for="l_status">Location is Mandatory</label>
                                            </div> -->
                                        </div>
                                    </div>
                                </form>
                            </div>

                    </div>



                    <div class="pb-4">
                    </div>

                </div>



                <!-- Tab 2 -->
                <div class="tab-pane fade show" id="home1" role="tabpanel" aria-labelledby="home-tab1">

                    <div class="form-body" style="margin-top: 10px;">
                        <form id="tab1Form" autocomplete="off">

                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxMon" name="modules" id="checkBoxMon" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Mon</label>
                                <div class="md-form md-outline ml-4 startTimeMon">
                                    <input type="time" id="startTimeMon" name="modules" class="form-control" placeholder="Select time">
                                    <label for="startTimeMon">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeMon">
                                    <input type="time" id="endTimeMon" name="modules" class="form-control" placeholder="Select time">
                                    <label for="endTimeMon">End Time</label>
                                </div>
                            </div>
                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxTue" name="modules" id="checkBoxTue" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Tue</label>
                                <div class="md-form md-outline ml-4 startTimeTue">
                                    <input type="time" id="startTimeTue" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeTue">
                                    <input type="time" id="endTimeTue" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">End Time</label>
                                </div>
                            </div>
                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxWed" name="modules" id="checkBoxWed" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Wed</label>
                                <div class="md-form md-outline ml-4 startTimeWed">
                                    <input type="time" id="startTimeWed" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeWed">
                                    <input type="time" id="endTimeWed" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">End Time</label>
                                </div>
                            </div>
                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxThu" name="modules" id="checkBoxThu" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Thu</label>
                                <div class="md-form md-outline ml-4 startTimeThu">
                                    <input type="time" id="startTimeThu" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeThu">
                                    <input type="time" id="endTimeThu" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">End Time</label>
                                </div>
                            </div>
                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxFri" name="modules" id="checkBoxFri" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Fri</label>
                                <div class="md-form md-outline ml-4 startTimeFri">
                                    <input type="time" id="startTimeFri" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeFri">
                                    <input type="time" id="endTimeFri" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">End Time</label>
                                </div>
                            </div>
                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxSat" name="modules" id="checkBoxSat" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Sat</label>
                                <div class="md-form md-outline ml-4 startTimeSat">
                                    <input type="time" id="startTimeSat" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeSat">
                                    <input type="time" id="endTimeSat" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">End Time</label>
                                </div>
                            </div>
                            <div class="form-check ml-4 d-flex">
                                <input type="checkbox" class="form-check-input filled-in checkBoxSun" name="modules" id="checkBoxSun" onchange="valueChanged()">
                                <label class="form-check-label small text-uppercase card-link-secondary mt-2" for="new3">Sun</label>
                                <div class="md-form md-outline ml-4 startTimeSun">
                                    <input type="time" id="startTimeSun" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">Start Time</label>
                                </div>
                                <div class="md-form md-outline ml-4 startTimeSun">
                                    <input type="time" id="endTimeSun" class="form-control" name="modules" placeholder="Select time">
                                    <label for="default-picker">End Time</label>
                                </div>
                            </div>

                        </form>
                    </div>









                </div>



                <div class="pb-4">
                </div>

            </div>





            </form>

        </div>

    </div>
    <div class="add-offer-foot pb-4">
        <button type="button" class="btn btn-default grey-btn" onclick="window.location.href ='viewSuppliers'">Back</button>
        <button type="button" class="btn btn-default float-right" id="saveButton" onclick="validateData()">Add</button>
        <button type="button" class="btn btn-default float-right buttonload disabled" style="display: none;" id="loadingButton"><i class="fa fa-circle-o-notch fa-spin"></i>Loading...</button>
    </div>
    <div class="pb-4">
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
        $(".startTimeMon").hide();
        $(".startTimeTue").hide();
        $(".startTimeWed").hide();
        $(".startTimeThu").hide();
        $(".startTimeFri").hide();
        $(".startTimeSat").hide();
        $(".startTimeSun").hide();


        function valueChanged() {
            if ($('.checkBoxMon').is(":checked"))
                $(".startTimeMon").show();

            //$('.checkBoxMon').attr('value', 'true');   
            else
                $(".startTimeMon").hide();
            if ($('.checkBoxTue').is(":checked"))
                $(".startTimeTue").show();
            else
                $(".startTimeTue").hide();
            if ($('.checkBoxWed').is(":checked"))
                $(".startTimeWed").show();
            else
                $(".startTimeWed").hide();
            if ($('.checkBoxThu').is(":checked"))
                $(".startTimeThu").show();
            else
                $(".startTimeThu").hide();
            if ($('.checkBoxFri').is(":checked"))
                $(".startTimeFri").show();
            else
                $(".startTimeFri").hide();
            if ($('.checkBoxSat').is(":checked"))
                $(".startTimeSat").show();
            else
                $(".startTimeSat").hide();
            if ($('.checkBoxSun').is(":checked"))
                $(".startTimeSun").show();
            else
                $(".startTimeSun").hide();
        }


        var slider1 = document.getElementById("myRange");
        var output1 = document.getElementById("demo");
        slider1.oninput = function() {
            output1.innerHTML = this.value;
        }
        var range = slider1.value * 1000;

        function othername() {
            var slider = Number(document.getElementById("myRange").value);
            //var output = document.getElementById("demo");
            //output.innerHTML = slider.value;
            output1.innerHTML = slider;




            range = slider * 1000; // 1km = 1000m

            // console.log(range);
            initMap_1();

        }

        //othername();

        // var range = slider.oninput = function() {
        //   //output.innerHTML = this.value;
        //    return this.value;
        //   // console.log(slider.value);    
        // }




        var map, map1;

        function initMap() {
            var uluru = {
                lat: 28.633071,
                lng: 77.219714
            };
            $("input[name='clubLocation']").val(28.633071 + "," + 77.219714);
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
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
                $("input[name='clubLocation']").val(place.geometry.location.lat() + "," + place.geometry.location.lng());

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

            initMap_1();

        }

        function initMap_1() {
            var uluru = {
                lat: 28.633071,
                lng: 77.219714
            };
            $("input[name='clubLocation1']").val(28.633071 + "," + 77.219714);
            map1 = new google.maps.Map(document.getElementById('map1'), {
                zoom: 10,
                center: uluru
            });

            var marker1 = new google.maps.Marker({
                position: uluru,
                map: map1,
                draggable: true
            });

            /*var output1 = document.getElementById("demo").value;
            console.log(output1);*/
            //var range;
            /*slider.oninput = function() {
              //output.innerHTML = this.value;
               range = 10000*slider.value;
               rangevalue(range);
               console.log(slider.value);    
            }*/

            console.log(range);

            var circle = new google.maps.Circle({
                map: map1,
                radius: range, // 10 miles in metres
                fillColor: '#AA0000'
            });
            //  var output = document.getElementById("demo");
            //console.log(output);
            circle.bindTo('center', marker1, 'position');
            /*var input1 = document.getElementById('pac-input1');
            var autocomplete1 = new google.maps.places.Autocomplete(input1);
            autocomplete1.bindTo('bounds', map1);

            var infowindow1 = new google.maps.InfoWindow();
            var infowindowContent1 = document.getElementById('infowindow-content1');
            infowindow1.setContent(infowindowContent1);

            autocomplete1.addListener('place_changed1', function() {
                infowindow1.close();
                marker1.setVisible(false);
                var place1 = autocomplete.getPlace();
                if (!place1.geometry) {
      
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                if (place1.geometry.viewport) {
                    map1.fitBounds(place1.geometry.viewport);
                } else {
                    map1.setCenter(place1.geometry.location);
                    map1.setZoom(17);
                }
                marker1.setPosition(place1.geometry.location);
                marker1.setVisible(true);
                console.log(place1.geometry.location.lat() + ":::" + place1.geometry.location.lng());
                 $("input[name='clubLocation1']").val(place1.geometry.location.lat()+","+place1.geometry.location.lng());
                 
                var address1 = '';
                if (place1.address1_components) {
                    address = [
                        (place1.address1_components[0] && place1.address1_components[0].short_name || ''),
                        (place1.address1_components[1] && place1.address1_components[1].short_name || ''),
                        (place1.address1_components[2] && place1.address1_components[2].short_name || '')
                    ].join(' ');
                }

                infowindowContent1.children['place-icon1'].src = place.icon;
                infowindowContent1.children['place-name1'].textContent = place.name;
                infowindowContent1.children['place-address1'].textContent = address;
                infowindow1.open(map1, marker1);
            });

            google.maps.event.addListener(marker1, 'dragend', function(evt) {
                $("input[name='clubLocation1']").val(evt.latLng.lat() + "," + evt.latLng.lng());
            });

             var circle1 = new google.maps.Circle({
                  map1: map1,
                  radius: 16093,    // 10 miles in metres
                  fillColor: '#AA0000'
                });
                circle1.bindTo('center', marker1, 'position');*/
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
        let edit = "<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>";
        let id = "<?= isset($_GET['id']) ? $_GET['id'] : '0' ?>";
        if (id != 0) {
            prefill();
        } else {
            // validateData();
        }

        function prefill() {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('Api_Ajaxcontroller/fetchSupplier?edit='); ?>" + edit + "",
                data: {
                    id: id,
                    table_name: 'suppliers',
                    //  add:edit,
                    //  add:$("#addSuppliers").find(':selected').val(),
                },
                dataType: 'json',
                success: function(data, status, xhr, response) {
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");
                    if (status == "success") {
                        if (data.status) {
                            console.log(data.data);
                            var res = data.data;
                            $("#Nid").val(res.id);
                            $("#shopName").val(res.shopName);
                            $("#fName").val(res.fName);

                            //$(".modules").val(res.TimeModules);
                            console.log(res.TimeModules);
                            if (res.TimeModules) {
                                let arr = res.TimeModules.split(',');
                                console.log(arr);
                                console.log(arr[0]);
                                if (arr[0] == 'on' && arr[1] != '') {
                                    document.getElementById("checkBoxMon").checked = true;
                                    $(".startTimeMon").show();

                                    document.getElementById("startTimeMon").value = arr[1];
                                    document.getElementById("endTimeMon").value = arr[2];

                                    console.log("true");
                                    console.log(arr[1]);
                                    console.log(arr[2]);
                                }
                                if (arr[3] == 'on' && arr[4] != '') {
                                    document.getElementById("checkBoxTue").checked = true;
                                    $(".startTimeTue").show();
                                    document.getElementById("startTimeTue").value = arr[4];
                                    document.getElementById("endTimeTue").value = arr[5];
                                }
                                if (arr[6] == 'on' && arr[7] != '') {
                                    document.getElementById("checkBoxWed").checked = true;
                                    $(".startTimeWed").show();
                                    document.getElementById("startTimeWed").value = arr[7];
                                    document.getElementById("endTimeWed").value = arr[8];
                                }
                                if (arr[9] == 'on' && arr[10] != '') {
                                    document.getElementById("checkBoxThu").checked = true;
                                    $(".startTimeThu").show();
                                    document.getElementById("startTimeThu").value = arr[10];
                                    document.getElementById("endTimeThu").value = arr[11];
                                }
                                if (arr[12] == 'on' && arr[13] != '') {
                                    document.getElementById("checkBoxFri").checked = true;
                                    $(".startTimeFri").show();
                                    document.getElementById("startTimeFri").value = arr[13];
                                    document.getElementById("endTimeFri").value = arr[14];
                                }
                                if (arr[15] == 'on' && arr[16] != '') {
                                    document.getElementById("checkBoxSat").checked = true;
                                    $(".startTimeSat").show();
                                    document.getElementById("startTimeSat").value = arr[16];
                                    document.getElementById("endTimeSat").value = arr[17];
                                }
                                if (arr[18] == 'on' && arr[19] != '') {
                                    document.getElementById("checkBoxSun").checked = true;
                                    $(".startTimeSun").show();
                                    document.getElementById("startTimeSun").value = arr[19];
                                    document.getElementById("endTimeSun").value = arr[20];
                                }
                            }
                            /*else {
                                let arr = res.TimeModules.split(',');
                                $('input[type=checkbox][name=modules]').filter(function() {
                                    return arr.includes(this.value);
                                }).prop('checked', true);
                            }    */



                            $("#driversNo").val(res.driversNo),
                                $("#mobileNo").val(res.mobileNo),
                                $("#emailId").val(res.emailId),
                                $("#alternativeMobileNo").val(res.alternativeMobileNo),
                                $("#vehicleNo").val(res.vehicleNo),
                                $("#adharCardNo").val(res.adharCardNo),
                                $("#bottleNo").val(res.bottleNo),
                                $("#myRange").val(res.rangeLocation),

                                $("#demo").val(res.rangeLocation),
                                othername();
                            //$("input[name='clubLocation']").val(res.location),


                            // $("#hideAddSuppliers").hide();
                            $('#addSuppliers option[value="' + edit + '"]').attr("selected", "selected");
                            $('#status option[value="' + res.status + '"]').attr("selected", "selected");

                            if (res.image != "null" && res.image != "") {
                                var mockFile = {
                                    size: 1000000,
                                    accepted: true,
                                    sName: res.image,
                                    sUrl: "../../ci/suppliers_image/" + res.image
                                };
                                addFileDZ("eventPhotos", mockFile);
                                console.log("Image Fetching");
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
                    validateDataTime();
                } else {
                    $('.nav-tabs a[href="#home"]').tab('show');
                    alert("Select at least 1 photo for view");
                }
            } else {
                $('.nav-tabs a[href="#home"]').tab('show');
                console.log("Form 0 invalid");

            }

        }

        function validateDataTime() {

            if ($('.checkBoxMon').is(":checked") || $('.checkBoxTue').is(":checked") || $('.checkBoxWed').is(":checked") || $('.checkBoxThu').is(":checked") || $('.checkBoxFri').is(":checked") || $('.checkBoxSat').is(":checked") || $('.checkBoxSun').is(":checked")) {

                if ($('.checkBoxMon').is(":checked")) {
                    if ($('#startTimeMon').val() != '' && $('#endTimeMon').val() != '') {
                        sendData();
                    } else {
                        alert("Select monday timing");
                    }
                }
                if ($('.checkBoxTue').is(":checked")) {
                    if ($('#startTimeTue').val() != '' && $('#endTimeTue').val() != '') {
                        sendData();
                    } else {
                        alert("Select tuesday timing");
                    }
                }
                if ($('.checkBoxWed').is(":checked")) {
                    if ($('#startTimeWed').val() != '' && $('#endTimeWed').val() != '') {
                        sendData();
                    } else {
                        alert("Select wednesday timing");
                    }
                }
                if ($('.checkBoxThu').is(":checked")) {
                    if ($('#startTimeThu').val() != '' && $('#endTimeThu').val() != '') {
                        sendData();
                    } else {
                        alert("Select thursday timing");
                    }
                }
                if ($('.checkBoxFri').is(":checked")) {
                    if ($('#startTimeFri').val() != '' && $('#endTimeFri').val() != '') {
                        sendData();
                    } else {
                        alert("Select friday timing");
                    }
                }
                if ($('.checkBoxSat').is(":checked")) {
                    if ($('#startTimeSat').val() != '' && $('#endTimeSat').val() != '') {
                        sendData();
                    } else {
                        alert("Select monday timing");
                    }
                }
                if ($('.checkBoxSun').is(":checked")) {
                    if ($('#startTimeSun').val() != '' && $('#endTimeSun').val() != '') {
                        sendData();
                    } else {
                        alert("Select monday timing");
                    }
                }
            } else {
                $('.nav-tabs a[href="#home1"]').tab('show');
                alert("Select at least 1 day for timing");
            }



            // if($('.checkBoxTue').is(":checked"))   
            // if($('.checkBoxWed').is(":checked"))
            // if($('.checkBoxThu').is(":checked"))
            // if($('.checkBoxFri').is(":checked"))   
            // if($('.checkBoxSat').is(":checked"))          
            // if($('.checkBoxSun').is(":checked"))

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
        console.log(slider1.value);

        function sendData() {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('Api_Ajaxcontroller/sendData'); ?>",
                data: {
                    table_name: 'suppliers',
                    shopName: $("#shopName").val(),
                    image: photos[0],

                    id: id,
                    add: $("#addSuppliers").find(':selected').val(),
                    status: $('#status').find(":selected").val(),
                    location: $("input[name='clubLocation']").val(),
                    rangeLocation: slider1.value,


                    TimeModules: $("input[name=modules]").map(function() {
                        return this.value;
                    }).get().join(","),

                    driversNo: $("#driversNo").val(),
                    fName: $("#fName").val(),
                    mobileNo: $("#mobileNo").val(),
                    alternativeMobileNo: $("#alternativeMobileNo").val(),
                    vehicleNo: $("#vehicleNo").val(),
                    emailId: $("#emailId").val(),
                    adharCardNo: $("#adharCardNo").val(),
                    bottleNo: $("#bottleNo").val(),
                    shopName: $("#shopName").val(),
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