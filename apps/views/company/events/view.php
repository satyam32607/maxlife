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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
            <div class="row">
              <div class="container"> 
                  <!-- BEGIN PAGE TITLE -->
                  <div class="page-title">
                    <h1><?php echo $heading; ?></h1>
                  </div>
                  <!-- END PAGE TITLE -->
                  <div class="form-div pull-right">
                    <form action="" method="get" id="date-filter">
                          <input type="text" name="event_date" placeholder="Select date range" value="<?php if(array_key_exists('event_date',$_GET)) {echo $_GET['event_date'];} ?>" />
                    </form>
                  </div>
              </div>
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
                <div class="col-md-4"><a href="<?php echo base_url();?>company/events/add" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Event </span> </a></div>
                
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
                            <i class="fa fa-user"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
										<th> Srno. </th>
                                        <th> Event name</th>
                                        <th> Event date</th>
										<th> Event title </th>
										<th> Vendor name</th>
										<th> Batch</th>
										<th align="center">Print</th>
										<th align="center">Participants</th>
										<th align="center"> Events Sessions</th>
										<th> Status</th>
										<th> Created By</th>
										<th> Created On</th>
										<th> Action</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
										 foreach($results as $row) {
										  $srno++;
										  
										  $postuserrow = get_table_info('users','user_id',$row->created_by);
										  $batchrow = get_table_info('batches','batch_id',$row->batch_id);
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?>
                                    <a href="<?php echo base_url();?>company/events/edit/<?php echo $row->event_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $row->event_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->event_date));?></td>
                                    <td><?php echo $row->event_title; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $batchrow->batch_name; ?></td>
                                    <td nowrap><a target="_blank" href="<?php echo base_url();?>company/events/print_event/<?php echo $row->event_id; ?>"  class="label label-sm label-success" title="Print Event"><i class="fa fa-print"></i></a>
                                    <?php 
                                        $colorClasses   =   ['success','info','danger','warning','primary','default'];
                                        foreach ($row->templates as $key => $eventMail) {
                                          
                                          $mailUrl    =   base_url().'company/events/print_mail/'.$eventMail->id;
                                          echo "<a class='label label-sm label-$colorClasses[$key]' target='_blank' href='$mailUrl' title='Message'><i class='fa fa-envelope-o'></i></a>";
                                          echo "&nbsp;";
                                        }
                                      ?>
                                    </td>
                                    <td nowrap>
                                      
                                    <?php if($row->total_participants<=0): ?>
                                    <a href="<?php echo base_url();?>company/participants/update_event_participants/<?php echo $row->event_id; ?>" title="Auto Add Participants"> <span class="label label-sm label-success">auto add</span>
                                    <a href="<?php echo base_url();?>company/events/upload_participants/<?php echo $row->event_id; ?>" title="Upload Participants"> <span class="label label-sm label-success">upload </span> </a>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url();?>company/participants/view/<?php echo $row->event_id; ?>" title="View Participants"> <span class="label label-sm label-success">view [<?php echo $row->total_participants; ?>] </span> </a> <br><br>
                                    <a href="<?php echo base_url();?>company/participants/delete_event_participant/<?php echo $row->event_id; ?>" data-repeater-delete="" onclick="return confirm('Do you want to delete this Event All Participants records ?');" class="btn btn-danger">
                                      <i class="fa fa-close"></i>
                                      </a>
                                  
                                   </td>
                                   <td><table class="table table-bordered table-striped table-condensed">
                                     <thead>
                                        <tr>
                                            <th style="font-size:11px;"> Srno. </th>
                                            <th style="font-size:11px;">Agenda </th>
                                            <th style="font-size:11px;">Start-End  </th>
                                        </tr>
                                    </thead>
                                    <?php
									  $sessionresults = $this->events_model->view_event_sessions($row->event_id);
									  if(is_array($sessionresults))
									  {  $sr_no=0; 
									     foreach($sessionresults as $sessionrow) {
										 $sr_no++;	 
									  ?>
                                        <tr>
                                        <td style="font-size:11px;"><?php echo $sr_no; ?></td>
                                        <td style="font-size:11px;"><?php echo $sessionrow->agenda; ?></td>
                                        <td style="font-size:11px;" nowrap><?php echo date('g:i A',strtotime($sessionrow->start_time)); ?>-<?php echo date('g:i A',strtotime($sessionrow->end_time)); ?></td>
                                       
										  
                                        
                                        </tr>
                                        <?php } } ?>
                                        </table>
                                 </td>
                                 
                                    <td><?php if($row->is_active==1) {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this Event ?');" href="<?php echo base_url();?>company/events/status/<?php echo $row->event_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this Event ?');" href="<?php echo base_url();?>company/events/status/<?php echo $row->event_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><a href="<?php echo base_url();?>company/events/edit/<?php echo $row->event_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                                    </td>
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
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(function() {
    $('input[name="event_date"]').daterangepicker({
        opens: 'left',
        autoUpdateInput: false, // Prevents auto-filling the input field
        locale: {
            format: 'YYYY/MM/DD',
            cancelLabel: 'Clear' // Label for the clear button
        }
    });

    // Apply a clear event
    $('input[name="event_date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
        $("#date-filter").submit();
    });

    $('input[name="event_date"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $("#date-filter").submit();
    });
});


</script>

</body>
</html>