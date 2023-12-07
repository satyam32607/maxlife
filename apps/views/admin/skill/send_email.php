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
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
            <div class="container"> 
              <!-- BEGIN PAGE BREADCRUMBS -->
              <ul class="page-breadcrumb breadcrumb">
                <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>admin/campaigns/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                        <div class="caption"> <i class="fa fa-users"></i><?php echo $heading; ?> </div>
                      </div>
                      <div class="portlet-body form">
                      
                        <?php  $attributes = array('id' => 'sendemail_form','name' => 'sendemail_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                   	        echo form_open_multipart(base_url().'admin/skill/send_email', $attributes);
							
                         ?>
                        <div class="form-body">
                          <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below. </div>
                          <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            Your form validation is successful! </div>
                          <?php if(validation_errors()):?>
                          <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span> <?php echo validation_errors(); ?></span> </div>
                          <?php endif; ?>
                         			
                          
                          <div class="row">
                          
                          <div class="col-md-6">
                             <div class="form-group">
                             <label class="control-label">Choose Template  <span class="required"> * </span></label>
                            <?php 
							  $sms_template_array = $this->skill_model->get_sms_email_templates('e');
							  $selected = ($this->input->post('template_id')) ? $this->input->post('template_id') : '';
							  echo form_dropdown('template_id', $sms_template_array,  $selected,'id="template_id" class="form-control"  required ');
							  echo form_error('template_id');
							  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Email Subject<span class="required"> * </span></label>
                                  <?php
									  $data = array(
									  'name'        => 'email_subject',
									  'id'          => 'email_subject',	
									  'value'       => set_value('email_subject') ? $this->input->post("email_subject") : '',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
									 echo form_input($data);
									?>
					         </div>
                            </div>
                           
                          </div>
                          
                          
                          <div class="row">
                          
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Email Body<span class="required"> * </span></label>
                                   <?php
									  $data = array(
									  'name'        => 'email_body',
									  'id'          => 'email_body',	
									  'value'       => set_value('email_body') ? $this->input->post("email_body") : '',
									  'rows'   => '8',									
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
									 echo form_textarea($data);
									?>
						    </div>
                            </div>
                           
                          </div>
                     
                          
                         <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <input type="checkbox" name="selectall[]" id="selectall">&nbsp;Select All
                              </div>
                            </div>
                          </div>
                          
                            <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Candidates List</label>
                                 <div style="height:380px; margin-left:10px;overflow-y:scroll">
                                       <div class="md-checkbox-list">
                                       <?php
									    $candidates_array=$this->skill_model->get_alert_candidates_list('email');
									    if(is_array($candidates_array))
                                        {
                                    	 foreach($candidates_array as $candrow){
									   ?>
                                        <div class="md-checkbox">
                                            <input id="candidate_id<?php echo $candrow->candidate_id; ?>" name="candidate_id[]" value="<?php echo $candrow->candidate_id; ?>" class="md-check checkbox_ids" type="checkbox">
                                           
                                            <label for="candidate_id<?php echo $candrow->candidate_id; ?>">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span><?php echo $candrow->candidate_name; ?> - <?php echo strtolower($candrow->candidate_email); ?> </label>
                                        </div>
                                        <?php 
                                          }
                                        }
                                       ?>
                                    </div>
                                    </div>
                                    <?php echo form_error('candidate_id[]'); ?>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row-->
                                     
                       </div>                     
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-offset-6 col-md-8">
                              <button type="submit" id="submit_btn" class="btn green" value="Submit">Save & Continue</button>
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
<script src="<?php echo base_url();?>assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>

<script>
$('#template_id').change(function(){
		var template_id = $('#template_id').val();
		var template_array = template_id.split("|||");
		//alert(template_array[0]);
		if(template_array[1]!='')
		 {
			$('#email_subject').val("");
			$('#email_subject').val(template_array[1]);
			
			$('#email_body').val("");
			$('#email_body').val(template_array[2]);
		 }
		});

	   $('#selectall').click(function(event) {  //on click 
			if(this.checked) { // check select status
				$('.checkbox_ids').each(function() { //loop through each checkbox
					this.checked = true;  //select all checkboxes with class "checkbox1"               
				});
			}else{
				$('.checkbox_ids').each(function() { //loop through each checkbox
					this.checked = false; //deselect all checkboxes with class "checkbox1"     
				});         
			}
		 });
	</script>
</body>
</html>