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
                    <li> <a href="<?php echo base_url(); ?>">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="#"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                    <li> <span><?php echo $heading; ?></span> </li>
                  </ul>
                </div>
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
                                    <th> Primary Email</th>
                                    <th> Name</th>
                                    <th> Code</th>
                                    <th> Mobile no1.</th>
                                    <th> Mobile no2.</th>
                                    <th> Country/State/City</th>
                                    <th> Pincode </th>
                                    <th> Address </th>
                                    <th> Created By</th>
                                    <th> Reg date</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                    <th> Shadow</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
										 foreach($results as $row) {
										 $srno++;
										 
										  if($row->country_id!='0')
										  {
										   $countryrow = get_table_info('country','country_id',$row->country_id);
										   $country_name= $countryrow->country_name;
										  }
										  else
										  {  $country_name='';
										  }
										 
										  if($row->state_id!='0')
										  {
										   $staterow = get_table_info('state','state_id',$row->state_id);
										   $state_name = '/'.$staterow->state_name;
										  }
										  else
										  {  $state_name='';
										  }
										  
										  if($row->city_id!='0')
										  {
										   $cityrow = get_table_info('city','city_id',$row->city_id);
										   $city_name= '/'.$cityrow->city_name;
										  }
										  else
										  {  $city_name='';
										  }
										  
										  $postuserrow = get_table_info('users','user_id',$row->post_user_id);
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                    <td><?php echo $row->country_code; ?></td>
                                    <td><?php echo $row->mobile_no1; ?></td>
                                    <td><?php echo $row->mobile_no2; ?></td>
                                    <td><?php echo $country_name.$state_name.$city_name; ?></td>  
                                    <td><?php echo $row->pin_code; ?></td>
                                    <td><?php echo $row->address; ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->reg_date));?></td>
                                    <td><?php if($row->is_active=='1') {?><span class="label label-sm label-success"><?php echo  'Active'; ?></span><?php }
                                     else { ?><span class="label label-sm label-danger"><?php echo 'De-Active';?> </span> <?php } ?></td>
                                    <td><a href="<?php echo base_url();?>profile/<?php echo $row->user_id; ?>"><i class="fa fa-search"></i></a></td>   
                                    <td><a href="<?php echo base_url();?>admin/dashboard/login_as_shadow/<?php echo $row->user_id; ?>">Shadow</a></td>
                                                                                    
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