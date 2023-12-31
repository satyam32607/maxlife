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

                            <i class="fa fa-envelope"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>

                    </div>

                    <div class="portlet-body">

                        <div class="table-responsive">

                              <table class="table table-bordered table-striped table-condensed flip-content">

                                <thead>

                              <tr>

                              <th> Srno. </th>

                              <th> Invoice No. </th>

                              <th> Invoice Date</th>

                              <th> Invoice format</th>

                              <th> Remarks</th>

                               <th> Admin Status</th>

                              <th> Admin Update On</th>

                              <th> Company Status </th>

                              <th> Company Update On</th>

                               <th> Created On</th>

                             </tr>

                                </thead>

                                <tbody>

							   <?php 

                                if(is_array($results))

                                {  $srno=0; 

                                foreach($results as $row) {

                                $srno++;

								

								if($row->company_approve_date!=NULL && $row->company_approve_date!='0000-00-00 00:00:00')	

								 $company_approve_date =  date('d M, Y',strtotime($row->company_approve_date));

								 else

								 $company_approve_date='';

								 

								 if($row->admin_approve_date!=NULL  && $row->admin_approve_date!='0000-00-00 00:00:00')	

								 $admin_approve_date =  date('d M, Y',strtotime($row->admin_approve_date));

								 else

								 $admin_approve_date='';

								 

						        ?>    

                                    <tr>

                                    <td><?php echo $srno; ?> </td>

                                    <td><?php echo invoice_no_format.$row->invoice_no; ?></td>

                                    <td><?php echo date('d M, Y',strtotime($row->invoice_date));?></td>

                                     <td align="center"><a href="<?php echo base_url(); ?>admin/invoices/details/<?php echo $row->invoice_id; ?>/<?php echo $row->user_id; ?> "><i class="icon-envelope"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="<?php echo base_url(); ?>admin/invoices/view_invoice_payments/<?php echo $row->invoice_id; ?>"><i class="icon-list"></i></a>
                                     </td>

                                    <td><?php echo $row->user_remarks;?></td>

                                     <td><?php if($row->admin_invoice_status=='ap') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to Not Approve this Invoice ?');" href="<?php echo base_url();?>admin/invoices/status/<?php echo $row->invoice_id; ?>/na"><?php echo  'Approved'; ?></a><?php }

                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to Approve this Invoice ?');" href="<?php echo base_url();?>admin/invoices/status/<?php echo $row->invoice_id; ?>/ap"><?php echo 'Not Approved';?> </a> <?php } ?></td>

                                     

                                  

                                     <td><?php echo $admin_approve_date;?></td>

                                      <td><?php if($row->company_invoice_status=='ap') {?><a class="label label-sm label-success"><?php echo  'Approved'; ?></a><?php }

									 elseif($row->company_invoice_status=='pe') {?><a class="label label-sm label-danger"><?php echo  'Pending'; } 

                                     elseif($row->company_invoice_status=='na') {?><a class="label label-sm label-danger"><?php echo  'Not Approved'; } ?>

									</td>

                                    <td><?php echo $company_approve_date;?></td>

                                    

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

</html>