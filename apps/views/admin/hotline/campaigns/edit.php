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
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <?php $this->load->view("includes/notifications.php");?>
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/hotline/campaigns/view"><?php echo $main_heading; ?></a>
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
                                                  <?php  $attributes = array('id' => 'camp_form','name' => 'camp_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                                                         echo form_open_multipart(base_url().'admin/hotline/campaigns/edit/'.$edit_data->campaign_id.'', $attributes);
                                                         echo form_hidden('campaign_id', $edit_data->campaign_id);
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
                                                    <label class="control-label">Campaign name <span class="required"> * </span></label>
                                                    <?php $data = array(
                                                          'name'        => 'campaign_name',
                                                          'id'          => 'campaign_name',	
                                                          'value'       => $edit_data->campaign_name,					
                                                          'maxlength'   => '100',
                                                          'class'   => 'form-control',
                                                          'required'   => 'required',
                                                          );
                                                       echo form_input($data);
                                                       echo form_error('campaign_name');
                                                      ?>
                                                </div>
                                            </div>
                                            
                                       <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Total data <span class="required"> * </span></label>
                                        <?php 
                                          $data_records_array = data_records_array();
                                          $selected = ($this->input->post('total_data')) ? $this->input->post('total_data') : $edit_data->total_data;
                                          echo form_dropdown('total_data', $data_records_array,  $selected,'id="total_data" class="form-control"  required ');
                                          echo form_error('total_data');
                                          ?>
                                      </div>
                                    </div>
                                           
                                        </div>
                                        <!--/row-->
                                                
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label class="control-label">Maximum duration <span class="required"> * </span></label>
                                        <?php 
                                          $duration_array = duration_array();
                                          $selected = ($this->input->post('duration')) ? $this->input->post('duration') : $edit_data->duration;
                                          echo form_dropdown('duration', $duration_array,  $selected,'id="duration" class="form-control"  required ');
                                          echo form_error('duration');
                                          ?>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label class="control-label">Maximum calls Limit <span class="required"> * </span></label>
                                        <?php
                                             
                                              $data = array(
                                              'name'        => 'maximum_calls',
                                              'id'          => 'maximum_calls',	
                                              'value'       => set_value('maximum_calls') ? $this->input->post("maximum_calls") : $edit_data->maximum_calls,			
                                              'maxlength'   => '5',
                                              'class'   => 'form-control',
                                              'required'   => 'required',
                                              );
                                           echo form_input($data);
                                           echo form_error('maximum_calls');
                                          ?>
                                          <small>Example: (100,200,500,1000)</small>
                                        </div>
                                        </div>
                                        
                                        
                                        </div>
                                        <!--/row-->
                                        
                                        
                                        <h4>Percentage:</h4>
                                        <div class="row">
                                        <div class="col-md-12">
                                        <?php
										if($edit_data->percentage_json!='')
										{
										 $percentagejson=json_decode($edit_data->percentage_json);
										 $cancel_percentage = $percentagejson[0]->cancel_percentage;
										 $congestion_percentage = $percentagejson[0]->congestion_percentage;
										 $chanunavail_percentage = $percentagejson[0]->chanunavail_percentage;
										}else
										{
									     $cancel_percentage = '';
										 $congestion_percentage = '';
										 $chanunavail_percentage = '';
										}
										?>
                                        <div class="row">
                                        
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        <label class="control-label"> Cancel Percentage <span class="required"> * </span></label>
                                        <?php 
                                        $data_percentage_array = data_percentage_array();
                                        $selected = ($this->input->post('cancel_percentage')) ? $this->input->post('cancel_percentage') :$cancel_percentage;
                                        echo form_dropdown('cancel_percentage', $data_percentage_array,  $selected,'id="cancel_percentage" class="form-control"  required ');
                                        echo form_error('cancel_percentage');
                                        ?>
                                        </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-4">
                                         <div class="form-group">
                                        <label class="control-label">Congestion Percentage <span class="required"> * </span></label>
                                         <?php 
                                        $data_percentage_array = data_percentage_array();
                                        $selected = ($this->input->post('congestion_percentage')) ? $this->input->post('congestion_percentage') : $congestion_percentage;
                                        echo form_dropdown('congestion_percentage', $data_percentage_array,  $selected,'id="congestion_percentage" class="form-control"  required ');
                                        echo form_error('congestion_percentage');
                                        ?>
                                         </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                         <div class="form-group">
                                        <label class="control-label"> Chanunavail Percentage <span class="required"> * </span></label>
                                        <?php 
                                        $data_percentage_array = data_percentage_array();
                                        $selected = ($this->input->post('chanunavail_percentage')) ? $this->input->post('chanunavail_percentage') : $chanunavail_percentage;
                                        echo form_dropdown('chanunavail_percentage', $data_percentage_array,  $selected,'id="chanunavail_percentage" class="form-control"  required ');
                                        echo form_error('chanunavail_percentage');
                                        ?>
                                         </div>
                                         </div>
                                        
                                        </div>
                                        
                                        
                                        </div>
                                        
                                        </div>
                                        <!--/row-->
                                        
                                                
                                                
                                        <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="control-label">Start date<span class="required"> * </span></label>
                                            <div class="input-group" data-date-format="yyyy-mm-dd H:i">
                                                 <?php $data = array(
                                                      'name'        => 'start_date',
                                                      'id'          => 'start_date',
                                                      'value'       => $edit_data->start_date,
                                                      'maxlength'   => '15',
                                                      'class'   => 'form-control',
                                                      'placeholder'   => 'YYYY-MM-DD H:I:S',
                                                      'required'   => 'required',
                                                   );
                                                  echo form_input($data);
                                                  echo form_error('start_date');
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
                                            <label class="control-label">End date<span class="required"> * </span></label>
                                            <div class="input-group" data-date-format="yyyy-mm-dd H:i">
                                                 <?php $data = array(
                                                      'name'        => 'end_date',
                                                      'id'          => 'end_date',
                                                      'value'       => $edit_data->end_date,
                                                      'maxlength'   => '15',
                                                      'class'   => 'form-control',
                                                      'placeholder'   => 'YYYY-MM-DD H:I:S',
                                                      'required'   => 'required',
                                                   );
                                                  echo form_input($data);
                                                  echo form_error('end_date');
                                                  ?>
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        
                                      </div>
                                         <!--/row-->
                                             
                                             
                                             <div class="portlet box blue-hoki">  
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-building" aria-hidden="true"></i>District Data Limit</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="expand"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body portlet-expand">
                                            
                                       
                                    <div class="row">
                                         <div class="form-group">
                                          <div class="col-md-12">
                                         <label class="control-label"><strong>Already Districts:</strong></label>
                                          <?php
												 if(is_array($districtsresult))
												 {
												 foreach ($districtsresult as $distkey=> $distrow){
												 ?>  
                                                       <div class="row">
                                                                <div class="col-md-3">
                                                                   <label class="control-label">District</label>
                                                                   <?php
                                                                        $fields = array('is_active'=>'1');
                                                                        $district_array = gettabledropdown('districts',$fields,'district_id','district_name','district_name','ASC');
                                                                        $selected = ($this->input->post('district_id')) ? $this->input->post('district_id') : $distrow->district_id;
                                                                        echo form_dropdown('district_id', $district_array,  $selected,'id="district_id" class="form-control"  required" ');
                                                                        echo form_error('district_id');
                                                                       ?>
                                                                    </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <label class="control-label">District data</label>
                                                                    <input type="text" placeholder="Data Limit" name="data_limit" id="data_limit" class="form-control" value="<?php echo $distrow->data_limit; ?>" />
                                                                    </div>
                                                                    
                                                                <!--<div class="col-md-1">
                                                                    <label class="control-label">&nbsp;</label>
                                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger">
                                                                        <i class="fa fa-close"></i>
                                                                    </a>
                                                                </div>-->
                                                            </div>
                                                       
                                                      <?php } } ?> 
                                             </div>
                                     </div>
                                    </div>
                                    
    
                                              <div class="row"> 
                                                 
                                                        <div class="col-md-12">
                                                         <label class="control-label"><strong>New  Districts:</strong></label>
                                                         
                                                            <div class="mt-repeater">
                                                                <div data-repeater-list="group-a">
                                                                    <div data-repeater-item="" class="row">
                                                                        <div class="col-md-3">
                                                                            <label class="control-label">District</label>
                                                                           <?php
                                                                                $fields = array('is_active'=>'1');
                                                                                $district_array = gettabledropdown('districts',$fields,'district_id','district_name','district_name','ASC');
                                                                                $selected = ($this->input->post('district_id')) ? $this->input->post('district_id') : $this->input->post('district_id');
                                                                                echo form_dropdown('district_id', $district_array,  $selected,'id="district_id" class="form-control"  required" ');
                                                                                echo form_error('district_id');
                                                                               ?>
                                                                            </div>
                                                                        
                                                                        <div class="col-md-3">
                                                                            <label class="control-label">District data</label>
                                                                            <input type="text" placeholder="Data Limit" name="data_limit" id="data_limit" class="form-control" />
                                                                            </div>
                                                                            
                                                                        <div class="col-md-1">
                                                                            <label class="control-label">&nbsp;</label>
                                                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger">
                                                                                <i class="fa fa-close"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <a href="javascript:;" data-repeater-create="" class="btn btn-info mt-repeater-add">
                                                                    <i class="fa fa-plus-small"></i> Add</a>
                                                                <br>
                                                                <br> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                          
                                            </div>
                                            
                                        
                                                
                                                 <div class="row">
                                                 <div class="col-md-6">
                                                        <div class="form-group">
                                                         <label>Description </label>
                                                        <?php $data = array(
                                                          'name'        => 'description',
                                                          'id'          => 'description',	
                                                          'value'       => $edit_data->description,
                                                          'rows'   => '4',									
                                                          'class'   => 'form-control',
                                                          );
                                                         echo form_textarea($data);
                                                         echo form_error('description');
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
   	 <!-- END CUSTOM SCRIPTS -->
<script type="text/javascript">
$(document).ready(function(){
$('#start_date').datetimepicker({
	   format: 'yyyy-mm-dd hh:ii',
	 	changeMonth: true,changeYear: true,
	    autoclose: true
	});
	
$('#end_date').datetimepicker({
	   format: 'yyyy-mm-dd hh:ii',
	 	changeMonth: true,changeYear: true,
	    autoclose: true
	});
		
});	
</script>
 <script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>
        
    </body>
</html>