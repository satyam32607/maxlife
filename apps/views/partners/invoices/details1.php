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

    <body class="page-container-bg-solid">
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
                                       <li> <a href="<?php echo base_url(); ?>partners/dashboard">Dashboard</a> <i class="fa fa-circle"></i> </li>
                                        <li> <a href="<?php echo base_url(); ?>partners/invoices/details"><?php echo $main_heading; ?></a> <i class="fa fa-circle"></i> </li>
                                        <li> <span><?php echo $heading; ?></span> </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        <div class="invoice">
                                            <div class="row invoice-logo">
                                                <div class="col-xs-6 invoice-logo-space">
                                                   <!-- <img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo-light.png" class="img-responsive" alt="" /> --></div>
                                                <div class="col-xs-6">
                                                    <p> <?php echo invoice_no_format.$rowinvoice->invoice_no; ?> / <?php echo date('d M, Y',strtotime($rowinvoice->invoice_date));?>
                                                        <span class="muted"> <?php echo $rowuser->name; ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr/>
                                            
                                             <div class="row">
                                              <div class="col-md-12 text-center"><h6> <strong>TAX INVOICE U/S 28 OF GST ACT, 2016</strong></h6></div>
                                             </div>
                                           
                                            
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h3>Client:</h3>
                                                    <ul class="list-unstyled">
                                                    
 

                                                        <li> DREAM WEAVERS EDUTRACK PRIVATE LIMITED</li>
                                                        <li> 4th Floor, SCO 1-12, PPR Mall,</li>
                                                        <li> Mithapur Road, Goal Market </li>
                                                        <li> Jalandhar, Punjab </li>
                                                        <li> Pin Code: 144001 </li>
                                                    
                                                    </ul>
                                                </div>
                                                <div class="col-xs-4">
                                                   <!-- <h3>About:</h3>
                                                    <ul class="list-unstyled">
                                                        <li> Drem psum dolor sit amet </li>
                                                        <li> Laoreet dolore magna </li>
                                                        <li> Consectetuer adipiscing elit </li>
                                                        <li> Magna aliquam tincidunt erat volutpat </li>
                                                        <li> Olor sit amet adipiscing eli </li>
                                                        <li> Laoreet dolore magna </li>
                                                    </ul>-->
                                                </div>
                                                <div class="col-xs-4 invoice-payment">
                                                   
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <strong>PAN NO: </strong> AAECM4400H </li>
                                                        <li>
                                                            <strong>GSTN Number: </strong>03AAECM4400H1Z2 </li>
                                                        <li>
                                                            <strong>Invoice Number:</strong> <?php echo invoice_no_format.$rowinvoice->invoice_no; ?>/ 23-24 </li>
                                                        <li>
                                                            <strong>Invoice Date:</strong> <?php echo date('d M, Y',strtotime($rowinvoice->invoice_date));?> </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th> # </th>
                                                                <th> Services </th>
                                                                <th class="hidden-xs"> HSN/SAC  </th>
                                                                <th class="hidden-xs"> Quantity </th>
                                                                <th class="hidden-xs"> Unit Cost </th>
                                                                <th> Total </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                         <?php 
														if(is_array($results))
														{  
														$srno=0;
														$total_amt=0; 
														foreach($results as $row) {
														$srno++;
														
													     $totalamt = ($row->price*$row->qty);
														 $total_amt = $total_amt+$totalamt
													  ?>   
                                								<tr>
                                                                <td><?php echo $srno; ?>
                                                                <td><?php echo $row->service_name; ?></td>
                                                                <td class="hidden-xs"><?php echo $row->hsn_code; ?> </td>
                                                                <td class="hidden-xs"> <?php echo $row->qty; ?> </td>
                                                                <td class="hidden-xs"> <?php echo price_format($row->price); ?>  </td>
                                                                <td> <?php echo price_format($totalamt); ?> </td>
                                                            </tr>
                                                           <?php } } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="well">
                                                    
                                                    <?php
													if($rowuser->state_id!='0')
														  {
														  $staterow = get_table_info('state','state_id',$rowuser->state_id);
														  $state_name = $staterow->state_name;
														  }
														  else
														  {  $state_name='';
														  }
														  
														  if($rowuser->city_id!='0')
														  {
														  $cityrow = get_table_info('city','city_id',$rowuser->city_id);
														  $city_name= '/'.$cityrow->city_name;
														  }
														  else
														  {  $city_name='';
														  }
													?>
                                                        <address>
                                                            <strong> <?php echo $rowuser->name; ?></strong>
                                                            <br/> <?php echo $rowuser->first_name.' '.$rowuser->last_name; ?>
                                                            <br/> <?php echo $state_name.$city_name; ?>
                                                            <br/><?php echo $rowuser->pin_code; ?>, <?php echo $rowuser->address; ?><br>
                                                            <abbr title="Phone">Contact No.:</abbr> <?php echo $rowuser->mobile_no1; ?></address>
                                                            
                                                            <strong> Pan No: <?php echo $rowuser->pan_no; ?><br>
                                                             GSTN Number: <?php echo $rowuser->gst_no; ?><br>
                                                             </strong>
                                                       
                                                            <br/>
                                                           Email address: <?php echo $rowuser->email; ?>
                                                            <address>
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8 invoice-block">
                                                    <ul class="list-unstyled amounts">
                                                     <?php 
													   $gst_amt = ($total_amt*18)/100;
													   $grant_total = ($total_amt+$gst_amt);
											  		 ?>
                                                        <li>
                                                            <strong>Sub - Total amount:</strong> <?php echo price_format($total_amt); ?> </li>
                                                       
                                                            <strong>GST: 18%  </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php  echo price_format($gst_amt);  ?></li>
                                                        <li>
                                                            <strong>Grand Total:</strong> <?php echo price_format($grant_total); ?> </li>
                                                    </ul>
                                                 
                                                    
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
                       
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
             <?php $this->load->view("includes/footer.php");?>
             
        </div>
      
	<?php $this->load->view("includes/scripts.php"); ?>
    
    </body>

</html>