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
                <li> <a href="<?php echo base_url(); ?>company/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>company/vendors/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                       <?php  $attributes = array('id' => 'comp_form','name' => 'role_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
							 echo form_open_multipart(base_url().'company/vendors/edit/'.$edit_data->user_id.'', $attributes);
							 echo form_hidden('user_id', $edit_data->user_id);
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
                                <label class="control-label">Vendor name <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'vendor_name',
									  'id'          => 'vendor_name',	
									  'value'       => $edit_data->name,								
									  'maxlength'   => '100',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('vendor_name');
								  ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Primary Email <span class="required"> * </span></label>
                                <?php $data = array(
									  'name'        => 'email',
									  'id'          => 'email',	
									  'value'       => $edit_data->email,						
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
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Primary Mobile no </label>
                                <?php $data = array(
									  'name'        => 'mobile_no1',
									  'id'          => 'mobile_no1',									
									  'value'       => $edit_data->mobile_no1,		
									  'maxlength'   => '15',
									  'class'   => 'form-control',
									  );
									 echo form_input($data);
									 echo form_error('mobile_no1');
									?>
                              </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                          
                         
                          
                          <div class="row">
                          
                            <div class="col-md-6">
                             <label class="control-label">Vendor Photo </label>
                              
                              <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" id="dvPreview">
                                       <?php if($edit_data->user_photo!='')
                                       {
                                            $photo    ='<img id="preview" src="'.base_url().'assets/static/'.$this->session->userdata('master_id').'/vendor_photos/resized/'.$edit_data->user_photo.'"> ';
                                       }
                                       else
                                       {
                                            $photo    ='<img id="preview" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"> ';
                                       }
                                       echo $photo;
                                       ?>
                                        
                                         </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input id="user_photo" type="file" name="user_photo" class="upload"  accept="image/*"/> </span>
                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-danger">NOTE! </span>
                                     <span>Attached image thumbnail format JPG,PNG,JPEG</span>
                                </div>
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
</body>
</html>