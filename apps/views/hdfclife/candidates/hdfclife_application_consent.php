<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?php echo web_title; ?></title>
      <meta content="width=device-width, initial-scale=1" name="viewport" />
       <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/theme/custom.css">
      <link href="<?php echo base_url(); ?>assets/css/theme/gijgo.min.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <div class="container box-container">
         <!-- Header -->
             <div class="row mb-5 justify-content-between" id="header">
                <div class="col-md-9">
                  <h1 class="application">Point of Sales Person (POSP) Application Form</h1>
                </div>
                <div class="col-md-3 logo">
                   <img src="<?php echo base_url(); ?>assets/img/logo.png" class="img-fluid" alt="HDFC Life Insurance" title="HDFC Life Insurance">
                </div>
             </div>
         		<?php  
			 	 $attributes = array('id' => 'form2','name' => 'form2','class' => 'application_form2','role' => 'form','autocomplete' => 'off','novalidate');
				 echo form_open(base_url().'hdfclife/candidates/hdfclife_application_consent', $attributes);
				 ?>
           <div class="row">
             <div class="col-12">
                <!-- BEGIN Notification -->
                <?php $this->load->view("includes/notification.php");?>
                
                 <div class="portlet-body">
                <?php if ($steps): ?>
                  <div class="alert alert-info alert-dismissible fade show">
                     <strong>Note:</strong><br>  <?php echo $steps; ?> 
                  </div>
                    <?php endif; ?>
                 </div>
    
                <!-- END Notification -->
               </div>
               
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                <label class="mr-sm-2">Application Number</label>
                 <?php $data = array(
					  'name'        => 'application_no',
					  'id'          => 'application_no',	
					  'value'       => $row->application_no,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               
            </div>
            <!-- Personal Details -->
            <div class="row">
               <div class="col-12 form-heading">
                  Personal Details
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">Applicant Full Name</label>
                   <?php $data = array(
					  'name'        => 'applicant_full_name',
					  'id'          => 'applicant_full_name',	
					  'value'       => $row->applicant_full_name,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
      		   </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">Father's Name</label>
                   <?php $data = array(
					  'name'        => 'father_name',
					  'id'          => 'father_name',	
					  'value'       => $row->father_name,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">Gender</label>
                   <?php $data = array(
					  'name'        => 'gender',
					  'id'          => 'gender',	
					  'value'       => $row->gender,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">Marital Status</label>
                   <?php $data = array(
					  'name'        => 'marital_status',
					  'id'          => 'marital_status',	
					  'value'       => $row->marital_status,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
              </div>
              
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">Nationality</label>
                  <?php $data = array(
					  'name'        => 'nationality',
					  'id'          => 'nationality',	
					  'value'       => $row->nationality,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <!-- Address -->
            <div class="row">
               <div class="col-12 form-heading">
                  Current Full Address
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">House Number</label>
                  <?php $data = array(
					  'name'        => 'house_no',
					  'id'          => 'house_no',	
					  'value'       => $row->house_no,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">Street</label>
                  <?php $data = array(
					  'name'        => 'street',
					  'id'          => 'street',	
					  'value'       => $row->street,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">City</label>
                  <?php $data = array(
					  'name'        => 'city',
					  'id'          => 'city',	
					  'value'       => $row->city,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-6 d-md-flex my-2 main-form align-items-center sub-form">
                  <label  class="mr-sm-2">District</label>
                  <?php $data = array(
					  'name'        => 'district',
					  'id'          => 'district',	
					  'value'       => $row->district,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <div class="row">
               <div class="col-md-8 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">State</label>
                 <?php $data = array(
					  'name'        => 'state',
					  'id'          => 'state',	
					  'value'       => $row->state,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-4 d-md-flex my-2 main-form align-items-center sub-form">
                  <label  class="mr-sm-2">Pincode</label>
                  <?php $data = array(
					  'name'        => 'pin_code',
					  'id'          => 'pin_code',	
					  'value'       => $row->pin_code,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <div class="row">
            <div class="col-md-5 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2">PAN</label>
                  <?php $data = array(
					  'name'        => 'pan_no',
					  'id'          => 'pan_no',	
					  'value'       => $row->pan_no,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               
               <div class="col-md-7 d-md-flex my-2 main-form align-items-center sub-form">
                  <label  class="mr-sm-2">Email ID</label>
                  <?php $data = array(
					  'name'        => 'email_id',
					  'id'          => 'email_id',	
					  'value'       => strtolower($row->email_id),								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            
            <!-- Education -->
            <div class="row">
               <div class="col-12 form-heading">
                  Education Details
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll">
                  <label  class="mr-sm-2">Board University Name</label>
                   <?php $data = array(
					  'name'        => 'paboard_university_namen_no',
					  'id'          => 'board_university_name',	
					  'value'       => $row->board_university_name,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll">
                  <label  class="mr-sm-2">Roll no./Seat no./Registration no.</label>
                  <?php $data = array(
					  'name'        => 'roll_no_seat_no_registration_no',
					  'id'          => 'roll_no_seat_no_registration_no',	
					  'value'       => $row->roll_no_seat_no_registration_no,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <div class="row align-items-center main-form">
               <div class="col-md-8 roll d-md-flex roll">
            
                     <label  class="mr-sm-2">Educational Qualification</label>
                   
                        <label class="form-check-label educa">
                         <?php $data = array(
						  'name'        => 'educational_qualification',
						  'id'          => 'educational_qualification',	
						  'value'       => $row->educational_qualification,								
						  'class'   => 'form-control mb-2',
						  'readonly'   => true
						  );
					    echo form_input($data);
					    ?>
                        </label>
                    
                      
           
               </div>
               <div class="col-lg-4 d-md-flex year">
                  <label  class="mr-sm-2">Year of Passing</label>
                  <?php $data = array(
					  'name'        => 'year_of_passing',
					  'id'          => 'year_of_passing',	
					  'value'       => $row->year_of_passing,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll">
                  <label  class="mr-sm-2">Other Qualification</label>
                  <?php $data = array(
					  'name'        => 'other_qualification',
					  'id'          => 'other_qualification',	
					  'value'       => $row->other_qualification,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll">
                  <label  class="mr-sm-2">Occupation /
                  Primary Profession</label>
                  <?php $data = array(
					  'name'        => 'occupation_primary_profession',
					  'id'          => 'occupation_primary_profession',	
					  'value'       => $row->occupation_primary_profession,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <!-- Bank Details -->
            <div class="row">
               <div class="col-12 form-heading">
                  Bank Details
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll dec">
                  <label  class="mr-sm-2">Bank Account Number</label>
                 <?php $data = array(
					  'name'        => 'bank_account_number',
					  'id'          => 'bank_account_number',	
					  'value'       => $row->bank_account_number,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll dec">
                  <label  class="mr-sm-2">Bank Name</label>
                 <?php $data = array(
					  'name'        => 'bank_name',
					  'id'          => 'bank_name',	
					  'value'       => $row->bank_name,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll dec">
                  <label  class="mr-sm-2">Bank Branch Name</label>
                  <?php $data = array(
					  'name'        => 'bank_branch_name',
					  'id'          => 'bank_branch_name',	
					  'value'       => $row->bank_branch_name,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll dec">
                  <label  class="mr-sm-2">IFSC</label>
                  <?php $data = array(
					  'name'        => 'ifsc_code',
					  'id'          => 'ifsc_code',	
					  'value'       => $row->ifsc_code,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll dec">
                  <label  class="mr-sm-2">Applicant Name as per Bank Account</label>
                  <?php $data = array(
					  'name'        => 'applicant_name_as',
					  'id'          => 'applicant_name_as',	
					  'value'       => $row->applicant_name_as,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
            </div>
            <!-- Declaration -->
            <div class="row">
               <div class="col-12 form-heading">
                  Declaration (to be filled in case of relation)
               </div>
               
                  
                     <div class="col-12 d-md-flex my-2 main-form align-items-center dec">
                        <label  class="mr-sm-2">Are you related to any current employee of HDFC Life?</label>
                         <?php $data = array(
							  'name'        => 'any_of_your_relative_is',
							  'id'          => 'any_of_your_relative_is',	
							  'value'       => $row->any_of_your_relative_is,								
							  'class'   => 'form-control mb-2',
							  'readonly'   => true
							  );
						   echo form_input($data);
						   ?>
                      </div>
                 <div class="col-12 d-md-flex my-2 main-form align-items-center dec">
                  <label  class="mr-sm-2">Name of the employee related to</label>
                 <?php $data = array(
					  'name'        => 'name_of_your_relative',
					  'id'          => 'name_of_your_relative',	
					  'value'       => $row->name_of_your_relative,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-12 d-md-flex my-2 main-form align-items-center dec">
                  <label  class="mr-sm-2">Describe Relationship</label>
                  <?php $data = array(
					  'name'        => 'relationship',
					  'id'          => 'relationship',	
					  'value'       => $row->relationship,								
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               <div class="col-md-12">
                  The definition of relative is spouse/dependent children or
                  dependent step children, whether residing with the employee or not. If you are related to any of the mentioned relations, then your
                  application shall be rejected.
               </div>
               
               
               
            </div>
            
             <div class="row">&nbsp; </div>
            
             <!-- BEGIN Notification -->
             <div class="portlet-body">
             <?php if ($steps): ?>
              <div class="alert alert-info alert-dismissible fade show">
                 <strong>Note:</strong><br>  <?php echo $steps; ?> 
              </div>
                <?php endif; ?>
             </div>
           <!-- END Notification -->
                
            <!-- Declaration Content -->
            <div class="row">
               <div class="col-12 form-heading">
                  Declaration by the Candidate
               </div>
               <div class="col-md-12">
                  I hereby declare that:  &nbsp;&nbsp; <label  class="mr-sm-2"><a id="agree_terms" class="agree_terms" name="agree_terms" href="<?php echo base_url(); ?>hdfclife/candidates/download_terms">DOWNLOAD TERMS AND CONDITIONS:</a></label>
               </div>
               
               <div class="col-md-12">
                  <ul>
               <li>I have applied for an appointment to act as an POSP LI Agent with HDFC Life Insurance Company Limited (HDFC Life) and have also read and understood the terms and conditions of appointment provided at the following link: <a href="https://brandsite-static.hdfclife.com/media/documents/apps/POSP%20Appointment%20T%26C.pdf" target="_blank">https://brandsite-static.hdfclife.com/media/documents/apps/POSP%20Appointment%20T%26C.pdf</a> </li>
              <li>I understand that the terms and conditions are subject to change from time to time and I agree to be bound by the updated terms and conditions.</li>
            <li>I have furnished copies of the following documents for processing and storage of my POSP LI application form: i) PAN Card ii) Aadhaar Card iii) Cancelled Cheque / Bank Passbook iv) Education Proof v) Address Proof (if different from Aadhaar Card) vi) Age proof (if different from PAN Card)</li>
              <li>The particulars given above are complete, true and accurate and I shall indemnify and hold harmless HDFC Life from and against any liabilities, claims, damages, penalties, costs, charges or levies whatsoever, arising due to any information provided by me in this form. I understand that my appointment as POSP LI is at the sole discretion of HDFC Life.</li>
               <li>I shall refund any amount credited to my account either in excess or which is not due to me, at anytime due to any reason whether by HDFC Life or not.</li>
              <li>I shall inform HDFC Life with an advance notice of 6 weeks, in case I desire to change my bank details due to any reason.</li>
              <li>I have not been found to be of unsound mind by a court of competent jurisdiction.</li>
                  
               <li>I have not been found guilty of criminal misappropriation or criminal breach of trust or cheating or forgery or an abetment of or attempt to commit any such oence by a court of competent jurisdictio</li>
               <li>I have not been found guilty of or to have knowingly participated in or connived at any fraud, dishonestly or mis-representation against an insurer or an insured.</li>
              
            <li>I hereby arm, agree and acknowledge that HDFC Life may share my personal information, including contact information and bank account details in accordance with the applicable laws with HDFC Life’s partners and third parties in connection with my appointment as POSP with HDFC Life. I authorise HDFC Life to share my personal information to the extent provided herein.</li>
    
                  </ul>
                  
                 
                  
               </div>
               
                <div class="col-md-12 d-md-flex my-2 main-form align-items-center roll iacceptagree"> 
                  <label  class="mr-sm-2"><input type="checkbox" name="agree" id="agree"  class="iagree" disabled="disabled" value="1">&nbsp;&nbsp;&nbsp;<strong>I accept the Terms & Conditions.</strong></label>
                  </div>
               
               
              
            
            </div>
            
            <div class="row" id="otp_verify" style="display:none;">
               <div class="col-12 form-heading">
                 To provide your consent and submit application, please enter OTP
               </div>
               <div class="col-md-6 d-md-flex my-2 main-form align-items-center">
                  <label  class="mr-sm-2"> Mobile number</label>
                   <?php $data = array(
					  'name'        => 'mobile_no',
					  'id'          => 'mobile_no',	
					  'value'       => $row->mobile_no,				
					  'class'   => 'form-control mb-2',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
               </div>
               
              <div class="col-md-2 d-md-flex main-form align-items-center roll">
					<button class="btn cont-btn send_otp">Send OTP</button>
				</div>
                            
              
                <div class="col-sm-1 loadingimage" style="display:none;" style="position:fixed;">
                    <img src="<?php echo base_url();?>assets/img/spin.gif" width="48px" />
                </div>
                
               
            </div>
            
             <div class="row" id="otp_div_id" style="display:none;">
               <div class="col-md-12  my-4 main-form align-items-center roll">
			      <div class="alert alert-info info-dismissible fade show text-center">
                       <div id="startClock"><img src="<?php echo base_url(); ?>assets/img/otp.png" class="img-fluid" alt="OTP" title="OTP"><p id="otp_text"></p></div>
             	 <div class="col-md-3 d-md-flex justify-content-between mx-auto my-2 main-form align-items-center roll enter_otp text-center">
                  <?php $data = array(
						  'name'        => 'otp',
						  'id'          => 'otp',
						  'value'       => set_value('otp'),
						  'maxlength'   => '6',
						  'class'   => 'form-control mb-2 numbersOnly',
						  'required'   => 'required',
						  'onkeypress'   => 'return isNumber(event)',
						  'placeholder'   => 'Enter your OTP',
						  );
						  echo form_input($data);
				 	 ?>
				   <div class="col-12 col-md-2 check_otp" style="display:none;">
                    <i class="fa fa-check fa-2x" title="OTP is correct" aria-hidden="true" style="color:darkgreen"></i>
                    <i class="fa fa-exclamation-triangle fa-2x" title="OTP is not correct" aria-hidden="true" style="color:#D51D25"></i>
				</div>

               </div>
               <p id="wrong_otp" style="clear:both;" class="note"></p>
                  <p id="correct_otp" class="success_txt"></p>
             	  
               </div>

                 </div>

                 </div>
                 
            
            
            <div class="row justify-content-between">
               <div class="col-md-4">
               
                  <div class="d-md-flex align-items-center my-3 date">
                     <label  class="mr-sm-2">Date</label>
                    <?php $data = array(
					  'name'        => 'date',
					  'id'          => 'date',	
					  'value'       => date('Y-m-d'),								
					  'class'   => 'form-control',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
                  </div>
                  <div class="d-md-flex align-items-center my-3 date">
                     <label  class="mr-sm-2">Place</label>
                     <?php $data = array(
					  'name'        => 'place',
					  'id'          => 'place',	
					  'value'       => $row->district,								
					  'class'   => 'form-control',
					  'readonly'   => true
					  );
				   echo form_input($data);
				   ?>
                  </div>
               </div>
               
               
            </div>
        <?php echo form_close(); ?>  
      </div>
      <div class="container">
         <strong>HDFC Life Insurance Company Limited [Formerly HDFC Standard Life Insurance Company Limited] (HDFC Life). </strong>CIN: L65110MH2000PLC128245. IRDAI Registration No. 101.
         Regd. Off: 13th Floor, Lodha Excelus, Apollo Mills Compound, N.M. Joshi Marg, Mahalaxmi, Mumbai - 400 011.
      </div>
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- Date Picker -->
      <script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>
      <script>
    	 $(document).ready(function() {
       
		  $('input[type="checkbox"]').click(function(){
		  if($(this).is(":checked")){
				$('#otp_verify').show(); 
             }
            else if($(this).is(":not(:checked)")){
               $('#otp_verify').hide(); 
            }
        });
		
		 $(".numbersOnly").keyup(function(){
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});
  
	 
		});
	 </script>
     <script type="text/javascript">
	  $("#agree_terms").click(function(){
			 $("input.iagree").removeAttr("disabled");
		 });
		 
	  $(".iacceptagree").click(function(){
		if ($("#agree").is(":disabled")){
			 alert('It\'s mandatory to download the Terms & Conditions.');
		}
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
			$.get('<?php echo base_url();?>hdfclife/candidates/send_otp', function( data ) {
				//alert(data);
				if(data=="0"){
					alert("Mobile number is not associated with this application.");
				}
				else if(data=="6"){
					alert("You have exceeded the OTP limit for the day.");
				}
				else if(data=="2"){
					alert("This mobile number already exists in the system.");
				}else if(data=="3"){
					alert("There is something wrong with the connectivity. Please try again later.");
				}
				else if(data=="4"){
					alert("Mobile number is not correct. Please write only 10 digit number. Do not include 0 and +91 in front of your number.");
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
	
	 $("#otp").keyup(function(){
		var otp_num=$(this).val();
		var get_number=$("#mobile_no").val();
		var otp_num_length =  otp_num.length;
		if((get_number!='') && (otp_num_length>=4)){
			$('.check_otp .fa-check').hide();
			$('.check_otp .fa-exclamation-triangle').hide();
			p = document.getElementById("wrong_otp");
			p.innerHTML = '';
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
			$.get('<?php echo base_url();?>hdfclife/candidates/validate_otp', function( data ) {
				if(data==1){
					$('.check_otp').show();
					$('.check_otp .fa-check').show();
					$('.check_otp .fa-exclamation-triangle').hide();
					$('.send_otp').remove();
					$('#mobile_no').prop('readonly', true);
					$('#otp').prop('readonly', true);
					$("#startClock").remove();
					p = document.getElementById("wrong_otp");
					p.innerHTML = '';
					p = document.getElementById("correct_otp");
					p.innerHTML = 'OTP verified successfully.';
					
					 window.location = '<?php echo base_url();?>response';
					 return false;
				}else{
				
				}
			});
			
		}
	});
	 	 
	 $("#otp").keypress(function(){
		var otp_num=$(this).val();
		var get_number=$("#mobile_no").val();
		var otp_num_length =  otp_num.length;
		if((get_number!='') && (otp_num_length>=4)){
			$('.check_otp .fa-check').hide();
			$('.check_otp .fa-exclamation-triangle').hide();
			p = document.getElementById("wrong_otp");
			p.innerHTML = '';
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
			$.get('<?php echo base_url();?>hdfclife/candidates/validate_otp', function( data ) {
				if(data==1){
					$('.check_otp').show();
					$('.check_otp .fa-check').show();
					$('.check_otp .fa-exclamation-triangle').hide();
					p = document.getElementById("wrong_otp");
					p.innerHTML = '';
					$('.send_otp').remove();
					$('#mobile_no').prop('readonly', true);
					$('#otp').prop('readonly', true);
					$("#startClock").remove();
					 window.location = '<?php echo base_url();?>response';
					 return false;
				}
				else if(data==2){
					p = document.getElementById("wrong_otp");
					p.innerHTML = 'You have entered the wrong OTP';
					
					$('.check_otp').show();
					$('.check_otp .fa-check').hide();
					$('.check_otp .fa-exclamation-triangle').show();
					 return false;
				}
				else{
				
				}
			});
			
		}
	});
	 

	/*========== timer of OTP =========*/
		$("body").on('click', '#startClock', function() {
			var counter = 120;
			var remaining=120;
			
			var timer2 = "2:00";
            var interval = setInterval(function() {
            $("#otp_div_id").show();
					$("#startClock").show();
					$("#otp").show();
            
              var timer = timer2.split(':');
              //by parsing integer, I avoid all extra string processing
              var minutes = parseInt(timer[0], 10);
              var seconds = parseInt(timer[1], 10);
              --seconds;
              minutes = (seconds < 0) ? --minutes : minutes;
              seconds = (seconds < 0) ? 59 : seconds;
              seconds = (seconds < 10) ? '0' + seconds : seconds;
              //minutes = (minutes < 10) ?  minutes : minutes;
              //$('.countdown').html(minutes + ':' + seconds);
              document.getElementById('otp_text').innerHTML = 'You can resend OTP after '+minutes + ':' + seconds + ' mins.';
              //if (minutes < 0) clearInterval(interval);
              //check if both minutes and seconds are 0
              if ((seconds <= 0) && (minutes <= 0)) {
                  clearInterval(interval);
                  $("#otp_div_id").hide();
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
					$.get('<?php echo base_url();?>hdfclife/candidates/expire_otp', function( data ) {
						 
					});
              }
              timer2 = minutes + ':' + seconds;
            }, 1000);
			
		});
	
		function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
/*========== timer of OTP end =========*/
	</script>
  <script src="https://kit.fontawesome.com/56aa2db371.js" crossorigin="anonymous"></script>
   </body>
</html>