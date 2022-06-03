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
                    <div class="row body-head">
                        <div class="col-lg-4 col-6 left">
                            <p>All Views</p>
                        </div>
                        <div class="col-lg-8 col-6 right">
                            <button type="button" class="btn outline-btn default small" onclick="window.location.href ='addUsers'"><i class="fa fa-plus"></i>Add New</button>
                        </div>
                    </div>
                    <table id="example" class="display nightlife-listing" cellspacing="0" width="100%">
                        <thead class="nightlife-list-head">
                            <tr>
                                <th>Image</th>
                                <th>name</th>
                                <th>MobileNo</th>
                                <th>Aqua Coin</th>
                                <th>Reward Point</th>
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
        const imgUrl = "../../ci/suppliers_image/";

        $(document).ready(function() {
            table = $('#example').DataTable({
                "scrollX": true,
                "language": {
                    paginate: {
                        next: '<i class="fa fa-angle-right">', // or '→'
                        previous: '<i class="fa fa-angle-left">' // or '←'
                    }
                },
                "ajax": {
                    "type": "GET",
                    "url": "<?= base_url('Api_Ajaxcontroller/fetchAllUsers'); ?>",
                    "data": function(d) {},
                },
                "columns": [{
                        "data": "image",
                        "bSortable": false,
                        render: function(data, type, row) {
                            return ` <div class="offer-image" style="background-image: url(${imgUrl+data});"></div> `;
                        }
                    }, {
                        "data": "name"
                    },
                    {
                        "data": "mobileNo"
                    },
                    {
                        "data": "aquaCoin"
                    },
                    {
                        "data": "rewardPoint"
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
        });

        function editData(id) {
            window.location.href = "<?php echo base_url(); ?>ControllerUsers/addUsers?id=" + id + "";
        }

        function removeData(id) {
            if (confirm("Are you sure you want to remove this notification!")) {
                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('Api_Ajaxcontroller/removeData'); ?>",
                    data: {
                        id: id,
                        table_name: 'users',
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