<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo isset($title) ? $title : title ; ?></title>
    	 <?php $this->load->view("includes/styles.php");?>
   	   </head>
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
                                        <h1><?php echo $heading; ?></h1>
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
                                            <a href="<?php echo base_url(); ?>dashboard"><?php echo $main_heading; ?></a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span><?php echo $heading; ?></span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        
                                       <div class="row">
                                        <div class="col-md-9">
                                         <?php $this->load->view("includes/notifications.php");?>
                                            
                                            <div class="portlet box green">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-key"></i><?php echo $heading; ?> </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12 col-sm-9 col-xs-9">
                                                          <?php  $attributes = array('id' => 'changepwd_form','name' => 'changepwd_form','class' => 'form-horizontal','role' => 'form','autocomplete' => 'off');
                                                                 echo form_open(base_url().'change_password', $attributes);
                                                          ?>
                                                         <div class="form-body">
                                                         
                                                        <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                             <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                                  
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">New password <span class="required"> * </span></label>
                                                                     <div class="col-md-8"> 
                                                                     <?php $data = array(
																		  'name'        => 'userpass',
																		  'id'          => 'userpass',
																		  'value'       => set_value('userpass'),
																		  'maxlength'   => '32',
																		  'class'   => 'form-control',
																		  'type'   => 'password',
																		  'minlength'   => '4',
																		  'required'   => 'required',
																		  'placeholder'   => 'Minimum of 4 characters.',
																		  );
																		  echo form_input($data);
																		  echo form_error('userpass');
																     ?>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Confirm Password <span class="required"> * </span></label>
                                                                     <div class="col-md-8"> 
                                                                       <?php $data = array(
																			  'name'        => 'compass',
																			  'id'          => 'compass',
																			   'value'       => set_value('compass'),
																			  'maxlength'   => '32',
																			  'class'   => 'form-control',
																			  'type'   => 'password',
																			  'required'   => 'required',
																			  );
																			  echo form_input($data);
																			  echo form_error('compass');
																	    ?>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                           <div class="row">
                                                           <div class="col-md-12">&nbsp;&nbsp;</div>
                                                           </div>
                                                        
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-8">
                                                                    <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <input type="reset" class="btn default" name="Reset" value="Reset">
                                                                </div>
                                                            </div>
                                                       </div>
                                                                    
                                                             <?php echo form_close(); ?>
                                                             <?php $this->load->view("includes/loader.php");?>
                                                        </div>
                                                    </div>
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
        <?php $this->load->view("includes/scripts.php");?>
         <!-- BEGIN CUSTOM SCRIPTS -->
		<script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>
		 <!-- END CUSTOM SCRIPTS -->
    </body>

</html>