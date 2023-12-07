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
              <div class="row">
                <div class="col-md-8">
                  <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="#"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                    <li> <span><?php echo $heading; ?></span> </li>
                  </ul>
                </div>
                
              
              <!-- END PAGE BREADCRUMBS --> 
              <!-- BEGIN PAGE CONTENT INNER -->
              <div class="page-content-inner">
                <div class="row">
                  <div class="col-md-12">
                    <?php $this->load->view("includes/notifications.php");?>
                    <!-- BEGIN TABLE PORTLET-->
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
										<th> Srno. </th>
										<th> Company</th>
										<th> Batch Id</th>
										<th> Candidate Id</th>
										<th> Candidate Name</th>
										<th> From period</th>
										<th> To Period</th>
										<th> CTC</th>
                                        <th> Mess</th>
                                        <th> OT mins</th>
                                        <th> OT rate</th>
                                        <th>Print</th>
										<th> Created By</th>
										<th> Created date</th>
										<th> Action</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
                                         foreach($results as $row) {
										 $srno++;
										 
										 $comprow = get_table_info('companies','company_id',$row->company_id);
										 $postuserrow = get_table_info('users','user_id',$row->created_by);
                                	  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $comprow->company_name; ?></td>
                                    <td><?php echo $row->batch_id; ?></td>
                                    <td><?php echo $row->candidateid; ?></td>
                                    <td><?php echo $row->acc_holder_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->from_period));?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->to_period));?></td>
                                    <td><?php echo $row->candidate_ctc; ?></td> 
                                    <td><?php echo $row->mess; ?></td>  
                                    <td><?php echo $row->ot_mins; ?></td> 
                                    <td><?php echo $row->ot_rate; ?></td>
                                    <td><center><a class="label label-sm label-success" href="<?php echo base_url();?>admin/payslips/print_payslip/<?php echo $row->payslip_id; ?>/<?php echo $row->candidate_id; ?>"><i class="fa fa-print"></i></a></center></td> 
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                     <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><a  onclick="return confirm('Do you want to Delete this Transaction ?');" href="<?php echo base_url();?>admin/payslips/delete/<?php echo $row->payslip_id; ?>/<?php echo $row->candidate_id; ?>" title="Edit"><i class="fa fa-remove"></i></a></td> 
                      				                                                  
                                    </tr>
                                     <?php 
									  } 
									} ?>
                                </tbody>
                            </table>
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