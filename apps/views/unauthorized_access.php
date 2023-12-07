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
       
         <div class="row">
         
          <div class="col-md-12 validations-bg text-center">
            <img src="<?php echo base_url(); ?>assets/img/invalid.png" alt="invalid">
            <h5 class="validations-txt">Unauthorized.</h5>
          </div>
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