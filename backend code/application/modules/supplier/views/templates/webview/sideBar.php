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
                    <a href="<?php echo base_url();?>supplier/Dashboard"><i class="fa fa-dashboard"></i>Overview</a>
                </li>
                 <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i>Drivers</a>
                    <ul>
                         <li><a href='<?php echo base_url();?>supplier/ControllerDrivers/viewDrivers'>View </a></li>
                        <li><a  href='<?php echo base_url();?>supplier/ControllerDrivers/addDrivers'>Add New</a></li>
                        <!-- <li><a href='<?php echo base_url();?>controllerBanner/selectBanner'>View </a></li> -->
                    </ul>
                </li>
                 <li class="sidebar-acc">
                    <a href="#"><i class="fa fas fa-eye"></i>Profile</a>
                    <ul>    
                    <li><a href='<?php echo base_url();?>supplier/ControllerSuppliers/viewSuppliers'>View</a></li>
                        <!-- <li><a href='<?php echo base_url();?>supplier/controllerUsers/addUsers'>Add New</a></li> -->
                    </ul>
                </li>
                
                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i>Capacity</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/controllerCapacity/viewCapacity">View </a></li>
                        <!-- <li><a href="<?php echo base_url();?>supplier/controllerUpdates/addUpdates">Add New</a></li> -->
                    </ul>
                </li>

               <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Orders</a>

                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/ControllerOrder/viewOrders">View </a></li>
                        <!-- <li><a href="<?php echo base_url();?>supplier/controllerContributors/addContributors">Add New</a></li> -->
                    </ul>
                </li>

                <!-- <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>Inspiration View</a>

                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/controllerInspiration/viewInspiration">View </a></li>
                        <li><a href="<?php echo base_url();?>supplier/controllerInspiration/addInspiration">Add New</a></li>
                    </ul>
                </li>

                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-question-circle-o" aria-hidden="true"></i>Get Involved</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/ControllerGetinvolved/viewgetinvolved">Get Involved view </a></li>
                    <li><a href="<?php echo base_url();?>supplier/ControllerGetinvolved/viewFAQ">View </a></li>
                        <li><a href="<?php echo base_url();?>supplier/ControllerGetinvolved/addFAQ">Add New</a></li>
                    </ul>
                </li>

                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>Contact-Us View</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/controllerContactUs/viewContactUs">View </a></li>
                        ///<li><a href="<?php echo base_url();?>supplier/controllerContactUs/addContactUs">Add New</a></li> 
                    </ul>
                </li>
              
                <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-money" aria-hidden="true"></i>
Donation</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/controllerDonation/viewDonation">View </a></li>
                    <li><a href="<?php echo base_url();?>supplier/controllerDonation/viewFAQ">View FAQ </a></li>
                        <li><a href="<?php echo base_url();?>supplier/controllerDonation/addFAQ">Add FAQ</a></li>
                    
                        ///<li><a href="<?php echo base_url();?>controllerDonation/addDonation">Add New</a></li> 
                    </ul>
                </li> -->
                <!-- <li class="sidebar-acc">
                    <a href="#"><i class="fa fa-bell"></i>Notifications</a>
                    <ul>
                    <li><a href="<?php echo base_url();?>supplier/controllerNotification/viewNotification">View </a></li>
                        <li><a href="<?php echo base_url();?>supplier/controllerNotification/addNotification">Add New</a></li>
                    </ul>
                </li> -->
            </ul>
           
        </div>
        <!-- #sidebar-wrapper