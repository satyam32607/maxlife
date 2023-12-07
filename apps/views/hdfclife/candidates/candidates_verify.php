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
				$attributes = array('id' => 'form1','name' => 'form1','class' => 'application_form1','role' => 'form','autocomplete' => 'off','novalidate');
				echo form_open(base_url().'hdfclife/candidates/hdfclife_verify', $attributes);
				 ?>
            <div class="row">
             <div class="col-12">
                <!-- BEGIN Notification -->
                <?php $this->load->view("includes/notification.php");?>
                <!-- END Notification -->
               </div>
               
              <div class="col-12 form-heading">
                  Personal Details
               </div>
               
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label for="application-number" class="mr-sm-2">Applicant Full Name</label>
                  <input type="text" class="form-control mb-2"  readonly id="applicant_name" name="applicant_name" value="<?php echo $row->applicant_full_name; ?>">
               </div>
               <div class="col-md-12 d-md-flex my-2 main-form align-items-center">
                  <label for="application-number" class="mr-sm-2">Application Number</label>
                  <input type="text" class="form-control mb-2" readonly id="application_no" name="application_no"  value="<?php echo $row->application_no; ?>">
               </div>
               
                 
               <div class="col-md-6 d-md-flex my-2 main-form align-items-center">
                  <label for="datepicker" class="mr-sm-2">Date of Birth</label>
                  <input type="text" id="datepicker" placeholder="DD/MM/YYYY" class="date_of_birth"  name="date_of_birth" required  />
               </div>
               
            </div>
            <div class="row mt-5 justify-content-between">
               <div class="col-md-4 note">
                  Please enter your Date of Birth & Continue.
               </div>
               <div class="col-md-2 text-right">
                  <button type="submit" class="btn cont-btn">Continue</button>
               </div>
            </div>
          <?php echo form_close(); ?>
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
	  
	   $("#datepicker").datepicker({
		  changeMonth: true,startDate: '-65y',endDate: '-10y',
		  format: 'dd/mm/yyyy',
		  autoclose: true,
		  uiLibrary: 'bootstrap4',
		}).on('changeDate', function(e) {
		});	
    </script>
      <script>
	// Disable form submissions if there are invalid fields
	(function() {
	  'use strict';
	  window.addEventListener('load', function() {
		// Get the forms we want to add validation styles to
		var forms = document.getElementsByClassName('application_form1');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		  form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			  event.preventDefault();
			  event.stopPropagation();
			}
			form.classList.add('was-validated');
		  }, false);
		});
	  }, false);
	})();
	</script>
   </body>
</html>