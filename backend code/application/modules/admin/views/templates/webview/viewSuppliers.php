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
                    <!-- <div class="col no-padding">
                        <label>View Suppliers</label>
                        <div class="dropdown" name="viewSuppliers">
                            <select id="viewSuppliers">
                                <option value="" disabled>View Suppliers</option>
                                <option value="home" selected>Home</option>
                                <option value="who-we-are">Who-We-Are</option>
                                <option value="what-we-do">What-We-Do</option>
                                <option value="contact-us">Contact-Us</option>
                                <option value="get-involved">Get-Involved</option>
                            </select>
                            <span id="errorDropdown"></span>
                        </div>
                    </div> -->
                    <div class="row body-head">
                        <div class="col-lg-4 col-6 left">
                            <p>All Views</p>
                        </div>
                        <div class="col-lg-8 col-6 right">
                            <button type="button" class="btn outline-btn default small" onclick="window.location.href ='addSuppliers'"><i class="fa fa-plus"></i>Add New</button>
                        </div>
                    </div>
                    <table id="example" class="display nightlife-listing" cellspacing="0" width="100%">
                        <thead class="nightlife-list-head">
                            <tr>
                                <th>Image</th>
                                <th>shopName</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>Edit</th>
                                <th>Remove</th>
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
        var table;
        const imgUrl = "../../../aquaVan/suppliers_image/";
        var count = 0;
        var view = "home";
        var edit;
        $('#viewSuppliers').on('change', function() {
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
                "ajax": {
                    "type": "GET",
                    "url": "<?= base_url('admin/Api_Ajaxcontroller/fetchAll');?>",
                    "data": function(d) {
                        d.view = view;
                          d.table_name='suppliers';
                    },
                },
                "columns": [{
                        "data": "image",
                        "bSortable": false,
                        render: function(data, type, row) {
                            return ` <div class="offer-image" style="background-image: url(${imgUrl+data});"></div> `;
                        }
                    },
                    {
                        "data": "shopName"
                    },
                    {
                        "data": "fName"
                    },
                    {
                        "data": "mobileNo"
                    },
                    {
                        "data": "emailId"
                    },
                    {
                        "data": "id",
                        "bSortable": false,
                        render: function(data, type, row) {
                            return `<i class="fa fa-pencil" style="font-size:22px" onclick="editData(${data})"></i>`;
                        }
                    },
                    {
                        "data": "id",
                        "bSortable": false,
                        render: function(data, type, row) {
                            return `<i class="fa fa-times" style="font-size:22px" aria-hidden="true" onclick="removeData(${data})"></i>`;
                        }
                    }
                ]
            });



        function editData(id) {
            // alert(edit);
            window.location.href = "<?php echo base_url(); ?>admin/ControllerSuppliers/addSuppliers?id=" + id + "&edit=" + view + "";

        }

        function removeData(id) {
            console.log(view);
            if (confirm("Are you sure you want to remove this notification!")) {
                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('admin/Api_Ajaxcontroller/removeData'); ?>",
                    data: {
                        id: id,
                        view:view,
                        table_name:'suppliers',
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
        }
    </script>