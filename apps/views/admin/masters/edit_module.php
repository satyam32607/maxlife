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
                                            <a href="<?php echo base_url(); ?>admin/masters/view_modules"><?php echo $main_heading; ?></a>
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
                                                          <?php  $attributes = array('id' => 'module_form','name' => 'module_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
																 echo form_open(base_url().'admin/masters/edit_module/'.$edit_data->menu_id.'', $attributes);
																 echo form_hidden('menu_id', $edit_data->menu_id);
                                                          ?>
                                                         <div class="form-body">
                                                         <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                         <div class="alert alert-success display-hide">
                                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                              
														 <?php if((validation_errors()) || ($already_msg)):?>
                                                        <div class="alert alert-danger">
                                                            <button class="close" data-close="alert"></button>
                                                             <span> <?php echo validation_errors(); ?><?php echo $already_msg;?></span>
                                                        </div>
                                                        <?php endif; ?>
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label class="control-label">User type <span class="required"> * </span></label>
                                                                     <?php
																		$user_type_array = user_type_array();
																		unset($user_type_array['A']);
																		$selected = ($this->input->post('user_type')) ? $this->input->post('user_type') : $edit_data->user_type;
																		echo form_dropdown('user_type', $user_type_array,  $selected,'id="user_type" class="form-control"  required ');
																	   ?>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    <label class="control-label">Module Type </label>
                                                                     <?php
																		 $navigation_array =  get_navigation_list($edit_data->user_type,0, 0);
																		 if (count($navigation_array) > 0){
																		 $selected = ($this->input->post('module_id')) ? $this->input->post('module_id') : $edit_data->is_parent;
																		 echo form_dropdown('module_id', $navigation_array,  $selected,'id="module_id" class="form-control"');
																		}
																		?>
                                                                    <?php   /*$data = array(
                                                                    'name'        => 'menu_name',
                                                                      'id'          => 'menu_name',	
                                                                      'value'       => $edit_data->menu_name,			
                                                                      'maxlength'   => '100',
                                                                      'class'   => 'form-control',
                                                                      'required'   => 'required',
																	  'readonly'   => true,
                                                                      );
                                                                   echo form_input($data);*/
                                                                  ?>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <!--/row-->
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Module name <span class="required"> * </span></label>
																		<?php $data = array(
																		  'name'        => 'menu_name',
																		  'id'          => 'menu_name',									
																		  'value'       => $edit_data->menu_name,
																		  'maxlength'   => '300',
																		  'class'   => 'form-control',
																		  'required'   => 'required',
																		  );
																		 echo form_input($data);
																		?>
                                                                    </div>
                                                                </div>
                                                           
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Module link</label>
                                                                          <?php $data = array(
																			  'name'        => 'menu_link',
																			  'id'          => 'menu_link',	
																			  'value'       => $edit_data->menu_link,							
																			  'maxlength'   => '300',
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
                                                                        <label class="control-label">Module class </label>
																	 <?php $data = array(
                                                                          'name'        => 'menu_class',
                                                                          'id'          => 'menu_class',									
                                                                          'value'       => $edit_data->menu_class,							
                                                                          'maxlength'   => '250',
                                                                          'class'   => 'form-control',
                                                                          );
                                                                         echo form_input($data);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                           
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label class="control-label">Set Order</label>
																	 <?php 
																	  $data = array(
                                                                          'name'        => 'set_order',
                                                                          'id'          => 'set_order',									
                                                                          'value'       => $edit_data->set_order,	
                                                                          'maxlength'   => '10',
                                                                          'class'   => 'form-control',
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
                                                                    <label>Diplay in Navigation Menu</label>
                                                                    <?php
																	if($edit_data->display_leftmenu==1){
																		$is_checked='checked="checked"';
																	 }else{
																		$is_checked='';
																	 }
																	 
																	 ?>
                                                                    <div class="md-checkbox-inline">
                                                                    <div class="md-checkbox">
                                                                        <input type="checkbox" id="display_menu" name="display_menu" value="1" <?php echo $is_checked; ?> class="md-check">
                                                                        <label for="display_menu">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> </label>
                                                                    </div>
                                                                </div>
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
        <!-- BEGIN QUICK NAV -->
        <?php $this->load->view("includes/scripts.php");?>
         <!-- BEGIN CUSTOM SCRIPTS -->
		<script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>
		 <!-- END CUSTOM SCRIPTS -->
        <script>
		$(document).ready(function(){
			
		$('#user_type').bind('change', function () {
			var user_type=$(this).val();
			var module_id=$("#module_id").val();
			if(user_type === null){ 
				var user_type=<?php echo $user_type; ?>;
			}
			if(module_id=== null || module_id==''){ 
				var module_id=<?php echo $module_id; ?>;
			}else{
				var module_id=0;
			}
			get_module(user_type,module_id);
			
		});
		$('#user_type').trigger('change');
		
	});
	
	  function get_module(user_type,module_id){
		$('#module_id').html('');
		var get_val=user_type;
		$("#module_id").find('option').remove();
		$.get('<?php echo base_url();?>ajaxrequest/get_modules/'+get_val, function( data ) {
			var obj = jQuery.parseJSON(data);
			$('#module_id').append($("<option></option>").attr("value",'').text('Select Module Type'));
			$.each(obj, function(idx, obj1) {
				var module_name=obj1.menu_name;
				var module_id=obj1.menu_id;
				$('#module_id').append($("<option></option>").attr("value",module_id).text(module_name)); 
			});
			$('#module_id option[value='+module_id+']').attr("selected", "selected");
		});
	 }
	</script>
    </body>

</html>