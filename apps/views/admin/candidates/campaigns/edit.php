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
		<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                            <?php $this->load->view("includes/notifications.php");?>
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/campaigns/view"><?php echo $main_heading; ?></a>
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
                                                        <i class="fa fa-tree"></i><?php echo $heading; ?> </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12 col-sm-9 col-xs-9">
                                                          <?php  $attributes = array('id' => 'camp_form','name' => 'camp_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
															     echo form_open_multipart(base_url().'admin/campaigns/edit/'.$edit_data->campaign_id.'', $attributes);
																 echo form_hidden('campaign_id', $edit_data->campaign_id);
														  ?>
                                                         <div class="form-body">
                                                         <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                         <div class="alert alert-success display-hide">
                                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                              
														 <?php if((validation_errors()) || ($already_msg)):?>
                                                        <div class="alert alert-danger">
                                                            <button class="close" data-close="alert"></button>
                                                             <span> <?php echo common_error_msg; ?><?php echo $already_msg;?></span>
                                                        </div>
                                                        <?php endif; ?>
                                                        
			                                                <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Campaign name <span class="required"> * </span></label>
                                                                        <?php $data = array(
																			  'name'        => 'campaign_name',
																			  'id'          => 'campaign_name',	
																			  'value'       => $edit_data->campaign_name,					
																			  'maxlength'   => '100',
																			  'class'   => 'form-control',
																			  'required'   => 'required',
																			  );
																		   echo form_input($data);
																		   echo form_error('campaign_name');
																		  ?>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                              <div class="form-group">
                                                                <label class="control-label">Start date<span class="required"> * </span></label>
                                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                                     <?php $data = array(
                                                                          'name'        => 'start_date',
                                                                          'id'          => 'start_date',
                                                                          'value'       => $edit_data->start_date,
                                                                          'maxlength'   => '15',
                                                                          'redonly'  => 'readonly',
                                                                          'class'   => 'form-control',
                                                                          'placeholder'   => 'YYYY-MM-DD',
                                                                          'required'   => 'required',
                                                                       );
                                                                      echo form_input($data);
                                                                      echo form_error('start_date');
                                                                      ?>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                              <div class="form-group">
                                                                <label class="control-label">End date<span class="required"> * </span></label>
                                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                                     <?php $data = array(
                                                                          'name'        => 'end_date',
                                                                          'id'          => 'end_date',
                                                                          'value'       => $edit_data->end_date,
                                                                          'maxlength'   => '15',
                                                                          'redonly'  => 'readonly',
                                                                          'class'   => 'form-control',
                                                                          'placeholder'   => 'YYYY-MM-DD',
                                                                          'required'   => 'required',
                                                                       );
                                                                      echo form_input($data);
                                                                      echo form_error('end_date');
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
                                                             <div class="col-md-6">
                                                                    <div class="form-group">
                                                                     <label>Description </label>
																	<?php $data = array(
                                                                      'name'        => 'description',
                                                                      'id'          => 'description',	
                                                                      'value'       => $edit_data->description,
																	  'rows'   => '4',									
                                                                      'class'   => 'form-control',
																      );
                                                                     echo form_textarea($data);
																	 echo form_error('description');
                                                                    ?>
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
   	 <!-- END CUSTOM SCRIPTS -->
         <script>
		$(document).ready(function(){
			
		$('#start_date').datepicker({
		changeMonth: true,startDate: '-1y',endDate: '0',
        format: 'yyyy-mm-dd',
		 autoclose: true,
  		 }).on('changeDate', function(e) {});
		
		 $("#end_date").datepicker({
		 format: 'yyyy-mm-dd',
		 autoclose: true,
		 }).on('changeDate', function(e) {
			
		 }); 
			
		});
	</script>
        
    </body>
</html>