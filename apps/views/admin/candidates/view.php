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
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                    <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="<?php echo base_url(); ?>admin/candidates/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
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
							 echo form_open(base_url().'admin/candidates/view', $attributes);
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
                                <div class="col-md-2">
                                 <label>Bank</label>
                                <?php
                                 $fields = array('is_active'=>'1');
                                 $bank_array = gettabledropdown('banks',$fields,'bank_id','bank_name','bank_name','ASC');
                                 $selected = ($this->input->post('bank_id')) ? $this->input->post('bank_id') : $bank_id;
                                 echo form_dropdown('bank_id', $bank_array,  $selected,'id="bank_id" class="form-control select2" ');
                                ?>
                                </div> 

                                <div class="col-md-3">
                                 <label>Employer name</label>
                                <?php
                                 $employer_name_array =$this->candidates_model->get_employers_name();
                                 $selected = ($this->input->post('employer_name')) ? $this->input->post('employer_name') : $employer_name;
                                 echo form_dropdown('employer_name', $employer_name_array,  $selected,'id="employer_name" class="form-control select2" ');
                                ?>
                                </div> 
                                    
                                <div class="col-md-5">
                                 <label>Search by Candidate Id, Contact Number, Candidate name, Bank account no.</label>
                                <?php
                                 $candidates_array = get_candidates_dropdown('0');
                                 $selected = ($this->input->post('candidate_id')) ? $this->input->post('candidate_id') : $candidate_id;
                                 echo form_dropdown('candidate_id', $candidates_array,  $selected,'id="candidate_id" class="form-control select2" ');
                                ?>
                                </div>     
                                   
                                
                               <div class="col-md-2">
                                    <label class="control-label"> </label>
                                    <div class="margin-top-10"><button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button></div>
                               </div>
                       
                             
                            </div>  
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
                        <div class="table-responsive"  style="font-size:11px !important;">
                              <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                  
                                    <tr>
                                    <th> Srno. </th>
                                    <th nowrap>Bank account no.</th>
                                    <th> Account holder name </th>
                                    <th nowrap> Pay Slips</th>
                                    <th nowrap> Bank Transaction</th>
                                    <th> Father name</th>
                                    <th> Bank  name</th>
                                    <th> Acc. Opening Date</th>
                                    <th>Employer  Name</th>    
                                    <th>IFSC code</th>
                                    <th>Bank Branch name</th>
                                    <th>Date Of Birth</th>
                                    <th> Branch Code</th>
                                    <th>Contact No.</th>
                                    <th>Photo</th>
                                    <th>MIRC Code</th>
                                    <th> Status</th>
                                    <th> Created On</th>
                                    <th>Action</th>        
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php 
									  if(is_array($results))
									  {  
									     $srno = $this->uri->segment(10)? ( $this->uri->segment(10) + $this->uri->segment(11)? $this->uri->segment(11):0 ):0;
										 if($srno=='')
										 $srno=0;
										 else
										 $srno=$srno;
										
		 								 foreach($results as $row) {
										 $srno++;
										
										  
										 if($row->acc_opening_date=='0000-00-00')
										  $acc_opening_date='';
										  else
										  $acc_opening_date = date("M d, Y",strtotime($row->acc_opening_date));
                                             
                                          if($row->date_of_birth=='0000-00-00')
										  $date_of_birth='';
										  else
										  $date_of_birth = date("M d, Y",strtotime($row->date_of_birth));
                             			  ?>   
                                 <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->bank_account_no; ?></td>
                                    <td><?php echo $row->acc_holder_name; ?></td>
                                    <td nowrap>
                                      <a href="<?php echo base_url();?>admin/payslips/view/<?php echo $row->candidate_id; ?>" title="View payslips"> <span class="label label-sm label-success">view [<?php echo $row->total_payslips; ?>] </span> </a>
                                      </td>
                                    <td>
                                      <a href="<?php echo base_url();?>admin/transactions/add/<?php echo $row->candidate_id; ?>" title="New Transaction"> <span class="label label-sm label-success">new </span> </a>
                                       <a href="<?php echo base_url();?>admin/transactions/view/<?php echo $row->candidate_id; ?>" title="View Candidates"> <span class="label label-sm label-success">view [<?php echo $row->total_transactions; ?>] </span> </a>
                                      
                        		     <center><a class="label label-sm label-success get_data_id" data-id="<?php echo $row->candidate_id; ?>" data-toggle="modal" href="#responsive"><i class="fa fa-print"></i></a></center>
                                      </td>
                                     
                                    <td><?php echo $row->father_name ; ?></td>
                                    <td><?php echo $row->bank_name ; ?></td>
                                    <td><?php echo $acc_opening_date ; ?></td>
                                    <td><?php echo $row->employer_name; ?></td>
                                    <td><?php echo $row->ifsc_code; ?></td>
                                    <td><?php echo $row->bank_branch_name; ?></td>
                                    <td><?php echo $date_of_birth; ?></td>
                                    <td><?php echo $row->branch_code; ?></td>
                                    <td><?php echo $row->contact_number; ?></td>
                                    <td> <?php 
                                        $user_photo = $row->candidate_photo;
                                         if($user_photo!='')
                                               $photo    ='<img src="'.base_url().'assets/static/photos/'.$user_photo.'" class="profile-image" width="100"> ';
                                         else	{
                                             
                                                $photo ='<img src="'.base_url().'assets/img/image-not-available.jpg" class="profile-image" width="100"> ';
                                           }				 
                                          if(isset($photo)) echo $photo;
                                           ?></td>
                                   <td><?php echo $row->mirc_code; ?></td>
                                    <td><?php if($row->is_active=='1') {?><a class="label label-sm label-success" onclick="return confirm('Do you want to de-activate this Candidate account ?');" href="<?php echo base_url();?>admin/candidates/status/<?php echo $row->candidate_id; ?>/0"><?php echo  'Active'; ?></a><?php }
                                     else { ?><a class="label label-sm label-danger" onclick="return confirm('Do you want to activate this Candidate account ?');" href="<?php echo base_url();?>admin/candidates/status/<?php echo $row->candidate_id; ?>/1"><?php echo 'De-Active';?> </a> <?php } ?></td>
                                    <td><?php echo date('d M, Y',strtotime($row->created_on));?></td>
                                    <td><a href="<?php echo base_url();?>admin/candidates/edit/<?php echo $row->candidate_id; ?>" title="Edit"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                     <?php 
									  } 
									} ?>
                                </tbody>
                            </table>
                            <div align="center"><?php if(isset($links)): echo  $links; endif; ?></div>
                        
                            
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
      
