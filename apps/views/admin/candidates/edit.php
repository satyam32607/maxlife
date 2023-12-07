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
		<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                                            <a href="<?php echo base_url(); ?>admin/candidates/view"><?php echo $main_heading; ?></a>
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
															     echo form_open_multipart(base_url().'admin/candidates/edit/'.$edit_data->candidate_id.'', $attributes);
																 echo form_hidden('candidate_id', $edit_data->candidate_id);
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
                                                                        <label class="control-label">Opening Balance </label>
                                                                        <?php $data = array(
																			  'name'        => 'opening_balance',
																			  'id'          => 'opening_balance',	
																			  'value'       => $edit_data->opening_balance,					
																			  'maxlength'   => '10',
																			  'class'   => 'form-control',
																			  );
																		   echo form_input($data);
																		   echo form_error('opening_balance');
																		  ?>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                            <!--/row-->
                                                           
                                                           <div class="row">


                                                            <div class="col-md-6">  <label><strong>Candidate Photo </strong> </label>
                                                              <div class="form-group">

                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" id="dvPreviewsign1">
                                                                       <?php if($edit_data->candidate_photo!=NULL)
                                                                        {   $photo    ='<img id="preview" src="'.base_url().'assets/static/photos/'.$edit_data->candidate_photo.'"> ';
                                                                       }
                                                                       else
                                                                       {    $photo    ='<img id="preview" src="'.base_url().'assets/img/image-not-available.jpg"> ';
                                                                       }
                                                                       echo $photo;
                                                                       ?> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input id="candidate_image" type="file" name="candidate_image" class="upload"  accept="image/*"/> </span>
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
         <script>
		$(document).ready(function(){
			
		$('#start_date').datepicker({
		changeMonth: true,startDate: '-1y',endDate: '0',
        format: 'yyyy-mm-dd',
		 autoclose: true,
  		 }).on('changeDate', function(e) {});
		
		 $("#end_date").datepicker({
		 format: 'yyyy-mm-dd',
		 autoclose: true,
		 }).on('changeDate', function(e) {
			
		 }); 
			
		});

             
$(function () {
            $("#candidate_image").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#dvPreviewsign2");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:200px;width: 150px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });	
             
	</script>
        
    </body>
</html>