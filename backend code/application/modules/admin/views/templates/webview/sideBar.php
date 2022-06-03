<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-logo">
                <h2 style="color: #fff;">Aqua Van</h2>
                
            </div>
            <p class="sidebar-brand">
                <a href="#">Summary</a>
            </p>
            <ul class="sidebar-nav">
                <li class="sidebar-acc">
                    <a href="<?php echo base_url();?>admin/Dashboard"><i class="fa fa-dashboard"></i>Overview</a>
                </li>
                 <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i>Suppliers</a>
                    <ul>
                         <li><a href='<?php echo base_url();?>admin/ControllerSuppliers/viewSuppliers'>View </a></li>
                        <li><a  href='<?php echo base_url();?>admin/ControllerSuppliers/addSuppliers'>Add New</a></li>
                        <!-- <li><a href='<?php echo base_url();?>controllerBanner/selectBanner'>View </a></li> -->
                    </ul>
                </li>
                 <li class="sidebar-acc">
                    <a href="#"><i class="fa fas fa-eye"></i>Users</a>
                    <!-- <a href="#"><i class="fa fa-address-book-o"></i>View</a> -->
                    <ul>
                    <li><a href='<?php echo base_url();?>admin/controllerUsers/viewUsers'>View</a></li>
                        <li><a href='<?php echo base_url();?>admin/controllerUsers/addUsers'>Add New</a></li>
                    </ul>
                </li>
                
                <!--<li class="sidebar-acc">
                    <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i>Latest Update View</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>controllerUpdates/viewUpdates">View </a></li>
                        <li><a href="<?php echo base_url();?>controllerUpdates/addUpdates">Add New</a></li>
                    </ul>
                </li>

                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Contributors View</a>

                    <ul>
                    <li><a href="<?php echo base_url();?>controllerContributors/viewContributors">View </a></li>
                        <li><a href="<?php echo base_url();?>controllerContributors/addContributors">Add New</a></li>
                    </ul>
                </li>

                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>Inspiration View</a>

                    <ul>
                    <li><a href="<?php echo base_url();?>controllerInspiration/viewInspiration">View </a></li>
                        <li><a href="<?php echo base_url();?>controllerInspiration/addInspiration">Add New</a></li>
                    </ul>
                </li>

                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-question-circle-o" aria-hidden="true"></i>Get Involved</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>ControllerGetinvolved/viewgetinvolved">Get Involved view </a></li>
                    <li><a href="<?php echo base_url();?>ControllerGetinvolved/viewFAQ">View </a></li>
                        <li><a href="<?php echo base_url();?>ControllerGetinvolved/addFAQ">Add New</a></li>
                    </ul>
                </li>

                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>Contact-Us View</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>controllerContactUs/viewContactUs">View </a></li>
                        ///<li><a href="<?php echo base_url();?>controllerContactUs/addContactUs">Add New</a></li> 
                    </ul>
                </li>
              
                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-money" aria-hidden="true"></i>
Donation</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>controllerDonation/viewDonation">View </a></li>
                    <li><a href="<?php echo base_url();?>controllerDonation/viewFAQ">View FAQ </a></li>
                        <li><a href="<?php echo base_url();?>controllerDonation/addFAQ">Add FAQ</a></li>
                    
                        ///<li><a href="<?php echo base_url();?>controllerDonation/addDonation">Add New</a></li> 
                    </ul>
                </li> -->
                <!-- <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-bell"></i>Notifications</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>controllerNotification/viewNotification">View </a></li>
                        <li><a href="<?php echo base_url();?>controllerNotification/addNotification">Add New</a></li>
                    </ul>
                </li> -->
            </ul>
           
        </div>
        <!-- #sidebar-wrapper