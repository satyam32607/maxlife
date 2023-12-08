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
                <!--<div class="col-md-4"><a href="<?php echo base_url();?>admin/companies/add" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Company </span> </a></div>-->
                
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
                              <th> Partner name </th>
                              <th> Primary Email</th>
                              <th> Contact person</th>
                              <th> Primary  Mobile no.</th>
                              <th> Alternate Mobile no.</th>
                              <th> Services </th>
                              <!-- <th> Country/State/City</th> -->
                              <!-- <th>Pincode</th> -->
                              <!-- <th>Address</th> -->
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

                            // if($row->country_id!='0')
                            //   {
                            //   $countryrow = get_table_info('country','country_id',$row->country_id);
                            //   $country_name= $countryrow->country_name;
                            //   }
                            //   else
                            //   {  $country_name='';
                            //   }
                            
                            //   if($row->state_id!='0')
                            //   {
                            //   $staterow = get_table_info('state','state_id',$row->state_id);
                            //   $state_name = '/'.$staterow->state_name;
                            //   }
                            //   else
                            //   {  $state_name='';
                            //   }
                              
                            //   if($row->city_id!='0')
                            //   {
                            //   $cityrow = get_table_info('city','city_id',$row->city_id);
                            //   $city_name= '/'.$cityrow->city_name;
                            //   }
                            //   else
                            //   {  $city_name='';
                            //   }
                              
                              $postuserrow = get_table_info('users','user_id',$row->created_by);
										        ?>    
                                    <tr>
                                    <td><?php echo $srno; ?>
                                    <a href="<?php echo base_url();?>admin/partners/edit/<?php echo $row->user_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->first_name;?></td>
                                    <td><?php echo $row->mobile_no1; ?></td>
                                    <td><?php echo $row->mobile_no2; ?></td>
                                    <<td><a href="<?php echo base_url();?>admin/companies/add_services/<?php echo $row->user_id; ?>"><i class="fa fa-plus-circle"></i></a>
                                            &nbsp;&nbsp;
                                        <a href="<?php echo base_url();?>admin/companies/partner_services/<?php echo $row->master_id; ?>/<?php echo $row->user_id; ?>"><i class="fa fa-list"></i></a>
                                    </td>
                                    <!-- <td><?php echo $country_name.$state_name.$city_name; ?></td> -->
                                    <!-- <td><?php echo $row->pin_code; ?></td> -->
                                    <!-- <td><?php echo $row->address; ?></td> -->
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this Partner ?');" href="<?php echo base_url();?>admin/partners/status/<?php echo $row->user_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this Partner ?');" href="<?php echo base_url();?>admin/partners/status/<?php echo $row->user_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                     <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><a href="<?php echo base_url();?>admin/partners/edit/<?php echo $row->user_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>  
                      				                                                     
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