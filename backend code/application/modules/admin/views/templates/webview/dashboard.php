<body>
    <div id="wrapper">
    <?php 
    $this->load->view('templates/webview/sideBar');
?>
        <!-- Page Content -->
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
                                            <p class="num" id="totalSuppliers">11</p>
                                            <p class="title">Suppliers</p>
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
                                          <p class="num" id="totalSuppliers">22</p>
                                            <p class="title">Users</p>
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
                                          <p class="num" id="totalSuppliers">22</p>
                                            <p class="title">Users</p>
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
                                          <p class="num" id="totalSuppliers">22</p>
                                            <p class="title">Users</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- 
                           <div class="row stats">
                       
                        <div class="col-12 col-lg-3">
                            <label style="margin-top: 30px;"><b>Total Order</b></label>
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-address-book-o"></i></div>
                                    </div>
                                    <div class="right">
                                        <div class="stat-desc">
                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 col-lg-3">
                             <label style="margin-top: 30px;"><b>Order Delivered</b></label>
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-align-justify"></i></div>
                                    </div>
                                    <div class="right">
                                        <div class="stat-desc">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-3">
                             <label style="margin-top: 30px;"><b>Order Pending</b></label>
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-map-marker"></i></div>
                                    </div>
                                    <div class="right">
                                        <div class="stat-desc">
                                          
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                      
                        <div class="col-12 col-lg-3">
                             <label style="margin-top: 30px;"><b>Canceled Order</b></label>
                            <div class="full-stats-cont">
                                <div class="full-stats-card">
                                    <div class="left">
                                        <div class="stat-icon"><i class="fa fa-tag"></i></div>
                                    </div>
                                    <div class="right">
                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
    </script>