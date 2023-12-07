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
                    <li> <a href="<?php echo base_url(); ?>">Home</a> <i class="fa fa-circle"></i> </li>
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
                      <!-- BEGIN FILTER TABLE-->
                         <?php  $attributes = array('id' => 'form1','name' => 'form1','class' => 'form-horizontal','role' => 'form','autocomplete' => 'off');
							 echo form_open(base_url().'admin/companies/users', $attributes);
							 echo form_hidden('company_id', $company_id);
				          ?>
                        <div class="portlet box blue-hoki">  
                        	<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-search"></i>Search </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand"> </a>
                                </div>
                            </div>
                        	<div class="portlet-body portlet-collapsed">
                            	<div class="row">
                                <div class="col-md-2">
                                    <label>Designation</label>
                                        <?php
                                            $fields = array('is_active'=>'1','user_id'=>$company_id);
                                            $designation_array = gettabledropdown('designation',$fields,'designation_id','designation_name','designation_name','ASC');
                                            $selected = ($this->input->post('designation_id')) ? $this->input->post('designation_id') : $this->input->post('designation_id');
                                            echo form_dropdown('designation_id', $designation_array,  $selected,'id="designation_id" class="form-control form-filter input-sm"  ');
                                         ?>
                                </div>
                                <div class="col-md-2">
                                    <label>Role</label>
                                         <?php
                                            $fields = array('is_active'=>'1','user_id'=>$company_id);
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
                                </div>
                            
                            </div>  
                            	<div class="margin-top-10"><button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button></div>
                            </div>
                        </div>
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
                                    <th> Primary Email</th>
                                    <th> Name</th>
                                    <th> Designation</th>
                                    <th> Role</th>
                                    <th> Code</th>
                                    <th> Mobile no1.</th>
                                    <th> Gender</th>
                                    <th> DOB</th>
                                    <th> DOJ</th>
                                   <!-- <th> Country/State/City</th>
                                    <th> Pincode </th>
                                    <th> Address </th>-->
                                    <th> Valid Upto</th>
                                    <th> Created By</th>
                                    <th> Reg date</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                    <th> Shadow</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  $srno=0; 
										 $gender_array = gender_array();
		 
										 foreach($results as $row) {
										 $srno++;
										 
										 $gender = $gender_array[$row->gender]; 
										  
										  if($row->date_of_birth=='0000-00-00')
										  $date_of_birth='';
										  else
										  $date_of_birth = date("M d, Y",strtotime($row->date_of_birth));
											
											
										  if($row->date_of_joining=='0000-00-00')
										  $date_of_joining='';
										  else
										  $date_of_joining = date("M d, Y",strtotime($row->date_of_joining));
										  
										  if($row->expiry_date=='0000-00-00')
										  $expiry_date='';
										  else
										  $expiry_date = date("M d, Y",strtotime($row->expiry_date));
						 					 
										  if($row->country_id!='0')
										  {
										   $countryrow = get_table_info('country','country_id',$row->country_id);
										   $country_name= $countryrow->country_name;
										  }
										  else
										  {  $country_name='';
										  }
										 
										  if($row->state_id!='0')
										  {
										   $staterow = get_table_info('state','state_id',$row->state_id);
										   $state_name = '/'.$staterow->state_name;
										  }
										  else
										  {  $state_name='';
										  }
										  
										  if($row->city_id!='0')
										  {
										   $cityrow = get_table_info('city','city_id',$row->city_id);
										   $city_name= '/'.$cityrow->city_name;
										  }
										  else
										  {  $city_name='';
										  }
										  
										  $rolerow = get_table_info('roles','role_id',$row->role_id);
										  $desigrow = get_table_info('designation','designation_id',$row->designation_id);
										  $postuserrow = get_table_info('users','user_id',$row->post_user_id);
									  ?>    
                                    <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                    <td><?php echo $desigrow->designation_name; ?></td>
                                    <td><?php echo $rolerow->role_name; ?></td>
                                    <td><?php echo $row->country_code; ?></td>
                                    <td><?php echo $row->mobile_no1; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $date_of_birth; ?></td>
                                    <td><?php echo $date_of_joining; ?></td>
                                   <!-- <td><?php echo $country_name.$state_name.$city_name; ?></td>  
                                     <td><?php echo $row->pin_code; ?></td>
                                    <td><?php echo $row->address; ?></td>-->
                                    <td><?php echo $expiry_date; ?></td>
                                    <td><?php echo $postuserrow->first_name.' '.$postuserrow->last_name; ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->reg_date));?></td>
                                    <td><?php if($row->is_active=='1') {?><span class="label label-sm label-success"><?php echo  'Active'; ?></span><?php }
                                     else { ?><span class="label label-sm label-danger"><?php echo 'De-Active';?> </span> <?php } ?></td>
                                    <td><a href="<?php echo base_url();?>profile/<?php echo $row->user_id; ?>"><i class="fa fa-search"></i></a></td>                                                   
                                      <td><a href="<?php echo base_url();?>admin/dashboard/login_as_shadow/<?php echo $row->user_id; ?>">Shadow</a></td>
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