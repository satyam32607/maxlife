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

                                        <th> Category </th>

										<th> Service name </th>

										<th> HSN-SAC</th>

										<th> Service Code </th>
										<th> Start Date </th>
										<th> End Date </th>
										<th> Qty </th>

										<th> Short name</th>
                    <th>Document Status</th>
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
                      $documentStatus     = $this->services_model->getDocumentStatus($row->user_service_id);
									  ?>    

                                    <tr>

                                    <td><?php echo $srno; ?></td>

                                    <td><?php echo $row->category_name; ?></td>

                                    <td><?php echo $row->service_name; ?></td>

                                    <td><?php echo $row->hsn_code; ?></td>

                                    <td><?php echo $row->service_code; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->start_date)); ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->end_date)); ?></td>
                                    <td><?php echo $row->qty; ?></td>

                                    <td><?php echo $row->service_short_name; ?></td>
                                    <td><?php echo $documentStatus ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>

                                     <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>

                                    <td>
                                      <a href="<?php echo base_url()."partners/services/add_services/".$row->user_service_id."/".$row->service_id ?>"><i class="fa fa-edit"></i></a>
                                      <!-- <a href=""><i class="fa fa-remove text-danger"></i></a> -->
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

</body>

</html>