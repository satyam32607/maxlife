<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?php echo ucfirst($candrow->acc_holder_name); ?>_<?php echo $candrow->bank_account_no; ?>_<?php echo date("d-m-Y",strtotime($end_date)); ?></title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <style>
         body{ padding:0; font-family:"Arial";font-size: 14px;}
         page {
         background: #fff;
         display: block;
         margin: 0 auto;
         margin-bottom:8rem;
         padding:0;
         }
         page[size="A4"] {  
         width: 22cm;
         height: 29.7cm;
         position: relative;
         }
         @media print {
         body, page {
         margin: 0 0;
         padding:0;
         }
         }
      </style>
   </head>
   <body>
      <page size="A4">
            <div style="width:100%; padding:20px 50px 20px 40px"> 
           <table style="width:936px; background:#fff;">
               
             <tr>
               <td height="100" colspan="2">&nbsp;</td>
             </tr>
               
            <tr>
               <td style="text-align:left; padding-left:25px;">
                  <img src="<?php echo base_url(); ?>assets/img/statement/icici/logo.svg" alt="ICICI Bank">
               </td>
               <td style="text-align:left; padding-right:25px; color:#fff; text-align:right; font-size:18px;">
                 ICICI Bank
               </td>
            </tr>
               
             <tr>
               <td  height="100" colspan="2">&nbsp;</td>
             </tr>
               
         </table>
          
          
           <table style="width:936px; background:#fff;">
            <tr>
                <td width="25%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="40%" style="font-family:Arial; font-size:15px; font-weight:600;">Statement Date : <?php echo date("d-m-Y"); ?></td>
                <td width="10%" align="center">&nbsp;</td>
            </tr>
               
           <tr>
               <td height="50" colspan="4">&nbsp;</td>
             </tr>
               
         </table>
          
          
           <table style="width:936px; background:#fff;">
            <tr>
                <td width="15%">&nbsp;</td>
                <td width="45%" align="center" style="font-family:Arial; font-size:15px; font-weight:600;">Detailed Statement</td>
                <td width="40%" align="center">&nbsp;</td>
            </tr>
               
           <tr>
               <td height="50" colspan="3">&nbsp;</td>
             </tr>
               
         </table>

                        <!-- Account Proof -->
                          <?php 
						  if(is_array($results))
						  {  
                               
							 $x=0;
							 $total_debit=0;
							 $total_credit=0;
                             $totalbalance=0;
							 $opening_balance=0;
                             $total_results = count($results); 
                        	 foreach($results as $row) {
                                 
                            $x++;
                       	    if($x=='1')
                             {
							  $opening_balance =$row->balance;
                             }
							 
							 
							 $total_debit= $total_debit+$row->debit;
							 $total_credit= $total_credit+$row->credit;
							 $total_balance =($total_credit-$total_debit);
                              
                             if($x==$total_results)
                             {
                                 
                              $totalbalance =  $row->balance;
                             }
                                      
							  } } 
                             ?>
                
               <table style="width:100%;">
                  <tr>
                     <td>
                        <table style="border-spacing:0; line-height:18px;margin-top:10px; width:100%;font-family:Arial; font-size:16px; font-weight:600;" cellpadding="3" cellspacing="2">
                           <tr>
                              <td width="50%" style="font-weight:bold; width:50%;">
                                Card Number 
                              </td>
                              <td width="2%" style="font-weight:bold;width:2%;">:</td>
                              <td width="48%" style="width:48%;">
                                <?php echo $candrow->bank_account_no; ?>
                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold;">
                                A/C 
                              </td>
                              <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 <?php echo $candrow->bank_account_no; ?> 
                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold;">
                                IFSC 
                              </td>
                              <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 <?php echo $candrow->ifsc_code; ?> 
                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold;">
                                 Card Status
                              </td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 ACTIVE
                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold;">
                                 Name of Corporate
                              </td>
                              <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                <?php echo $candrow->employer_bank_name; ?>

                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold; vertical-align:top;">
                                 Agent/Branch name                                                                            
                              </td>
                              <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 ICICI
                                
                              </td>
                           </tr>
                           <tr>
                             <td style="font-weight:bold; vertical-align:top;">
                                Closing balance                                                                                   
                              </td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 INR <?php echo price_format($opening_balance); ?>
                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold;">
                                Name of A/C Holder     
                              </td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 <?php echo ucfirst($candrow->acc_holder_name); ?>
                              </td>
                           </tr>
                           <tr>
                              <td style="font-weight:bold;">
                                Type of Address
                              </td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 Mailing
                              </td>
                           </tr>
                         <tr>
                              <td style="font-weight:bold;">
                                Bill to Address of The Customer
                              </td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 <?php echo $candrow->address; ?> State: <?php echo $candrow->state; ?> City: <?php echo $candrow->city; ?> PIN Code: <?php echo $candrow->pincode; ?> 
                              </td>
                           </tr> 
                            
                             <tr>
                              <td style="font-weight:bold;">
                                State Code
                              </td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                              <td>
                                 23
                              </td>
                              </tr>
                            
                            
                            
                             <tr>
                               <td style="font-weight:bold;">GSTIN of Customer</td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                               <td>NA</td>
                              </tr> 
                            
                             <tr>
                               <td style="font-weight:bold;">GSTIN of ICICI</td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                               <td>27AAACI1195H3ZK</td>
                              </tr> 
                            
                            <tr>
                               <td style="font-weight:bold;">Bill From Address of ICICI</td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                               <td>CICI Bank Tower, Ground Floor, BKC Road , Bandra Kurla 
