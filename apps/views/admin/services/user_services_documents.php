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
                    <!-- <li> <a href="<?php echo base_url(); ?>">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="<?php echo base_url();?>admin/companies/view_vendors/<?php echo $company->user_id; ?>"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                    <li> <span><?php echo $partner->name; ?></span> </li> -->
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
                            <!-- <i class="fa fa-user"></i> <?php echo $partner->name; ?>: <?php echo '('.$total_rows.')'; ?></div> -->
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-condensed flip-content">
                                <thead>
                                    <tr>
										<th> Srno. </th>
										<th> Document Name </th>
										<th> Document File</th>
										<th> Remarks</th>
										<th> Action</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php
									  if(is_array($results))
									  {  $srno=0; 
										 foreach($results as $row) {
                      if($row->document_name1=="" || !empty($row->document_name1))
                      {
                        continue;
                      }
										 $srno++;
										  
										
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->document_name1; ?></td>
                                    <td><a target="_blank" href="<?php echo base_url()."assets/static/2/partners/$partner_id/$row->document_file_name1" ?>"><i class="fa fa-eye"></i></a></td>
                                    <td class="remarks"><textarea style="color: black;" id="" cols="8" rows="3"><?php echo $row->remarks ?></textarea></td>
                                    <td>
                                        <?php if($row->doc_status!="P" && !empty($row->doc_status)){ ?>
                                            <span> <?php echo $row->doc_status=="A" ? "Approved" : "Not Approved" ?> </span>
                                            <?php } else{ ?>
                                            <span style="cursor: pointer;" onclick="submitResponse(this,'<?php echo  $row->service_document_id ?>','A')"><i class="fa fa-check"></i></span>
                                            &nbsp; &nbsp;
                                            <span style="cursor: pointer;" onclick="submitResponse(this,'<?php echo  $row->service_document_id ?>','N')"><i class="fa fa-times"></i></span>    
                                        <?php } ?>    
                                    </td>
                                    </tr>
                                     <?php 
									  } 
									} ?>
                                </tbody>
                            </table>
                            <form action="<?php echo base_url() . 'admin/companies/partner_service_document_action' ?>" id="action-form" method="get">
                                <input type="hidden" name="document_id" id="document_id">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="remarks" id="remarks">
                            </form>
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
<script>
    function submitResponse(elementObject,serviceId,action)
    {
       var remarks= $(elementObject).parent("td").siblings("td.remarks").find("textarea").val();
        if(remarks=="")
        {
            alert("remarks required");
        }
        else
        {
            $("#document_id").val(serviceId);
            $("#action").val(action);
            $("#remarks").val(remarks);
            $("#action-form").submit();
        }
    }
</script>
</body>
</html>