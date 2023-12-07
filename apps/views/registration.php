<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo isset($title) ? $title : title ; ?></title>
    <?php $this->load->view("includes/styles.php");?>
    <link class="main-stylesheet" href="<?php echo base_url();?>assets/css/register.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen">
   <script type="text/javascript">
	function openForm(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
	}
	
	function open_Form(obj, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
	//$('#'+obj+'').currentTarget.className += " active";
	if(obj=='addressfrmid'){
		$('#addressfrmid').addClass('active');
	}
	//$('#addressfrmid').currentTarget.className += " active";
	}
</script>
  </head>
  <body class="fixed-header" id="body">

    <!-- BEGIN SIDEBPANEL-->
    
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      <!-- START HEADER -->
      <div class="header outer-header">
        <!-- START MOBILE CONTROLS -->
        <!-- LEFT SIDE -->
        <div class="pull-left full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="sm-action-bar">
            <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
              <span class="icon-set menu-hambuger"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
        <!-- RIGHT SIDE -->
        <div class="pull-right full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="sm-action-bar">
            <a href="#" class="btn-link" data-toggle="quickview" data-toggle-element="#quickview">
              <span class="icon-set menu-hambuger-plus"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
        <!-- END MOBILE CONTROLS -->
        <div class=" pull-left sm-table">
          <div class="header-inner">
            <div class="brand inline">
              <img src="<?php echo base_url();?>assets/img/logo.png" alt="logo" data-src="<?php echo base_url();?>assets/img/logo.png" data-src-retina="<?php echo base_url();?>assets/img/logo_2x.png">
            </div>
            <!-- START NOTIFICATION LIST -->
          </div>
        </div>
  
      </div>
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          <!-- START CONTAINER FLUID -->
          <div class="container-fluid container-fixed-lg">
            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
              <li>
                <p class="text-white"><?php echo $main_heading; ?></p>
              </li>
              <li><a href="#" class="active"><?php echo $heading; ?></a>
              </li>
            </ul>
            <!-- END BREADCRUMB -->
          
              <div class="mainregistrationplustext">
              
              <h3 class="registrationformh3pages">REGISTRATION FORM</h3>
              <div class="row loginnote">
              	<div class="pararegform col-sm-11"><strong>Note:</strong> Enter only Gmail account email address. Do not have a gmail account. <a href="https://accounts.google.com/signup?hl=en-GB" target="_blank" class="clickherebtn">Click here</a></div>
                
              </div>
              
              <!-- tab -->
            <div class="tabmaindiv">
              <div class="tab astabinfo">
                  <a href="javascript:void(0)" class="tablinks active" id="personal_frm_id" onclick="openForm(event, 'PersonalFrm')">Personal Information</a>
                  <a href="javascript:void(0)" class="tablinks" id="addressfrmid" onclick="openForm(event, 'AddressFrm')">Address Details</a>
                  <a href="javascript:void(0)" class="tablinks" id="course_frm_id" onclick="openForm(event, 'CourseFrm')">Course Details</a>
                </div>
            </div>    
				<div class="alert alert-danger error_class" style="display:none;"> <span>Indicates a dangerous or potentially negative action.</span></div>
				
                 <header class="errors"><?php echo validation_errors(); ?></header>    
                 
                <div id="PersonalFrm" class="tabcontent" style="display:block;">
                  	<div class="row mainregistrationform">
               
                  <div class="col-lg-12 col-md-12">
                    <!-- START PANEL -->
                    <div class="panel panel-transparent panelregistrationform">
                    <div class="personalinfohead">Personal Information</div>
                      <div class="panel-body">
                       <?php  $attributes = array('id' => 'reg_form_personal', 'name' => 'reg_form_personal', 'autocomplete' => 'off', 'role' => 'form');
							echo form_open_multipart(base_url().'registration', $attributes);
					   ?>
                         <div class="row">
                            <div class="col-sm-12">
                              <div class="required">
                                <label class="inputhdsection"></label>
								

                                <?php $data = array(
									  'name'        => 'email',
									  'id'          => 'email',
									  'value'       => set_value('email'),
									  'maxlength'   => '100',
									  'class'   => 'inputclassmn',
									  'type'   => 'email',
									  'required'   => 'required',
									  'placeholder'   => 'We’ll send login details to this email address',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                          </div>
                          
                           <div class="row">
                            <div class="col-lg-6 col-sm-12">
                              <div class="required">
                                <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'userpass',
									  'id'          => 'userpass',
									  'value'       => set_value('userpass') ? $this->input->post("userpass") : "",
									  'maxlength'   => '32',
									  'class'   => 'inputclassmn',
									  'type'   => 'password',
									  'minlength'   => '4',
									  'required'   => 'required',
									  'placeholder'   => 'Password minimum of 4 characters.',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                            
                              <div class="col-lg-6 col-sm-12">
                              <div class="required">
                                 <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'compass',
									  'id'          => 'compass',
									   'value'       => set_value('compass') ? $this->input->post("compass") : "",
									  'maxlength'   => '32',
									  'class'   => 'inputclassmn',
									  'type'   => 'password',
									  'required'   => 'required',
									  'placeholder'   => 'Enter Confirm password.',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                          </div>
                          
                         
                        
                          <div class="row clearfix">
                            <div class="col-sm-6">
                              <div class="required">
                                 <label class="inputhdsection"></label>
                                 <?php $data = array(
									  'name'        => 'first_name',
									  'id'          => 'first_name',
									  'value'       => set_value('first_name'),
									  'maxlength'   => '80',
									  'class'   => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Enter your First name',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="required">
                               <label class="inputhdsection"></label>
                               <?php $data = array(
									  'name'        => 'last_name',
									  'id'          => 'last_name',
									  'value'       => set_value('last_name'),
									  'maxlength'   => '80',
									  'class'   => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Enter your Last name',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row clearfix">
                          
						  <div class="col-sm-6">
                              <div class="required">
                               <label class="inputhdsection"></label>
                               <?php $data = array(
									  'name'        => 'guardian_name',
									  'id'          => 'guardian_name',
									  'value'       => set_value('guardian_name'),
									  'maxlength'   => '80',
									  'class'   => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Enter your Guardian name',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                           <div class="col-sm-6">
                           <div class="calenderrelative required" aria-required="true">
                            <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'date_of_birth',
									  'id'          => 'date_of_birth',
									  'value'       => set_value('date_of_birth'),
									  'maxlength'   => '60 ',
									  'class'   => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Date of Birth',
									  );
									  echo form_input($data);
							    ?>
                                 <span class="calendericon">
                                   <i class="fa fa-calendar"></i>
                                   </span>
                              </div>
                              </div>
                              
                              </div>
                             
                           <div class="row clearfix">
						   
						    <div class="col-sm-12 col-lg-6">
                          <label class="inputhdsection"></label>
                          <div class="radio radio-success inputclassmn required">
                          <input type="radio" value="m" name="gender" id="m" checked="checked">
                          <label for="m">Male</label>
                          <input type="radio" value="f" name="gender" id="f">
                          <label for="f">Female</label>
                          </div>
                          
                             </div>
                   			   
                            
		                      <div class="col-sm-6">
                              <div>
                                <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'landline_no',
									  'id'          => 'landline_no',
									  'value'       => set_value('landline_no'),
									  'maxlength'   => '15',
									  'class'   => 'inputclassmn',
									  'placeholder'   => 'Landline No. With STD Code',
									  );
									  echo form_input($data);
							    ?>
                              </div>
                            </div>
                      </div>   
					  
					  <div class="row clearfix">
							<div class="col-sm-4">
                              <div class="required">
                                <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'mobile_no',
									  'id'          => 'mobile_no',
									  'value'       => set_value('mobile_no'),
									  'minlength'   => '10',
									  'maxlength'   => '15',
									  'class'   => 'inputclassmn number',
									  'required'   => 'required',
									  'placeholder'   => 'Mobile No.',
									  );
									  echo form_input($data);
							     ?>
                              </div>
							  <div id="startClock"><div id="count"></div></div>
                            </div>
							<div class="col-sm-2">
								<button class="btn btn-success btn-sm send_otp">Send OTP</button>
							</div>
							
							<div class="col-sm-3 enter_otp">
                              <div class="required">
                               <label class="inputhdsection"></label>
                               <?php $data = array(
									  'name'        => 'otp',
									  'id'          => 'otp',
									  'value'       => set_value('otp'),
									  'maxlength'   => '6',
									  'class'   => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Enter your OTP',
									  
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
							<div class="col-sm-1 loadingimage" style="display:none;">
								<img src="<?php echo base_url();?>assets/img/spin.gif" width="32px" />
							</div>
							<div class="col-sm-2 check_otp" style="display:none;">
								<i class="fa fa-check fa-2x" title="OTP is correct" aria-hidden="true" style="color:#10cfbd"></i>
								<i class="fa fa-exclamation-triangle fa-2x" title="OTP is not correct" aria-hidden="true" style="color:red"></i>
							</div>
							
					  </div>
                      
                       <div class="clearfix"></div>
                       <div class="nextpreviousformbtn">
                      <input type="submit" value="Next" class="nextprebtnp" />
               	     </div>
                     <?php echo form_close(); ?>
                      </div>
                    </div>
                    <!-- END PANEL -->
                  </div>
                  
                </div>
                
               
                </div>
                
                <div id="AddressFrm" class="tabcontent">
                  <div class="row mainregistrationform">
               
                  <div class="col-lg-12 col-md-12">
                    <!-- START PANEL -->
                    <div class="panel panel-transparent panelregistrationform">
                    <div class="personalinfohead">Address Details</div>
                      <div class="panel-body">
                      <?php  $attributes = array('id' => 'reg_form_address', 'name' => 'reg_form_address', 'autocomplete' => 'off', 'role' => 'form');
					    echo form_open_multipart(base_url().'registration', $attributes);
					  ?>
                
                              <div class="row clearfix"> 
                              <div class="col-sm-6">
                              <div class="required">
                                <label class="inputhdsection"></label>
                                  <?php
									$state_array = get_states_dropdown();
									$selected = ($this->input->post('state_id')) ? $this->input->post('state_id') : set_value('state_id');
									echo form_dropdown('state_id', $state_array,  $selected,'id="state_id" class="inputclassmn" required ');
									?> 
                             </div>
        
                      </div> 
                      
                      
                      <div class="col-sm-6">
                      <div class="required">
                        <label class="inputhdsection"></label>
                         <select name="city_id" id="city_id" required class="inputclassmn">
                        <option value="" selected="selected">Select City </option>
                        </select>      
                    
                     </div>
        
                      </div>
                      
                      
                      </div>   
                      
                      <div class="row clearfix">
                       
                     		 <div class="col-sm-6">
                              <div class="required">
                                <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'pin_code',
									  'id'          => 'pin_code',
									  'value'       => set_value('pin_code'),
									  'minlength'   => '4',
									  'maxlength'   => '8',
									  'class'   => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Pin Code',
									  );
									  echo form_input($data);
							  ?>
                              </div>
                            </div>
                            
                            <div class="col-sm-6">
                              <div>
                                <label class="inputhdsection"></label>
                                <?php
                                $blood_group_array = blood_group_array();
                                $selected = ($this->input->post('blood_group')) ? $this->input->post('blood_group') : set_value('blood_group');
                                echo form_dropdown('blood_group', $blood_group_array,  $selected,'id="blood_group" class="inputclassmn" ');
                                ?>
                               </div>
                    		  </div>
                            
                      </div>  
                      
                              
                      
                      <div class="row clearfix">
                      
                      		  <div class="col-sm-6">
                              <div class="required">
                                <label class="inputhdsection"></label>
                               <?php $data = array(
									  'name'        => 'address',
									  'id'          => 'address',
									  'value'       => set_value('address'),
									  'minlength'   => '10',
									  'rows'        => '2',
									  'class'       => 'inputclassmn',
									  'required'   => 'required',
									  'placeholder'   => 'Address',
									  );
									  echo form_textarea($data);
								  ?>
                              </div>
                              </div>
                              
                       </div>
                      
                      
                      <div class="row clearfix">
                           
                              <div class="col-sm-8">
                            
                              <div class="radio radio-success">
							  <?php if($this->input->post('identity_proof_type')=='1') { ?>
                              <input type="radio" value="1" name="identity_proof_type" id="1" checked="checked"><label for="1">Aadhar Card No.</label>
                              <input type="radio" value="2" name="identity_proof_type" id="2"><label for="2">Pan No.</label>
                              <input type="radio" value="3" name="identity_proof_type" id="3"><label for="3">Driving License</label>
                               <?php }
                               elseif($this->input->post('identity_proof_type')=='2') { ?>
                              <input type="radio" value="1" name="identity_proof_type" id="1"><label for="1">Aadhar Card No.</label>
                              <input type="radio" value="2" name="identity_proof_type" id="2"  checked="checked"><label for="2">Pan No.</label>
                              <input type="radio" value="3" name="identity_proof_type" id="3"><label for="3">Driving License</label>
                               <?php }
                               elseif($this->input->post('identity_proof_type')=='3') { ?>
                              <input type="radio" value="1" name="identity_proof_type" id="1"><label for="1">Aadhar Card No.</label>
                              <input type="radio" value="2" name="identity_proof_type" id="2"><label for="2">Pan No.</label>
                              <input type="radio" value="3" name="identity_proof_type" id="3"  checked="checked"><label for="3">Driving License</label>
                               <?php } else{ ?>
                               <input type="radio" value="1" name="identity_proof_type" id="1"  checked="checked"><label for="1">Aadhar Card No.</label>
                               <input type="radio" value="2" name="identity_proof_type" id="2"><label for="2">Pan No.</label>
                               <input type="radio" value="3" name="identity_proof_type" id="3"><label for="3">Driving License</label>
                                <?php }?>
                            
                              </div>
                              </div>
                              
                              
                              <div class="col-sm-4">
                             <div class="required">
                                <label class="inputhdsection"></label>
                                 <?php $data = array(
									  'name'        => 'identity_proof_no',
									  'id'          => 'identity_proof_no',
									  'value'       => set_value('identity_proof_no') ? set_value('identity_proof_no') : $this->input->post("identity_proof_no"),
									  'maxlength'   => '60',
									  'class'   => 'inputclassmn',
									   'required'   => 'required',
									  'placeholder'   => 'Identity Proof no.',
									  );
									  echo form_input($data);
							      ?>
                             </div>
                            </div>
                      
			                   
                      </div>
                      
                       
                       <!--<div class="row">  
                         <div class="col-lg-6">
                           <label class="inputhdsection">Choose File</label>
                            <div class="">
                              <input id="user_photo" placeholder="Profile Photo" name="user_photo" class="inputclassmn" accept="image/*"  type="file">
                                </div>
                                   
                            </div>
                            <div class="col-lg-6">
                            <div class="inputclassmn">
                                <div style="" id="dvPreview"><img id="preview" src="<?php echo base_url()?>assets/img/noimage.jpg"></div>
                           </div>
                            </div>
                            </div>-->
                       
               
                          <div class="clearfix"></div>
                                              
                           <div class="nextpreviousformbtn">
                            <input id="previousbtn" onClick="open_Form('personal_frm_id', 'PersonalFrm');"  type="button" value="Previous" class="previousbtn" />
                            &nbsp;&nbsp;
                            <input type="submit" value="Next" class="nextprebtnp" />
                            
                        </div>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                    <!-- END PANEL -->
                  </div>
                  
                </div> 
                </div>
                
                <div id="CourseFrm" class="tabcontent">
                  <div class="row mainregistrationform">
               
                  <div class="col-lg-12 col-md-12">
                    <!-- START PANEL -->
                    <div class="panel panel-transparent panelregistrationform">
                    <div class="personalinfohead">Course Details</div>
                      <div class="panel-body">
                        <?php  $attributes = array('id' => 'reg_form_course', 'name' => 'reg_form_course', 'autocomplete' => 'off', 'role' => 'form');
					     echo form_open_multipart(base_url().'registration', $attributes);
					     ?>
            
                       <div class="row">
                             <div class="col-sm-6">
                             <div class="required">
                             <label class="inputhdsection"></label>
							  <?php
                                $centre_users_array = get_users_dropdown('C','0');
                                $selected = ($this->input->post("centre_id")) ? $this->input->post("centre_id") : "";
                                echo form_dropdown('centre_id', $centre_users_array,  $selected,'id="centre_id" class="inputclassmn" required');
                                ?>
                            </div>
                            </div>
                             
                             <div class="col-sm-6">
                             <div class="required">
                             <label class="inputhdsection"></label>
							  <?php
                                 $course_stream_array = course_stream_array();
                                 $selected = ($this->input->post('course_stream')) ? $this->input->post('course_stream') : set_value('course_stream');
                                 echo form_dropdown('course_stream', $course_stream_array,  $selected,'required="required" id="course_stream" class="inputclassmn"');
                               ?>
                            </div>
                            </div>
                      </div>
                      
                      
                      		 <div class="row">
                              <div class="col-sm-6">
                              <div class="required">
                                <label class="inputhdsection"></label>
                                <select name="course_id" id="course_id" class="inputclassmn">
                                <option value="" selected="selected">Select Course</option></select>                         
                             </div>
                           
	                       </div>
                           
                             <div class="col-sm-6">
                              <div>
                                <label class="inputhdsection"></label>
                                <?php $data = array(
									  'name'        => 'prospectus_form_no',
									  'id'          => 'prospectus_form_no',
									  'value'       => set_value('prospectus_form_no') ? set_value('prospectus_form_no') : $this->input->post("prospectus_form_no"),
									  'minlength'   => '6',
									  'maxlength'   => '8',
									  'class'   => 'inputclassmn',
									  'placeholder'   => 'Prospectus Form No.',
									  );
									  echo form_input($data);
							      ?>
                              </div>
                            </div>
                           
                             
                            </div>
                            
                        
                
                        <div class="row clearfix">
                   		 <div class="col-sm-12">
                              <div class="">
                                
                               <div class="termsncond">
                               <ul>
<li>Candidates submitting the fee Online for admission may please note that submission of fee does not confirm admission.</li>
<li>Candidates submitting the fee Online are required to submit the requisite documents along with a printed copy of the online fee receipt (acknowledgement) within 5 working days of payment. The documents may be submitted in person or by post.</li>
<li>Confirmation of admission shall be subject to the compliance of your credentials to the eligibility criteria laid in the current year’s prospectus and verification and/or submission of certificates/documents required by INIFD to the respective Campuses / Registrar’s office as per the notified timelines.</li>
<li>Candidates will be informed via email / telephonically regarding receipt or shortfall in the documents.</li>
<li>Please contact 1800 103 3005 in case of any error in the payment.</li>
<li>Non-receipt of documents shall lead to cancellation of admission. Please note that fee once paid is non-refundable.</li>

                               </ul>
                               </div>
                               
                               
                               <div class="checkbox check-success">
                               <input value="1" id="agree" name="agree" type="checkbox">
                               <label for="agree">I agree</label>
                               </div>
                              
                              </div>
                            </div>
                    
                      </div>
                          
                      
                    
                          <div class="clearfix"></div>
                           <div class="nextpreviousformbtn">
                            <input id="previousbtn" onClick="open_Form('addressfrmid', 'AddressFrm');"  type="button" value="Previous" class="previousbtn" />
                            &nbsp;&nbsp;
                            <input type="button" name="finish" id="finish" value="FINISH"  class="nextprebtnp last_step" />
                            
                       
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                    <!-- END PANEL -->
                  </div>
                  
                </div>
                </div>
                
                
                
               
              </div>
          </div>
          <!-- END CONTAINER FLUID -->
      
      
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
		
		
         <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text text-white">Copyright &copy;  <?php echo  date('Y'); ?> </span>
              <span class="font-montserrat text-white"><?php echo company_name; ?></span>.&nbsp;
              <span class="hint-text text-white">All rights reserved. </span>
              <span class="sm-block text-white">
              <a class="m-l-10 text-white" href="<?php echo base_url();?>cancellation_refund_policy" class="m-l-10">Cancellation & Refund Policy</a>&nbsp; | &nbsp; 
             <a href="<?php echo base_url();?>terms_and_conditions" class="m-l-10 m-r-10 text-white">Terms & Conditions</a> | <a href="<?php echo base_url();?>privacy_policy" class="m-l-10 text-white">Privacy Policy</a>
             </span>
            </p>
           
            <div class="clearfix"></div>
          </div>

		<?php
       /* $access_url='';
        if($this->uri->segment(1)!='')
        $access_url .= trim($this->uri->segment(1));
        if($this->uri->segment(2)!='')
        $access_url .= '/'.trim($this->uri->segment(2));  
        if($this->uri->segment(3)!='')
        $access_url .= '/'.trim($this->uri->segment(3));
        
        $url = $_SERVER['HTTP_HOST'].'/' . $access_url;
        $query_str = $_SERVER['QUERY_STRING'];
                  
        if($query_str)
        $query_str="?".$query_str;
        if(!preg_match("/ajaxrequest/i", $url))
        {
            $hit_url = $url . $query_str;
            $inserthit ="Insert into `site_hits` (`IPP` ,`status` ,`user_id` ,`user_type` , `page_url` , `hit_url` , `hit_datetime`)
            Values('".$_SERVER['REMOTE_ADDR']."', 'lms', '".$this->session->userdata('user_id')."' , '".$this->session->userdata('user_type')."' , '".$_SERVER['PHP_SELF']."' , '$hit_url',  NOW())";
            $resulthits=mysql_query($inserthit) or die(mysql_error().$inserthit);
        }*/
        ?>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
   
   
   
    <!-- BEGIN VENDOR JS -->
   <?php $this->load->view("includes/scripts.php");?>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.min.js"></script> 
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
     
	 
	 
    <script type="text/javascript">
	$("#date_of_birth").datepicker({
	changeMonth: true,changeYear: true,endDate: '-14y',
    format: 'yyyy-mm-dd',
	});
	</script>
    <script type="text/javascript">

	$(function()
    {
		//var $cp = $('#first_name');
 	    $("#reg_form_personal").validate({
		rules: {
    userpass: "required",
    compass: {
      equalTo: "#userpass"
    }
  },
		submitHandler: function(form)
	  {  
	     		var email_id =  $('#email').val();
				if(email_id=='')  
				{	alert('Please enter email id.');
				}
				else if(!rb_checkEmail(email_id))  
				{	alert('Please enter valid email id.');
				}
	            else if(!valid_gmail(email_id))  
				{	alert('Please enter only gmail email id');
				}
				else
				{
					 open_Form('addressfrmid','AddressFrm');
					 return false;
				} 
	  
	  },
	
});



	   $("#reg_form_address").validate({ submitHandler: function(form)
	   {  
	     		var state_id =  $('#state_id').val();
				if(state_id=='')  
				{	alert('Please select state.');
				}
				
				else
				{
					 open_Form('course_frm_id', 'CourseFrm');
					 return false;
				}
	  },
	 });
	 
	 
		$("body").on('click', '#agree', function() {
			if ($(this).is(':checked')) {
				$('.last_step').prop('disabled', false);
			}else{
				$('.last_step').prop('disabled', true);
			}
		});
	 
	
	//$(".last_step").click(function(){
	$("body").on('click', '.last_step', function() {
		if ($('#agree').is(':checked')) {
			$(this).prop('disabled', false);
		}else{
			$(this).prop('disabled', true);
			return false;
		}
		
		// Personal Form
		var email=$("#email").val();
		var userpass=$("#userpass").val();
		var compass=$("#compass").val();
		var first_name=$("#first_name").val();
		var last_name=$("#last_name").val();
		var gender =$('input[name=gender]:checked').val();
		var mobile_no=$("#mobile_no").val();
		var landline_no=$("#landline_no").val();
		var date_of_birth=$("#date_of_birth").val();
		var guardian_name=$("#guardian_name").val();
		var otp=$("#otp").val();
		
		//Address Details
		var state_id=$("#state_id").val();
		var city_id=$("#city_id").val();
		var pin_code=$("#pin_code").val();
		var blood_group=$("#blood_group").val();
		var address=$("#address").val();
		var identity_proof_type=$('input[name=identity_proof_type]:checked').val();
		var identity_proof_no=$("#identity_proof_no").val();

		 $.ajaxSetup({
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash();?>',
					'mobile':mobile_no,
					'otp':otp,
				}
			}); 
		$.get('<?php echo base_url();?>registration/verfiy_otp', function( data ) {
			if(data=="0"){
				alert('There is some problem with the mobile number and OTP. Please check it.');
				return false;
			}
		});
		// Course Details
		var centre_id=$("#centre_id").val();
		var course_stream=$("#course_stream").val();
		var course_id=$("#course_id").val();
		var prospectus_form_no=$("#prospectus_form_no").val();
		
		if(userpass=='' || compass=='' || first_name=='' || last_name=='' || mobile_no=='' || date_of_birth=='' || guardian_name=='' || otp==''){
			open_Form('personal_frm_id', 'PersonalFrm');
			$("#personal_frm_id").addClass('active');
			$(".error_class").fadeIn("slow");
			$(".error_class span").html('Please fill all the required details of <strong>Personal Information</strong>');
			return false;
		}else if(state_id=='' || city_id=='' || pin_code=='' || address==''){
			open_Form('addressfrmid', 'AddressFrm');
			$("#reg_form_address").addClass('active');
			$(".error_class").fadeIn("slow");
			$(".error_class span").html('Please fill all the required details of <strong>Address details</strong>');
			return false;
		}else if(centre_id=='' || course_stream==''){
			open_Form('course_frm_id', 'CourseFrm');
			$("#reg_form_course").addClass('active');
			$(".error_class").fadeIn("slow");
			$(".error_class span").html('Please fill all the required details of <strong>Course details</strong>');
			return false;
		}else{
			var myArray = {};
			//required fields
			myArray["email"] = email;
			myArray["userpass"] = userpass;
			myArray["first_name"] = first_name;
			myArray["last_name"] = last_name;
			myArray["last_name"] = last_name;
			myArray["guardian_name"] = guardian_name;
			myArray["gender"] = gender;
			myArray["date_of_birth"] = date_of_birth;
			myArray["mobile_no"] = mobile_no;
			myArray["landline_no"] = landline_no;
			myArray["centre_id"] = centre_id;
			myArray["course_stream"] = course_stream;
			myArray["course_id"] = course_id;
			myArray["prospectus_form_no"] = prospectus_form_no;
			myArray["state_id"] = state_id;
			myArray["city_id"] = city_id;
			myArray["pin_code"] = pin_code;
			myArray["address"] = address;
			myArray["identity_proof_type"] = identity_proof_type;
			myArray["identity_proof_no"] = identity_proof_no;
			
			//optional fields
			myArray["landline_no"] = landline_no;
			myArray["blood_group"] = blood_group;
			
			
			$.ajax({
				type    : 'POST',
				url     : '<?php echo base_url();?>registration/student',
				data    : {result:JSON.stringify(myArray)},
				success : function(response) {
					// alert(response);
					// return false;
					  var arr = response.split('|||');
					  var response_result = arr[1];
					  //alert(response_result);
					  if(response_result=='2')
								{	alert('Sorry, Email id is already registered.');
								}
						else if(response_result=='0')
								{	alert('Congrats!!! You are register. But there is some error in email sending.');
									localStorage.clear();
								   window.location.href = "<?php echo base_url();?>students/dashboard";
								}
						else if(response_result=='3')
								{	alert('Sorry, Prospectus/Form no is already registered.');
								    
								}	
						else if(response_result=='1')
								{	alert('Congrats!!! You are register. Your login details have been sent to your email address.');
								 localStorage.clear();
								  window.location.href = "<?php echo base_url();?>students/dashboard";
								}					
					 // alert(response);
				}    
			});
			
			
		}
	});
	
});



	function valid_gmail(value){
		return  /^[a-z0-9](\.?[a-z0-9]){5,}@gmail\.com$/i.test(value);
	}
	
	function rb_checkEmail(email)
	{       if (email.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
					return false;
			else
					return true;
	}
	
	  $(function () {
            $("#user_photo").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#dvPreview");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:100px;width: 100px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
		
	
 $("#state_id").change(function () { 
		$('#city_id').html('');
		var get_val=$(this).val();
		$("#city_id").find('option').remove();
		$.get('<?php echo base_url();?>ajaxrequest/get_city_list/'+get_val, function( data ) {
			var obj = jQuery.parseJSON(data);
			$('#city_id').append($("<option></option>").attr("value",'').text('Select City'));
			$.each(obj, function(idx, obj1) {
				var city_name=obj1.city_name;
				var city_id=obj1.city_id;
				//alert(city_name);
				$('#city_id').append($("<option></option>").attr("value",city_id).text(city_name)); 
			});
		});
   });		  
   	
		
  $("#course_stream").change(function () { 
		$('#course_id').html('');
		var get_val=$(this).val();
		var get_centre=$("#centre_id").val();
		$("#course_id").find('option').remove();
		$.get('<?php echo base_url();?>ajaxrequest/get_course/'+get_centre+'/'+get_val, function( data ) {
			var obj = jQuery.parseJSON(data);
			$('#course_id').append($("<option></option>").attr("value",'').text('Select Course'));
			$.each(obj, function(idx, obj1) {
				var course_name=obj1.course_name;
				var course_id=obj1.course_id;
				$('#course_id').append($("<option></option>").attr("value",course_id).text(course_name)); 
			});
		});
   });		  
			

	 $(".send_otp").click(function(){
		 var mobile_no=$("#mobile_no").val();
		 var check_len=mobile_no.length;
		 if(check_len>=10){
			
			
			 $.ajaxSetup({
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash();?>',
					'mobile':mobile_no
				}
			}); 
			$.get('<?php echo base_url();?>registration/send_otp', function( data ) {
				//alert(data);
				if(data=="2"){
					alert("Mobile number is already exist. Please try another number.");
				}else if(data=="3"){
					alert("There is something wrong with the connectivity. Please try again later.");
				}
				else if(data=="4"){
					alert("Mobile Number is not correct. Please write only 10 digit number. Do not include 0 and +91 in front of your number.");
				}else if(data=="5"){
					alert("Please refresh the page and try again");
				}else{
					$("#startClock").trigger('click');
					$('.enter_otp').show(); 
					$('.send_otp').prop('disabled', true);
				}
				 
			});
			
			
		 }else{
			 alert('Please enter the valid mobile number');
			 return false;
		 }
		
	 });	
	 
	 
	 $("#otp").hide();
	 $(".enter_otp").hide();
	 var get_otp=$("#otp").val();
	 if(get_otp==''){
		 $("#reg_form_personal .nextprebtnp").prop('disabled', true);
	 }
	 $("#otp").keyup(function(){
		var otp_num=$(this).val();
		var get_number=$("#mobile_no").val();
		if(get_number!=''){
			$('.check_otp .fa-check').hide();
			$('.check_otp .fa-exclamation-triangle').hide();
			 $.ajaxSetup({
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash();?>',
					'mobile':get_number,
					'otp':otp_num,
				},beforeSend: function(xhr) {
                $('.loadingimage').show();
             },
				complete: function(xhr, stat) {
				$('.loadingimage').hide();
				},
				 success: function(result,status,xhr) {
				}
			}); 
			$.get('<?php echo base_url();?>registration/validate_otp', function( data ) {
				if(data==1){
					$('.check_otp').show();
					$('.check_otp .fa-check').show();
					$('.check_otp .fa-exclamation-triangle').hide();
					$('.send_otp').remove();
					$('#mobile_no').prop('readonly', true);
					$('#otp').prop('readonly', true);
					$("#startClock").remove();
					$("#reg_form_personal .nextprebtnp").prop('disabled', false);
				}else{
					$('.check_otp').show();
					$('.check_otp .fa-check').hide();
					$('.check_otp .fa-exclamation-triangle').show();
				}
			});
			
		}else{
			alert("Please fill the mobile number.");
			return false;
		}
	});
	 

	/*========== timer of OTP =========*/
		//$("#startClock").click( function(){
		$("body").on('click', '#startClock', function() {
			var counter = 120;
			setInterval(function() {
				counter--;
				if (counter >= 0) {
					$("#startClock").show();
					$("#otp").show();
					span = document.getElementById("count");
					span.innerHTML = 'You can resend OTP after '+counter+' sec.';
				}
				if (counter === 0) {
					clearInterval(counter);
					$("#startClock").hide();
					$("#otp").hide();
					$('.send_otp').prop('disabled', false);
					$('.check_otp').hide();
					$('.enter_otp').hide();
					$("#otp").val('');
					var mobile_no=$('#mobile_no').val();
					$.ajaxSetup({
							data: {
								'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash();?>',
								'mobile':mobile_no
							}
						}); 
					$.get('<?php echo base_url();?>registration/expire_otp', function( data ) {
						 
					});
				}
			}, 1000);
		});
	/*========== timer of OTP end =========*/
	
	 
	 $("#course_id").change(function () { 
		var get_val=$(this).val();
		var get_centre=$("#centre_id").val();
		$.get('<?php echo base_url();?>ajaxrequest/course_batch_exists/'+get_val+'/'+get_centre, function( data ) {
			var obj = jQuery.parseJSON(data);
			if(obj=='')
			{
				   alert('This Centre New Academic session batches can’t created. Please contact administrator.');
				   $('#finish').hide();  
			}
			else
			{
				  $('#finish').show();  
			}
		});
		
		
  });
  $(function($) {
            $("#prospectus_form_no").mask("IB999999");
   });
  </script>
	
    <!-- END PAGE LEVEL JS -->
  </body>
</html>