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
                                                <i class="fa fa-user"></i>Companies
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/companies/view" class="nav-link ">
														<i class="fa fa-user"></i> View Companies  </a>
												</li>
									 	   </ul>    
									    </li>
                                        

                                       <!-- <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i>Vendors
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/vendors/view" class="nav-link ">
														<i class="fa fa-user"></i> View Vendors  </a>
												</li>
											     
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/vendors/add" class="nav-link ">
														<i class="icon-pencil"></i> Add Vendor</a>
												</li>
                                   	   </ul>    
									    </li>!-->
                                        
                                        
                                        <!--  <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i>Events
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/events/view" class="nav-link ">
														<i class="fa fa-user"></i> View Events  </a>
												</li>
											     
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/events/add" class="nav-link ">
														<i class="icon-pencil"></i> Add Event</a>
												</li>
                                   	   </ul>    
									    </li>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i>Statement Candidates
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/candidates/view" class="nav-link ">
														<i class="fa fa-user"></i> View Candidates  </a>
												</li>
												
												<!--<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/campaigns/add" class="nav-link ">
														<i class="icon-pencil"></i> Add Campaign</a>
												</li>-->
                                                
                                               <!-- <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/candidates/upload_bulk_candidates" class="nav-link ">
														<i class="icon-pencil"></i> Upload Bulk Candidates</a>
												</li>
                                                
                                               <!--  <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/bulk_certificates/download" class="nav-link ">
														<i class="icon-pencil"></i> Get Bulk Certificates</a>
												</li>-->
										 <!--  </ul>    
									    </li>!-->
                                        
                                        <li>
                                            <a href="<?php echo base_url();?>Logout">
                                                <i class="icon-key"></i> Log Out </a>
                                        </li>
                                        
                                          <!-- <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i> Reports
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/language_reports/report_date_wise" class="nav-link ">
														<i class="fa fa-user"></i> Candidates Language  Report  </a>
												</li>
                                                
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/trainingpushreports/push_report" class="nav-link ">
														<i class="fa fa-user"></i> Data Push Report  </a>
												</li>
										   </ul>    
									    </li>-->
                                        
                                     <!--   
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i> Courses
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/dw/courses/view" class="nav-link ">
														<i class="fa fa-user"></i>DW Courses </a>
												</li>
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/posp/courses/view" class="nav-link ">
														<i class="fa fa-user"></i>Posp Courses </a>
												</li>
										   </ul>    
									    </li>-->
                                        
                                      <!--  <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i>DW API Log
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/apidashboard" class="nav-link ">
														<i class="fa fa-log"></i> Dw Main API Log </a>
												</li>
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/apidashboard/posp" class="nav-link ">
														<i class="fa fa-log"></i> Dw Posp API Log </a>
												</li>
										   </ul>    
									    </li>
                                        
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i> Skill
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/skill/send_sms" class="nav-link ">
														<i class="fa fa-user"></i> Send Sms</a>
												</li>
										   </ul>    
									    </li>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i>Hotline Campaigns
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/hotline/campaigns/view" class="nav-link ">
														<i class="fa fa-user"></i> View Campaigns  </a>
												</li>
												
												<li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/hotline/campaigns/add" class="nav-link ">
														<i class="icon-pencil"></i> Add Campaign</a>
												</li>
                                                
                                                <li aria-haspopup="true" class=" ">
													<a href="<?php echo base_url(); ?>admin/hotline/campaigns/upload_bulk_candidates" class="nav-link ">
														<i class="icon-pencil"></i> Upload Bulk Candidates</a>
												</li>
                                                
										   </ul>    
									    </li>-->
                                          
                                          
                                          
                                        
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
                                                <i class="fa fa-bank"></i> Vendors
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/vendors/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Vendors  </a>
                                                        </li>
                                                        
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/vendors/add" class="nav-link ">
                                                                <i class="icon-pencil"></i> Add Vendor</a>
                                                        </li>
                                                   </ul>
                                                   
                                            </li>
                                            
                                            
                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-bank"></i> Events
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/events/events_master" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Master Events  </a>
                                                        </li>
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/events/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Events  </a>
                                                        </li>
                                                        
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/events/add" class="nav-link ">
                                                                <i class="icon-pencil"></i> Add Event</a>
                                                        </li>
                                                   </ul>
                                                   
                                            </li>
                                            
                                           
                                      
                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="icon-users"></i> Participants
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>company/participants/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Participants </a>
                                                        </li>
                                                   </ul>
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
                                            <a href="<?php echo base_url(); ?>vendors/dashboard"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                     
                               			 <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                            <a href="javascript:;">
                                                <i class="fa fa-user"></i> Trainers
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>vendors/trainers/view" class="nav-link ">
                                                                <i class="fa fa-tag"></i> View Trainers  </a>
                                                        </li>
                                                        
                                                        <li aria-haspopup="true" class=" ">
                                                            <a href="<?php echo base_url(); ?>vendors/trainers/add" class="nav-link ">
                                                                <i class="icon-pencil"></i> Add Trainer</a>
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
									