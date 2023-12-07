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
                                            <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/masters/view_roles"><?php echo $main_heading; ?></a>
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
                                                        <i class="fa fa-gift"></i><?php echo $heading; ?> </div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                                          <?php  $attributes = array('id' => 'role_form','name' => 'role_form','class' => 'form-horizontal','role' => 'form','autocomplete' => 'off');
																 echo form_open(base_url().'admin/masters/edit_role/'.$edit_data->role_id.'', $attributes);
																 echo form_hidden('role_id', $edit_data->role_id);
														  ?>
                                                         <div class="form-body">
                                                         
														   <?php if((validation_errors()) || ($already_msg)):?>
                                                            <div class="alert alert-danger">
                                                                <button class="close" data-close="alert"></button>
                                                                 <span> <?php echo validation_errors(); ?><?php echo $already_msg;?></span>
                                                            </div>
                                                            <?php endif; ?>
                                                        
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Role name <span class="required"> * </span></label>
                                                                     <div class="col-md-8"> 
                                                                    <?php $data = array(
                                                                      'name'        => 'role_name',
                                                                      'id'          => 'role_name',	
                                                                      'value'       => $edit_data->role_name,				
                                                                      'maxlength'   => '100',
                                                                      'class'   => 'form-control',
                                                                      'required'   => 'required',
                                                                      );
                                                                   echo form_input($data);
                                                                  ?>
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Description</label>
                                                                     <div class="col-md-8"> 
                                                                    <?php $data = array(
                                                                      'name'        => 'description',
                                                                      'id'          => 'description',	
                                                                      'value'       => $edit_data->description,										
                                                                      'class'   => 'form-control',
                                                                      );
                                                                     echo form_textarea($data);
                                                                     ?>
                                                                   </div>
                                                                </div>
                                                                
                                                                
                                                              
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Rights  <span class="required"> * </span></label>
                                                                    <div class="col-md-8">
                                                                    <div  style="height:350px;  margin-left:10px;overflow-y:scroll">
                                                                        <div class="md-checkbox-list">
                                                                            <div class="md-checkbox">
                                                                                <input type='checkbox' class="md-check"  id='selecctall'>
                                                                                <label for="selecctall">
                                                                                    <span></span>
                                                                                    <span class="check"></span>
                                                                                    <span class="box"></span> Select All 
                                                                                </label>
                                                                            </div>
                                                                                <?php
                                                                                $default_opt=array();
                                                                                $default_opt=json_decode($edit_data->role_rights,true);
                                                                                echo $this->master_model->navigate_rights('U',$default_opt);
                                                                                ?>
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                               
                                                       
                                                               
                                                            </div> 
                                                        
                                                             
                                                                              
                                                          </div> 
                                                            
                                                        
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-4 col-md-8">
                                                                    <button type="submit" class="btn green" id="submit_btn" value="Submit">Submit</button>
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