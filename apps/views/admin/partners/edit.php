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
                <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>admin/partners/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                      
                      <?php  $attributes = array('id' => 'comp_form','name' => 'role_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                                echo form_open_multipart(base_url().'admin/partners/edit/'.$edit_data->user_id.'', $attributes);
                                echo form_hidden('user_id', $edit_data->user_id);
                                echo form_hidden('user_address_id', $edit_data->user_address_id);
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
                                <label class="control-label">Choose  Company <span class="required"> * </span></label>
                                <?php
                                  $fields = array('is_active'=>'1','user_type'=>'C','is_master'=>'1');
                                  $company_array = gettabledropdown('users',$fields,'user_id','name','name','ASC');
                                  $selected = ($this->input->post('company_id')) ? $this->input->post('company_id') : $edit_data->master_id;
                                  echo form_dropdown('company_id', $company_array,  $selected,'id="company_id" class="form-control"  required ');
                                  echo form_error('company_id');
                                  ?>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Primary Email <span class="required"> * </span></label>
                                <?php $data = array(
                                  'name'        => 'email',
                                  'id'          => 'email',	
                                  'value'       => set_value('email') ? $this->input->post("email") : $edit_data->email,								
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
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Company name <span class="required"> * </span></label>
                                <?php $data = array(
                                'name'        => 'comp_name',
                                'id'          => 'comp_name',	
                                'value'       => set_value('comp_name') ? $this->input->post("comp_name") : $edit_data->name,						
                                'maxlength'   => '100',
                                'class'   => 'form-control',
                                'required'   => 'required',
                                );
                              echo form_input($data);
                              echo form_error('comp_name');
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
                                    'value'       => set_value('first_name') ? $this->input->post("first_name") : $edit_data->first_name,									
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
                                  'value'       => set_value('last_name') ? $this->input->post("last_name") : $edit_data->last_name,							
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
                          $selected = ($this->input->post('country_id')) ? $this->input->post('country_id') : $edit_data->country_id;
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
                                <label>Pin code </label>
                                <?php $data = array(
									  'name'        => 'pin_code',
									  'id'          => 'pin_code',	
									  'value'       => set_value('pin_code') ? $this->input->post("pin_code") : $edit_data->pin_code,								
									  'min'   => '4',
									  'maxlength'   => '8',
									  'class'   => 'form-control',
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
                                <label class="control-label">Primary Mobile no <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'mobile_no1',
									  'id'          => 'mobile_no1',									
									  'value'       => set_value('mobile_no1') ? $this->input->post("mobile_no1") : $edit_data->mobile_no1,				
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
                                <label class="control-label">Alternate Mobile no </label>
                                <?php $data = array(
									  'name'        => 'mobile_no2',
									  'id'          => 'mobile_no2',									
									  'value'       => set_value('mobile_no2') ? $this->input->post("mobile_no2") : $edit_data->mobile_no2,		
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
                                <label class="control-label">Alternate Email</label>
								     <?php $data = array(
                                      'name'        => 'alternate_email',
                                      'id'          => 'alternate_email',	
                                      'value'       => set_value('alternate_email') ? $this->input->post("alternate_email") : $edit_data->alternate_email,							
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
                                <label class="control-label">Landline no </label>
                                <?php $data = array(
                                'name'        => 'landline_no',
                                'id'          => 'landline_no',									
                                'value'       => set_value('landline_no') ? $this->input->post("landline_no") : $edit_data->landline_no,
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
                                <label>Address </label>
                                <?php $data = array(
                                  'name'        => 'address',
                                  'id'          => 'address',	
                                  'value'       => set_value('address') ? $this->input->post("address") : $edit_data->address,
                                  'rows'   => '4',									
                                  'class'   => 'form-control',
                                  );
                                echo form_textarea($data);
                                echo form_error('address');
                                ?>
                              </div>
                            </div>

                     
                      </div>    
                           
                          
                          <!--/row-->
                          
                       
                           
                          
                          <div class="row">
                            
                          </div>
                          
                          <!--/row-->
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Profile</label>
                                 <?php $data = array(
                              'name'        => 'company_profile',
                              'id'          => 'company_profile',	
                              'value'       => set_value('company_profile') ? $this->input->post("company_profile") : $edit_data->company_profile,
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