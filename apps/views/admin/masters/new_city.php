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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #3 for bootstrap form validation demos using jquery validation plugin" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
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
                                        <h1>Bootstrap Form Validation
                                            <small>bootstrap form validation demos using jquery validation plugin</small>
                                        </h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                    <!-- BEGIN PAGE TOOLBAR -->
                                    <div class="page-toolbar">
                                        <!-- BEGIN THEME PANEL -->
                                        <div class="btn-group btn-theme-panel">
                                            <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-settings"></i>
                                            </a>
                                            <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <h3>THEME COLORS</h3>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <ul class="theme-colors">
                                                                    <li class="theme-color theme-color-default" data-theme="default">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Default</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-blue-hoki" data-theme="blue-hoki">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Blue Hoki</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-blue-steel" data-theme="blue-steel">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Blue Steel</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-yellow-orange" data-theme="yellow-orange">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Orange</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-yellow-crusta" data-theme="yellow-crusta">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Yellow Crusta</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <ul class="theme-colors">
                                                                    <li class="theme-color theme-color-green-haze" data-theme="green-haze">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Green Haze</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-red-sunglo" data-theme="red-sunglo">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Red Sunglo</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-red-intense" data-theme="red-intense">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Red Intense</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-purple-plum" data-theme="purple-plum">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Purple Plum</span>
                                                                    </li>
                                                                    <li class="theme-color theme-color-purple-studio" data-theme="purple-studio">
                                                                        <span class="theme-color-view"></span>
                                                                        <span class="theme-color-name">Purple Studio</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 seperator">
                                                        <h3>LAYOUT</h3>
                                                        <ul class="theme-settings">
                                                            <li> Theme Style
                                                                <select class="theme-setting theme-setting-style form-control input-sm input-small input-inline tooltips" data-original-title="Change theme style" data-container="body" data-placement="left">
                                                                    <option value="boxed" selected="selected">Square corners</option>
                                                                    <option value="rounded">Rounded corners</option>
                                                                </select>
                                                            </li>
                                                            <li> Layout
                                                                <select class="theme-setting theme-setting-layout form-control input-sm input-small input-inline tooltips" data-original-title="Change layout type" data-container="body" data-placement="left">
                                                                    <option value="boxed" selected="selected">Boxed</option>
                                                                    <option value="fluid">Fluid</option>
                                                                </select>
                                                            </li>
                                                            <li> Top Menu Style
                                                                <select class="theme-setting theme-setting-top-menu-style form-control input-sm input-small input-inline tooltips" data-original-title="Change top menu dropdowns style" data-container="body"
                                                                    data-placement="left">
                                                                    <option value="dark" selected="selected">Dark</option>
                                                                    <option value="light">Light</option>
                                                                </select>
                                                            </li>
                                                            <li> Top Menu Mode
                                                                <select class="theme-setting theme-setting-top-menu-mode form-control input-sm input-small input-inline tooltips" data-original-title="Enable fixed(sticky) top menu" data-container="body"
                                                                    data-placement="left">
                                                                    <option value="fixed">Fixed</option>
                                                                    <option value="not-fixed" selected="selected">Not Fixed</option>
                                                                </select>
                                                            </li>
                                                            <li> Mega Menu Style
                                                                <select class="theme-setting theme-setting-mega-menu-style form-control input-sm input-small input-inline tooltips" data-original-title="Change mega menu dropdowns style" data-container="body"
                                                                    data-placement="left">
                                                                    <option value="dark" selected="selected">Dark</option>
                                                                    <option value="light">Light</option>
                                                                </select>
                                                            </li>
                                                            <li> Mega Menu Mode
                                                                <select class="theme-setting theme-setting-mega-menu-mode form-control input-sm input-small input-inline tooltips" data-original-title="Enable fixed(sticky) mega menu" data-container="body"
                                                                    data-placement="left">
                                                                    <option value="fixed" selected="selected">Fixed</option>
                                                                    <option value="not-fixed">Not Fixed</option>
                                                                </select>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END THEME PANEL -->
                                    </div>
                                    <!-- END PAGE TOOLBAR -->
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <a href="index.html">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="#">More</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Form Stuff</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        <div class="m-heading-1 border-green m-bordered">
                                            <h3>jQuery Validation Plugin</h3>
                                            <p> This jQuery plugin makes simple clientside form validation easy, whilst still offering plenty of customization options. For more info please check out
                                                <a class="btn red btn-outline" href="http://jqueryvalidation.org"
                                                    target="_blank">the official documentation</a>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- BEGIN VALIDATION STATES-->
                                                <div class="portlet light portlet-fit portlet-form " id="form_wizard_1">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class=" icon-layers font-green"></i>
                                                            <span class="caption-subject font-green sbold uppercase">Validation States</span>
                                                        </div>
                                                        <div class="actions">
                                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                                <i class="icon-cloud-upload"></i>
                                                            </a>
                                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                                <i class="icon-wrench"></i>
                                                            </a>
                                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <!-- BEGIN FORM-->
                                                        <form action="#" class="form-horizontal">
                                                            <div class="form-body">
                                                                <h3 class="form-section">Basic validation States</h3>
                                                                <div class="form-group has-warning">
                                                                    <label class="control-label col-md-3" for="inputWarning">Input with warning</label>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" id="inputWarning" />
                                                                        <span class="help-block"> Something may have gone wrong </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-error">
                                                                    <label class="control-label col-md-3" for="inputError">Input with error</label>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" id="inputError" />
                                                                        <span class="help-block"> Please correct the error </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-success">
                                                                    <label class="control-label col-md-3" for="inputSuccess">Input with success</label>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" id="inputSuccess" /> </div>
                                                                </div>
                                                                <h3 class="form-section">Validation States With Icons</h3>
                                                                <div class="form-group has-warning">
                                                                    <label class="control-label col-md-3">Input with warning</label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa fa-exclamation tooltips" data-original-title="please write a valid email"></i>
                                                                            <input type="text" class="form-control" /> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-error">
                                                                    <label class="control-label col-md-3">Input with error</label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa fa-warning tooltips" data-original-title="please write a valid email"></i>
                                                                            <input type="text" class="form-control" /> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-success">
                                                                    <label class="control-label col-md-3">Input with success</label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa fa-check tooltips" data-original-title="success input!"></i>
                                                                            <input type="text" class="form-control" /> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="submit" class="btn green">Submit</button>
                                                                        <button type="button" class="btn default">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- END FORM-->
                                                    </div>
                                                </div>
                                                <!-- END VALIDATION STATES-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- BEGIN VALIDATION STATES-->
                                                <div class="portlet light portlet-fit portlet-form ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-settings font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Basic Validation</span>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                                <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                                                    <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                                                <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                                                                    <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <!-- BEGIN FORM-->
                                                        <form action="#" id="form_sample_1" class="form-horizontal">
                                                            <div class="form-body">
                                                                <div class="alert alert-danger display-hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                                <div class="alert alert-success display-hide">
                                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Name
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="name" data-required="1" class="form-control" /> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Email
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input name="email" type="text" class="form-control" /> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">URL
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input name="url" type="text" class="form-control" />
                                                                        <span class="help-block"> e.g: http://www.demo.com or http://demo.com </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Number
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input name="number" type="text" class="form-control" /> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Digits
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input name="digits" type="text" class="form-control" /> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Credit Card
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input name="creditcard" type="text" class="form-control" />
                                                                        <span class="help-block"> e.g: 5500 0000 0000 0004 </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Occupation&nbsp;&nbsp;</label>
                                                                    <div class="col-md-4">
                                                                        <input name="occupation" type="text" class="form-control" />
                                                                        <span class="help-block"> optional field </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Select
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control" name="select">
                                                                            <option value="">Select...</option>
                                                                            <option value="Category 1">Category 1</option>
                                                                            <option value="Category 2">Category 2</option>
                                                                            <option value="Category 3">Category 5</option>
                                                                            <option value="Category 4">Category 4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Multi Select
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control" name="select_multi" multiple>
                                                                            <option value="Category 1">Category 1</option>
                                                                            <option value="Category 2">Category 2</option>
                                                                            <option value="Category 3">Category 3</option>
                                                                            <option value="Category 4">Category 4</option>
                                                                            <option value="Category 5">Category 5</option>
                                                                        </select>
                                                                        <span class="help-block"> select max 3 options, min 1 option </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Input Group
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-envelope"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" name="input_group" placeholder="Email Address"> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="submit" class="btn green">Submit</button>
                                                                        <button type="button" class="btn grey-salsa btn-outline">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- END FORM-->
                                                    </div>
                                                </div>
                                                <!-- END VALIDATION STATES-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- BEGIN VALIDATION STATES-->
                                                <div class="portlet light portlet-fit portlet-form ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-bubble font-green"></i>
                                                            <span class="caption-subject font-green bold uppercase">Validation Using Icons</span>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="btn-group">
                                                                <a class="btn green btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                                                                    <i class="fa fa-angle-down"></i>
                                                                </a>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                        <a href="javascript:;"> Option 1</a>
                                                                    </li>
                                                                    <li class="divider"> </li>
                                                                    <li>
                                                                        <a href="javascript:;">Option 2</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">Option 3</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">Option 4</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <!-- BEGIN FORM-->
                                                        <form action="#" id="form_sample_2" class="form-horizontal">
                                                            <div class="form-body">
                                                                <div class="alert alert-danger display-hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                                <div class="alert alert-success display-hide">
                                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                                <div class="form-group  margin-top-20">
                                                                    <label class="control-label col-md-3">Name
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <input type="text" class="form-control" name="name" /> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Email
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <input type="text" class="form-control" name="email" /> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">URL
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <input type="text" class="form-control" name="url" /> </div>
                                                                        <span class="help-block"> e.g: http://www.demo.com or http://demo.com </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Number
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <input type="text" class="form-control" name="number" /> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Digits
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <input type="text" class="form-control" name="digits" /> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Credit Card
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <input type="text" class="form-control" name="creditcard" /> </div>
                                                                        <span class="help-block"> e.g: 5500 0000 0000 0004 </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="submit" class="btn green">Submit</button>
                                                                        <button type="button" class="btn default">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- END FORM-->
                                                    </div>
                                                </div>
                                                <!-- END VALIDATION STATES-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- BEGIN VALIDATION STATES-->
                                                <div class="portlet light portlet-fit portlet-form ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-settings font-dark"></i>
                                                            <span class="caption-subject font-dark sbold uppercase">Advance Validation</span>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                                                    <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                                                    <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <!-- BEGIN FORM-->
                                                        <form action="#" id="form_sample_3" class="form-horizontal">
                                                            <div class="form-body">
                                                                <div class="alert alert-danger display-hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                                <div class="alert alert-success display-hide">
                                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Name
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="name" data-required="1" class="form-control" /> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Email Address
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-envelope"></i>
                                                                            </span>
                                                                            <input type="email" name="email" class="form-control" placeholder="Email Address"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Occupation&nbsp;&nbsp;</label>
                                                                    <div class="col-md-4">
                                                                        <input name="occupation" type="text" class="form-control" /> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Select2 Dropdown
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control select2me" name="options2">
                                                                            <option value="">Select...</option>
                                                                            <option value="Option 1">Option 1</option>
                                                                            <option value="Option 2">Option 2</option>
                                                                            <option value="Option 3">Option 3</option>
                                                                            <option value="Option 4">Option 4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Datepicker</label>
                                                                    <div class="col-md-4">
                                                                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                                                            <input type="text" class="form-control" readonly name="datepicker">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn default" type="button">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                        <!-- /input-group -->
                                                                        <span class="help-block"> select a date </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Membership
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="mt-radio-list" data-error-container="#form_2_membership_error">
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="membership" value="1" /> Fee
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="membership" value="2" /> Professional
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                        <div id="form_2_membership_error"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Services
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <div class="mt-checkbox-list" data-error-container="#form_2_services_error">
                                                                            <label class="mt-checkbox">
                                                                                <input type="checkbox" value="1" name="service" /> Service 1
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-checkbox">
                                                                                <input type="checkbox" value="2" name="service" /> Service 2
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-checkbox">
                                                                                <input type="checkbox" value="3" name="service" /> Service 3
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                        <span class="help-block"> (select at least two) </span>
                                                                        <div id="form_2_services_error"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Markdown</label>
                                                                    <div class="col-md-9">
                                                                        <textarea name="markdown" data-provide="markdown" rows="10" data-error-container="#editor_error"></textarea>
                                                                        <div id="editor_error"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">WYSIHTML5 Editor
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <textarea class="wysihtml5 form-control" rows="6" name="editor1" data-error-container="#editor1_error"></textarea>
                                                                        <div id="editor1_error"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group last">
                                                                    <label class="control-label col-md-3">CKEditor
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>
                                                                        <div id="editor2_error"> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="submit" class="btn green">Submit</button>
                                                                        <button type="button" class="btn default">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <!-- END VALIDATION STATES-->
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
                        <a href="javascript:;" class="page-quick-sidebar-toggler">
                            <i class="icon-login"></i>
                        </a>
                        <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                            <div class="page-quick-sidebar">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                                            <span class="badge badge-danger">2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alerts
                                            <span class="badge badge-success">7</span>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                    <i class="icon-bell"></i> Alerts </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                    <i class="icon-info"></i> Notifications </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                    <i class="icon-speech"></i> Activities </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                    <i class="icon-settings"></i> Settings </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                                        <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                                            <h3 class="list-heading">Staff</h3>
                                            <ul class="media-list list-items">
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-success">8</span>
                                                    </div>
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Bob Nilson</h4>
                                                        <div class="media-heading-sub"> Project Manager </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar1.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Nick Larson</h4>
                                                        <div class="media-heading-sub"> Art Director </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-danger">3</span>
                                                    </div>
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar4.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Deon Hubert</h4>
                                                        <div class="media-heading-sub"> CTO </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar2.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Ella Wong</h4>
                                                        <div class="media-heading-sub"> CEO </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <h3 class="list-heading">Customers</h3>
                                            <ul class="media-list list-items">
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-warning">2</span>
                                                    </div>
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar6.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Lara Kunis</h4>
                                                        <div class="media-heading-sub"> CEO, Loop Inc </div>
                                                        <div class="media-heading-small"> Last seen 03:10 AM </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="label label-sm label-success">new</span>
                                                    </div>
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar7.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Ernie Kyllonen</h4>
                                                        <div class="media-heading-sub"> Project Manager,
                                                            <br> SmartBizz PTL </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar8.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Lisa Stone</h4>
                                                        <div class="media-heading-sub"> CTO, Keort Inc </div>
                                                        <div class="media-heading-small"> Last seen 13:10 PM </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-success">7</span>
                                                    </div>
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar9.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Deon Portalatin</h4>
                                                        <div class="media-heading-sub"> CFO, H&D LTD </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar10.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Irina Savikova</h4>
                                                        <div class="media-heading-sub"> CEO, Tizda Motors Inc </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-danger">4</span>
                                                    </div>
                                                    <img class="media-object" src="<?php echo base_url();?>assets/layouts/layout/img/avatar11.jpg" alt="...">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Maria Gomez</h4>
                                                        <div class="media-heading-sub"> Manager, Infomatic Inc </div>
                                                        <div class="media-heading-small"> Last seen 03:10 AM </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="page-quick-sidebar-item">
                                            <div class="page-quick-sidebar-chat-user">
                                                <div class="page-quick-sidebar-nav">
                                                    <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                                        <i class="icon-arrow-left"></i>Back</a>
                                                </div>
                                                <div class="page-quick-sidebar-chat-user-messages">
                                                    <div class="post out">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Bob Nilson</a>
                                                            <span class="datetime">20:15</span>
                                                            <span class="body"> When could you send me the report ? </span>
                                                        </div>
                                                    </div>
                                                    <div class="post in">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar2.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Ella Wong</a>
                                                            <span class="datetime">20:15</span>
                                                            <span class="body"> Its almost done. I will be sending it shortly </span>
                                                        </div>
                                                    </div>
                                                    <div class="post out">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Bob Nilson</a>
                                                            <span class="datetime">20:15</span>
                                                            <span class="body"> Alright. Thanks! :) </span>
                                                        </div>
                                                    </div>
                                                    <div class="post in">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar2.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Ella Wong</a>
                                                            <span class="datetime">20:16</span>
                                                            <span class="body"> You are most welcome. Sorry for the delay. </span>
                                                        </div>
                                                    </div>
                                                    <div class="post out">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Bob Nilson</a>
                                                            <span class="datetime">20:17</span>
                                                            <span class="body"> No probs. Just take your time :) </span>
                                                        </div>
                                                    </div>
                                                    <div class="post in">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar2.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Ella Wong</a>
                                                            <span class="datetime">20:40</span>
                                                            <span class="body"> Alright. I just emailed it to you. </span>
                                                        </div>
                                                    </div>
                                                    <div class="post out">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Bob Nilson</a>
                                                            <span class="datetime">20:17</span>
                                                            <span class="body"> Great! Thanks. Will check it right away. </span>
                                                        </div>
                                                    </div>
                                                    <div class="post in">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar2.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Ella Wong</a>
                                                            <span class="datetime">20:40</span>
                                                            <span class="body"> Please let me know if you have any comment. </span>
                                                        </div>
                                                    </div>
                                                    <div class="post out">
                                                        <img class="avatar" alt="" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3.jpg" />
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:;" class="name">Bob Nilson</a>
                                                            <span class="datetime">20:17</span>
                                                            <span class="body"> Sure. I will check and buzz you if anything needs to be corrected. </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="page-quick-sidebar-chat-user-form">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Type a message here...">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green">
                                                                <i class="icon-paper-clip"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                                        <div class="page-quick-sidebar-alerts-list">
                                            <h3 class="list-heading">General</h3>
                                            <ul class="feeds list-items">
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-check"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> You have 4 pending tasks.
                                                                    <span class="label label-sm label-warning "> Take action
                                                                        <i class="fa fa-share"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-success">
                                                                        <i class="fa fa-bar-chart-o"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> Finance Report for year 2013 has been released. </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 20 mins </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-danger">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 24 mins </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received with
                                                                    <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 30 mins </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 24 mins </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> Web server hardware needs to be upgraded.
                                                                    <span class="label label-sm label-warning"> Overdue </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 2 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-default">
                                                                        <i class="fa fa-briefcase"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> IPO Report for year 2013 has been released. </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 20 mins </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                            <h3 class="list-heading">System</h3>
                                            <ul class="feeds list-items">
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-check"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> You have 4 pending tasks.
                                                                    <span class="label label-sm label-warning "> Take action
                                                                        <i class="fa fa-share"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-danger">
                                                                        <i class="fa fa-bar-chart-o"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> Finance Report for year 2013 has been released. </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 20 mins </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-default">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 24 mins </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received with
                                                                    <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 30 mins </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 24 mins </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-warning">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> Web server hardware needs to be upgraded.
                                                                    <span class="label label-sm label-default "> Overdue </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 2 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-info">
                                                                        <i class="fa fa-briefcase"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> IPO Report for year 2013 has been released. </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 20 mins </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                                        <div class="page-quick-sidebar-settings-list">
                                            <h3 class="list-heading">General Settings</h3>
                                            <ul class="list-items borderless">
                                                <li> Enable Notifications
                                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                                <li> Allow Tracking
                                                    <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                                <li> Log Errors
                                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                                <li> Auto Sumbit Issues
                                                    <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                                <li> Enable SMS Alerts
                                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                            </ul>
                                            <h3 class="list-heading">System Settings</h3>
                                            <ul class="list-items borderless">
                                                <li> Security Level
                                                    <select class="form-control input-inline input-sm input-small">
                                                        <option value="1">Normal</option>
                                                        <option value="2" selected>Medium</option>
                                                        <option value="e">High</option>
                                                    </select>
                                                </li>
                                                <li> Failed Email Attempts
                                                    <input class="form-control input-inline input-sm input-small" value="5" /> </li>
                                                <li> Secondary SMTP Port
                                                    <input class="form-control input-inline input-sm input-small" value="3560" /> </li>
                                                <li> Notify On System Error
                                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                                <li> Notify On SMTP Error
                                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                                            </ul>
                                            <div class="inner-content">
                                                <button class="btn btn-success">
                                                    <i class="icon-settings"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END QUICK SIDEBAR -->
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <?php $this->load->view("includes/footer.php");?>
        </div>
        <!-- BEGIN QUICK NAV -->
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url();?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>