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
         <link href="<?php echo base_url(); ?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
          <style type="text/css">
		.portlet > .portlet-title{margin-bottom: 5px;min-height: 10px !important;}
		.portlet.light > .portlet-title > .actions {
	     padding: 0px 0 8px;
		}
		.table-scrollable {margin: 0 0 !important;}
		
		</style>
          </head>
    <!-- END HEAD -->

    <div class="page-container-bg-solid page-header-menu-fixed">
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
                                        <h1>Dashboard
                                            <small>dashboard</small>
                                        </h1>
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
                                            <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                       
                                        <li>
                                            <span><?php echo $heading; ?></span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                      <div class="profile-content">
                                      
                                      <div class="row" style="height:300px;"></div>
                                        <div class="row">
                                            <div class="col-md-8">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <!-- BEGIN PORTLET -->
                                                <!--<div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption caption-md">
                                                            <i class="icon-bar-chart theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Campaign Report </span>
                                                            <span class="caption-helper hide">Yearly stats...</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                    	<div class="row">
                                                       <div class="col-md-12">
                                                        <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                        <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr class="uppercase">
                                                                        <th> Created Date </th>
                                                                        <th> Total </th>
                                                                        <th>Link Report </th>
                                                                    </tr>
                                                                </thead>
                                                               <?php 
															  $total_cand=0; 
															  if(is_array($campaigns_results))
															  {
																 foreach($campaigns_results as $camprow) {
																 $total_cand = $total_cand+$camprow->total_candidates;
																 ?>		 
                                                                <tr>
                                                                    <td> <?php echo date("M d, Y",strtotime($camprow->start_date)); ?></td>
                                                                    <td><a href="<?php echo base_url();?>admin/reports/campaign_date_wise/0/<?php echo $camprow->start_date; ?>/<?php echo $camprow->start_date; ?>"><span class="bold theme-font">[<?php echo $camprow->total_candidates; ?>]</span></a> </td>
                                                                    <td><a href="<?php echo base_url();?>admin/reports/campaign_link_date_wise/0/<?php echo $camprow->start_date; ?>/<?php echo $camprow->start_date; ?>"><span class="bold theme-font">[<?php echo $camprow->total_candidates; ?>]</span></a> </td>
                                                                </tr>
                                                                <?php
																	}
																   }
                                                                  if($total_cand!=0)
                                                                   {
                                                                  ?>
                                                                  <tr>
                                                                  <th>Total</th>
                                                                  <th><a href="<?php echo base_url();?>admin/reports/campaign_date_wise/">[<?php echo $total_cand; ?>]</a></th>
                                                                  <th><a href="<?php echo base_url();?>admin/reports/campaign_link_date_wise/">[<?php echo $total_cand; ?>]</a></th>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                            
                                                            </div>
                                                        </div>
                                                            </div>
                                                           
                                                        </div>
                                                      
                                                    </div>
                                                </div>-->
                                                <!-- END PORTLET -->
                                                </div>
                                                
                                            <!--<div class="col-md-6">
                                                <!-- BEGIN PORTLET -->
                                                <!--<div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption caption-md">
                                                            <i class="icon-bar-chart theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Candidates Consent Updation Report </span>
                                                            <span class="caption-helper hide">Yearly stats...</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                      <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                        <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr class="uppercase">
                                                                        <th> Date </th>
                                                                        <th> Total </th>
                                                                    </tr>
                                                                </thead>
                                                               <?php 
															  $total_consent=0; 
															  if(is_array($cand_consent_results))
															  {
																 foreach($cand_consent_results as $consentrow) {
																 $total_consent = $total_consent+$consentrow->total;
																 ?>		 
                                                                <tr>
                                                                    <td> <?php echo date("M d, Y",strtotime($consentrow->dt)); ?></td>
                                                                    <td><a href="<?php echo base_url();?>admin/reports/consent_candidates_date_wise/<?php echo $consentrow->dt; ?>/<?php echo $consentrow->dt; ?>"><span class="bold theme-font">[<?php echo $consentrow->total; ?>]</span></a> </td>
                                                                </tr>
                                                                <?php
																	}
																   }
                                                                  if($total_consent!=0)
                                                                   {
                                                                  ?>
                                                                  <tr>
                                                                  <th>Total</th>
                                                                  <th>[<?php echo $total_consent; ?>]</th>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <!-- END PORTLET -->
                                                <!---->
                                                
                                                
                                                <!--<div class="col-md-6">
                                                <!-- BEGIN PORTLET -->
                                                 <!--<div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption caption-md">
                                                            <i class="icon-bar-chart theme-font hide"></i>
                                                            <span class="caption-subject font-blue-madison bold uppercase">Followups  Report </span>
                                                          <!--  <span class="caption-helper hide">Yearly stats...</span>-->
                                                       <!--  </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                    	<div class="row">
                                                       <div class="col-md-6">
                                                        <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                        <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr class="uppercase">
                                                                        <th> Pending </th>
                                                                        <th> Total </th>
                                                                    </tr>
                                                                </thead>
                                                               <?php 
															  $total_pendingfollowup=0; 
															  if(is_array($pendingfollowups_results))
															  {
																 foreach($pendingfollowups_results as $pfollowrow) {
																 $total_pendingfollowup = $total_pendingfollowup+$pfollowrow->total;
																 ?>		 
                                                                <tr>
                                                                    <td> <?php echo date("M d, Y",strtotime($pfollowrow->dt)); ?></td>
                                                                    <td><a href="<?php echo base_url();?>followups/all/0/<?php echo $pfollowrow->dt; ?>/<?php echo $pfollowrow->dt; ?>"><span class="bold theme-font">[<?php echo $pfollowrow->total; ?>]</span></a> </td>
                                                                </tr>
                                                                <?php
																	}
																   }
                                                                  if($total_pendingfollowup!=0)
                                                                   {
                                                                  ?>
                                                                  <tr>
                                                                  <th>Total</th>
                                                                  <th>[<?php echo $total_pendingfollowup; ?>]</th>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                            
                                                            </div>
                                                        </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                           <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                           <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr class="uppercase">
                                                                        <th> Done </th>
                                                                        <th> Total </th>
                                                                    </tr>
                                                                </thead>
                                                               <?php 
															  $total_custfollowup=0; 
															  if(is_array($custfollowups_results))
															  {
																 foreach($custfollowups_results as $custfollowrow) {
																 $total_custfollowup = $total_custfollowup+$custfollowrow->total;
																 ?>		 
                                                                <tr>
                                                                    <td> <?php echo date("M d, Y",strtotime($custfollowrow->dt)); ?></td>
                                                                    <td><a href="<?php echo base_url();?>followups/done/0/<?php echo $custfollowrow->dt; ?>/<?php echo $custfollowrow->dt; ?>"><span class="bold theme-font">[<?php echo $custfollowrow->total; ?>]</span></a> </td>
                                                                </tr>
                                                                <?php
																	}
																   }
                                                                  if($total_custfollowup!=0)
                                                                   {
                                                                  ?>
                                                                  <tr>
                                                                  <th>Total</th>
                                                                  <th>[<?php echo $total_custfollowup; ?>]</th>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                            
                                                            </div>
                                                        </div>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                                <!-- END PORTLET -->
                                                <!-- </div>-->
                                                
                                                
                                               
                                               
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                     
                                            </div>
                                            </div>
                                            
                                         
                                        </div>
                                                                                            
                                                    
                                                <!-- END PROFILE CONTENT -->
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