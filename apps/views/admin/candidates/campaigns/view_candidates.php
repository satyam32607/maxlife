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
              <div class="row margin-bottom-10">
                <div class="col-md-8">
                  <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="<?php echo base_url(); ?>admin/campaigns/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                    <li> <span><?php echo $heading; ?></span> </li>
                  </ul>
                </div>
                <div class="col-md-4">&nbsp;</div>
                
              </div>
              
              <!-- END PAGE BREADCRUMBS --> 
              <!-- BEGIN PAGE CONTENT INNER -->
              <div class="page-content-inner">
                <div class="row">
                  <div class="col-md-12">
                    <?php $this->load->view("includes/notifications.php");?>
                      <!-- BEGIN FILTER TABLE-->
                         <?php  $attributes = array('id' => 'form1','name' => 'form1','class' => 'form-horizontal','role' => 'form','autocomplete' => 'off');
							 echo form_open(base_url().'admin/campaigns/candidates', $attributes);
				          ?>
                       
                          <?php echo form_close(); ?>
                          <!-- END FILTER TABLE-->    
                    
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                                        
    
                     <!-- BEGIN TABLE PORTLET-->
                    <div class="portlet-body">
                        <div class="table-responsive"  style="font-size:11px !important;">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                                    <th> Srno. </th>
                                    <th nowrap> Application No.</th>
                                    <th nowrap> Candidate ID </th>
                                    <th> Applicant name</th>
                                    <th nowrap> Date of Birth</th>
                                    <th> Gender</th>
                                    <th>Bank Name</th>
                                    <th>Bank Account no.</th>
                                    <th>State</th>
                                    <th> City/District</th>
                                    <th> Mobile no</th>
                                    <th> Unique ID</th>
                                    <th> Status</th>
                                    <th> Created On</th>
                                    <th> Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  
									     $srno = $this->uri->segment(10)? ( $this->uri->segment(10) + $this->uri->segment(11)? $this->uri->segment(11):0 ):0;
										 if($srno=='')
										 $srno=0;
										 else
										 $srno=$srno;
										
		 								 foreach($results as $row) {
										 $srno++;
										
										  
										 if($row->date_of_birth=='0000-00-00')
										  $date_of_birth='';
										  else
										  $date_of_birth = date("M d, Y",strtotime($row->date_of_birth));
										  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->application_no; ?></td>
                                    <td><?php echo $row->candidateid; ?></td>
                                    <td><?php echo $row->applicant_full_name ; ?></td>
                                    <td><?php echo $date_of_birth; ?></td>
                                    <td><?php echo $row->gender; ?></td>
                                    <td><?php echo $row->bank_name; ?></td>
                                    <td><?php echo $row->bank_account_number; ?></td>
                                    <td><?php echo $row->state; ?></td>
                                    <td><?php echo $row->city; ?>/<?php echo $row->district; ?></td>
                                    <td><?php echo $row->mobile_no; ?></td>
                                    <td><?php echo $row->unique_id; ?></td>
                                    <td><?php echo $row->candidate_status; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this User account ?');" href="<?php echo base_url();?>admin/campaigns/status/<?php echo $row->campaign_log_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this User account ?');" href="<?php echo base_url();?>admin/campaigns/status/<?php echo $row->campaign_log_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    </tr>
                                     <?php 
									  } 
									} ?>
                                </tbody>
                            </table>
                            <div align="center"><?php if(isset($links)): echo  $links; endif; ?></div>
                        </div>
                    </div>
                </div>
                    <!-- END TABLE PORTLET--> 
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
</body>
</html>