<!-- responsive -->

    
    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Get Bank Statement</h4>
        </div>
        <div class="modal-body">
            <?php  $attributes = array('id' => 'form3','name' => 'form3','class' => 'form-horizontal1','role' => 'form','autocomplete' => 'off');
             echo form_open(base_url().'admin/transactions/statement', $attributes);
             echo form_hidden('fs', '1');
          ?>
        <input type="hidden" name="cand_id" id="cand_id" value="">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Start date<span class="required"> * </span></label>
                    <div class="input-group date" data-date-format="yyyy-mm-dd">
                         <?php $data = array(
                              'name'        => 'start_date',
                              'id'          => 'start_date',
                              'value'       => set_value('start_date'),
                              'maxlength'   => '15',
                               'redonly'  => true,
                              'class'   => 'form-control',
                              'placeholder'   => 'YYYY-MM-DD',
                              'required'   => 'required',
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

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">End date<span class="required"> * </span></label>
                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                         <?php $data = array(
                              'name'        => 'end_date',
                              'id'          => 'end_date',
                              'value'       => set_value('end_date'),
                              'maxlength'   => '15',
                              'redonly'  => true,
                              'class'   => 'form-control',
                              'placeholder'   => 'YYYY-MM-DD',
                              'required'   => 'required',
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
                <div class="col-md-9" align="right">
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn green">&nbsp;&nbsp;&nbsp;
                    <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                </div>
            </div>    
            
            
           <?php echo form_close(); ?>    
            
        </div>
      <!--  <div class="modal-footer">
            <input type="submit" name="submit" id="submit" value="Submit" class="btn green">
            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
        </div>-->
    </div>
    
 
  
    
      
  <?php $this->load->view("includes/footer.php");?>
</div>

    

    
    
<?php $this->load->view("includes/scripts.php");?>
 <script src="<?php echo base_url();?>assets/pages/scripts/components-select2.min.js" type="text/javascript">
 <script src="<?php echo base_url();?>assets/pages/js/custom.js" type="text/javascript"></script>    
        <!-- END THEME LAYOUT SCRIPTS -->
<!-- END CUSTOM SCRIPTS --> 
<script>
    $(".get_data_id").on('click', function() {
        //alert($(this).attr("data-id"));
         //"#candidate_id").val("");
          $("#cand_id").val($(this).attr("data-id"));
        // alert($("#cand_id").val());
        
});
    
		$('#start_date').datepicker({
		changeMonth: true,startDate: '-3y',endDate: '0',
        format: 'yyyy-mm-dd',
		 autoclose: true,
  		 }).on('changeDate', function(e) {
		  var date2 = $('#start_date').datepicker('getDate', '+30d'); 
		  date2.setDate(date2.getDate()+120); 
		  //alert(date2);
		  $('#end_date').datepicker('setDate', date2);
 		});
	
		$("#end_date").datepicker({
		 format: 'yyyy-mm-dd',
		  autoclose: true,
		 }).on('changeDate', function(e) {
		}); 

	</script>
    
    
</body>
</html>