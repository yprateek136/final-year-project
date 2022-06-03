<body>
    <div id="wrapper">
    <?php 
    $this->load->view('templates/webview/sideBar');
?>
        <!-- Page Content -->
        <form id="tab1Form" autocomplete="off">
                            <input type="hidden" autocomplete="false" />
                            <input placeholder="id" type="hidden" maxlength="3" id="Nid" value="" />
                            <input placeholder="id" type="hidden" id="sessionEmail" value="<?= $this->session->userdata('adminLoggedIn') ?>" />

        </form>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div id="main-cont">
                    <!-- Stats -->
                    <div class="row stats">
                        <!-- 1 -->
                        <div class="col-12 col-lg-3">
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-address-book-o"></i></div>
                                    </div>
                                    <div class="right">
                                        <div class="stat-desc">
                                             <p class="num" id="AllDrivers">15</p>
                                            <p class="title">Drivers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 2 -->
                        <div class="col-12 col-lg-3">
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-align-justify"></i></div>
                                    </div>
                                    <div class="right">
                                        <div class="stat-desc">
                                             <p class="num" id="AllOrderPending">30</p>
                                            <p class="title">Order Pending</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 3 -->
                        <div class="col-12 col-lg-3">
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-map-marker"></i></div>
                                    </div>
                                    <div class="right">
                                        <div class="stat-desc">
                                           <p class="num" id="AllOrderDelivered">100</p>
                                            <p class="title">Order Delivered</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 4 -->
                        <div class="col-12 col-lg-3">
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-tag"></i></div>
                                    </div>
                                    <div class="right">
                                            <div class="stat-desc">
                                                <p class="num" id="TotalAmount">520</p>
                                                <p class="title">Total Amount</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
           
        <!-- /#page-content-wrapper -->
   
    <!-- /#wrapper -->
    <style>
        canvas {
            height: 335px !important;
        }
    </style>
    <?php $this->load->view('templates/webview/_parts/foot');
?>

    <script>
         Bar Chart
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["23 Oct", "24 Oct", "25 Oct", "26 Oct", "27 Oct", "28 Oct", "29 Oct", "30 Oct"],
            datasets: [{
                label: 'Revenue',
                backgroundColor: color(window.chartColors.purple).alpha(1).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 0,
                data: [0, 0, 0, 900, 1200, 0, 0, 0]
            }]

        };

        window.onload = function () {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Bar Chart'
                    }
                }
            });
        };
        
        Custom Dropdown
        $("#graph").click(function () {
            $("#options-cont").toggle();
        });
        //Carousel
        $('.carousel').carousel({
            interval: false
        });











        let id = "<?= isset($_GET['id']) ? $_GET['id'] : '0' ?>";
        // if (id != 0) {
        dashboard();
        function dashboard() {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('supplier/Api_Ajaxcontroller/fetchByEmailDashboard'); ?>",
                data: {
                    emailId: $("#sessionEmail").val(),
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
                            $("#AllDrivers").val(res.driver);
                            $("#AllOrderPending").val(res.orderPending);
                            $("#AllOrderDelivered").val(res.orderDelivered);
                            $("#TotalAmount").val(res.totalAmount);

                            //$(".modules").val(res.TimeModules);
                            // console.log(res.TimeModules);
                            // if (res.TimeModules) {
                            //     let arr = res.TimeModules.split(',');
                            //     console.log(arr);
                            //     console.log(arr[0]);
                            //     if (arr[0] == 'on' && arr[1] != '') {
                            //         document.getElementById("checkBoxMon").checked = true;
                            //         $(".startTimeMon").show();

                            //         document.getElementById("startTimeMon").value = arr[1];
                            //         document.getElementById("endTimeMon").value = arr[2];

                            //         console.log("true");
                            //         console.log(arr[1]);
                            //         console.log(arr[2]);
                            //     }
                            //     if (arr[3] == 'on' && arr[4] != '') {
                            //         document.getElementById("checkBoxTue").checked = true;
                            //         $(".startTimeTue").show();
                            //         document.getElementById("startTimeTue").value = arr[4];
                            //         document.getElementById("endTimeTue").value = arr[5];
                            //     }
                            //     if (arr[6] == 'on' && arr[7] != '') {
                            //         document.getElementById("checkBoxWed").checked = true;
                            //         $(".startTimeWed").show();
                            //         document.getElementById("startTimeWed").value = arr[7];
                            //         document.getElementById("endTimeWed").value = arr[8];
                            //     }
                            //     if (arr[9] == 'on' && arr[10] != '') {
                            //         document.getElementById("checkBoxThu").checked = true;
                            //         $(".startTimeThu").show();
                            //         document.getElementById("startTimeThu").value = arr[10];
                            //         document.getElementById("endTimeThu").value = arr[11];
                            //     }
                            //     if (arr[12] == 'on' && arr[13] != '') {
                            //         document.getElementById("checkBoxFri").checked = true;
                            //         $(".startTimeFri").show();
                            //         document.getElementById("startTimeFri").value = arr[13];
                            //         document.getElementById("endTimeFri").value = arr[14];
                            //     }
                            //     if (arr[15] == 'on' && arr[16] != '') {
                            //         document.getElementById("checkBoxSat").checked = true;
                            //         $(".startTimeSat").show();
                            //         document.getElementById("startTimeSat").value = arr[16];
                            //         document.getElementById("endTimeSat").value = arr[17];
                            //     }
                            //     if (arr[18] == 'on' && arr[19] != '') {
                            //         document.getElementById("checkBoxSun").checked = true;
                            //         $(".startTimeSun").show();
                            //         document.getElementById("startTimeSun").value = arr[19];
                            //         document.getElementById("endTimeSun").value = arr[20];
                            //     }
                            // }
                            /*else {
                                let arr = res.TimeModules.split(',');
                                $('input[type=checkbox][name=modules]').filter(function() {
                                    return arr.includes(this.value);
                                }).prop('checked', true);
                            }    */



                            // $("#driversNo").val(res.driversNo),
                            //     $("#mobileNo").val(res.mobileNo),
                            //     $("#emailId").val(res.emailId),
                            //     $("#alternativeMobileNo").val(res.alternativeMobileNo),
                            //     $("#vehicleNo").val(res.vehicleNo),
                            //     $("#adharCardNo").val(res.adharCardNo),
                            //     $("#bottleNo").val(res.bottleNo),
                            //     $("#myRange").val(res.rangeLocation),

                            //     $("#demo").val(res.rangeLocation),
                            //     othername();
                            //$("input[name='clubLocation']").val(res.location),


                            // $("#hideAddSuppliers").hide();
                            //$('#addSuppliers option[value="' + edit + '"]').attr("selected", "selected");
                            // $('#status option[value="' + res.status + '"]').attr("selected", "selected");

                            // if (res.image != "null" && res.image != "") {
                            //     var mockFile = {
                            //         size: 1000000,
                            //         accepted: true,
                            //         sName: res.image,
                            //         sUrl: "../../../aquaVan/suppliers_image/" + res.image
                            //     };
                            //     addFileDZ("eventPhotos", mockFile);
                            //     console.log("Image Fetching");
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








    </script>