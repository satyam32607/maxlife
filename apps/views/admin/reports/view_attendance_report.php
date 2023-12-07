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
<link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
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
                    <li> <a href="<?php echo base_url(); ?>admin">Dashboard</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="#"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
							 echo form_open(base_url().'admin/admin/view_users', $attributes);
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
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                                    <th> Srno. </th>
                                    <th> Name</th>
                                    <th>Mobile no.</th>
                                    <th> Department</th>
                                    <th> Location</th>
                                    <th> Designation</th>
                                    <th>Attendance Status</th>
                                    <th>Exam Status</th>
                                    <th> Reg date</th>
                                    <th> Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
										 $gender_array = gender_array();
		 
										 foreach($results as $row) {
										 $srno++;
										 
										 if($row->gender!='')
										 $gender = $gender_array[$row->gender]; 
										 else
										 $gender='';
										  
										 if($row->date_of_birth=='0000-00-00')
										  $date_of_birth='';
										  else
										  $date_of_birth = date("M d, Y",strtotime($row->date_of_birth));
										
										  $postuserrow = get_table_info('users','user_id',$row->created_by);
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                    <td><?php echo $row->urn_no ; ?></td>
                                    <td><?php echo $date_of_birth; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $row->location_name; ?></td>
                                    <td><?php echo $row->mobile_no1; ?></td>
                                    <td>&nbsp;</td>
                                    <td><?php echo date('d M, Y',strtotime($row->reg_date));?></td>
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this User account ?');" href="<?php echo base_url();?>admin/users/status/<?php echo $row->user_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this User account ?');" href="<?php echo base_url();?>admin/users/status/<?php echo $row->user_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
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