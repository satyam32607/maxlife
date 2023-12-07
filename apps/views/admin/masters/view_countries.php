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
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <a href="<?php echo base_url(); ?>">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="#"><?php echo $main_heading; ?></a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span><?php echo $heading; ?></span>
                                        </li>
                                    </ul>
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
                                                            <i class="fa fa-location-arrow"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?> </div>
                                                        </div>
                                                    <div class="portlet-body flip-scroll">
                                                        <table class="table table-bordered table-striped table-condensed flip-content">
                                                            <thead class="flip-content">
                                                                <tr>
                                                                    <th> Srno. </th>
                                                                     <th> Country name </th>
                                                    				 <th> Sort name</th>
                                                                     <th> Total states</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>	
                                                            <?php 
															  if(is_array($results))
															  {  $srno=0; 
																 foreach($results as $row) {
																 $srno++;
															  ?>
                                                                <tr>
                                                                   <td><?php echo $srno; ?></td>
                                                                    <td><?php echo $row->country_name; ?></td>
                                                                    <td><?php echo $row->sortname; ?></td>
                                                                    <td><a href="<?php echo base_url();?>admin/masters/view_states/0/<?php echo $row->country_id; ?>" title="View States"> <span class="label label-sm label-success">view  [<?php echo $row->total_states; ?>] </span></a></td>
                                                                </tr>
                                                              <?php 
																  } 
																} ?>  
                                                            </tbody>
                                                        </table>
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
                        <a href="javascript:;" class="page-quick-sidebar-toggler">
                            <i class="icon-login"></i>
                        </a>
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