<!DOCTYPE html>
<html lang="en">
   <head>
     <title><?php echo isset($title) ? $title : web_title ; ?></title>
      <meta content="width=device-width, initial-scale=1" name="viewport" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/theme/custom.css">
      <link href="<?php echo base_url(); ?>assets/css/theme/gijgo.min.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <div class="container box-container validations-bx">
         <!-- Header -->
         <div class="row mb-5 justify-content-between" id="header">
                <div class="col-md-9">
                  <h1 class="application">Point of Sales Person (POSP) Application Form</h1>
                </div>
                <div class="col-md-3 logo">
                   <img src="<?php echo base_url(); ?>assets/img/logo.png" class="img-fluid" alt="HDFC Life Insurance" title="HDFC Life Insurance">
                </div>
             </div>
     
     
         <div class="row">
         <?php if($this->session->userdata('common_message')=='1'): ?>
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/invalid.png" alt="invalid">
            <h5 class="validations-txt">Page not found.</h5>
          </div>
          <?php endif; ?>
          
           <?php if($this->session->userdata('common_message')=='2'): ?>
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/updated.png" alt="Updates">
            <h5 class="validations-txt">Already updated.</h5>
          </div>
          <?php endif; ?>
          
           <?php if($this->session->userdata('common_message')=='3'): ?>
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/deactivated.png" alt="Deactivated">
            <h5 class="validations-txt"> De-activated.</h5>
          </div>
          <?php endif; ?>
            
           <?php if($this->session->userdata('common_message')=='4'): ?> 
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/expire.png" alt="Expired">
            <h5 class="validations-txt">Validity has been expired.</h5>
          </div>
           <?php endif; ?>
           
          <?php if($this->session->userdata('common_message')=='5'): ?>
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/updated.png" alt="Updates">
            <h5 class="validations-txt">Your application consent has been updated successfully.</h5>
          </div>
          <?php endif; ?>
          
          <?php if($this->session->userdata('common_message')=='0'): ?>
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/invalid.png" alt="invalid">
            <h5 class="validations-txt">Your session has been expired.</h5>
          </div>
          <?php endif; ?>
          
         </div>

      </div>
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- Date Picker -->
      <script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>
     </body>
</html>