Complex, Mumbai Suburban State:MAHARASHTRA City:MUMBAI PIN Code:400051</td>
                              </tr>
                            
                             <tr>
                               <td style="font-weight:bold;">Place of Supply</td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                               <td>MADHYA PRADESH</td>
                             </tr> 
                            
                            
                             <tr>
                               <td style="font-weight:bold;">HSN Code</td>
                               <td style="font-weight:bold;">&nbsp;:</td>
                               <td>997112</td>
                             </tr> 
                              
                              
                            
                        </table>
                     </td>
                  </tr>
               </table>
            
          <table border="0" cellspacing="0" cellpadding="" width=963 style='width:936px;margin-left:6.1pt;border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:.4pt 0cm 0cm .35pt; border-spacing:0;margin:20px 20px 10px;'>
              
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:21.65pt'>
  <td width=87 valign=top style='width:65.55pt;border:solid black 1.0pt;
  mso-border-top-alt:1.0pt;mso-border-left-alt:1.0pt;mso-border-bottom-alt:
  .5pt;mso-border-right-alt:.5pt;mso-border-color-alt:black;mso-border-style-alt:
  solid;background:#E5E5E5;padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:1.9pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Sr No </span></p>
  </td>
  <td width=88 valign=top style='width:65.75pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .75pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.15pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Tran Date </span></p>
  </td>
  <td width=88 valign=top style='width:65.7pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .75pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.75pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .5pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.2pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Value Date </span></p>
  </td>
  <td width=87 valign=top style='width:65.55pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  mso-border-top-alt:solid black 1.0pt;background:#E5E5E5;padding:.4pt 0cm 0cm .35pt;
  height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-align:justify;text-justify:
  inter-ideograph;text-indent:0cm'><span style='font-size:7.0pt;mso-bidi-font-size:
  11.0pt;line-height:107%;font-weight:normal'>Unique <span class=SpellE>Txn</span>
  ID (Invoice No) </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .75pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Tran Description </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .75pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.75pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .5pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.15pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Tran Currency </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .75pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Tran Amount </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .75pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.75pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .5pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:1.9pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Billing Currency </span></p>
  </td>
  <td width=88 valign=top style='width:65.8pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  mso-border-top-alt:solid black 1.0pt;background:#E5E5E5;padding:.4pt 0cm 0cm .35pt;
  height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Billing Amount </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  .75pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Credit/Debit </span></p>
  </td>
  <td width=87 valign=top style='width:65.55pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .75pt;mso-border-top-alt:
  1.0pt;mso-border-left-alt:.75pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  1.0pt;mso-border-color-alt:black;mso-border-style-alt:solid;background:#E5E5E5;
  padding:.4pt 0cm 0cm .35pt;height:21.65pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:1.95pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>Tran Status </span></p>
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
 <tr style='mso-yfti-irow:1;height:46.15pt'>
  <td width=87 valign=top style='width:65.55pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  mso-border-left-alt:solid black 1.0pt;padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:1.9pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'> <?php echo $srno; ?> </span></p>
  </td>
  <td width=88 valign=top style='width:65.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-right-alt:solid black .75pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.15pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'><?php echo date('d/m/Y',strtotime($row->transaction_date));?></span></p>
  </td>
  <td width=88 valign=top style='width:65.7pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .75pt;mso-border-alt:solid black .5pt;
  mso-border-left-alt:solid black .75pt;padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.2pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>- </span></p>
  </td>
  <td width=87 valign=top style='width:65.55pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-align:justify;text-justify:
  inter-ideograph;text-indent:0cm'><span style='font-size:7.0pt;mso-bidi-font-size:
  11.0pt;line-height:107%;font-weight:normal'><?php echo $row->transaction_id; ?> </span></p>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>3 </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-right-alt:solid black .75pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span class=SpellE><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'><?php echo $row->narration; ?></span></span><span style='font-size:7.0pt;mso-bidi-font-size:
  11.0pt;line-height:107%;font-weight:normal'> </span></p>

  
  </td>
  <td width=88 valign=top style='width:65.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .75pt;
  mso-border-alt:solid black .5pt;mso-border-left-alt:solid black .75pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.15pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>INR </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-right-alt:solid black .75pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal align=right style='margin-top:0cm;margin-right:1.75pt;
  margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:right;
  text-indent:0cm'><span style='font-size:7.0pt;mso-bidi-font-size:11.0pt;
  line-height:107%;font-weight:normal'><?php if($row->debit!=NULL): ?><?php echo $row->debit; ?><?php endif;?> <?php if($row->credit!=NULL): ?> <?php echo $row->credit; ?> <?php endif;?> </span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .75pt;
  mso-border-alt:solid black .5pt;mso-border-left-alt:solid black .75pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:1.9pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>INR </span></p>
  </td>
  <td width=88 valign=top style='width:65.8pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal align=right style='margin-top:0cm;margin-right:1.9pt;
  margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:right;
  text-indent:0cm'><span style='font-size:7.0pt;mso-bidi-font-size:11.0pt;
  line-height:107%;font-weight:normal'><?php if($row->debit!=NULL): ?><?php echo $row->debit; ?><?php endif;?> <?php if($row->credit!=NULL): ?> <?php echo $row->credit; ?> <?php endif;?></span></p>
  </td>
  <td width=88 valign=top style='width:65.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-right-alt:solid black .75pt;
  padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:2.05pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'> <?php if($row->debit!=NULL): ?> <?php echo $row->debit; ?>Debit<?php endif;?>
           <?php if($row->credit!=NULL): ?><?php echo $row->credit; ?>Credit<?php endif;?>
      </span></p>
  </td>
  <td width=87 valign=top style='width:65.55pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .75pt;
  mso-border-top-alt:.5pt;mso-border-left-alt:.75pt;mso-border-bottom-alt:.5pt;
  mso-border-right-alt:1.0pt;mso-border-color-alt:black;mso-border-style-alt:
  solid;padding:.4pt 0cm 0cm .35pt;height:46.15pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
  margin-left:1.95pt;margin-bottom:.0001pt;text-indent:0cm'><span
  style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:107%;font-weight:
  normal'>SETTLED </span></p>
  </td>
 </tr>
              
  <?php } } ?>
              
 
              

