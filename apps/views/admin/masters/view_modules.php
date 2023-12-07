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
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url();?>assets/global/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
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
                                    <div class="row">
                                        <div class="col-md-8">
                                          <ul class="page-breadcrumb breadcrumb">
                                            <li> <a href="<?php echo base_url(); ?>">Home</a> <i class="fa fa-circle"></i> </li>
                                            <li> <a href="#"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                                            <li> <span><?php echo $heading; ?></span> </li>
                                          </ul>
                                        </div>
<!--                                        <div class="col-md-4"><a href="<?php echo base_url();?>admin/masters/add_module" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Module </span> </a></div>-->
                                        
                                        </div>
                                    <!-- END PAGE BREADCRUMBS -->
                                     <?php  $attributes = array('id' => 'module_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
										echo form_open(base_url().'admin/masters/view_modules', $attributes);
									  ?>
										<div class="form-body">
											<div class="row">
											<div class="col-md-12">
										  
											<div class="col-md-2">
											<div class="form-group">
											   <label class="control-label">User Type </label>
												<?php
												 $user_type_array = user_type_array();
												 unset($user_type_array['A']);
												 $selected = ($this->input->post('user_type')) ? $this->input->post('user_type') : $user_type;
												 echo form_dropdown('user_type', $user_type_array,  $selected,'id="user_type" class="form-control" ');
												?> 
										 </div>
										 </div>
										<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">&nbsp;</label><br>
											<button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>
										</div>
										</div>
																	
											  
									 </div>
								  
									 </div>        
									</div>
										
									<?php echo form_close(); ?> 
                        
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        
                                        <div class="portlet light ">
                                            <div class="portlet-body ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                     <?php $this->load->view("includes/notifications.php");?>
                                                     
                                                        <div class="margin-bottom-10" id="nestable_list_menu">
                                                            <button type="button" class="btn green btn-outline sbold uppercase" data-action="expand-all">Expand All</button>
                                                            <button type="button" class="btn red btn-outline sbold uppercase" data-action="collapse-all">Collapse All</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="portlet light "> 
                                                    <div class="portlet-title" >
                                                        <div class="caption">
                                                            <i class="fa fa-reorder font-green"></i>
                                                            <span class="caption-subject font-green sbold uppercase"><?php
															  $user_type_array = user_type_array();
															  if($user_type!=''): echo $user_type_array[$user_type].' ALL Modules'; endif; ?></span>
                                                        </div>
                                                        
                                                        
                                               	 <div class="col-md-6"><a href="<?php echo base_url();?>admin/masters/add_module/<?php echo $user_type; ?>" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Module </span> </a></div>
                                                        
                                                    </div>
                                                    <div class="portlet-body ">
                                                           
														  <?php if($results){?>
                                                         <div class="dd" id="nestable_list_3 ">
                                                            <ol class="dd-list">
                                                           		<?php print $results; ?>
                                                            </ol>
                                                          </div>
                                                          <?php }else{
                                                              print "There are no modules.";
                                                          }?>
                                                          
                                                          <div class="clearfix"></div>
                                                        
                                                        
                                                        
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
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-nestable/jquery.nestable.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/ui-nestable.js" type="text/javascript"></script>
		 <!-- END CUSTOM SCRIPTS -->
    </body>

</html>