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
                <div class="col-md-4"><a href="<?php echo base_url();?>vendors/trainers/add" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Trainer </span> </a></div>
                
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
                                        <th> Photo</th>
										<th> Trainer name </th>
										<th> Primary Email</th>
										<th> Primary Mobile no.</th>
										<th> Status</th>
										<th> Created By</th>
										<th> Reg date</th>
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
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?>
                                    <a href="<?php echo base_url();?>vendors/trainers/edit/<?php echo $row->user_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
                                    <td><?php 
									$user_photo = $row->user_photo;
									 if($user_photo!='')
										   $photo    ='<img src="'.base_url().'assets/static/'.$this->session->userdata('master_id').'/trainer_photos/resized/'.$user_photo.'" class="profile-image"> ';
									 else	{
										 if($row->gender=='m')
											$photo ='<img src="'.base_url().'assets/img/male.jpg" class="profile-image"> ';
										 else if($row->gender=='f') 
											$photo ='<img src="'.base_url().'assets/img/female.jpg" class="profile-image"> ';				 
										}				 
								 	  if(isset($photo)) echo $photo;
                                       ?> </td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->mobile_no1; ?></td>
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this Trainer ?');" href="<?php echo base_url();?>vendors/trainers/status/<?php echo $row->user_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this Trainer ?');" href="<?php echo base_url();?>vendors/trainers/status/<?php echo $row->user_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    <td><?php echo $postuserrow->name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><a href="<?php echo base_url();?>vendors/trainers/edit/<?php echo $row->user_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
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