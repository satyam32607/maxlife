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
                                    <li> <a href="<?php echo base_url(); ?>partners/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                                    <li> <a href="<?php echo base_url(); ?>partners/services/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
                                                    <div class="caption"> <i class="fa fa-user"></i><?php echo $service->service_name; ?> </div>
                                                </div>
                                                <div class="portlet-body form">

                                                    <?php $attributes = array('class' => 'horizontal-form', 'role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open_multipart(base_url() . 'partners/services/store_services', $attributes);
                                                    ?>

                                                    <div class="form-body">
                                                        <input type="hidden" name="partner_id" value="<?php echo $partnerId ?>">
                                                        <input type="hidden" name="user_service_id" value="<?php echo $user_service_id ?>">
                                                        <input type="hidden" name="service_id" value="<?php echo $service->service_id ?>">
                                                        <?php $i = 0; ?>
                                                        <?php $submit = 0; ?>

                                                        <?php if (!empty($documents)) {
                                                            foreach ($documents as $document) { ?>
                                                                <?php $i++; ?>
                                                                <br><br>
                                                                <input type="hidden" name="document_id[]" <?php if ($document->doc_status == "P" || $document->doc_status == "N" || empty($document->doc_status)) { ?> name="document_id[]" value="<?php echo $document->service_document_id ?> <?php } ?>">
                                                                <div class="container mt-5">
                                                                    <div class="row">
                                                                        <div class="col-md-12 offset-lg-3 mt-3">
                                                                            <div style="border: solid lightblue 1px;">
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Document Name <?php echo $i ?> <span class="required"> * </span></label>
                                                                                        <input type="text" class="form-control" <?php if ($document->doc_status == "P" || $document->doc_status == "N" || empty($document->doc_status)) { ?> name="document_name_1[]" <?php } ?> value="<?php echo $document->document_name1 ?>" <?php if ($document->doc_status == "A") { ?> readonly <?php } ?> required id="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Document File <?php echo $i ?> <span class="required"> * </span></label>
                                                                                        <?php if (!$document->document_file_name1 || $document->doc_status == "N") { ?>
                                                                                            <?php if ($document->document_file_name1) { ?>
                                                                                                <a target="_blank" href="<?php echo base_url() . "assets/static/2/partners/$partnerId/$document->document_file_name1" ?>"><i class="fa fa-eye"></i></a>
                                                                                            <?php } ?>
                                                                                            <?php if (($document->document_file_name1 && $document->doc_status == "N") || empty($document->document_file_name1)) { ?>
                                                                                                <input type="file" name="document_file_1[]" required id="">
                                                                                                <?php $submit = 1; ?>
                                                                                            <?php } ?>
                                                                                        <?php } else { ?>
                                                                                            <a target="_blank" href="<?php echo base_url() . "assets/static/2/partners/$partnerId/$document->document_file_name1" ?>"><i class="fa fa-eye"></i></a>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
                                                                                <?php if (!empty($document->doc_status)) { ?>
                                                                                    <div class="col-md-2">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label">Status</label>
                                                                                            <input type="text" class="form-control" readonly value="<?php if ($document->doc_status == "A") {
                                                                                                                                                        echo "Approved";
                                                                                                                                                    } elseif ($document->doc_status == "N") {
                                                                                                                                                        echo "Not Approved";
                                                                                                                                                    } else {
                                                                                                                                                        echo "Pending";
                                                                                                                                                    } ?>" required id="">
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <!-- <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Document Name 2</label>
                                                                                    <input type="name" class="form-control" name="document_name_2[]" id="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Document File 2</label>
                                                                                    <input type="file" name="document_file_2[]" id="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Document Name 3</label>
                                                                                    <input type="name" class="form-control" name="document_name_3[]" id="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Document File 3</label>
                                                                                    <input type="file" name="document_file_3[]" id="">
                                                                                </div>
                                                                            </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php }
                                                        } else { ?>
                                                            <div class="container mt-5">
                                                                <div class="row m-b-20">
                                                                    <div class="pull-right">
                                                                        <a href="javascript:;" id="clone" class="btn btn-success btn-sm">
                                                                            <i class="fa fa-plus"></i> Add more</a>
                                                                    </div>
                                                                </div>
                                                                <div class="row cloned-row" id="cloned-data-id-1">
                                                                    <div class="col-md-12 offset-lg-3 mt-3">
                                                                        <div style="border: solid lightblue 1px;">
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Document Name <span class="index"> 1 </span> <span class="required"> * </span></label>
                                                                                    <input type="text" class="form-control" name="document_name_1[]" required id="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Document File <span class="index"> 1 </span> <span class="required"> * </span></label>
                                                                                    <input type="file" name="document_file_1[]" required id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <a href="javascript:;" class="btn btn-danger btn-sm delete_clone_elemet">
                                                                                <i class="fa fa-close"></i> Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <?php if (1) { ?>
                                                                <div class="col-md-offset-6 col-md-8">
                                                                    <button type="submit" id="submit_btn" class="btn green" value="Submit">Submit</button>
                                                                </div>
                                                            <?php } ?>
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
      $('.cloned-row:last').find("span.index").text(eval(countrow + 1))

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
    </script>
</body>

</html>