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
                <div class="col-md-4"><a href="<?php echo base_url();?>admin/hotline/campaigns/add" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Campaign </span> </a></div>
                
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
                            <i class="fa fa-tree"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
										<th> Srno. </th>
										<th> Campaign name </th>
										<th>Duration</th>
										<th>Total Data</th>
										<th>Maximum call Limit</th>
										<th> Percentage%</th>
										<th> Start date</th>
										<th> End date</th>
										<th> description</th>
										<th>Process Data</th>
										<th> Candidates </th>
										<th>Total update</th>
										<th>Reset</th>
										<th>Fresh Data</th>
										<th>Cancel Status</th>
										<th>Report</th>
										<th> Status</th>
										<th> Created By</th>
										<th> Created date</th>
										<th> Action</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0;
									     $data_records_array =data_records_array(); 
										 foreach($results as $row) {
										 $srno++;
										 $postuserrow = get_table_info('users','user_id',$row->created_by);
										// echo "--------->".$row->percentage_json;
										if($row->percentage_json!='')
										{
										 $percentagejson=json_decode($row->percentage_json);
										 $cancel_percentage = 'can:'. $percentagejson[0]->cancel_percentage.'%|';
										 $congestion_percentage = 'con:'. $percentagejson[0]->congestion_percentage.'%|';
										 $chanunavail_percentage = 'cha:'. $percentagejson[0]->chanunavail_percentage.'%';
										 $total_percentage = ($percentagejson[0]->cancel_percentage+$percentagejson[0]->congestion_percentage+ $percentagejson[0]->chanunavail_percentage);
										}else
										{
									     $cancel_percentage = '';
										 $congestion_percentage = '';
										 $chanunavail_percentage = '';
										 $total_percentage = '';
										}
										
										if($row->total_data!=NULL)
										$total_data = $data_records_array[$row->total_data];
										else
										$total_data='';
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?>
                                    <a href="<?php echo base_url();?>admin/hotline/campaigns/edit/<?php echo $row->campaign_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $row->campaign_name; ?></td>
                                    <td><?php echo $row->duration; ?></td>
                                    <td><?php echo $total_data; ?></td>
                                    <td><?php echo $row->maximum_calls; ?></td>
                                    <td><?php echo $cancel_percentage; ?><?php echo $congestion_percentage; ?><?php echo $chanunavail_percentage; ?><br>
                                    Total: <?php echo $total_percentage; ?></td>
                                    <td><?php echo date('d M, Y H:i:s',strtotime($row->start_date));?></td>
                                    <td><?php echo date('d M, Y H:i:s',strtotime($row->end_date));?></td>
                                    <td><?php echo $row->description; ?></td>
                                    <td nowrap><a href="<?php echo base_url();?>admin/hotline/campaigns/process_data/<?php echo $row->campaign_id; ?>" title="Process Data"> <span class="label label-sm label-success">add data </span> </a></td>
                                   
                                    <td nowrap><a href="<?php echo base_url();?>admin/hotline/campaigns/upload_bulk_candidates/<?php echo $row->campaign_id; ?>" title="Upload Bulk Candidates"> <span class="label label-sm label-success">upload </span> </a>
                                    <a href="<?php echo base_url();?>admin/hotline/campaigns/candidates/<?php echo $row->campaign_id; ?>" title="View Candidates"> <span class="label label-sm label-success">view [<?php echo $row->total_candidates; ?>] </span> </a>  </td>
                                    <td align="center">[<?php echo $row->total_update_candidates; ?>]  </a></td>
                                   <td align="center">
                                    <?php if($row->campaign_stage!=NULL && $row->campaign_stage==2): ?> <a href="<?php echo base_url();?>admin/hotline/campaigns/reset_data_status/<?php echo $row->campaign_id; ?>" class="label label-sm label-success" onclick="return confirm('Do you want to Reset this Campaign Data ?');">reset</a><?php endif; ?></td>
                                    <td align="center">
                                     <a href="<?php echo base_url();?>admin/hotline/campaigns/refresh_data_status/<?php echo $row->campaign_id; ?>" class="label label-sm label-success" onclick="return confirm('Do you want to Refresh this Campaign Data ?');">refresh</a></td>
                                    <td>  <?php //if($row->campaign_stage!=NULL && $row->campaign_stage<2): ?> <a href="<?php echo base_url();?>admin/hotline/campaigns/update_data_status/<?php echo $row->campaign_id; ?>" class="label label-sm label-success">update</a><?php ///endif; ?></td>
                                    <td><?php //if($row->campaign_stage!=NULL && $row->campaign_stage==2): ?><a href="<?php echo base_url();?>admin/hotline/reports/campaignreport_export_to_excel/<?php echo $row->campaign_id; ?>" class="label label-sm label-success">excel</a><?php //endif;  ?></td>
                                   <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this Campaigns ?');" href="<?php echo base_url();?>admin/hotline/campaigns/status/<?php echo $row->campaign_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this Campaigns ?');" href="<?php echo base_url();?>admin/hotline/campaigns/status/<?php echo $row->campaign_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                     <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><a href="<?php echo base_url();?>admin/hotline/campaigns/edit/<?php echo $row->campaign_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td> 
                      				                                                  
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