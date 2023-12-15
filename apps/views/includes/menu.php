									<?php if($this->session->userdata('user_type')=='A') { ?>
                                    <div class="hor-menu">
                                    <ul class="nav navbar-nav">
                                    	<li class="hidden-sm hidden-xs">
                                        	<a href="#" style="padding:0; margin-right:15px;"><img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo.png" alt="logo" class="logo-default"></a>
                                        </li>
                                        
                                           <li aria-haspopup="true">
                                            <a href="<?php echo base_url(); ?>admin/dashboard"> <i class="fa fa-home"></i> Dashboard</a>
                                        </li>
            
                                       <!-- <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="javascript:;"> Masters
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                               
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/categories/view" class="nav-link ">
														<i class="fa fa-database"></i> View Categories</a>
												</li>
								              </ul>
                                        </li>-->
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-building"></i>Companies
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/companies/view" class="nav-link ">
														<i class="fa fa-building"></i> View Companies  </a>
												</li>
									 	   </ul>    
									    </li>
                                        
                                         <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-bank"></i>Services
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/services/view" class="nav-link ">
														<i class="fa fa-bank"></i> View Services</a>
												</li>
											     
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/services/add" class="nav-link ">
														<i class="icon-pencil"></i> Add Service</a>
												</li>
                                   	   </ul>    
									    </li>
                                        
                                        

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i>Partners
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/partners/view" class="nav-link ">
														<i class="fa fa-user"></i> View Partners  </a>
												</li>
											     
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/partners/add" class="nav-link ">
														<i class="icon-pencil"></i> Add Partner</a>
												</li>
                                   	   </ul>    
									    </li>
                                        
                                        
                                       
    
                                        
                                        <li>
                                            <a href="<?php echo base_url();?>Logout">
                                                <i class="icon-key"></i> Log Out </a>
                                        </li>
                                        
                                       
                                     </ul>
                                </div>
                                 <?php } 
                                  elseif($this->session->userdata('user_type')=='C') { ?>
                                  
                                  <div class="hor-menu">
                                    <ul class="nav navbar-nav">
                                    <li class="hidden-sm hidden-xs">
                                        	<a href="#" style="padding:0; margin-right:15px;"><img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo-light.png" alt="logo" class="logo-default"></a>
                                        </li>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="<?php echo base_url(); ?>company/dashboard"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                     
                               			 <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-users"></i> Partners
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/partners/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Partners  </a>
                                                        </li>
                                                        
                                                   </ul>
                                                   
                                            </li>


                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-building"></i> Invoices
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">

                                                            <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/invoices/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Invoices  </a>
                                                        </li>
                   				                 </ul>
                                                   
                                            </li>
                                            <li>
                                            <a href="<?php echo base_url();?>Logout">
                                                <i class="icon-key"></i> Log Out </a>
                                             </li>
                                 
                                    </ul>
                                  </div>
                                   
                                <?php } 
								
								  elseif($this->session->userdata('user_type')=='V') { ?>
                                  <div class="hor-menu">
                                    <ul class="nav navbar-nav">
                                    <li class="hidden-sm hidden-xs">
                                        	<a href="#" style="padding:0; margin-right:15px;"><img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo-light.png" alt="logo" class="logo-default"></a>
                                        </li>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="<?php echo base_url(); ?>partners/dashboard"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                     
                               			 <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i> Services
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>partners/services/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Services  </a>
                                                        </li>
                                                        
                                                   </ul>
                                                   
                                            </li>


                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-building"></i> Invoices
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">

                                                            <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>partners/invoices/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Invoices  </a>
                                                        </li>

                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>partners/invoices/add" class="nav-link ">
                                                                <i class="fa fa-pencil"></i> Create Invoice  </a>
                                                        </li>
                                                        
                                                   </ul>
                                                   
                                            </li>
                                            
                                            
                                            <li>
                                            <a href="<?php echo base_url();?>Logout">
                                                <i class="icon-key"></i> Log Out </a>
                                             </li>
                                 
                                    </ul>
                                  </div>
                                  
                                <?php } 
								
                                  elseif($this->session->userdata('user_type')=='B') { ?>
                                  <div class="hor-menu">
                                    <ul class="nav navbar-nav">
                                    <li class="hidden-sm hidden-xs">
                                        	<span style="padding:0; margin-right:15px;"><img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo-light.png" alt="logo" class="logo-default"></span>
                                        </li>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="<?php echo base_url(); ?>branches/dashboard"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="icon-briefcase"></i> Masters
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class="dropdown-submenu active">
                                                    <a href="javascript:;" class="nav-link nav-toggle active">
                                                        <i class="fa fa-group"></i> Role Management
                                                        <span class="arrow open"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>branches/masters/view_roles" class="nav-link ">
                                                                <i class="icon-tag"></i> View Roles  </a>
                                                        </li>
                                                        
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>branches/masters/add_role" class="nav-link ">
                                                                <i class="icon-pencil"></i> Add Role </a>
                                                        </li>
                                                   </ul>
                                                </li>
                                                
                                                <li aria-haspopup="true" class="dropdown-submenu active">
                                                    <a href="javascript:;" class="nav-link nav-toggle active">
                                                        <i class="fa fa-graduation-cap"></i> Designation
                                                        <span class="arrow open"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>branches/masters/view_designation" class="nav-link ">
                                                                <i class="icon-tag"></i> View Designation  </a>
                                                        </li>
                                                        
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>branches/masters/add_designation" class="nav-link ">
                                                                <i class="icon-pencil"></i> Add Designation </a>
                                                        </li>
                                                   </ul>
                                                </li>
                                                
                                                </ul>
                                              
                                            </li>
                                      
                                    
                                           <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="icon-users"></i> Users
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>branches/users/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Users </a>
                                                        </li>
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>branches/users/add" class="nav-link ">
                                                                <i class="icon-pencil"></i> Create User</a>
                                                        </li>
                                            </ul>
                                                   
                                            </li>
                                    </ul>
                                  </div>
                                  
                                  <?php }  elseif($this->session->userdata('user_type')=='U') { ?>
                                  <div class="hor-menu">
                                    <ul class="nav navbar-nav">
                                    <li class="hidden-sm hidden-xs">
                                        	<a href="#" style="padding:0; margin-right:15px;"><img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo-light.png" alt="logo" class="logo-default"></a>
                                        </li>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="<?php echo base_url(); ?>users/dashboard">  <i class="fa fa-home"></i>Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        
                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-cubes"></i> Customers
                                                <span class="arrow"></span>
                                            </a>
                                                 <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>users/customers/view" class="nav-link ">
                                                                <i class="fa fa-cubes"></i> View Customers </a>
                                                        </li>
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>users/customers/add" class="nav-link ">
                                                                <i class="icon-pencil"></i> Add Customer</a>
                                                        </li>
                                                   </ul>
                                                   
                                            </li>
                                        
                                    </ul>
                                  </div>
                                <?php } ?>
									