		
				<div class="page-header">
					<!-- BEGIN HEADER TOP -->
					<div class="page-header-top visible-sm visible-xs">
						<div class="container">
							<!-- BEGIN LOGO -->
							<div class="page-logo">
								<a href="<?php echo base_url(); ?>">
									<img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo.png" alt="logo" class="logo-default">
								</a>
							</div>
							<!-- END LOGO -->
							<!-- BEGIN RESPONSIVE MENU TOGGLER -->
							<a href="javascript:;" class="menu-toggler"></a>
							<!-- END RESPONSIVE MENU TOGGLER -->
						   
						</div>
					</div>
					<!-- END HEADER TOP -->
					<!-- BEGIN HEADER MENU -->
					<div class="page-header-menu">
						<div class="container">
							<div class="page-header-top pull-right hidden-sm hidden-xs">
							 <!-- BEGIN TOP NAVIGATION MENU -->
								<div class="top-menu">
									<ul class="nav navbar-nav pull-right">
										<!-- BEGIN NOTIFICATION DROPDOWN -->
										<!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
										<!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
										<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
											<a href="javascript:;" class="dropdown-toggle" data-close-others="true" id="message_notification">
											</a>
										</li>
										<!-- END NOTIFICATION DROPDOWN -->
                                        
                                        <!--<li class="droddown dropdown-separator">
												<span class="separator"></span>
											</li>-->
										
                                              	<!-- BEGIN INBOX DROPDOWN -->
                                            
											<!-- END INBOX DROPDOWN -->
                                         

                                            
										<!-- BEGIN USER LOGIN DROPDOWN -->
										<li class="dropdown dropdown-user dropdown-dark">
											<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
												<!--<img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/layouts/layout3/img/avatar9.jpg">-->
												<span class="username username-hide-mobile">
												<?php if($this->session->userdata('user_type')=='C' && $this->session->userdata('is_master')=='1'){
													echo $this->session->userdata('name');
												}else
												{
												   echo ucfirst($this->session->userdata('f_name') .' '.$this->session->userdata('l_name')); 
												}?></span>
											</a>
											<ul class="dropdown-menu dropdown-menu-default">
												<!--<li>
													<a href="<?php echo base_url();?>profile/<?php echo $this->session->userdata('user_id')?>">
														<i class="icon-user"></i> My Profile </a>
												</li>-->
												<!--<li>
													<a href="<?php echo base_url();?>change_password">
													   <i class="fa fa-lock"></i> Change Password
													</a>
												</li>-->
												<li class="divider"> </li>
												<li>
													<a href="<?php echo base_url();?>Logout">
														<i class="icon-key"></i> Log Out </a>
												</li>
											</ul>
										</li>
										<!-- END USER LOGIN DROPDOWN -->
										<!-- BEGIN QUICK SIDEBAR TOGGLER -->
										<li class="dropdown dropdown-extended quick-sidebar-toggler">
											<span class="sr-only">Toggle Quick Sidebar</span>
											<i class="icon-logout"></i>
										</li>
										<!-- END QUICK SIDEBAR TOGGLER -->
									</ul>
								</div>
								<!-- END TOP NAVIGATION MENU -->
							</div>
							<!-- BEGIN MEGA MENU -->
							<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
							<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
							<?php 
								$this->load->view("includes/menu.php"); ?>
							<!-- END MEGA MENU -->
						</div>
					</div>
					<!-- END HEADER MENU -->
				</div>
				<!-- END HEADER -->   
				 <!-- BEGIN SHADOW BAR-->
			<?php
				  if($this->session->userdata('user_shadow_id')!=''): ?>
				   <script type="text/javascript">
				   function shadow_mode_redirect(location)
				   { //alert('Hi');  
					 window.location = location;
				   }
				   </script>
					<div class=" shadow-login">
                    
                     <div class="show_live_call_status" style="float:left; font-size:16px; color:#A60B0E;">&nbsp;</div>
                    
						<i class="fa-fw fa fa-warning text-danger"></i>
						<strong class="text-danger">Warning</strong> 
						 You are currently shadowing  <span style="font-size:13px; font-weight:700">"<?php $usertype = user_type_array();echo  $usertype[$this->session->userdata('user_type')]; ?> 
						<?php if($this->session->userdata('name')!='' && $this->session->userdata('name')!='0'):  ?>: <?php echo $this->session->userdata('name');  ?><?php endif; ?>
						 <?php if($this->session->userdata('f_name')!='' && $this->session->userdata('f_name')!='0'):  ?>: <?php echo $this->session->userdata('f_name');  ?><?php endif; ?>"</span>
					     <?php  if($this->session->userdata('user_type')=='A'){ ?>
							<a onClick="shadow_mode_redirect('<?php echo base_url();?>admin/dashboard/login_as');" href="javascript:void(0);" title="Log Out of Shadow Account">
                            <?php } else
							{
							?>
                            <a onClick="shadow_mode_redirect('<?php echo base_url();?>company/dashboard/login_as');" href="javascript:void(0);" title="Log Out of Shadow Account">
                            <?php
							}
						 	?>
                            
					 <span class="glyphicon glyphicon-log-out text-danger" style="font-size:14px;" title="Log Out of Shadow Account"></span>
					</a>
					
				 </div>
			  <?php  endif ?>
				  
			 <!-- END SHADOW BAR -->