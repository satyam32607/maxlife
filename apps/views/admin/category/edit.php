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
                                            <a href="<?php echo base_url(); ?>admin/categories/view"><?php echo $main_heading; ?></a>
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
                                                        <i class="fa fa-file-o"></i><?php echo $heading; ?> </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12 col-sm-9 col-xs-9">
                                                          <?php  $attributes = array('id' => 'add_category_frm','name' => 'add_category_frm','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
															     echo form_open_multipart(base_url().'admin/categories/edit/'.$edit_data->category_id.'', $attributes);
																 echo form_hidden('category_id', $edit_data->category_id);
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
                                                                        <label class="control-label">Company <span class="required"> * </span></label>
                                                                         <?php $fields = array('is_active'=>'1');
																			$company_array = gettabledropdown('companies',$fields,'company_id','company_name','company_name','ASC');
																			$selected = ($this->input->post('company_id')) ? $this->input->post('company_id') : $edit_data->company_id;
																			echo form_dropdown('company_id', $company_array,  $selected,'id="company_id" class="form-control"');
																			echo form_error('company_id');
																		  ?>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Parent <span class="required"> * </span></label>
                                                                          <?php
																		     $parent_category_array =  $this->category_model->get_categories_list('0','1','0');
																			 if (count($parent_category_array) > 0){
																			 $selected = ($this->input->post('parent_id')) ? $this->input->post('parent_id') : $edit_data->parent_id;
																			 echo form_dropdown('parent_id', $parent_category_array,  $selected,'id="parent_id" class="form-control"');
																			}
																			?>
                                                                    </div>
                                                                </div>
                                                               

                                                            </div>
                                                            <!--/row-->
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Category name <span class="required"> * </span></label>
                                                                         <?php $data = array(
																			  'name'        => 'category_name',
																			  'id'          => 'category_name',	
																			  'value'       => set_value('category_name') ? $this->input->post("category_name") : $edit_data->category_name,												
																			  'maxlength'   => '100',
																			  'class'   => 'form-control',
																			  'required'   => 'required',
																			  );
																			echo form_input($data);
																			echo form_error('category_name');
																		   ?>
                                                                    </div>
                                                                </div>
                                                                
                                                               

                                                            </div>
                                                            <!--/row-->
                                                            
                                                            
                                                            <div class="row">
                                                                
                                                                 <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Weight <span class="required"> * </span></label>
                                                                         <?php $data = array(
																			  'name'        => 'weight',
																			  'id'          => 'weight',	
																			  'value'       => set_value('weight') ? $this->input->post("weight") : $edit_data->weight,												
																			  'maxlength'   => '10',
																			  'class'   => 'form-control',
																			  'required'   => 'required',
																			  );
																			echo form_input($data);
																			echo form_error('weight');
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
		<script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>
		 <!-- END CUSTOM SCRIPTS -->
    </body>
</html>