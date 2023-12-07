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
                                   		 <h1>PDF Certificates Download </h1>
                                        <h1>The script may take some time to complete the task (depends on the number of records) so please be PATIENT.</h1>
                                        
                                    </div>
                                    <!-- END PAGE TITLE -->
                                   
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                   
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                    
                                      <?php if($error):?>
                                        <div class="alert alert-danger">
                                            <button class="close" data-close="alert"></button>
                                             <span><?php echo $error;?></span>
                                        </div>
                                        <?php endif; ?>
                                        
										<?php if($msg):?>
                                        <div class="alert alert-success">
                                            <button class="close" data-close="alert"></button>
                                             <span><?php echo $msg;?></span>
                                        </div>
                                        <?php endif; ?>
                            
								        <?php  $attributes = array('id' => 'upload_certificate_form','class' => 'upload_certificate_form','role' => 'form');
                                         echo form_open_multipart(base_url().'admin/bulk_certificates/download', $attributes);
										 echo form_hidden('heading_title', 'Bulk Certificate');
									    ?>
                                        <header class="errors"><?php echo validation_errors(); ?></header>
                                        
                          				  <div class="search-page search-content-4">
                                            <div class="search-bar bordered">
                                                <div class="row">
                                                             
                                                         <div class="col-md-6">
                                                          <div class="btn btn-primary required">
                                                                <span>Upload CSV File</span><input id="userfile" type="file" name="userfile" required class="upload" />
                                                          </div> 
                                                         
                                                          <div class="clearfix margin-top-10">
                                                                     <span><p class="hint-text"><strong>Upload CSV File</strong><br>
                                                                              File size must be less than 2Mb.</p></span>
                                                           </div>
                                                                
                                                           </div>
                                                            
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                SAVE AS in CSV FORMAT. For help please follow below mentioned link<br />
                                                                <span class="blue"><a class="blue" HREF="javascript:void(0)" style="text-decoration:underline;" onclick="window.open('<?php echo base_url();?>csv_instructions.html', 'csvinstructions','width=590,height=590,menubar=no,status=no,scrollbars=yes,resizable=yes','_blank')">Instructions to save an EXCEL FILE in CSV Format</a>&nbsp;</span>
                                                                </div>
                                                            </div>
                                                             
                                                  </div>
                                                            
                                            </div>
                                            
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-6 col-md-4">
                                                                    <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input type="reset" class="btn default" name="Reset" value="Reset">
                                                                </div>
                                                            </div>
                                                       </div>
                                           
                                        </div>
                                        
                                       					 
                                                       
                                         <?php echo form_close(); ?>  
                                    </div>
                                    <!-- END PAGE CONTENT INNER -->
                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                     
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <?php $this->load->view("includes/footer.php");?>
        </div>
        <!-- BEGIN QUICK NAV -->
        
       <?php $this->load->view("includes/scripts.php");?>
   
    </body>

</html>