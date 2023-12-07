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
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
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
                            <i class="fa fa-users"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                            <th> Srno. </th>
                            <th> Event name</th>
                            <th> Event date</th>
                            <th>Participant Name</th>
                            <th>Email Id</th>
                            <th>Invite Sent </th>
                            <th> Joined</th>
                            <th> Drop out during<br> the session</th>
                            <th> Attended <br>Full Session </th>
                           <th> Created On</th>
                       
									</tr>
                                </thead>
                                <tbody>
                    <?php 
                   
									  if(is_array($results))
									  {  $srno=0; 
										 foreach($results as $row) {
										  $srno++;
										  
										  $postuserrow = get_table_info('users','user_id',$row->created_by);
										 // $batchrow = get_table_info('batches','batch_id',$row->batch_id);
									  ?>    
                                    <tr data-index="<?php echo $srno; ?>">
                                    <td><?php echo $srno; ?></td>
                                    
                                    <td><?php echo $row->event_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->event_date));?></td>
                                    <td><?php echo $row->participant_name; ?></td>
                                    <td><?php echo $row->participant_email_id; ?></td>
                                    <td align="center" class="invite-sent"><?php echo $row->invite_sent; ?></td>
                                    <td align="center" class="joined-session"><?php echo $row->joined; ?></td>
                                    <td align="center">
                                      <select name="" onchange="submitEventSession('<?php echo  $row->event_participant_id ?>',this)" id="">
                                        <option value="No" <?php if($row->drop_out_session=="No") echo "selected";  ?> >No</option>
                                        <option value="Yes" <?php if($row->drop_out_session=="Yes") echo "selected";  ?>>Yes</option>
                                        <option value="Absent" <?php if($row->drop_out_session=="Absent") echo "selected";  ?>>Absent</option>
                                      </select>
                                    </td>
                                    <td align="center" class="attended-session"><?php echo $row->attended_full_session; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                  
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
<script>
  function submitEventSession(eventParticipantId,field)
  {
    var baseUrl           =   "<?php echo base_url() ?>";
    var tableRowEvent     =   $(field).parent('td').parent('tr');
    var eventSessionValue =   $(field).val();
    // console.log($(tableRowEvent).html());
    switch (eventSessionValue) {
      case 'Yes':
        $(tableRowEvent).find("td.attended-session").html('n');
        break;

      case 'No':
        $(tableRowEvent).find("td.attended-session").html('y');
        $(tableRowEvent).find("td.invite-sent").html('Y');
        $(tableRowEvent).find("td.joined-session").html('Y');
        break;

      case 'Absent':
        $(tableRowEvent).find("td.attended-session").html('n');
        $(tableRowEvent).find("td.joined-session").html('N');
        break;
      
    }

        $.ajax({
          url: `${baseUrl}company/Events/updateParticipantSession`, // Replace with your URL
          type: 'GET', // GET or POST, depending on your method
          data: {
            event_participant_id: eventParticipantId, // Replace with your data keys and values
            event_session_value: eventSessionValue
          },
          success: function(response) {
              // This function is called if the request succeeds
              // 'response' contains the data returned from the server
              console.log(response);
          },
          error: function(xhr, status, error) {
              // This function is called if the request fails
              console.log('Error: ' + error);
          }
      });

  }
</script>
</html>