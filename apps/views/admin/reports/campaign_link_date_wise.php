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
                    <li> <a href="<?php echo base_url(); ?>admin/reports/campaign_link_date_wise"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
							 echo form_open(base_url().'admin/reports/campaign_link_date_wise', $attributes);
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
                          
                            
                             <div class="col-md-2 pull right">
                                    <a href="<?php echo base_url();?>admin/reports/campaign_link_export_to_excel/<?php echo $campaign_id; ?>/<?php echo $startdate; ?>/<?php echo $enddate; ?>/<?php echo $search_by; ?>/<?php echo $search_value; ?>" title="Export To Excel" class="btn btn-sm btn-success"> 
                                       <i class="fa fa-file-excel-o fa-2x"></i>&nbsp;&nbsp;Export To Excel
                                    </a>
                            </div>
                   
                         
                        </div>  
                        </div>
                    </div>
                       
                          <?php echo form_close(); ?>
                          <!-- END FILTER TABLE-->    
                    
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                                        
    
                     <!-- BEGIN TABLE PORTLET-->
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                                    <th> Srno. </th>
                                    <th> Application No.</th>
                                    <th> Candidate ID </th>
                                    <th> Applicant full name</th>
                                    <th> Date of Birth</th>
                                    <th> Gender</th>
                                    <th> State</th>
                                    <th> City/District</th>
                                    <th> Mobile no</th>
                                    <th>Last Alert</th>
                                    <th> Status</th>
                                    <th> Created On</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  
									   //  $srno = $this->uri->segment(09) ? ( $this->uri->segment(09) + $this->uri->segment(10) ? $this->uri->segment(10):0 ):0;		
									      $srno='';
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
                                    <td><?php echo $row->state; ?></td>
                                    <td><?php echo $row->city; ?>/<?php echo $row->district; ?></td>
                                    <td><?php echo $row->mobile_no; ?></td>
                                    <td nowrap><?php echo date('d M, Y',strtotime($row->last_sent_datetime)); ?></td>
                                    <td><?php echo $row->candidate_status; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
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