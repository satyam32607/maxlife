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
<link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
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
                    <?php $this->load->view("includes/notifications.php");?>
                      <!-- BEGIN FILTER TABLE-->
                         <?php  $attributes = array('id' => 'form1','name' => 'form1','class' => 'form-horizontal','role' => 'form','autocomplete' => 'off');
							 echo form_open(base_url().'admin/admin/view_users', $attributes);
				          ?>
                        <!--<div class="portlet box blue-hoki">  
                        	<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-search"></i>Search </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand"> </a>
                                </div>
                            </div>
                        	<div class="portlet-body portlet-collapsed">
                            	<div class="row">
                                <!--<div class="col-md-2">
                                    <label>Designation</label>
                                        <?php
                                            $fields = array('is_active'=>'1','group_id'=>$this->session->userdata('group_id'));
                                            $designation_array = gettabledropdown('designation',$fields,'designation_id','designation_name','designation_name','ASC');
                                            $selected = ($this->input->post('designation_id')) ? $this->input->post('designation_id') : $this->input->post('designation_id');
                                            echo form_dropdown('designation_id', $designation_array,  $selected,'id="designation_id" class="form-control form-filter input-sm"  ');
                                         ?>
                                </div>
                                <div class="col-md-2">
                                    <label>Role</label>
                                         <?php
                                            $fields = array('is_active'=>'1','group_id'=>$this->session->userdata('group_id'));
                                            $role_array = gettabledropdown('roles',$fields,'role_id','role_name','role_name','ASC');
                                            $selected = ($this->input->post('role_id')) ? $this->input->post('role_id') : $this->input->post('role_id');
                                            echo form_dropdown('role_id', $role_array,  $selected,'id="role_id" class="form-control form-filter input-sm" ');
                                           ?> 
                                </div>
                                <div class="col-md-2">
                                    <label>Status</label>
                                          <?php
                                            $user_status_array = userstatusarray();
                                            $selected = ($this->input->post('status')) ? $this->input->post('status') : $this->input->post('status');
                                            echo form_dropdown('status', $user_status_array,  $selected,'id="status" class="form-control form-filter input-sm"');
                                            ?>
                                </div>
                                <div class="col-md-2">
                                    <label>Search by</label>
                                            <?php
                                            $search_by_array = search_by_array();
                                            $selected = ($this->input->post('search_by')) ? $this->input->post('search_by') : $this->input->post('search_by');
                                            echo form_dropdown('search_by', $search_by_array,  $selected,'id="search_by" class="form-control form-filter input-sm"');
                                            ?>
                                </div>
                                <div class="col-md-2">
                                    <label>Search value</label>
                                           <?php $data = array(
                                              'name'        => 'search_value',
                                              'id'          => 'search_value',	
                                              'value'       => set_value('search_value'),									
                                              'maxlength'   => '80',
                                              'placeholder'   => 'Enter search value',
                                              'class'   => 'form-control form-filter input-sm',
                                              );
                                            echo form_input($data);
                                            ?>
                                </div>
                                <div class="col-md-2">
                                    <label>Perpage</label>
                                            <?php
                                             $per_page_records = per_page_records();
                                             $selected = ($this->input->post('per_page')) ? $this->input->post('per_page') : $this->input->post('per_page');
                                             echo form_dropdown('per_page', $per_page_records,  $selected,'id="per_page" onChange="document.form1.submit();" class="form-control form-filter input-sm"');
                                            ?>
                                </div>-->
                            
                             <!--</div>  
                            	<div class="margin-top-10"><button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button></div>
                            </div>
                        </div>-->
                          <?php echo form_close(); ?>
                          <!-- END FILTER TABLE-->    
                    
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                    </div>
                                        
    
                     <!-- BEGIN TABLE PORTLET-->
                    <div class="portlet-body">
                        <div class="table-responsive">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                                    <th> Srno. </th>
                                    <th> Name</th>
                                    <th> Primary Email</th>
                                    <th> Urn No</th>
                                    <th> Date of Birth</th>
                                    <th> Gender</th>
                                    <th> Location</th>
                                    <th> Zone</th>
                                    <th>State</th>
                                    <th>Mobile no</th>
                                    <th> Created By</th>
                                    <th> Reg date</th>
                                    <th> Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
										 $gender_array = gender_array();
		 
										 foreach($results as $row) {
										 $srno++;
										 
										 if($row->gender!='')
										 $gender = $gender_array[$row->gender]; 
										 else
										 $gender='';
										  
										 if($row->date_of_birth=='0000-00-00')
										  $date_of_birth='';
										  else
										  $date_of_birth = date("M d, Y",strtotime($row->date_of_birth));
										
										  $postuserrow = get_table_info('users','user_id',$row->created_by);
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->urn_no ; ?></td>
                                    <td><?php echo $date_of_birth; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $row->location_name; ?></td>
                                    <td><?php echo $row->zone_name; ?></td>
                                    <td><?php echo $row->city_name; ?></td>
                                    <td><?php echo $row->mobile_no1; ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->reg_date));?></td>
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this User account ?');" href="<?php echo base_url();?>admin/users/status/<?php echo $row->user_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this User account ?');" href="<?php echo base_url();?>admin/users/status/<?php echo $row->user_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    </tr>
                                     <?php 
									  } 
									} ?>
                                </tbody>
                            </table>
                            <div align="center"><?php if(isset($links)): echo  $links; endif; ?></div>
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