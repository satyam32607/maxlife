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
                    <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="#"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                    <li> <span><?php echo $heading; ?></span> </li>
                  </ul>
                </div>
                <div class="col-md-4"><a href="<?php echo base_url();?>admin/categories/add" class="btn btn-circle btn-success pull-right"> <i class="fa fa-plus"></i><span class="hidden-xs"> Add Category</span> </a></div>
                
              </div>
              
              <!-- END PAGE BREADCRUMBS --> 
              <!-- BEGIN PAGE CONTENT INNER -->
              <div class="page-content-inner">
                <div class="row">
                  <div class="col-md-12">
                    <?php $this->load->view("includes/notifications.php");?>
                    
                         <?php  $attributes = array('id' => 'form1','name' => 'form1','class' => 'form-horizontal','role' => 'form','autocomplete' => 'off');
							 echo form_open(base_url().'admin/categories/view', $attributes);
				          ?>
                        <div class="portlet box blue-hoki">  
                        	<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-search"></i>Search </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand"> </a>
                                </div>
                            </div>
                        	<div class="portlet-body portlet-expand">
                            	<div class="row">
                             
                               <div class="col-md-4">
                                    <label class="control-label"> </label>
									<div class="margin-top-10"><button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button></div>
                               </div>
                             
                            </div>  
                            </div>
                        </div>
                          <?php echo form_close(); ?>
                          <!-- END FILTER TABLE--> 
                          
                    <!-- BEGIN TABLE PORTLET-->
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-o"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                                    <th> Srno. </th>
									<th> Category Type</th>
									<th>Company</th>
                                    <th> Category name</th>
									<th>Player Limit</th>
                                    <th> Weight</th>
                                    <th> Created By</th>
                                    <th> Created date</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
									     $category_array =  $this->category_model->get_categories_list('0','1','0');
									     foreach($results as $row) {
										 $srno++;
										 
										 if($row->category_id!='0')
										 $category_name =  $category_array[$row->category_id];	
										 else
										 $category_name='';
										 
										 $postuserrow = get_table_info('users','user_id',$row->created_by);
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
									<td><?php echo $row->category_type_name; ?></td>
									<td><?php echo $row->company_name; ?></td>
                                    <td><?php echo $category_name; ?></td>
									<td><?php echo $row->player_limit; ?></td>
                                    <td><?php echo $row->weight; ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this Category ?');" href="<?php echo base_url();?>admin/categories/status/<?php echo $row->category_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this Category ?');" href="<?php echo base_url();?>admin/categories/status/<?php echo $row->category_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                     <td><a href="<?php echo base_url();?>admin/categories/edit/<?php echo $row->category_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
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