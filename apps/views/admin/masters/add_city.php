e<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo isset($title) ? $title : title ; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #3 for bootstrap form validation demos using jquery validation plugin" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-menu-fixed">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <?php $this->load->view("includes/header.php");?>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Bootstrap Form Validation
                                            <small>bootstrap form validation demos using jquery validation plugin</small>
                                        </h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <a href="index.html">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="#">More</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Form Stuff</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        
                                      <div class="row">
                            <div class="col-md-9">
                                
                                
                                
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i><?php echo $heading; ?></div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="portlet-body">
                                       <!-- BEGIN FORM-->
										 <?php  $attributes = array('id' => 'plan_frm','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                                         echo form_open(base_url().'admin/plans/add', $attributes);
                                         ?>
                                                 
                                      <!--   <?php if((validation_errors()) || ($already_msg)):?>
                                        <div class="alert alert-danger">
                                            <button class="close" data-close="alert"></button>
                                             <span> <?php echo validation_errors(); ?><?php echo $already_msg;?></span>
                                        </div>
                                        <?php endif; ?>-->
                                        
                                          <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                          <div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                  
                                               

                                                <div class="portlet-body form">
                                                   
                                                        <div class="form-body">
                                               				    <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Choose Member <span class="required"> * </span></label>
                                                                       <?php
																		$fields = array('is_active'=>'1','user_type'=>'M');
																		$member_array = gettabledropdown('users',$fields,'user_id','name','name','ASC');
																		$selected = ($this->input->post('user_id')) ? $this->input->post('user_id') : set_value('user_id');
																		echo form_dropdown('user_id', $member_array,  $selected,'id="user_id" class="form-control"  required" ');
																	   ?>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                    <label class="control-label">Membership <span class="required"> * </span></label>
                                                                    <?php
                                                                        $role_array = get_role_array();
                                                                        $selected = ($this->input->post('role_id')) ? $this->input->post('role_id') : set_value('role_id');
                                                                        echo form_dropdown('role_id', $role_array,  $selected,'id="role_id" required="required" class="form-control" ');
                                                                      ?> 
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            
                                                            <div class="row">
                                                                
                                                                <div class="col-md-12">
                                                                <div class="form-group">
                                                                <label class="control-label">Start Date <span class="required"> * </span></label>
                                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
																	 <?php $data = array(
                                                                          'name'        => 'start_date',
                                                                          'id'          => 'start_date',
                                                                          'value'       => set_value('start_date'),
                                                                          'maxlength'   => '15',
                                                                          'redonly'  => 'readonly',
                                                                          'class'   => 'form-control',
                                                                          'required'   => 'required',
                                                                       );
                                                                      echo form_input($data);
                                                                      ?>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                 </div>
                                                          
                                                                 </div>
                                                                </div>
                                                               
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            
                                                            <div class="row">
                                                                
                                                                <div class="col-md-12">
                                                                <div class="form-group">
                                                                <label class="control-label">End Date <span class="required"> * </span></label>
                                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
																	 <?php $data = array(
                                                                          'name'        => 'end_date',
                                                                          'id'          => 'end_date',
                                                                          'value'       => set_value('end_date'),
                                                                          'maxlength'   => '15',
                                                                          'redonly'  => 'readonly',
                                                                          'class'   => 'form-control',
                                                                          'required'   => 'required',
                                                                       );
                                                                      echo form_input($data);
                                                                      ?>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                 </div>
                                                          
                                                                 </div>
                                                                </div>
                                                               
                                                            </div>
                                                            <!--/row-->
                                                            
                                                  
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Payment Amount <span class="required"> * </span> </label>
                                                                        <?php $data = array(
																			  'name'        => 'payment_amt',
																			  'id'          => 'payment_amt',	
																			  'value'       => set_value('payment_amt'),	
																			  'class'   => 'form-control',
																			  'required'   => 'required',							
																			  'maxlength'   => '10',
																			  );
																		   echo form_input($data);
																		  ?>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                            <!--/row-->
                                                            
                                                          <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Payment Details <span class="required"> * </span> </label>
                                                                        <?php $data = array(
																		  'name'        => 'payment_details',
																		  'id'          => 'payment_details',	
																		  'value'       => set_value('payment_details'),
																		  'class'   => 'form-control',
																		  'rows'   => '3',
																		  );
																		 echo form_textarea($data);
																		?>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            
                                                             <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Remarks </label>
                                                                        <?php $data = array(
																		  'name'        => 'remarks',
																		  'id'          => 'remarks',	
																		  'value'       => set_value('remarks'),
																		  'class'   => 'form-control',
																		  'rows'   => '5',
																		  );
																		 echo form_textarea($data);
																		?>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                            <!--/row-->
                                                        </div>
                                                        
                                               
                                                </div>
                                              
                                         <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-5 col-md-6">
                                                    <button type="submit" class="btn green" value="Submit">Submit</button>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="reset" name="Reset" value="Reset"  class="btn default">
                                                </div>
                                            </div>
                                         </div>
                                                        
                                       <?php echo form_close(); ?> 
                                        
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                            </div>
                            
                        </div>  
                                        
                                        
                                    </div>
                                    <!-- END PAGE CONTENT INNER -->
                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                        <!-- BEGIN QUICK SIDEBAR -->
                        <a href="javascript:;" class="page-quick-sidebar-toggler">
                            <i class="icon-login"></i>
                        </a>
                        <!-- END QUICK SIDEBAR -->
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <?php $this->load->view("includes/footer.php");?>
        </div>
        <!-- BEGIN QUICK NAV -->
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url();?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>