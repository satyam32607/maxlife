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

                <div class="col-md-12">

                  <ul class="page-breadcrumb breadcrumb">

                    <li> <a href="<?php echo base_url(); ?>dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>

                    <li> <a href="<?php echo base_url() ?>admin/invoices/view/<?php echo $invoice_id; ?>"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>

                    <li> <span><?php echo $heading; ?></span> </li>
                    <a class="btn btn-circle btn-success pull-right m-b-20" href="<?php echo base_url() ?>admin/invoices/form/<?php echo $invoice_id; ?>">Add Invoice Payment</a>
                  </ul>

                </div>

               </div>

              

              <!-- END PAGE BREADCRUMBS --> 

              <!-- BEGIN PAGE CONTENT INNER -->

              <div class="page-content-inner">

                <div class="row">

                  <div class="col-md-12">

                    <?php $this->load->view("includes/notifications.php");?>

                    <!-- BEGIN TABLE PORTLET-->

                    <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption">

                            <i class="fa fa-envelope"></i> <?php echo $heading; ?>: <?php echo '('.$num_rows.')'; ?></div>
                        </div>

                    <div class="portlet-body">

                        <div class="table-responsive">

                              <table class="table table-bordered table-striped table-condensed flip-content">

                                <thead>

                              <tr>

                              <th> Srno. </th>

                              <th> Transaction Id</th>

                              <th> Transaction Amount</th>

                              <th> Transaction Date</th>

                              <th> Transaction Detail</th>

                               <th> Payment Mode</th>

                              <th> Created By</th>

                              <th> Transaction Status </th>

                             </tr>

                                </thead>

                                <tbody>

							   <?php 

                                if(is_array($results))

                                {  $srno=0; 

                                foreach($results as $row) {

                                $srno++;
								 if($row->transaction_status=="P")
                                 {
                                    $status     =   "Pending";
                                 }
                                 else
                                 {
                                    $status     =   "Confirmed";
                                 }

						        ?>    

                                    <tr>

                                    <td><?php echo $srno; ?> </td>

                                    <td><?php echo $row->transaction_id; ?></td>

                                    <td><?php echo $row->transaction_amount;?></td>

                                    <td><?php echo date('d M, Y',strtotime($row->transaction_date));?></td>

                                    <td><?php echo $row->transaction_detail;?></td>

                                    <td><?php echo $row->payment_mode;?></td>
                                    
                                    <td><?php echo $row->name;?></td>
                                    <?php if($row->transaction_status!="P"){ ?>
                                        <td><?php echo $status;?></td>
                                    <?php } else { ?>
                                        <td>
                                            <select onchange="changeStatus('<?php echo $row->invoice_payment_id; ?>',this)">
                                                <option value="P">Pending</option>
                                                <option value="C">Confirmed</option>
                                            </select>
                                        </td>
                                    <?php }?>
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

<script>
    function changeStatus(invoicePaymentId,selectObject)
    {
        if(confirm("Are you sure ?"))
        {
          var baseUrl           =   "<?php echo base_url() ?>";
          var selectVal   =   $(selectObject).val();
          $.ajax({
            url: `${baseUrl}admin/Invoices/updatePaymentStatus`, // Replace with your URL
            type: 'GET', // GET or POST, depending on your method
            data: {
              invoice_payment_id: invoicePaymentId, // Replace with your data keys and values
              payment_status: selectVal
            },
            success: function(response) {
              $(selectObject).parent("td").text("Confirmed");
                // This function is called if the request succeeds
                // 'response' contains the data returned from the server
                
            },
            error: function(xhr, status, error) {
                // This function is called if the request fails
                console.log('Error: ' + error);
            }
        });
      }
      else
      {
          $(selectObject).find(`option[value="P"]`).prop("selected", true);
      }
    }
</script>

</body>

</html>