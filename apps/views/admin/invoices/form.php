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

                                    <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>

                                    <li> <a href="<?php echo base_url(); ?>admin/invoices/view_invoice_payments/<?php echo $invoice_id ?>"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>

                                    <li> <span><?php echo $heading; ?></span> </li>

                                </ul>

                                <!-- END PAGE BREADCRUMBS -->

                                <!-- BEGIN PAGE CONTENT INNER -->

                                <div class="page-content-inner">

                                    <div class="row">

                                        <div class="col-md-9">

                                            <?php $this->load->view("includes/notifications.php"); ?>

                                            <div class="portlet box green">

                                                <div class="portlet-title">

                                                    <div class="caption"> <i class="fa fa-tree"></i><?php echo $heading; ?> </div>

                                                </div>

                                                <div class="portlet-body form">



                                                    <?php $attributes = array('id' => 'comp_form', 'name' => 'comp_form', 'class' => 'horizontal-form', 'role' => 'form', 'autocomplete' => 'off');

                                                    echo form_open_multipart(base_url() . 'admin/invoices/paymentSubmit/', $attributes);
                                                    echo form_hidden('invoice_id', $invoice_id);
                                                    ?>

                                                    <div class="form-body">

                                                        <div class="alert alert-danger display-hide">

                                                            <button class="close" data-close="alert"></button>

                                                            You have some form errors. Please check below.
                                                        </div>

                                                        <div class="alert alert-success display-hide">

                                                            <button class="close" data-close="alert"></button>

                                                            Your form validation is successful!
                                                        </div>

                                                        <?php if (validation_errors()) : ?>

                                                            <div class="alert alert-danger">

                                                                <button class="close" data-close="alert"></button>

                                                                <span> <?php echo common_error_msg; ?></span>
                                                            </div>

                                                        <?php endif; ?>

                                                        <!--/row-->

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="control-label">Transaction ID </label>

                                                                    <?php $data = array(

                                                                        'name'        => 'transaction_id',

                                                                        'id'          => 'transaction_id',

                                                                        'type'        =>  'text',

                                                                        'value'       => set_value('transaction_id'),

                                                                        'maxlength'   => '60',

                                                                        'required'    => true,

                                                                        'class'   => 'form-control',

                                                                    );

                                                                    echo form_input($data);

                                                                    echo form_error('transaction_id');

                                                                    ?>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="control-label">Transaction Amount </label>

                                                                    <?php $data = array(

                                                                        'name'        => 'transaction_amount',

                                                                        'id'          => 'transaction_amount',

                                                                        'type'        =>  'number',
                                                                        'step'        =>   '0.01',
                                                                        'value'       => set_value('transaction_amount'),

                                                                        'required'    => true,

                                                                        'class'   => 'form-control',

                                                                    );

                                                                    echo form_input($data);

                                                                    echo form_error('transaction_amount');

                                                                    ?>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="control-label">Transaction Date </label>

                                                                    <?php $data = array(

                                                                        'name'        => 'transaction_date',

                                                                        'id'          => 'transaction_date',

                                                                        'type'        =>  'date',

                                                                        'value'       => set_value('transaction_date'),

                                                                        'required'    => true,

                                                                        'class'   => 'form-control',

                                                                    );

                                                                    echo form_input($data);

                                                                    echo form_error('transaction_date');

                                                                    ?>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Payment Mode</label>
                                                                    <select name="payment_mode" class="form-control">
                                                                        <option value="online">Online</option>
                                                                        <option value="DD-Check">DD-Check</option>
                                                                        <option value="Bank Transfer">Bank Transfer</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="control-label">Transaction Detail </label>

                                                                    <?php $data = array(

                                                                        'name'        => 'transaction_detail',

                                                                        'id'          => 'transaction_detail',

                                                                        'type'        =>  'text',

                                                                        'value'       => set_value('transaction_detail'),

                                                                        'required'    => true,

                                                                        'class'   => 'form-control',

                                                                    );

                                                                    echo form_input($data);

                                                                    echo form_error('transaction_detail');

                                                                    ?>

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

    <script src="<?php echo base_url(); ?>assets/pages/js/custom.js" type="text/javascript"></script>



    <!-- END CUSTOM SCRIPTS -->

</html>