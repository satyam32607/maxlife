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
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

 <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
          
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
                <li> <a href="<?php echo base_url(); ?>company/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>company/events/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                <li> <span><?php echo $heading; ?></span> </li>
              </ul>
              <!-- END PAGE BREADCRUMBS --> 
              <!-- BEGIN PAGE CONTENT INNER -->
              <div class="page-content-inner">
                <div class="row">
                  <div class="col-md-9">
                  <?php $this->load->view("includes/notifications.php");?>
                    <div class="portlet box green">
                      <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-calendar-plus-o"></i><?php echo $heading; ?> </div>
                      </div>
                      <div class="portlet-body form">
                       <?php  $attributes = array('id' => 'comp_form','name' => 'role_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
							 echo form_open_multipart(base_url().'company/events/edit/'.$edit_data->event_id.'', $attributes);
							 echo form_hidden('event_id', $edit_data->event_id);
					   ?>
                        <div class="form-body">
                          <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below. </div>
                          <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            Your form validation is successful! </div>
                          <?php if((validation_errors()) || ($already_msg)):?>
                          <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span> <?php echo common_error_msg; ?><?php echo $already_msg;?></span> </div>
                          <?php endif; ?>
                         <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Event name <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'event_name',
									  'id'          => 'event_name',	
									  'value'       => $edit_data->event_name,										
									  'maxlength'   => '255',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('event_name');
								  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Event Title</label>
                                <?php $data = array(
									  'name'        => 'event_title',
									  'id'          => 'event_title',	
									  'value'       => $edit_data->event_title,							
									  'maxlength'   => '255',
									  'class'   => 'form-control',
									  );
								   echo form_input($data);
								   echo form_error('event_title');
								  ?>
                              </div>
                            </div>
                            
                            
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Choose Template <span class="required"> * </span></label>
                                   <?php
									$fields = array('is_active'=>'1');
									$template_array = gettabledropdown('templates',$fields,'template_id','template_name','template_name','ASC');
									$selected = ($this->input->post('template_id')) ? $this->input->post('template_id') : $edit_data->template_id;
									echo form_dropdown('template_id', $template_array,  $selected,'id="template_id" class="form-control"  required ');
								   ?>
                              </div>
                            </div>
                            
                          
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Vendor  <span class="required"> * </span></label>
                                  <?php
									$fields = array('is_active'=>'1','user_type'=>'V');
									$vendor_array = gettabledropdown('users',$fields,'user_id','name','name','ASC');
									$selected = ($this->input->post('vendor_id')) ? $this->input->post('vendor_id') :  $edit_data->vendor_id;
									echo form_dropdown('vendor_id', $vendor_array,  $selected,'id="vendor_id" class="form-control"  required ');
								   ?>
                              </div>
                            </div>
                            
                           
                          </div>
                          
                          <!--/row-->
                          
                          
                          <div class="row">
                          
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Batch  <span class="required"> * </span></label>
                                  <?php
									$fields = array('is_active'=>'1','company_id'=>$this->session->userdata('master_id'));
									$batches_array = gettabledropdown('batches',$fields,'batch_id','batch_name','batch_id','ASC');
									$selected = ($this->input->post('batch_id')) ? $this->input->post('batch_id') : $edit_data->batch_id;
									echo form_dropdown('batch_id', $batches_array,  $selected,'id="batch_id" class="form-control"  required ');
								   ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Event date <span class="required"> * </span></label>
                                 <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                     <?php
                                      $data = array(
                                          'name'        => 'event_date',
                                          'id'          => 'event_date',
                                          'value'       => $edit_data->event_date,
                                          'maxlength'   => '15',
                                          'class'   => 'form-control',
                                          'placeholder'   => 'YYYY-MM-DD',
                                          'required'   => 'required',
                                       );
                                      echo form_input($data);
                                      echo form_error('event_date');
                                      ?>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">Event Type <span class="required"> * </span></label>
                                <?php
                                $selected = ($this->input->post('event_type')) ? $this->input->post('event_type') : $edit_data->event_type;
                                echo form_dropdown('event_type', $eventTypes,  $selected,'id="event_type" class="form-control"  required ');
                                ?>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">Event Master <span class="required"> * </span></label>
                                <?php
                                $selectedMaster = ($this->input->post('event_master_id')) ? $this->input->post('event_master_id') : $edit_data->event_master_id;
                                echo form_dropdown('event_master_id', $eventMasters,  $selectedMaster,'id="event_master_id" class="form-control"  required ');
                                ?>
                              </div>
                            </div>
                          </div>
                          <!--/row-->
                          
                          
                          <div class="row">
                          
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Event Header Text <span class="required"> * </span></label>
                               <?php $data = array(
                                  'name'        => 'event_header_text',
                                  'id'          => 'event_header_text',	
                                  'value'       => $edit_data->event_header_text,
                                  'rows'   => '4',									
                                  'class'   => 'form-control',
                                  );
                                 echo form_textarea($data);
                                 echo form_error('event_header_text');
                                ?>
                              </div>
                            </div>
                           
                                    
                          </div>
                          <!--/row-->
                          <div class="portlet box blue-hoki">  
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-building" aria-hidden="true"></i>Event Sessions </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand"> </a>
                                </div>
                            </div>
                            <div class="portlet-body portlet-expand">
                                <div class="row"> 
                                <div class="col-md-12">
                                
                                    <?php
									 if(is_array($resultsessions))
									 {
									 foreach ($resultsessions as $sessionkey=> $sessionrow){
									 ?> 
                                    <div class="form-group">
                                   
                                        <div class="col-md-12">
                                                   
                                                        <div class="col-md-3">
                                                            <label class="control-label">Agenda</label>
                                                           <?php 
																$data = array(
																  'name'        => 'agenda',
																  'id'          => 'agenda',	
																  'value'       => $sessionrow->agenda,		
																  'maxlength'   => '255',
																  'class'   => 'form-control',
																  'required'   => 'required',
																  'readonly'   => true,
																  );
																echo form_input($data);
															  ?>
                                                            </div>
                                                        
                                                        <div class="col-md-3">
                                                         <label class="control-label">Start time</label>
                                                          <div class="input-group bs-datetime">
                                                            <input  name="start_time" id="start_time" class="form-control" readonly size="16" type="text" value="<?php echo $sessionrow->start_time; ?>" >
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                          <label class="control-label">End time</label>
                                                          <div class="input-group bs-datetime">
                                                            <input  name="end_time" id="end_time" class="form-control" readonly size="16" type="text" value="<?php echo $sessionrow->end_time; ?>">
                                                            
                                                            </div>
                                                        </div>
                                                           
                                                        <div class="col-md-1">
                                                            <label class="control-label">&nbsp;</label>
                                                            <br>
                                                             <a class="label  label-danger" onclick="return confirm('Do you want to delete this Record ?');" href="<?php echo base_url();?>company/events/delete_event_session/<?php echo $sessionrow->event_session_id; ?>/<?php echo $sessionrow->event_id; ?>"><i class="fa fa-close"></i></a>
                                                        </div>
                                           
                                        </div>
                                        
                                        
                                        
                                    </div>
                                    
                                    <?php } } ?>
                                    
                                    
                                    
                                </div>
                            </div>
                            
                            <h4 style="padding-left:20px;">Add More</h4>
                            
                            <div class="row"> 
                            <div class="col-md-12">
                                 <div class="form-group">
                                    
                                    <?php
                                     $start_time = '10:30 AM';
                                     $end_time = '10:40 AM';
                                    ?>
                                    <div class="col-md-12">
                                        <div class="mt-repeater">
                                            <div data-repeater-list="group-a">
                                                <div data-repeater-item="" class="row">
                                                    <div class="col-md-3">
                                                        <label class="control-label">Agenda</label>
                                                       <?php 
                                                            $data = array(
                                                              'name'        => 'agenda',
                                                              'id'          => 'agenda',	
                                                              'value'       => set_value('agenda'),		
                                                              'maxlength'   => '255',
                                                              'class'   => 'form-control',
                                                              );
                                                            echo form_input($data);
                                                            echo form_error('agenda');
                                                          ?>
                                                        </div>
                                                    
                                                    <div class="col-md-3">
                                                     <label class="control-label">Start time</label>
                                                      <div class="input-group bs-datetime">
                                                        <input  name="start_time" id="start_time" class="form-control clockface_1" data-format="hh:mm A" size="16" type="text" value="" >
                                                        <span class="input-group-addon">
                                                            <button class="btn default date-reset" type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </span>
                                                        <span class="input-group-addon">
                                                            <button class="btn default date-set" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                      <label class="control-label">End time</label>
                                                      <div class="input-group bs-datetime">
                                                        <input  name="end_time" id="end_time" class="form-control clockface_1" data-format="hh:mm A" size="16" type="text" value="">
                                                        <span class="input-group-addon">
                                                            <button class="btn default date-reset" type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </span>
                                                        <span class="input-group-addon">
                                                            <button class="btn default date-set" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    
                                                        
                                                    <div class="col-md-1">
                                                        <label class="control-label">&nbsp;</label>
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="javascript:;" data-repeater-create="" class="btn btn-info mt-repeater-add">
                                                <i class="fa fa-plus-small"></i> Add</a>
                                            <br>
                                            <br> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            </div>
                            </div>
                            
                       
                       
                         </div>  
                                            
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-offset-6 col-md-8">
                              <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>
                              &nbsp;&nbsp;&nbsp;&nbsp;
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
              <!-- END PAGE CONTENT INNER --> 
            </div>
          </div>
          <!-- END PAGE CONTENT BODY --> 
          <!-- END CONTENT BODY --> 
        </div>
        <!-- END CONTENT --> 
        <!-- BEGIN QUICK SIDEBAR --> 
        <a href="javascript:;" class="page-quick-sidebar-toggler"> <i class="icon-login"></i> </a> 
        <!-- END QUICK SIDEBAR --> 
      </div>
      <!-- END CONTAINER --> 
    </div>
  </div>
  <?php $this->load->view("includes/footer.php");?>
</div>
<?php $this->load->view("includes/scripts.php");?>
<!-- BEGIN CUSTOM SCRIPTS --> 
<!-- BEGIN PAGE LEVEL PLUGINS -->
 <script src="<?php echo base_url();?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">
   $('#event_date').datepicker({
	    format: 'yyyy-mm-dd',
	 	changeMonth: true,changeYear: true,startDate: '-2y',endDate: '0',
	    autoclose: true
	});
</script>
</body>
</html>