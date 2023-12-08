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
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

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
                <ul class="page-breadcrumb breadcrumb">
                  <li> <a href="<?php echo base_url(); ?>schools/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                  <li> <a href="<?php echo base_url(); ?>schools/students/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                  <li> <span><?php echo $heading; ?></span> </li>
                </ul>
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                  <div class="row">
                    <div class="col-md-12">
                      <?php $this->load->view("includes/notifications.php"); ?>
                      <div class="portlet box green">
                        <div class="portlet-title">
                          <div class="caption"> <i class="fa fa-user"></i><?php echo $heading; ?> </div>
                        </div>
                        <div class="portlet-body form">

                          <?php $attributes = array('id' => 'student_form', 'name' => 'student_form', 'class' => 'horizontal-form', 'role' => 'form', 'autocomplete' => 'off');
                          echo form_open_multipart(base_url() . 'admin/companies/store_services', $attributes);
                          ?>
                          <input type="hidden" name="partner_id" value="<?php echo $partner_id ?>">
                          <div class="form-body">
                            <div class="alert alert-danger display-hide">
                              <button class="close" data-close="alert"></button>
                              You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success display-hide">
                              <button class="close" data-close="alert"></button>
                              Your form validation is successful!
                            </div>
                            <?php if ((validation_errors())) : ?>
                              <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span> <?php echo validation_errors(); ?></span>
                              </div>
                            <?php endif; ?>


                            <div class="row">
                              <div class="pull-right">
                                <a href="javascript:;" id="clone" class="btn btn-success btn-sm">
                                  <i class="fa fa-plus"></i> Add more</a>
                              </div>
                            </div>

                            <div class="cloned-row" id="cloned-data-id-1">
                              <div class="row">

                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label class="control-label">Services <span class="required"> * </span></label>
                                    <select name="services[]" class="form-control" required>
                                      <?php
                                      
                                      foreach ($services as $service) {
                                        echo  "<option value='$service->service_id'>$service->service_name - $service->service_code </option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>


                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label class="control-label">Quantity <span class="required"> * </span></label>
                                    <?php $data = array(
                                      'name'        => 'qty[]',
                                      'id'          => 'qty',
                                      'type'        =>  'number',
                                      'value'       => set_value('qty'),
                                      'max'         => '200',
                                      'min'         => '1',
                                      'class'   => 'form-control',
                                      'required'   => 'required',
                                      'oninput'   => 'limitNumberLength(this)',
                                    );
                                    echo form_input($data);
                                    echo form_error('qty');
                                    ?>
                                  </div>
                                </div>


                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>Start Date <span class="required"> * </span></label>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                      <?php $data = array(
                                        'name'        => 'start_date[]',
                                        'id'          => 'start_date',
                                        'value'       => set_value('start_date'),
                                        'class'   => 'form-control date_picker',
                                        'required'   => 'required',
                                        'placeholder'   => 'YYYY-MM-DD',
                                      );
                                      echo form_input($data);
                                      echo form_error('start_date');
                                      ?>
                                      <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>End Date <span class="required"> * </span></label>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                      <?php $data = array(
                                        'name'        => 'end_date[]',
                                        'id'          => 'end_date',
                                        'value'       => set_value('end_date'),
                                        'class'   => 'form-control date_picker',
                                        'required'   => 'required',
                                        'placeholder'   => 'YYYY-MM-DD',
                                      );
                                      echo form_input($data);
                                      echo form_error('end_date');
                                      ?>
                                      <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              <!--/row-->

                              <div class="row">


                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Remarks </label>
                                    <textarea name="remarks[]" class="form-control" id="remarks" cols="30" rows="10"></textarea>
                                    <?php
                                    echo form_error('remarks');
                                    ?>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">

                                    <a href="javascript:;" class="btn btn-danger btn-sm delete_clone_elemet">
                                      <i class="fa fa-close"></i> Delete</a>

                                  </div>
                                </div>

                                <!--/row-->



                                <!--/row-->

                                <div class="row">
                                  <hr style="color:#000; font-size:16px;">
                                </div>
                              </div>



                            </div>
                            <div class="form-actions">
                              <div class="row">
                                <div class="col-md-offset-6 col-md-8">
                                  <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                  <input type="reset" class="btn default" name="Reset" value="Reset">
                                </div>
                              </div>
                            </div>
                            <?php echo form_close(); ?>
                            <?php $this->load->view("includes/loader.php"); ?>
                          </div>

                        </div>
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
    <!-- BEGIN CUSTOM SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo base_url(); ?>assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/pages/js/custom.js" type="text/javascript"></script>
    <!-- END CUSTOM SCRIPTS -->
    <script>
      $(document).ready(function() {

        $("#clone").on('click', function() {
          var countrow = $(".cloned-row").length;
          var cloned_div_id = $('.cloned-row:last').attr('id');
          //alert(cloned_div_id);
          var clonedivid = cloned_div_id.slice(0, 14);
          var clonerowdivcount = cloned_div_id.slice(15, 16);
          var clonedivcount = (parseInt(clonerowdivcount) + 1)
          //alert(countrow);
          if (countrow < 200) {
            $(".cloned-row:first").clone().insertAfter(".cloned-row:last");
            $('.cloned-row:last').each(function(index) {
              var clonedividnm = clonedivid + '-' + clonedivcount;
              $('.cloned-row:last').attr('id', clonedividnm);
            });

            $('.cloned-row:last').find('input').val("");
            //$('.cloned-row:last').find('select').val("");
            $('.cloned-row:last').find('checkbox').val("");

            $('.cloned-row:last').find('textarea').val("");
            $('.cloned-row:last').find('img').remove();
            //$(".cloned-row:last").find('.date_picker').datepicker("setDate", currentDate);
            $('.date_picker').removeData('datepicker').unbind().datepicker({
              changeMonth: true,
              format: 'yyyy-mm-dd',
              autoclose: true,
            }).on('changeDate', function(e) {});
            countrow++;
          }

          return false;
        });

        $("body").on('click', '.delete_clone_elemet', function() {
          var lClonedRow = $('.cloned-row').length;
          //alert(lClonedRow);
          if (lClonedRow < 2) {
            alert("Unable to delete");
          } else {
            $(this).parents('.cloned-row').remove();
            //$(this).parent().parent().parent().parent().remove();
          }
          return false;
        });
      });

      function limitNumberLength(element) {
        const minValue = 1;
        const maxValue = 200;

        if (element.value < minValue) {
          element.value = minValue;
        } else if (element.value > maxValue) {
          element.value = maxValue;
        }
      }
    </script>
</body>

</html>