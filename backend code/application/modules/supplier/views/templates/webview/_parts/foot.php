 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js')?>"></script>
    <script src="<?php echo base_url('assets/admin/js/bootstrap-clockpicker.min.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="<?php echo base_url('assets/admin/js/dropzone.min.js')?>"></script>
    <script src="<?php echo base_url('assets/admin/js/dropzone-amd-module.min.js')?>"></script>

        <script src="<?php echo base_url('assets/admin/js/datatables.min.js')?>"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src=" <?php echo base_url('assets/admin/js/validate.min.js');?>"></script>
   
    <script src=" <?php echo base_url('assets/admin/js/constant.js');?>"></script>
   
     <script>
        //Sidebar
        $("#wrapper").toggleClass("toggled");
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");

        });
        //Sidebar Accordian
        var acc = document.getElementsByClassName("sidebar-acc");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].onclick = function () {
                this.classList.toggle("active");
                var panel = this.getElementsByTagName("ul")[0];
                $(panel).toggle();
                //if (panel.style.display == "block") {
                //    panel.style.display = "none";
                //} else {
                //    panel.style.display = "block";
                //}
            };
        }
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                //For Date

         $("#datepicker").datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        todayBtn:  1,
        startDate: today,
        autoclose: true,
        useCurrent: false,
            }).on('changeDate', function (selected) {
            $('#datepicker1').datepicker('setStartDate', new Date(selected.date.valueOf()));
        });

        $('#datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            todayBtn:  1,
            startDate: today,
            autoclose: true,
            useCurrent: false,
            //  }).on('changeDate', function (selected) {
            // $('#datepicker').datepicker('setEndDate', new Date(selected.date.valueOf()));
        });

        //For Time
        $('.clockpicker').clockpicker();
        // Select 2
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                placeholder: "Search for facilities..",
                allowClear: true
            });
        });
        //Media Query for Sidebar
        var mq = window.matchMedia("(max-width: 768px)");
        if (mq.matches) {
            $("#wrapper").toggleClass("toggled");
            $("#menu-toggle").click(function (e) {
                $('header').toggleClass('header-left-pad');
            });
        }

    </script>
</body>
</html>