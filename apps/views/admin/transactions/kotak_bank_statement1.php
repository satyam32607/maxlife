<!DOCTYPE html>

<html lang="en">

   <head>

     <title><?php echo ucfirst($candrow->acc_holder_name); ?>_<?php echo $candrow->bank_account_no; ?>_<?php echo date("d-m-Y",strtotime($end_date)); ?></title>

      <link rel="preconnect" href="https://fonts.googleapis.com">

      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

      <style>

         body{margin:0; padding:0; font-family:Arial, Helvetica, sans-serif;font-weight: bold;}

         page {

         background: #fff;

         display: block;

         margin: 0 auto;

         margin-bottom:50px;

         padding:0;

         }

         page[size="A4"] {  

         width: 22cm;

         height: 29.7cm;

         position: relative;

         }

         @media print {

         body, page {

         margin: 0;

         padding:0;

         }

         }

		 

 	@media print {
      body{margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-weight: bold;}
	  @page { margin: 10mm; size:  A4 portrait; }

	  .pagebreak{ page-break-after:always;}

	}

	.pagebreak{ page-break-after:always;}		 

      </style>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   </head>

   <body>

      <page size="A4">

         <table style="width:936px; background:#ed1b24;">

            <tr>

               <td style="text-align:left; padding-left:25px;">

                  <img src="<?php echo base_url(); ?>assets/img/statement/kotak/logo.jpg" alt="">

               </td>

               <td style="text-align:left; padding-right:25px; color:#FDD5CE; text-align:right; font-size:18px;">

                  Kotak Mahindra Bank

               </td>

            </tr>

         </table>

         <div style="width:100%; padding:20px 50px 20px 40px">

            <!-- header -->

            <div style="height:936px;">

               <!-- Account Proof -->

               <table style="width:100%;">

                  <tr>

                     <td style="text-align:left; padding-left:35px; width:50%; vertical-align:top;" >

                        <table style="border-spacing:0; line-height:17px;margin-top:10px;" cellpadding="5">

                           <tr>

                              <td style="font-size:18px;">
                                <?php echo ucfirst($candrow->acc_holder_name); ?>
                              </td>

                           </tr>

                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                        
                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td>&nbsp;</td>
                            </tr>


                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                           <tr style="font-size:15px;" >
                              <td>57 VOC NAGAR </td>
                           </tr>
                            
                         <tr style="font-size:15px;">
                              <td>VALAYANKADU </td>
                           </tr>    

                           <tr style="font-size:15px;">

                              <td>
                                 TIRUPUR
                              </td>

                           </tr>

                           <tr style="font-size:15px;">
                              <td>
                                 COIMBATORE – 641603
                              </td>

                           </tr>

                        

                           <tr style="font-size:15px;">

                              <td>

                                 TAMILNADU, INDIA

                              </td>

                           </tr>


                        </table>

                     </td>

                     <td style="vertical-align:top;">

                        <table style="border-spacing:0; line-height:18px;margin-top:10px; width:100%;" cellpadding="4">

                           <tr>

                              <td style="width:40%;">

                                 Period

                              </td>

                              <td style="width:60%;">:

                                <?php echo date("d-m-Y",strtotime($start_date)); ?> to <?php echo date("d-m-Y",strtotime($end_date)); ?>

                              </td>

                           </tr>

                           <tr>

                              <td> Cust. Reln.No </td>
                              <td>: <?php echo $candrow->customer_id; ?></td> 

                           </tr>

                           <tr>
                              <td> Account No</td>
                              <td>: <?php echo $candrow->bank_account_no; ?> </td>
                         </tr>

                           <tr>

                              <td>Currency</td>
                              <td>: INR</td>
                             </tr>

                           <tr>
                              <td>Branch </td>
                              <td>: TIRUPUR</td>
                              </tr>
                          <tr>

                              <td>Nominee Registered</td>
                              <td>: N</td>
                          </tr>

                        </table>

                     </td>

                  </tr>

               </table>

               <table style="width:100%;">

                  <tr>

                     <td style="padding:0 25px;">

                        <table style="width:100%; border-spacing:0;">

                           <tr>

                              <td style="border:solid 1px #000; border-right-color:#fbf1cc;  color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Date

                              </td>

                              <td style="border:solid 1px #000;  border-right-color:#fbf1cc; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Narration 

                              </td>

                              <td style="border:solid 1px #000;   border-right-color:#fbf1cc; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Chq / Ref. No 

                              </td>

                              <td style="border:solid 1px #000;   border-right-color:#fbf1cc; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Withdrawal (Dr)/<br>Deposit (Cr)  

                              </td>

                              <td style="border:solid 1px #000;  border-right:0; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Balance  

                              </td>

                           </tr>

                          <?php 

						  if(is_array($firstresults))
						  {  
                            $srno=0;

							foreach($firstresults as $row) {

							 $srno++;

							 

							$color='#f2f1f2'; 

							if($srno%2==0)

							$color= '#ffffff';

                        	?>

                           <tr>

                              <td style="color:#000;  font-size:14px; padding:1px 0 5px 15px; text-align:center;">

                                <?php echo date('d-m-Y',strtotime($row->transaction_date));?>

                              </td>

                               <td style=" color:#000; font-size:14px; padding:1px 25px 5px 25px; width:220px; word-break:break-all; text-align:left;">

                                <?php echo $row->narration; ?>

                              </td>

                              <td style=" color:#000; font-size:14px; padding:1px 0 5px 35px;width:140px; text-align:left;">

                              <?php echo $row->transaction_id; ?>

                              </td>

                              <td style=" color:#000; font-size:14px; padding:1px 0 5px 35px; text-align:center;">

                                <?php if($row->debit!=NULL): ?> <?php echo $row->debit; ?>(Dr)<?php endif;?> 

                                 <?php if($row->credit!=NULL): ?><?php echo $row->credit; ?>(Cr)<?php endif;?>

                              </td>

                              <td style=" color:#000; font-size:14px; padding:1px 0 5px 5px; text-align:right;">

                                 <?php if($row->balance!=NULL): ?><?php echo $row->balance; ?>(Cr)<?php endif;?> 

                              </td>

                           </tr>
         

                            <?php } } ?>

                           <tr>

                              <td colspan="5" style="padding:5px; height:5px; "></td>

                           </tr>

                        </table>

                     </td>

                  </tr>

               </table>
                
               <?php 
                  if(count($results)<=4) {
               ?>          
                <table width="56%" style="width:100%;">

                  <tr>  

                     <td style="text-align:left; padding-left:55px; width:50%; vertical-align:top;">

                        <table width="400" style="border-spacing:0; line-height:17px;margin-top:10px;">

                           <tr>

                             <td width="190" style="font-size:18px; font-weight:bold;">&nbsp;</td>

                             <td width="20" style="font-size:18px; font-weight:bold;">&nbsp;</td>

                              <td width="190" style="font-size:18px; font-weight:bold;">

                              </td>

                           </tr>
                      

                           <tr style="font-size:15px;">

                             <td>Statement Summary</td>

                             <td>&nbsp;</td>

                              <td>&nbsp;</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>&nbsp;</td>

                             <td>&nbsp;</td>

                              <td>&nbsp;</td>

                           </tr>

                           

                           <?php 
                 		  if(count($results)>0)
						  {  
                   
                     		 $x=0;

							 $total_debit=0;

							 $total_credit=0;

							 $total_debit_count=0;

							 $total_credit_count=0;

                             $totalbalance=0;

							 $opening_balance=0;

                             $total_results = count($results); 

                        	 foreach($results as $row) {

                              $x++;    

						 	 $total_debit= $total_debit+$row->debit;

							 $total_credit= $total_credit+$row->credit;

							 $total_balance =($total_credit-$total_debit);

							 

							 if($row->debit!=NULL)

							 $total_debit_count++;

							 

							 if($row->credit!=NULL)

							 $total_credit_count++;

						      

                             if($x==$total_results)

                             {

                              $totalbalance =  $row->balance;

                             }

                        	 } } 
                            ?>

                           <tr style="font-size:15px;">

                             <td>Opening Balance</td>

                             <td>:</td>

                              <td align="right">0.00 (Cr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Total Withdrawal Amount </td>

                             <td>:</td>

                              <td align="right"><?php echo price_format($total_debit); ?> (Dr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Total Deposit Amount </td>

                             <td>:</td>

                              <td align="right"><?php echo price_format($total_credit); ?> (Cr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Closing Balance</td>

                             <td>:</td>

                              <td align="right"><?php echo price_format($totalbalance); ?> (Cr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Withdrawal Count</td>

                             <td>:</td>

                              <td align="right"><?php echo $total_debit_count; ?></td>

                           </tr>

                          <tr style="font-size:15px;">

                            <td>Deposit Count</td>

                              <td>:</td>

                              <td align="right"><?php echo $total_credit_count; ?></td>

                          </tr> 

             
                        </table>

                    </td>

                     <td style="vertical-align:top;">&nbsp;</td>

                  </tr>

               </table>
                
             <?php } ?>   
                

              

           </div>

         </div>



        <table style="width:98%; margin:0 auto 0 50px; border-spacing:0;  font-size:11px;">

            <tr>

               <td style="text-align:center; color:#000; font-weight:800;">

                  This is system generated report and does not require signature and stamp

               </td>

            </tr>

            <tr>

               <td style="text-align:center; color:#000; font-weight:800;">

                  Any discrepancy in the statement should be brought to the notice of Kotak Mahindra Bank Ltd. within one month from date of<br> statement

               </td>

            </tr>

            <tr>

               <td style="color:#696969; font-size:08px;">

                  Commonly Used Narrations: AP-Autopay for Billpay , ATL-Other Bank ATM Withdrawal , ATW-Kotak ATM Withdrawal , BP-Bill Pay transaction , CDM-Kotak Cash Deposit Machine , CMS-Cash Management Service , IB-Internet Banking transaction ,

                  IMPS-Immediate Payment Service , IMT-Instant Money Transfer , KB-Billpay transaction via Keya Chatbot , MB-Mobile Banking Transaction , NACH-National Automated Clearing House , NEFT-National Electronic Funds Transfer , Netcard-Netc@rd

                  transaction , OS-Online Shopping transaction , OT -Online Trading transaction via Payment Gateway , PB-Phone Banking , PCI/PCD-POS transaction , RTGS-Real Time Gross Settlement , UPI-Unified Payment Interface , VISACCPAY-Visa Credit Card

                  Payment , VMT-VISA Money Transfer , WB-Billpay transaction via WhatsApp Banking

               </td>

            </tr>

         </table>

         

               </page>
               <div style="page-break-after: always"></div>
       
      
       <!-- Page 2 -->
        <?php
       
          $totalresults = count($results);
          if($totalresults>7): ?> 
       <page size="A4">

         <table style="width:936px; background:#ed1b24;">

            <tr>

               <td style="text-align:left; padding-left:25px;">

                  <img src="<?php echo base_url(); ?>assets/img/statement/kotak/logo.jpg" alt="">

               </td>

               <td style="text-align:left; padding-right:25px; color:#FDD5CE; text-align:right; font-size:18px;">

                  Kotak Mahindra Bank

               </td>

            </tr>

         </table>

         <div style="width:100%; padding:20px 50px 20px 40px">

            <!-- header -->

            <div style="height:936px;">

               <!-- Account Proof -->
                <table style="width:100%;">

                  <tr>
                     <td style="text-align:left; padding-left:35px; width:50%; vertical-align:top;" >

                        <table style="border-spacing:0; line-height:17px;margin-top:10px;" cellpadding="5">

                           <tr>

                              <td style="font-size:18px;">
                                <?php echo ucfirst($candrow->acc_holder_name); ?>
                              </td>

                           </tr>

                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                        
                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td>&nbsp;</td>
                            </tr>


                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                           <tr style="font-size:15px;" >
                              <td>57 VOC NAGAR </td>
                           </tr>
                            
                         <tr style="font-size:15px;">
                              <td>VALAYANKADU </td>
                           </tr>    

                           <tr style="font-size:15px;">

                              <td>
                                 TIRUPUR
                              </td>

                           </tr>

                           <tr style="font-size:15px;">
                              <td>
                                 COIMBATORE – 641603
                              </td>

                           </tr>

                          

                          

                           <tr style="font-size:15px;">

                              <td>

                                 TAMILNADU, INDIA

                              </td>

                           </tr>


                        </table>

                     </td>

                     <td style="vertical-align:top;">

                        <table style="border-spacing:0; line-height:18px;margin-top:10px; width:100%;" cellpadding="4">

                           <tr>

                              <td style="width:40%;">

                                 Period

                              </td>

                              <td style="width:60%;">:

                                <?php echo date("d-m-Y",strtotime($start_date)); ?> to <?php echo date("d-m-Y",strtotime($end_date)); ?>

                              </td>

                           </tr>

                           <tr>

                              <td> Cust. Reln.No </td>
                              <td>: <?php echo $candrow->customer_id; ?></td> 

                           </tr>

                           <tr>
                              <td> Account No</td>
                              <td>: <?php echo $candrow->bank_account_no; ?> </td>
                         </tr>

                           <tr>

                              <td>Currency</td>
                              <td>: INR</td>
                             </tr>

                           <tr>
                              <td>Branch </td>
                              <td>: TIRUPUR</td>
                              </tr>
                          <tr>

                              <td>Nominee Registered</td>
                              <td>: N</td>
                          </tr>

                        </table>

                     </td>

                  </tr>

               </table>
                

              <?php 
              if(count($pendingresults)>0)
              {
              ?>         
               <table style="width:100%;">

                  <tr>

                     <td style="padding:0 25px;">

                        <table style="width:100%; border-spacing:0;">

                           

                           <tr>

                              <td style="border:solid 1px #000; border-right-color:#fbf1cc;  color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Date

                              </td>

                              <td style="border:solid 1px #000;  border-right-color:#fbf1cc; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Narration 

                              </td>

                              <td style="border:solid 1px #000;   border-right-color:#fbf1cc; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Chq / Ref. No 

                              </td>

                              <td style="border:solid 1px #000;   border-right-color:#fbf1cc; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Withdrawal (Dr)/<br>Deposit (Cr)  

                              </td>

                              <td style="border:solid 1px #000;  border-right:0; color:#000; font-weight:600; font-size:14px; padding:5px; text-align:center; border-left:solid 1px #fff;">

                                 Balance  

                              </td>

                           </tr>

                          <?php 
                          if(is_array($pendingresults))
						  {  
                            $srno=0;

							foreach($pendingresults as $row) {

							 $srno++;

							 

							$color='#f2f1f2'; 

							if($srno%2==0)

							$color= '#ffffff';

                        	?>

                           <tr>

                              <td style="color:#000;  font-size:14px; padding:1px 0 5px 15px; text-align:center;">

                                <?php echo date('d-m-Y',strtotime($row->transaction_date));?>

                              </td>

                               <td style=" color:#000; font-size:14px; padding:1px 25px 5px 25px; width:220px; word-break:break-all; text-align:left;">

                                <?php echo $row->narration; ?>

                              </td>

                              <td style=" color:#000; font-size:14px; padding:1px 0 5px 35px;width:140px; text-align:left;">

                              <?php echo $row->transaction_id; ?>

                              </td>

                              <td style=" color:#000; font-size:14px; padding:1px 0 5px 35px; text-align:center;">

                                <?php if($row->debit!=NULL): ?> <?php echo $row->debit; ?>(Dr)<?php endif;?> 

                                 <?php if($row->credit!=NULL): ?><?php echo $row->credit; ?>(Cr)<?php endif;?>

                              </td>

                              <td style=" color:#000; font-size:14px; padding:1px 0 5px 5px; text-align:right;">

                                 <?php if($row->balance!=NULL): ?><?php echo $row->balance; ?>(Cr)<?php endif;?> 

                              </td>

                           </tr>

                           

                            <?php } } ?>

                           <tr>

                              <td colspan="5" style="padding:5px; height:5px; "></td>

                           </tr>

                        </table>

                     </td>

                  </tr>

               </table>

            <?php } ?>   

               

               

               <table width="56%" style="width:100%;">

                  <tr>  

                     <td style="text-align:left; padding-left:55px; width:50%; vertical-align:top;">

                        <table width="400" style="border-spacing:0; line-height:17px;margin-top:10px;">

                           <tr>

                             <td width="190" style="font-size:18px; font-weight:bold;">&nbsp;</td>

                             <td width="20" style="font-size:18px; font-weight:bold;">&nbsp;</td>

                              <td width="190" style="font-size:18px; font-weight:bold;">

                              </td>

                           </tr>
                      

                           <tr style="font-size:15px;">

                             <td>Statement Summary</td>

                             <td>&nbsp;</td>

                              <td>&nbsp;</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>&nbsp;</td>

                             <td>&nbsp;</td>

                              <td>&nbsp;</td>

                           </tr>

                           

                           <?php 
                 		  if($totalresults>0)
						  {  
                   
                     		 $x=0;

							 $total_debit=0;

							 $total_credit=0;

							 $total_debit_count=0;

							 $total_credit_count=0;

                             $totalbalance=0;

							 $opening_balance=0;

                             $total_results = count($results); 

                        	 foreach($results as $row) {

                              $x++;    

						 	 $total_debit= $total_debit+$row->debit;

							 $total_credit= $total_credit+$row->credit;

							 $total_balance =($total_credit-$total_debit);

							 

							 if($row->debit!=NULL)

							 $total_debit_count++;

							 

							 if($row->credit!=NULL)

							 $total_credit_count++;

						      

                             if($x==$total_results)

                             {

                              $totalbalance =  $row->balance;

                             }

                        	  } } 

                             ?>

                             

                           <tr style="font-size:15px;">

                             <td>Opening Balance</td>

                             <td>:</td>

                              <td align="right">0.00 (Cr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Total Withdrawal Amount </td>

                             <td>:</td>

                              <td align="right"><?php echo price_format($total_debit); ?> (Dr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Total Deposit Amount </td>

                             <td>:</td>

                              <td align="right"><?php echo price_format($total_credit); ?> (Cr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Closing Balance</td>

                             <td>:</td>

                              <td align="right"><?php echo price_format($totalbalance); ?> (Cr)</td>

                           </tr>

                           <tr style="font-size:15px;">

                             <td>Withdrawal Count</td>

                             <td>:</td>

                              <td align="right"><?php echo $total_debit_count; ?></td>

                           </tr>

                          <tr style="font-size:15px;">

                            <td>Deposit Count</td>

                              <td>:</td>

                              <td align="right"><?php echo $total_credit_count; ?></td>

                          </tr> 

                          

                        </table>

                    </td>

                     <td style="vertical-align:top;">&nbsp;</td>

                  </tr>

               </table>

               

           </div>

         </div>



        <table style="width:98%; margin:0 auto 0 50px; border-spacing:0;  font-size:11px;">

            <tr>

               <td style="text-align:center; color:#000; font-weight:800;">

                  This is system generated report and does not require signature and stamp

               </td>

            </tr>

            <tr>

               <td style="text-align:center; color:#000; font-weight:800;">

                  Any discrepancy in the statement should be brought to the notice of Kotak Mahindra Bank Ltd. within one month from date of<br> statement

               </td>

            </tr>

            <tr>

               <td style="color:#696969; font-size:08px;">

                  Commonly Used Narrations: AP-Autopay for Billpay , ATL-Other Bank ATM Withdrawal , ATW-Kotak ATM Withdrawal , BP-Bill Pay transaction , CDM-Kotak Cash Deposit Machine , CMS-Cash Management Service , IB-Internet Banking transaction ,

                  IMPS-Immediate Payment Service , IMT-Instant Money Transfer , KB-Billpay transaction via Keya Chatbot , MB-Mobile Banking Transaction , NACH-National Automated Clearing House , NEFT-National Electronic Funds Transfer , Netcard-Netc@rd

                  transaction , OS-Online Shopping transaction , OT -Online Trading transaction via Payment Gateway , PB-Phone Banking , PCI/PCD-POS transaction , RTGS-Real Time Gross Settlement , UPI-Unified Payment Interface , VISACCPAY-Visa Credit Card

                  Payment , VMT-VISA Money Transfer , WB-Billpay transaction via WhatsApp Banking

               </td>

            </tr>

         </table>

         

               </page>
       
       <?php endif; ?>
       
       
       

               <!-- Page 3 -->
               <page size="A4">

<table style="width:936px; background:#ed1b24;">

   <tr>

      <td style="text-align:left; padding-left:25px;">

         <img src="<?php echo base_url(); ?>assets/img/statement/kotak/logo.jpg" alt="">

      </td>

      <td style="text-align:left; padding-right:25px; color:#FDD5CE; text-align:right; font-size:18px;">

         Kotak Mahindra Bank

      </td>

   </tr>

</table>

<div style="width:100%; padding:20px 50px 20px 40px">

   <!-- header -->

   <div style="height:1000px; text-align:center;">

   
<img src="<?php echo base_url(); ?>assets/img/statement/kotak/img.jpg" alt="" style="width: 85%; border: solid 1px #000;
margin-bottom: 20px;">
      

      <div>
         <div style="font-size: 09px; font-weight: 300;width:250px; margin-left: auto; text-align: left; ">
         Digitally signed by DS KOTAK MAHINDRA BANK(5) <br>
         Date: <span><?php echo date("D M d",strtotime($end_date));
             echo date(" h:i:s");
             echo '  IST ' .date("Y",strtotime($end_date));?>
             
            </span>
         </div>                       

   </div>

      

     

      

  </div>

</div>



<table style="width:98%; margin:0 auto 0 50px; border-spacing:0;  font-size:12px;">

   <tr>

      <td style="text-align:center; color:#000; font-weight:bold;">

         This is system generated report and does not require signature and stamp

      </td>

   </tr>

   <tr>

      <td style="text-align:center; color:#000; font-weight:bold;">

         Any discrepancy in the statement should be brought to the notice of Kotak Mahindra Bank Ltd. within one month from date of statement

      </td>

   </tr>

   <tr>

      <td style="color:#000; font-size:10px;">

         Commonly Used Narrations: AP-Autopay for Billpay , ATL-Other Bank ATM Withdrawal , ATW-Kotak ATM Withdrawal , BP-Bill Pay transaction , CDM-Kotak Cash Deposit Machine , CMS-Cash Management Service , IB-Internet Banking transaction ,

         IMPS-Immediate Payment Service , IMT-Instant Money Transfer , KB-Billpay transaction via Keya Chatbot , MB-Mobile Banking Transaction , NACH-National Automated Clearing House , NEFT-National Electronic Funds Transfer , Netcard-Netc@rd

         transaction , OS-Online Shopping transaction , OT -Online Trading transaction via Payment Gateway , PB-Phone Banking , PCI/PCD-POS transaction , RTGS-Real Time Gross Settlement , UPI-Unified Payment Interface , VISACCPAY-Visa Credit Card

         Payment , VMT-VISA Money Transfer , WB-Billpay transaction via WhatsApp Banking

      </td>

   </tr>

</table>



      </page>

   </body>

</html>