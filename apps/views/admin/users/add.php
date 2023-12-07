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
              <!-- BEGIN PAGE BREADCRUMBS -->
              <ul class="page-breadcrumb breadcrumb">
                <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>admin/users/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                        <div class="caption"> <i class="fa fa-user"></i><?php echo $heading; ?> </div>
                      </div>
                      <div class="portlet-body form">
                      
                        <?php  $attributes = array('id' => 'userreg_form','name' => 'userreg_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                   	        echo form_open_multipart(base_url().'admin/users/add', $attributes);
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
                         <!-- <div class="row">
                            <div class="col-md-12"> <small class="pull-right">Note : Default Password : (abc123)</small></div>
                          </div>-->
                          
                          <!--/row-->
                          
                          <div class="row">
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
                                   <small class="pull-left">Note : (Primary Email is username.) </small>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Urn No. <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'urn_no',
									  'id'          => 'urn_no',	
									  'value'       => set_value('urn_no'),								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('urn_no');
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
									  'value'       => set_value('userpass') ? $this->input->post("userpass") : "",
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
									   'value'       => set_value('compass') ? $this->input->post("compass") : "",
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
                                <label class="control-label">First name <span class="required"> * </span></label>
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
                                <label class="control-label">Last name <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'last_name',
									  'id'          => 'last_name',	
									  'value'       => set_value('last_name'),									
									  'maxlength'   => '80',
									  'class'   => 'form-control',
									   'required'   => 'required',
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
                                <label class="control-label">Date of Birth<span class="required"> * </span></label>
                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
									 <?php $data = array(
                                          'name'        => 'date_of_birth',
                                          'id'          => 'date_of_birth',
                                          'value'       => set_value('date_of_birth'),
                                          'maxlength'   => '15',
                                          'redonly'  => 'readonly',
                                          'class'   => 'form-control',
                                          'placeholder'   => 'YYYY-MM-DD',
										  'required'   => 'required',
                                       );
                                      echo form_input($data);
                                      echo form_error('date_of_birth');
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
                                <label class="control-label">Gender <span class="required"> * </span></label>
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                     <input type="radio" value="m" name="gender" id="m" <?php if($this->input->post("gender") && ($this->input->post("gender")=='m')) { echo 'checked="checked"'; }else { echo 'checked="checked"'; } ?> class="md-radiobtn">
                                        <label for="m">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Male </label>
                                    </div>
                                    
                                    <div class="md-radio">
                                     <input type="radio" value="f" name="gender" id="f" <?php if($this->input->post("gender") && ($this->input->post("gender")=='f')) { echo 'checked="checked"'; } ?> class="md-radiobtn">
                                        <label for="f">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Female </label>
                                    </div>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                          
                          <div class="row">
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Location <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'location_name',
									  'id'          => 'location_name',	
									  'value'       => set_value('location_name'),								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('location_name');
								  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Zone <span class="required"> * </span> </label>
                                <?php $data = array(
									  'name'        => 'zone_name',
									  'id'          => 'zone_name',	
									  'value'       => set_value('zone_name'),								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  );
								   echo form_input($data);
								   echo form_error('zone');
								  ?>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                          
                          <div class="row">
                            
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">State <span class="required"> * </span> </label>
                                <?php $data = array(
									  'name'        => 'state_name',
									  'id'          => 'state_name',	
									  'value'       => set_value('state_name'),								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									   'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('state_name');
								  ?>
                              </div>
                            </div>
                            
                            
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
</body>
</html>