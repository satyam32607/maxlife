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
            <div class="container"> 
              <!-- BEGIN PAGE BREADCRUMBS -->
              <div class="row margin-bottom-10">
                <div class="col-md-8">
                  <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="<?php echo base_url(); ?>admin/trainingpushreports/push_report"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                         echo form_open(base_url().'admin/trainingpushreports/push_report', $attributes);
                       ?>
                    <div class="portlet box blue-hoki">  
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-search"></i>Search </div>
                            <div class="tools">
                                <a href="javascript:;" class="expand"> </a>
                            </div>
                        </div>
                        <div class="portlet-body portlet-expand">
                            <div class="row">
                            <div class="col-md-2">
                               <label class="control-label">Start Date </label>
                                 <div class="input-group date" data-date-format="yyyy-mm-dd">
									 <?php 
									 if($start_date=='0')
									 $start_date='';
									 $data = array(
                                          'name'        => 'start_date',
                                          'id'          => 'start_date',
                                          'value'       => $start_date,
                                          'maxlength'   => '15',
                                           'redonly'  => true,
                                          'class'   => 'form-control',
                                          'placeholder'   => 'YYYY-MM-DD',
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
                           
                           <div class="col-md-2">
                               <label class="control-label">End Date </label>
                               <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
									 <?php 
									     if($end_date=='0')
										    $end_date='';
									 	$data = array(
                                          'name'        => 'end_date',
                                          'id'          => 'end_date',
                                          'value'       => $end_date,
                                          'maxlength'   => '15',
                                          'redonly'  => true,
                                          'class'   => 'form-control',
                                          'placeholder'   => 'YYYY-MM-DD',
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
                           
                           <div class="col-md-4">
                                <label class="control-label"> </label>
                                <div class="margin-top-10"><button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button></div>
                           </div>
                              
                   
                         
                        </div>  
                        </div>
                    </div>
                      <?php echo form_close(); ?>
                      <!-- END FILTER TABLE--> 
                          <!-- END FILTER TABLE-->    
                    
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                                        
    
                     <!-- BEGIN TABLE PORTLET-->
                    <div class="portlet-body">
                            <div class="row">
                           <div class="col-md-12">
                            <div class="scroller" style="height: 750px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <thead>
                                        <tr class="uppercase">
                                            <th> Created Date </th>
                                            <th> Total </th>
                                        </tr>
                                    </thead>
                                   <?php 
                                  $total_log_push=0; 
                                  if(is_array($results))
                                  {
                                     foreach($results as $row) {
                                     $total_log_push = $total_log_push+$row->total_push;
                                     ?>		 
                                    <tr>
                                        <td> <?php echo date("M d, Y",strtotime($row->push_datetime)); ?></td>
                                        <td><a href="<?php echo base_url();?>trainingpushreports/push_logs_detail/<?php echo $row->candidate_id; ?>/<?php echo $row->push_date; ?>"><span class="bold theme-font">[<?php echo $row->total_push; ?>]</span></a> </td>
                                    </tr>
                                    <?php
                                        }
                                       }
                                      if($total_log_push!=0)
                                       {
                                      ?>
                                      <tr>
                                      <th>Total</th>
                                      <th><a href="<?php echo base_url();?>admin/trainingpushreports/push_logs_detail/">[<?php echo $total_log_push; ?>]</a></th>
                                    </tr>
                                    <?php } ?>
                                </table>
                                
                                </div>
                            </div>
                                </div>
                               
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
<script>
		$('#start_date').datepicker({
		changeMonth: true,startDate: '-1y',endDate: '0',
        format: 'yyyy-mm-dd',
		 autoclose: true,
  		 }).on('changeDate', function(e) {
		 });
	
		$("#end_date").datepicker({
		 format: 'yyyy-mm-dd',
		  autoclose: true,
		 }).on('changeDate', function(e) {
		}); 

	</script>
</body>
</html>