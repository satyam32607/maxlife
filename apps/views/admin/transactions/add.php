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
          <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
              <ul class="page-breadcrumb breadcrumb">
                <li> <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="<?php echo base_url(); ?>admin/transactions/view"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                <li> <span><?php echo $heading; ?></span> </li>
              </ul>
              <!-- END PAGE BREADCRUMBS --> 
              <!-- BEGIN PAGE CONTENT INNER -->
              <div class="page-content-inner">
                <div class="row">
                  <div class="col-md-9">
                  <?php $this->load->view("includes/notifications.php");?>
                    <div class="portlet box green">
                      <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-tree"></i><?php echo $heading; ?> </div>
                      </div>
                      <div class="portlet-body form">
                      
                        <?php  $attributes = array('id' => 'camp_form','name' => 'camp_form','class' => 'horizontal-form','role' => 'form','autocomplete' => 'off');
                   	        echo form_open_multipart(base_url().'admin/transactions/add', $attributes);
                         ?>
                        <div class="form-body">
                          <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below. </div>
                          <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            Your form validation is successful! </div>
                          <?php 
                            if((validation_errors()) || ($already_msg)):?>
                          <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span> <?php echo validation_errors(); ?><?php echo $already_msg;?></span> </div>
                          <?php endif; ?>
                          
                            <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Candidate name <span class="required"> * </span></label>
                                <?php
							                   $candidates_array = get_candidates_dropdown('0');
                                 $selected = ($this->input->post('candidate_id')) ? $this->input->post('candidate_id') : $candidate_id;
                                 echo form_dropdown('candidate_id', $candidates_array,  $selected,'id="candidate_id" class="form-control select2" required ');
                                ?>
                               </div>
                            </div>
                            
                          </div>
                          <!--/row-->
                            
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Payment amount <span class="required"> * </span></label>
                                <?php
								    $data = array(
									  'name'        => 'payment_amount',
									  'id'          => 'payment_amount',	
									  'value'       => set_value('payment_amount') ? $this->input->post("payment_amount") : $this->input->post("payment_amount"),			
									  'maxlength'   => '10',
									  'class'   => 'form-control',
									  'required'   => 'required',
									  );
								   echo form_input($data);
								   echo form_error('payment_amount');
								  ?>
                              </div>
                            </div>
                            
                              
                              <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Payment status <span class="required"> * </span></label>
                                <?php
							     $payment_status_array = payment_status_array();
                                 $selected = ($this->input->post('payment_status')) ? $this->input->post('payment_status') : $this->input->post('payment_status');
                                 echo form_dropdown('payment_status', $payment_status_array,  $selected,'id="payment_status" class="form-control" required ');
                                ?>
						   </div>
                            </div>
                              
                              
                            
                          </div>
                          <!--/row-->
                          
                          
                          <div class="row">
                     
                           <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Transaction Date & Time <span class="required"> * </span></label>
                                <div class="input-group date transactiondatetime bs-datetime">
                                        <input  name="transaction_date" id="transaction_date" class="form-control" size="16" type="text" value="" readonly>
                                        <span class="input-group-addon">
                                            <button class="btn default date-reset" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>
                                        <span class="input-group-addon">
                                            <button class="btn default date-set" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                </div>
                              </div>
                            </div>
                            
                     
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Payment mode <span class="required"> * </span></label>
                                 <select name="payment_mode" id="payment_mode"  class="form-control" required>
                                              <option value="" selected="selected">Select </option>
                                            </select>     
                                            <?php  echo form_error('payment_mode'); ?>
                             </div>
                            </div>
                            
                          </div>
                          <!--/row-->`
                            
                            
                        <div class="row" id="joining_fee_id" style="display:none;">
                     
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Joining Fee </label>
                                 <div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="joining_fee" name="joining_fee" <?php if($this->input->post("joining_fee") && ($this->input->post("joining_fee")=='1')) { echo 'checked="checked"'; } ?> value="1" class="md-check">
                                        <label for="joining_fee">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> </label>
                                    </div>
                                </div>
                                
                             </div>
                            </div>


                            <div class="col-md-6">
                            <div class="form-group">
                                    <label>Interest Type</label>
                                    <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                            <input type="radio" name="interest_month" id="interest_month" value="none" checked> None Interest
                                            <span></span>
                                        </label>

                                        <label class="mt-radio">
                                            <input type="radio" name="interest_month" id="interest_month" value="mar"> March Interest
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="interest_month" id="interest_month" value="sep"> September Interest
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            
                          </div>
                          <!--/row-->
                            
                        
                                       
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
                        <?php $this->load->view("includes/loader.php");?>
                          
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
  <?php $this->load->view("includes/footer.php");?>
</div>
<?php $this->load->view("includes/scripts.php");?>
<!-- BEGIN CUSTOM SCRIPTS --> 
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END CUSTOM SCRIPTS --> 
<script>
    $('.transactiondatetime').datetimepicker({
	    format: 'yyyy-mm-dd hh:ii:ss',
	 	changeMonth: true,changeYear: true,startDate: '-2y',
	    autoclose: true
	});
    
 $(document).ready(function(){
		
		    $('#payment_status').bind('change', function () {
            
			var payment_status=$(this).val();
            var payment_mode=$("#payment_mode").val();  
			if(payment_status=='cr')
            $("#joining_fee_id").show();
            else
            $("#joining_fee_id").hide();    
                 
			get_payment_mode(payment_status,payment_mode);
		});
		$('#payment_status').trigger('change');
		
	});
    

    function get_payment_mode(payment_status,payment_mode){
         // alert(payment_status);
          //alert(payment_mode);
        $('#payment_mode').html('');
		$("#payment_mode").find('option').remove();
		$.get('<?php echo base_url();?>ajaxrequest/get_payment_mode/'+payment_status, function( data ) {
			var obj = jQuery.parseJSON(data);
			$('#payment_mode').append($("<option></option>").attr("value",'').text('Select'));
			$.each(obj, function(idx, obj1) {
				var title=obj1.title;
				var option_id=obj1.option_id;
				//alert(title);
				$('#payment_mode').append($("<option></option>").attr("value",option_id).text(title)); 
			});
			$('#payment_mode option[value='+option_id+']').attr("selected", "selected");
		});
	}
</script>
</body>
</html>