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
                <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>admin/companies/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                        <div class="caption"> <i class="fa fa-tree"></i><?php echo $heading; ?> </div>
                      </div>
                      <div class="portlet-body form">
                      
                        <?php  $attributes = array('id' => 'comp_form','name' => 'comp_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                   	        echo form_open_multipart(base_url().'admin/companies/add', $attributes);
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
                            <div class="col-md-12"> <small class="pull-right">Note : Default Password : (abc123)</small></div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Company name <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'comp_name',
									  'id'          => 'comp_name',	
									  'value'       => set_value('comp_name'),								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('comp_name');
								  ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Primary Email <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'email',
									  'id'          => 'email',	
									  'value'       => set_value('email'),								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  'email'   => true,
									  );
								   echo form_input($data);
								   echo form_error('email');
								  ?>
                              </div>
                            </div>
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Password <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'userpass',
									  'id'          => 'userpass',
									  'value'       => set_value('userpass') ? $this->input->post("userpass") : "abc123",
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
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Confirm Password <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'compass',
									  'id'          => 'compass',
									   'value'       => set_value('compass') ? $this->input->post("compass") : "abc123",
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
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Alternate Email</label>
								 <?php $data = array(
                                      'name'        => 'alternate_email',
                                      'id'          => 'alternate_email',	
                                      'value'       => set_value('alternate_email'),								
                                      'maxlength'   => '100',
                                      'class'   => 'form-control',
                                      'email'   => true,
                                      );
                                   echo form_input($data);
                                   echo form_error('alternate_email');
                                  ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Select Time Zone <span class="required"> * </span></label>
                                <?php
									$time_zone_array = time_zone_array();
									$selected = ($this->input->post('time_zone')) ? $this->input->post('time_zone') : '(UTC+05:30) New Delhi';
									echo form_dropdown('time_zone', $time_zone_array,  $selected,'id="time_zone" class="form-control"  required" ');
									echo form_error('time_zone');
								   ?>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Contact person first name <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'first_name',
									  'id'          => 'first_name',	
									  'value'       => set_value('first_name'),									
									  'maxlength'   => '80',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
									echo form_input($data);
									echo form_error('first_name');
								   ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Contact person last name</label>
                                <?php $data = array(
									  'name'        => 'last_name',
									  'id'          => 'last_name',	
									  'value'       => set_value('last_name'),									
									  'maxlength'   => '80',
									  'class'   => 'form-control',
									  );
									echo form_input($data);
									echo form_error('last_name');
								   ?>
                              </div>
                            </div>
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Country <span class="required"> * </span></label>
                                <?php
									$fields = array('is_active'=>'1');
									$country_array = gettabledropdown('country',$fields,'country_id','country_name','country_name','ASC');
									$selected = ($this->input->post('country_id')) ? $this->input->post('country_id') : '101';
									echo form_dropdown('country_id', $country_array,  $selected,'id="country_id" class="form-control"  required" ');
									echo form_error('country_id');
								   ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">State <span class="required"> * </span></label>
                                <?php
									$state_array = array();
									$state_array[''] = 'Select State'; 
									$selected = "";
									echo form_dropdown('state_id', $state_array,  $selected,'id="state_id" class="form-control"  required" ');
									echo form_error('state_id');
								   ?>
                              </div>
                            </div>
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">City <span class="required"> * </span></label>
                                <?php
									$city_array = array();
									$city_array[''] = 'Select City'; 
									$selected = "";
									echo form_dropdown('city_id', $city_array,  $selected,'id="city_id" class="form-control"  required" ');
									echo form_error('city_id');
								   ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Pin code <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'pin_code',
									  'id'          => 'pin_code',	
									  'value'       => set_value('pin_code'),									
									  'min'   => '4',
									  'maxlength'   => '8',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
									 echo form_input($data);
									 echo form_error('pin_code');
									?>
                              </div>
                            </div>
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Country code <span class="required"> * </span></label>
                                <?php
									$country_code_array = array();
									$country_code_array[''] = 'Select Country code'; 
									$selected = "";
									echo form_dropdown('country_code', $country_code_array,  $selected,'id="country_code" class="form-control"  required" ');
									echo form_error('country_code');
								  ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Landline no </label>
                                <?php $data = array(
									  'name'        => 'landline_no',
									  'id'          => 'landline_no',									
									  'value'       => set_value('landline_no'),			
									  'maxlength'   => '15',
									  'class'   => 'form-control',
									  );
									 echo form_input($data);
									 echo form_error('landline_no');
									?>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Primary Mobile no <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'mobile_no1',
									  'id'          => 'mobile_no1',									
									  'value'       => set_value('mobile_no1'),			
									  'maxlength'   => '15',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
									 echo form_input($data);
									 echo form_error('mobile_no1');
									?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Other Mobile no </label>
                                <?php $data = array(
									  'name'        => 'mobile_no2',
									  'id'          => 'mobile_no2',									
									  'value'       => set_value('mobile_no2'),			
									  'maxlength'   => '15',
									  'class'   => 'form-control',
									  );
									 echo form_input($data);
									 echo form_error('mobile_no2');
									?>
                              </div>
                            </div>
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Address <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'address',
									  'id'          => 'address',	
									  'value'       => set_value('address'),
									   'rows'   => '4',									
									  'class'   => 'form-control',
									   'required'   => 'required',
									  );
									 echo form_textarea($data);
									 echo form_error('address');
									?>
                              </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Assign Workflow <span class="required"> * </span></label>
                                <?php
									$workflow_limit_array= workflow_limit_array();
									$selected = ($this->input->post('workflow_limit')) ? $this->input->post('workflow_limit') : '';
									echo form_dropdown('workflow_limit', $workflow_limit_array,  $selected,'id="workflow_limit" class="form-control"  required ');
									echo form_error('workflow_limit');
								   ?>
                              </div>
                            </div>
                            
                          </div>
                          
                          <!--/row-->
                          
                           <?php 
							 $this->load->view("modules/add_call_setting");
						   ?>
                           
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" id="dvPreview"> <img id="preview" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                  <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
                                    <input id="user_photo" type="file" name="user_photo" class="upload"  accept="image/*"/>
                                    </span> <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                                </div>
                                <div class="clearfix margin-top-10"> <span class="label label-danger">NOTE! </span> <span>Attached image thumbnail format JPG,PNG,JPEG</span> </div>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Company Profile</label>
                                 <?php $data = array(
									  'name'        => 'company_profile',
									  'id'          => 'company_profile',	
									  'value'       => set_value('company_profile'),
									  'rows'       => '6',
									  'class'   => 'form-control',
									  );
									 echo form_textarea($data);
									 echo form_error('company_profile');
									?>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="col-md-3 control-label">Company Modules <span class="required"> * </span></label>
                                <div class="col-md-9">
                                  <div  style="height:350px;  margin-left:10px;overflow-y:scroll">
                                    <div class="md-checkbox-list">
                                      <div class="md-checkbox">
                                        <input type='checkbox' class="md-check"  id='selectall'>
                                        <label for="selectall"> <span></span> <span class="check"></span> <span class="box"></span> Select All </label>
                                      </div>
                                       <?php
										$default_opt=array('1');
										echo $this->master_model->navigate_rights('C',$default_opt);
										?>
                                    </div>
                                  </div>
                                  <?php echo form_error('role_rights[]'); ?> </div>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="col-md-3 control-label">User Modules <span class="required"> * </span></label>
                                <div class="col-md-9">
                                  <div  style="height:350px;  margin-left:10px;overflow-y:scroll">
                                    <div class="md-checkbox-list">
                                      <div class="md-checkbox">
                                        <input type='checkbox' class="md-check"  id='select_all'>
                                        <label for="select_all"> <span></span> <span class="check"></span> <span class="box"></span> Select All </label>
                                      </div>
                                      <?php
										 $default_opt=array('1');
										 echo $this->master_model->navigate_rights('U',$default_opt);
										?>
                                    </div>
                                  </div>
                                  <?php echo form_error('user_modules[]'); ?> </div>
                              </div>
                            </div>
                          </div>
                          
                          <!--/row--> 
                                  
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
         
<!-- END CUSTOM SCRIPTS --> 
<script>
		$(document).ready(function(){
		$('#country_id').bind('change', function () {
			var country_id=$(this).val();
			var state_id=$("#state_id").val();
			if(country_id === null){ 
				var country_id='<?php echo $country_id; ?>';
			}
			if(state_id=== null || state_id==''){ 
				var state_id='<?php echo $state_id; ?>';
			}else{
				var state_id=0;
			}
			
			if(country_code=== null || country_code==''){ 
				var country_code=<?php echo $country_code; ?>;
			}else{
				var country_code=0;
			}
			get_country_code(country_id,country_code);
			get_state(country_id,state_id);
		});
		$('#country_id').trigger('change');
			
			
		$('#state_id').bind('change', function () {
			var state_id=$(this).val();
			var city_id=$("#city_id").val();
			if(state_id === null){ 
				var state_id=<?php echo $state_id; ?>;
			}
			if(city_id=== null || city_id==''){ 
				var city_id=<?php echo $city_id; ?>;
			}else{
				var city_id=0;
			}
			get_city(state_id,city_id);
			
		});
		$('#state_id').trigger('change');
		
	});
	</script>
</body>
</html>