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
          <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
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
                                
                                <?php $this->load->view("includes/notifications.php");?>
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                            <a href="<?php echo base_url(); ?>admin/hotline/dashboard">Dashboard</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                          <li>
                                            <a href="<?php echo base_url(); ?>admin/hotline/campaigns/view"><?php echo $main_heading; ?></a>
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
                                            <div class="portlet box green">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-upload"></i><?php echo $heading; ?> </div>
                                                </div>
                                                <div class="portlet-body">

                                                    <div class="row">
                                                        
                                                        <div class="col-md-12 col-sm-9 col-xs-9">
                                                          <?php  $attributes = array('id' => 'upload_customers_form','name' => 'upload_customers_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                                                                 echo form_open_multipart(base_url().'admin/hotline/campaigns/upload_bulk_candidates', $attributes);
                                                          ?>
                                                         <div class="form-body">
                                                         <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                         <div class="alert alert-success display-hide">
                                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                              
														 <?php if((validation_errors()) || ($error) || ($err)):?>
                                                        <div class="alert alert-danger">
                                                            <button class="close" data-close="alert"></button>
                                                             <span> <?php echo validation_errors(); ?><?php if(isset($error)): echo $error; endif; if(isset($err)): echo '<p>'. $err.'</p>'; endif;?></span>
                                                        </div>
                                                        <?php endif; ?>
                                                          
                                                                  
                                                              <div class="row">
                                                             
                                                               <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    <label class="control-label">Select Campaign <span class="required"> * </span></label>
                                                                   <?php
																    $fields = array('is_active'=>'1');
																 	 $campaigns_array = gettabledropdown('hotline_campaigns',$fields,'campaign_id','campaign_name','campaign_name','ASC');
																	 $selected = ($this->input->post('campaign_id')) ? $this->input->post('campaign_id') : $campaign_id;
																	 echo form_dropdown('campaign_id', $campaigns_array,  $selected,'id="campaign_id" class="form-control select2" ');
																	?>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    SAVE AS in CSV FORMAT. For help please follow below mentioned link<br />
                                                                    <span class="blue"><a class="blue" HREF="javascript:void(0)" style="text-decoration:underline;" onclick="window.open('<?php echo base_url();?>csv_instructions.html', 'csvinstructions','width=590,height=590,menubar=no,status=no,scrollbars=yes,resizable=yes','_blank')">Instructions to save an EXCEL FILE in CSV Format</a>&nbsp;</span>
                                                                    </div>
                                                                </div>
                                                             
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            <div class="row">
                                                             <div class="col-md-6">
                                                              <div class="btn btn-primary required">
                                                                    <span>Upload CSV File</span><input id="userfile" type="file" name="userfile" required class="upload" />
                                                              </div> 
                                                              
                                                              <span class="blue">
                                                                    &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/hotline/campaigns/sample_file_download">Download Sample File</a>
                                                            </span>
                                                              
                                                              <div class="clearfix margin-top-10">
                                                                         <span><p class="hint-text"><strong>Upload CSV File</strong><br>
                      															  File size must be less than 3Mb.</p></span>
                                                               </div>
                                                                    
                                                               </div>
                                                                 
                                                              </div>
                         
                                                             <!--/row-->
                                                             
                                                               
                                                                
                                                     
                                                         </div>
                                                            
                                                        
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-6 col-md-8">
                                                                    <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;
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