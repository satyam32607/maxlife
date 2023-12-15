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
                <li> <a href="<?php echo base_url(); ?>admin/services/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                      
                        <?php  $attributes = array('id' => 'camp_form','name' => 'camp_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
							 echo form_open_multipart(base_url().'admin/services/edit/'.$edit_data->service_id.'', $attributes);
							 echo form_hidden('service_id', $edit_data->service_id);
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
                            <span> <?php echo validation_errors(); ?><?php echo $already_msg;?></span> </div>
                          <?php endif; ?>
                          
                          
                        <div class="row">
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Company <span class="required"> * </span></label>
                                <?php
									$fields = array('is_active'=>'1','user_type'=>'C','is_master'=>'1');
									$company_array = gettabledropdown('users',$fields,'user_id','name','name','ASC');
									$selected = ($this->input->post('company_id')) ? $this->input->post('company_id') :$edit_data->company_id;
									echo form_dropdown('company_id', $company_array,  $selected,'id="company_id" class="form-control"  required ');
									echo form_error('company_id');
								   ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Category <span class="required"> * </span></label>
                                <?php
									$fields = array('is_active'=>'1');
									$category_array = gettabledropdown('categories',$fields,'category_id','category_name','category_name','ASC');
									$selected = ($this->input->post('category_id')) ? $this->input->post('category_id') : $edit_data->category_id;
									echo form_dropdown('category_id', $category_array,  $selected,'id="category_id" class="form-control"  required ');
									echo form_error('category_id');
								   ?>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                          
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Service name <span class="required"> * </span></label>
                                <?php
								    $data = array(
									  'name'        => 'service_name',
									  'id'          => 'service_name',	
									  'value'       => set_value('service_name') ? $this->input->post("service_name") : $edit_data->service_name,			
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('service_name');
								  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Service Price <span class="required"> * </span></label>
                                <?php
								    $data = array(
									  'name'        => 'service_price',
									  'id'          => 'service_price',	
									  'value'       => set_value('service_price') ? $this->input->post("service_price") : $edit_data->service_price,			
									  'maxlength'   => '10',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								  ?>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                          
                          
                          <div class="row">
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Service Code <span class="required"> * </span></label>
                                <?php
								    $data = array(
									  'name'        => 'service_code',
									  'id'          => 'service_code',	
									  'value'       => set_value('service_code') ? $this->input->post("service_code") : $edit_data->service_code,			
									  'maxlength'   => '60',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Service short name </label>
                                <?php
								    $data = array(
									  'name'        => 'service_short_name',
									  'id'          => 'service_short_name',	
									  'value'       => set_value('service_short_name') ? $this->input->post("service_short_name") : $edit_data->service_short_name,			
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  );
								   echo form_input($data);
								   echo form_error('service_short_name');
								  ?>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                          
                            <div class="row">
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">HSN/SAC <span class="required"> * </span></label>
                                <?php
								    $data = array(
									  'name'        => 'hsn_code',
									  'id'          => 'hsn_code',	
									  'value'       => set_value('hsn_code') ? $this->input->post("hsn_code") : $edit_data->hsn_code,			
									  'maxlength'   => '20',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">GST % <span class="required"> * </span> </label>
                                <?php
								    $data = array(
									  'name'        => 'gst_rate',
									  'id'          => 'gst_rate',	
									  'value'       => set_value('gst_rate') ? $this->input->post("gst_rate") : $edit_data->gst_rate,			
									  'maxlength'   => '10',
									  'class'   => 'form-control',
									  );
								   echo form_input($data);
								   echo form_error('gst_rate');
								  ?>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                          <div class="row">
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">TDS % <span class="required"> * </span></label>
                                <?php
								    $data = array(
									  'name'        => 'tds',
									  'id'          => 'tds',	
									  'value'       => set_value('tds') ? $this->input->post("tds") : $edit_data->tds,			
									  'maxlength'   => '10',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('tds');
								  ?>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                              <label>Service Description </label>
                               <?php $data = array(
                                  'name'        => 'service_description',
                                  'id'          => 'service_description',	
                                  'value'       => set_value('service_description') ? $this->input->post("service_description") : $edit_data->service_description,	
                                  'rows'   => '4',									
                                  'class'   => 'form-control',
                                  );
                                 echo form_textarea($data);
                                 echo form_error('service_description');
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
 

</body>
</html>