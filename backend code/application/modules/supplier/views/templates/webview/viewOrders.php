<!-- Page Content -->
<body>
    <div id="wrapper">
        <?php
        $this->load->view('templates/webview/sideBar');
        ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div id="main-cont">
                    <!--  <div class="col no-padding">
                        <label>View Drivers</label>
                        <div class="dropdown" name="viewDrivers">
                            <select id="viewDrivers">
                                <option value="" disabled>View Drivers</option>
                                <option value="home" selected>Home</option>
                                <option value="who-we-are">Who-We-Are</option>
                                <option value="what-we-do">What-We-Do</option>
                                <option value="contact-us">Contact-Us</option>
                                <option value="get-involved">Get-Involved</option>
                            </select>
                            <span id="errorDropdown"></span>
                        </div>
                    </div> -->
                    <form id="tab1Form" autocomplete="off">
                            <input type="hidden" autocomplete="false" />
                            <input placeholder="id" type="hidden" maxlength="3" id="Nid" value=""/>
                            <input placeholder="id" type="hidden"  id="sessionEmail" value="<?=$this->session->userdata('adminLoggedIn')?>"/>
                    </form>


                    <div style="display: flex;">
                        <div class="col-6" style="padding: 0px;">
                            <b style="font-size: 20px;font-style: bold;margin:0px;">Total Amount</b>
                        </div>
                        <div class="col-6 right" style="text-align: right;padding-right: 20px;">
                            <b style="font-size: 20px;font-style: bold;margin:0px;"> <i class="fa fa-rupee"></i>4300</b>
                        </div>
                    </div>
                    <div class="row body-head">
                        <div class="col-lg-4 col-6 left">
                            <p>All Views</p>
                        </div>
                        <!--  <div class="col-lg-8 col-6 right">
                            <button type="button" class="btn outline-btn default small" onclick="window.location.href ='addDrivers'"><i class="fa fa-plus"></i>Add New</button>
                        </div> -->
                    </div>

                    <table id="example" class="display nightlife-listing" cellspacing="0" width="100%">
                        <thead class="nightlife-list-head">
                            <tr>
                                <th>Order No.</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                    <div class="table-cont">
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <?php
    $this->load->view('templates/webview/_parts/foot');
    ?>
    <script type="text/javascript">
        load();

        function load() {
            var table;
            const imgUrl = "../../../aquaVan/suppliers_image/";
            var count = 0;
            var view = "home";
            var edit;
            $('#viewDrivers').on('change', function() {
                view = this.value;
                table.ajax.reload();
            });

            table = $('#example').DataTable({
                responsive: true,
                "scrollX": true,
                "language": {
                    paginate: {
                        next: '<i class="fa fa-angle-right">', // or '→'
                        previous: '<i class="fa fa-angle-left">' // or '←'
                    }
                },
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', "row" + aData.id);
                },
                "ajax": {
                    "type": "GET",
                    "url": "<?= base_url('supplier/Api_Ajaxcontroller/fetchAll_order'); ?>",
                    "data": function(d) {
                        d.view = view;
                        d.table_name = 'order';
                        d.emailId = $("#sessionEmail").val();
                   
                    },
                },
                "columns": [
                    /*{
                                            "data": "image",
                                            "bSortable": false,
                                            render: function(data, type, row) {
                                                return ` <div class="offer-image" style="background-image: url(${imgUrl+data});"></div> `;
                                            }
                                        },*/
                    {
                        "data": "orderNo"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "mobileNo"
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "quantity"
                    },
                    {
                        "data": "amount"
                    },
                    // {
                    //     "data": "status"
                    // },
                    {
                        "data": "id",
                        "bSortable": false,
                        render: function(data, type, row) {
                            //console.log(row.attandance);
                            return `<div class="dropdown">
                            <button style="padding-left: 0px; padding-top: 0px; padding-bottom: 0px; padding-right: 0px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton${data}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onchange="color()">
                            ${color(row.status,data)}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" id="Pending" onclick="action('${data}','Pending')">Pending</a>
                                <a class="dropdown-item" href="#" id="Confirm" onclick="action('${data}','Confirm')">Confirm</a>
                                <a class="dropdown-item" href="#" id="Cancel" onclick="action('${data}','Cancel')">Cancel</a>
                            </div>
                            </div>`;
                        }
                    },
                    /*  {
                          "data": "id",
                          "bSortable": false,
                          render: function(data, type, row) {
                              return `<i class="fa fa-times" style="font-size:22px" aria-hidden="true" onclick="removeData(${data})"></i>`;
                          }
                      }*/
                ]

            });


        }
        count = 0;

        function color(via, id) {

            count++;
            console.log(id)
            console.log(via)
            if (via == 1) {
                return $("#dropdownMenuButton" + id + "").html(`<p  class="btn btn-warning" style="margin-bottom: 0px;">Pending</p>`);
            } else if (via == 2) {
                return $("#dropdownMenuButton" + id + "").html(`<p  class="btn btn-success" style="margin-bottom: 0px;">Confirm</p>`);
            } else if (via == 3) {
                return $("#dropdownMenuButton" + id + "").html(`<p  class="btn btn-secondary" style="margin-bottom: 0px;">Cancel</p>`);
            } else {
                return `<p  class="btn btn-warning" style="margin-bottom: 0px;">Pending</p>`;
            }
        }


        /*
                function editData(id) {
                    // alert(edit);
                    window.location.href = "<?php echo base_url(); ?>supplier/ControllerDrivers/addDrivers?id=" + id + "&edit=" + view + "";

                }*/

        /*function removeData(id) {
            console.log(view);
            if (confirm("Are you sure you want to remove this notification!")) {
                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('supplier/Api_Ajaxcontroller/removeData'); ?>",
                    data: {
                        id: id,
                        view:view,
                        table_name:'drivers',
                    },
                    dataType: 'json',
                    success: function(data, status, xhr) {
                        $("#loadingButton").hide();
                        $("#saveButton").show();
                        console.log('status: ' + status + ', data: ' + ":" + data + ":");
                        if (status == "success") {
                            if (status == "success") {
                                table.ajax.reload();
                                $('#tab0Form')[0].reset();
                            } else {
                                alert("Error, Please Rerty!");
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
        }*/
        function action(vid, via) {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('supplier/Api_Ajaxcontroller/action'); ?>",
                data: {
                    via: via,
                    id: vid,
                },
                dataType: 'json',
                success: function(data, status, xhr) {
                    $("#loadingButton").hide();
                    $("#saveButton").show();
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");

                    if (status == "success") {
                        console.log("in")
                        if (data.status) {
                            $("#opMsg").html(data.message);
                            $('#exampleModal').modal('show');

                            if (via == "Pending") {
                                $("#row" + vid).children().eq(6).html(`<div class="dropdown">
                                                <button style="padding-left: 0px; padding-top: 0px; padding-bottom: 0px; padding-right: 0px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton${data}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onchange="color()">
                                                <p class="btn btn-warning" style="margin-bottom: 0px;">Pending</p>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" id="Pending" onclick="action('${vid}','Pending')">Pending</a>
                                                    <a class="dropdown-item" href="#" id="Confirm" onclick="action('${vid}','Confirm')">Confirm</a>
                                                    <a class="dropdown-item" href="#" id="Cancel" onclick="action('${vid}','Cancel')">Cancel</a>
                                                </div>
                                                </div>`);
                                //$("#row"+vid).children().eq(6).html("Pending");
                            } else if (via == "Confirm") {
                                $("#row" + vid).children().eq(6).html(`<div class="dropdown">
                                                <button style="padding-left: 0px; padding-top: 0px; padding-bottom: 0px; padding-right: 0px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton${data}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onchange="color()">
                                                <p class="btn btn-success" style="margin-bottom: 0px;">Confirm</p>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" id="Pending" onclick="action('${vid}','Pending')">Pending</a>
                                                    <a class="dropdown-item" href="#" id="Confirm" onclick="action('${vid}','Confirm')">Confirm</a>
                                                    <a class="dropdown-item" href="#" id="Cancel" onclick="action('${vid}','Cancel')">Cancel</a>
                                                </div>
                                                </div>`);
                                //$("#row"+vid).children().eq(6).html("Confirm");
                            } else {
                                $("#row" + vid).children().eq(6).html(`<div class="dropdown">
                                                <button style="padding-left: 0px; padding-top: 0px; padding-bottom: 0px; padding-right: 0px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton${data}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onchange="color()">
                                                <p class="btn btn-secondary" style="margin-bottom: 0px;">Cancel</p>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" id="Pending" onclick="action('${vid}','Pending')">Pending</a>
                                                    <a class="dropdown-item" href="#" id="Confirm" onclick="action('${vid}','Confirm')">Confirm</a>
                                                    <a class="dropdown-item" href="#" id="Cancel" onclick="action('${vid}','Cancel')">Cancel</a>
                                                </div>
                                                </div>`);
                                //  $("#row"+vid).children().eq(6).html("Cancel");
                            }






                        } else {


                            $("#opMsg").html(data.message);
                            $('#exampleModal').modal('show');
                            // $('#tab0Form')[0].reset();
                            console.log(data.result);

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