</table>
       
          <div style="width:936px;">
            <table style="width:100%;">
                
                 <tr>
                  <td>&nbsp;&nbsp;</td>
                  </tr>
                
                <tr>
                  <td style="padding:3px; font-family:Arial; font-size:15px; font-weight:600;">
                   Total No of Records:  <?php echo $total_results; ?>
                  </td>
                 </tr>
                
               
               <tr>
                  <td style="padding:3px; font-family:Arial; font-size:15px; font-weight:600;">
                    Goods and Service Tax (GST) has been introduced by Govt. w.e.f. July 1, 2017. Accordingly GST rate of 18 % will be levied on 
all charges and fees applicable on cards. For fund transfer the IFSC code ICIC0000104 and A/c <?php echo $candrow->bank_account_no; ?> is to be 
used. This is a computer generated statement and does not require signature and bank logo.
                  </td>
               </tr>
                
               <tr>
                  <td height="30">&nbsp;</td>
               </tr>
               <tr>
                  <td align="center" style="padding:3px; font-family:Arial; font-size:13px; font-weight:600;">
                    *** END OF REPORT **
                  </td>
               </tr>
            </table>
         </div>
          
          
       
         
         <!-- Statement -->
  <!--       
         <div style="width:936px;">
            <table style="width:100%;">
               <tr>
                  <td style="text-align:right;padding:3px; font-family:Arial; font-size:13px; font-weight:600;">
                     Page : 2/2
                  </td>
               </tr>
               <tr>
                  <td style="border:solid 1px #000; padding:3px; font-family:Arial; font-size:13px; font-weight:600;">
                     For any queries of details on out products & services, please call our Phone Banking Numbers: 1860-267-7777 (Within India) and
                     +91 22 4406 6666 (Outside India) or write to us at "reachus@indusind.com" or visit us at www.indusind.com
                     * Service Tax Registration Number AAACI1314GST001. * Any discrepancies in this statement may kindly be brought to the notice
                     of the Bank within seven days. * This is a computer generated statement and so valid without signature.
                     Registered office: INDUSIND BANK LTD, 2401, General Thimmayya Road (Cantonment), Maharashtra Pune-411001.
                     Corporate Identity Number (CIN): L65191PN1994PLC076333
                  </td>
               </tr>
            </table>
         </div>-->
          </div>     
      </page>
    <!--  <div style="page-break-after: always;"></div>
       <page size="A4">
         <table style="width:936px; background:#981c1e;">
            <tr>
               <td style="text-align:left; padding-left:25px;">
                  <img src="images/logo.svg" alt="" style="width:250px;">
               </td>
               <td style="padding-right:25px; color:#fff; text-align:right; font-size:20px; font-style:italic;">
                  Statement Of Account
               </td>
            </tr>
         </table>
         <!-- name -->
          <!-- <div style="width:936px; height:1067px;">
          <div style="padding-top:30px; padding-bottom:10px;">
             <table style="width:100%;  border-collapse: collapse;">
               <tr>
                  <td style="font-family:Arial; font-size:12px; width:50%; padding-right:10px; text-transform:uppercase; color:#0000ff; font-size:14px; font-weight:bold; width:400px;">
                     <table style="font-size:13px; font-weight:600; width:100%;  height:137px; border-collapse: collapse; border:solid 2px #000;">
                        <tr>
                           <td style="padding:10px; font-weight:bold;">Vivek Sama</td>
                        </tr>
                        <tr>
                           <td style="padding:10px; font-size:13px; font-weight:bold; color:#000; font-weight:normal">H No 155 master tara chand nagar jalandhar</td>
                        </tr>
                        <tr>
                           <td style="padding:10px; font-weight:600; color:#000; font-weight:normal"> jalandhar-144001
                              <br>
                              Punjab, India
                           </td>
                        </tr>
                     </table>
                  </td>
                   
                  <td style="font-family:Arial; font-size:13px; width:50%; padding-left:10px; font-size:14px; width:400px;">
                     <table style="font-size:13px; width:100%; border-collapse: collapse; border:solid 2px #000;">
                        <tr>
                           <td style="padding:2px;">Generation Date</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;">16-Dec-2022</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Period</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;">1-Jan-2021 To 15-Dec-2022</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Customer Id</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;">30340536</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Account Number</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;">10002327515</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Account Type</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px; text-transform:uppercase;">Saving Account-indus Maxima</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Curenncy</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px; text-transform:uppercase;">INR</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Effective Available Balance</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px; text-transform:uppercase;">870.29</td>
                        </tr>
                     </table>
                  </td>
                   
               </tr>
            </table>
          </div>
           
       
         </div>
         <!-- Footer-->
         
         <!--<div style="width:936px;">
            <table style="width:100%;">
               
               <tr>
                  <td style="border:solid 1px #000; padding:3px; font-family:Arial; font-size:13px; font-weight:600;">
                    Goods and Service Tax (GST) has been introduced by Govt. w.e.f. July 1, 2017. Accordingly GST rate of 18 % will be levied on 
all charges and fees applicable on cards. For fund transfer the IFSC code ICIC0000104 and A/c 4629525404035544 is to be 
used. This is a computer generated statement and does not require signature and bank logo.
                  </td>
               </tr>
                
               <tr>
                  <td height="30">&nbsp;</td>
               </tr>
               <tr>
                  <td align="center" style="padding:3px; font-family:Arial; font-size:13px; font-weight:600;">
                    *** END OF REPORT **
                  </td>
               </tr>
            </table>
         </div>-->
       <!-- </page>-->
   </body>
</html>