<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

  <meta charset="utf-8" />

  <title><?php echo isset($title) ? $title : title; ?></title>

  <?php $this->load->view("includes/styles.php"); ?>

  <link href="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepiker3.min.css" rel="stylesheet" type="text/css" />



</head>

<!-- END HEAD -->



<body class="page-container-bg-solid page-header-menu-fixed">

  <div class="page-wrapper">

    <div class="page-wrapper-row">

      <div class="page-wrapper-top">

        <!-- BEGIN HEADER -->

        <?php $this->load->view("includes/header.php"); ?>

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

                      <?php $this->load->view("includes/notifications.php"); ?>



                      <?php if ((validation_errors()) || ($already_msg)) : ?>

                        <div class="alert alert-danger">

                          <button class="close" data-close="alert"></button>

                          <span> <?php echo common_error_msg; ?><?php echo $already_msg; ?></span>
                        </div>

                      <?php endif; ?>



                      <!-- BEGIN FILTER TABLE-->

                      <?php $attributes = array('id' => 'form1', 'name' => 'form1', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');

                      echo form_open(base_url() . 'partners/invoices/add', $attributes);

                      echo form_hidden('form_type', '1');

                      ?>

                      <div class="portlet box blue-hoki">

                        <div class="portlet-title">

                          <div class="caption">

                            <i class="fa fa-invoice"></i>Choose Month & Create Invoice
                          </div>

                          <div class="tools">

                            <a href="javascript:;" class="expand"> </a>

                          </div>

                        </div>

                        <div class="portlet-body portlet-expand">

                          <div class="row">

                            <div class="col-md-3">

                              <label>Choose Invoice Month</label>
                                  <input type="month" name="choose_invoice_month" value="<?php empty($_GET["choose_invoice_month"]) ?  null :  $_GET["choose_invoice_month"]; ?>" id="monthYearPicker">
                            </div>





                          </div>



                          <div class="margin-top-10"><button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button></div>

                        </div>

                      </div>

                      <?php echo form_close(); ?>

                      <!-- END FILTER TABLE-->



                      <?php

                      if ($total_results > 0) {

                      ?>



                        <?php $attributes = array('id' => 'form1', 'name' => 'form1', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');

                        echo form_open(base_url() . 'partners/invoices/add', $attributes);

                        echo form_hidden('form_type', '2');

                        echo form_hidden('user_service_id', '1');

                        ?>

                        <div class="portlet box green">

                          <div class="portlet-title">

                            <div class="caption">

                              <i class="fa fa-database"></i> Total records: <?php echo '(' . $total_results . ')'; ?>
                            </div>

                          </div>





                          <!-- BEGIN TABLE PORTLET-->





                          <div class="portlet-body">

                            <div class="table-responsive">

                              <table class="table table-bordered table-striped table-condensed flip-content">

                                <thead>

                                  <tr>

                                    <th> Srno. </th>

                                    <th> Category</th>

                                    <th>HSN/SAC</th>

                                    <th> Service</th>

                                    <th> Start Date</th>

                                    <th> End Date</th>

                                    <th> Remarks</th>

                                    <th>Document Status</th>

                                    <th>Document Approve Date</th>

                                  </tr>

                                </thead>

                                <tbody>

                                  <?php

                                  if (is_array($results)) {
                                    $srno = 0;

                                    $all_document_status = 0;



                                    foreach ($results as $row) {

                                      $srno++;



                                      if ($row->doc_approve_date != NULL  && $row->doc_approve_date != '0000-00-00 00:00:00')

                                        $doc_approve_date =  date('d M, Y', strtotime($row->doc_approve_date));

                                      else

                                        $doc_approve_date = '';



                                      $catrow = get_table_info('categories', 'category_id', $row->category_id);

                                      $servrow = get_table_info('services', 'service_id', $row->service_id);



                                      if ($row->doc_status != 'A') {

                                        $all_document_status++;
                                      }

                                  ?>

                                      <tr>

                                        <td><?php echo $srno; ?> </td>

                                        <td><?php echo $catrow->category_name; ?></td>

                                        <td><?php echo $servrow->hsn_code; ?></td>

                                        <td><?php echo $servrow->service_name; ?></td>

                                        <td><?php echo date('d M, Y', strtotime($row->start_date)); ?></td>

                                        <td><?php echo date('d M, Y', strtotime($row->end_date)); ?></td>

                                        <td><?php echo $row->remarks; ?></td>

                                        <td><?php if ($row->doc_status == 'A') { ?><a class="label label-sm label-success"><?php echo  'Approved'; ?></a><?php } elseif ($row->doc_status == 'P') { ?><a class="label label-sm label-danger"><?php echo  'Pending';
                                                                                                                                                    } elseif ($row->doc_status == 'N') { ?><a class="label label-sm label-danger"><?php echo  'Not Approved';
                                                                                                                                                    } ?>

                                        </td>

                                        <td><?php echo $doc_approve_date; ?></td>

                                      </tr>

                                  <?php

                                    }
                                  }

                                  ?>

                                </tbody>

                              </table>





                              <!--/row-->



                            </div>



                            <?php if ($all_document_status == '0') : ?>

                              <div class="row">

                                <div class="col-md-3">

                                  <label class="control-label">Invoice Date<span class="required"> * </span></label>

                                  <div class="input-group">
                                    <?php $data = array(

                                      'name'        => 'invoice_date',

                                      'type'          => 'date',

                                      'value'       => set_value('invoice_date'),

                                      'maxlength'   => '15',

                                      'redonly'  => 'readonly',

                                      'class'   => 'form-control',

                                      'placeholder'   => 'YYYY-MM-DD',

                                      'required'   => 'required',

                                    );

                                    echo form_input($data);

                                    echo form_error('invoice_date');

                                    ?>



                                  </div>

                                </div>



                                <div class="col-md-3">



                                  <label>Remarks</label>

                                  <?php $data = array(

                                    'name'        => 'user_remarks',

                                    'id'          => 'user_remarks',

                                    'value'       => set_value('user_remarks') ? $this->input->post("user_remarks") : set_value('user_remarks'),

                                    'rows'       => '4',

                                    'cols'       => '50',

                                    'class'   => 'form-control',

                                  );

                                  echo form_textarea($data);

                                  echo form_error('user_remarks');

                                  ?>

                                </div>



                                <div class="col-md-2">

                                  <br> <br> <br>

                                  <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>

                                  &nbsp;&nbsp;&nbsp;&nbsp;

                                  <input type="reset" class="btn default" name="Reset" value="Reset">

                                </div>



                              </div>



                            <?php endif; ?>



                          </div>





                        </div>

                        <?php echo form_close(); ?>

                        <!-- END TABLE PORTLET-->



                      <?php }  ?>



                      <?php if ($this->input->post('form_type') == '1') :

                        if ($total_results < 0) { ?>

                          ?>

                          <div class="row">

                            <div class="col-md-8 text-center m-t-10"> No Record Found!.</div>



                          </div>

                      <?php }
                      endif; ?>



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

    <?php $this->load->view("includes/footer.php"); ?>

  </div>

  <?php $this->load->view("includes/scripts.php"); ?>

  <script src="<?php echo base_url(); ?>assets/pages/js/custom.js" type="text/javascript"></script>

</body>
<!-- <script>
    document.getElementById('monthYearPicker').addEventListener('change', function() {
        var selectedMonthYear = this.value;
        
        if (selectedMonthYear) {
            // Split the date into year and month
            var parts = selectedMonthYear.split('-');
            // Reformat to MM-YYYY
            var formattedDate = parts[1] + '-' + parts[0];
            console.log(formattedDate); // Outputs something like "03-2023"
        }
    });
</script> -->


</html>