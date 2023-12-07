<!DOCTYPE html>
<html lang="en">
   <head>
     <title>Statement_<?php echo ucfirst($candrow->acc_holder_name); ?>_<?php echo $candrow->bank_account_no; ?>_<?php echo date("d-m-Y",strtotime($end_date)); ?></title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <style>
         body{ padding:0; font-family: Tahoma, Verdana, Segoe, sans-serif; font-size: 14px;}
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

         @media print {
           .pagebreak{ page-break-after:always;}
         }
        .pagebreak{ page-break-after:always;}
        
      

      </style>
   </head>
   <body>
        
       <page size="A4">
         <table style="width:936px; background:#981c1e;">
            <tr>
               <td style="text-align:left; padding-left:25px;">
                  <img src="<?php echo base_url(); ?>assets/img/statement/indusind/logo.svg" alt="" style="width:250px;">
               </td>
               <td style="padding-right:25px; color:#fff; text-align:right; font-size:20px; font-style:italic;">
                  Statement Of Account
               </td>
            </tr>
         </table>
         <!-- name -->
         <div style="width:936px; height:1088px;">
          <div style="padding-top:30px; padding-bottom:10px;">
             <table style="width:100%;  border-collapse: collapse;">
               <tr>
                  <td style="font-family:Arial; font-size:12px; width:50%; padding-right:10px; text-transform:uppercase; color:#0000ff; font-size:14px; font-weight:bold; width:400px;">
                     <table style="font-size:13px; font-weight:600; width:100%;  height:137px; border-collapse: collapse; border:solid 2px #000;">
                        <tr>
                           <td style="padding:10px; font-weight:bold;"><?php echo ucfirst(strtolower($candrow->acc_holder_name)); ?></td>
                        </tr>
                        <tr>
                           <td style="padding:10px; font-size:13px; font-weight:bold; color:#000; font-weight:normal"><?php echo strtoupper(strtolower($candrow->address)); ?> </td>
                        </tr>
                        <tr>
                           <td style="padding:10px; font-weight:600; color:#000; font-weight:normal"> <?php echo strtoupper(strtolower($candrow->city)); ?> - <?php echo $candrow->pincode; ?>
                              <br>
                              <?php echo strtoupper(strtolower($candrow->state)); ?>, INDIA
                           </td>
                        </tr>
                     </table>
                  </td>
                  <td style="font-family:Arial; font-size:13px; width:50%; padding-left:10px; font-size:14px; width:400px;">
                     <table style="font-size:13px; width:100%; border-collapse: collapse; border:solid 2px #000;">
                         
                         <?php 
						  if(is_array($results))
						  {  
                               
							 $x=0;
							 $total_debit=0;
							 $total_credit=0;
                      $totalbalance=0;
							 $opening_balance=0;
                      $last_trans_date='';
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
                              $last_trans_date = $row->transaction_date;  
                             }
                                      
							  } } 
                             ?>
                         
                        <tr>
                           <td style="padding:2px;">Generation Date</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;">
                         
                           <?php
                           $days =  '1';
                           $trans_date=date("Y-m-d",strtotime("+".$days." day",strtotime($end_date))); 
                           echo date("d-M-Y",strtotime($trans_date));
                            ?></td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Period</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;"><?php echo date("d-M-Y",strtotime($start_date)); ?> To <?php echo date("d-M-Y",strtotime($end_date)); ?></td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Customer Id</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;"><?php echo $candrow->customer_id; ?></td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Account Number</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px;"><?php echo $candrow->bank_account_no; ?></td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Account Type</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px; text-transform:uppercase;"><?php echo strtoupper(strtolower($candrow->account_type)); ?></td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Currency</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px; text-transform:uppercase;">INR</td>
                        </tr>
                        <tr>
                           <td style="padding:2px;">Effective Available Balance</td>
                           <td style="padding:2px;">:</td>
                           <td style="padding:2px; text-transform:uppercase;"><?php echo price_format($totalbalance); ?></td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
          </div>
           <table style="width:100%;  border-collapse: collapse;">
               
               <tr>
                  <td style="width:90px; background:#a52a2a; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; color:#fff; font-weight:bold;  font-size:14px; padding:5px 0; text-align:center;">Date</td>
                  <td style="width:200px; background:#a52a2a; border-right:solid 1px #000;  color:#fff; font-weight:bold; font-size:14px; padding:5px 0 0 5px;">Particualrs
                  </td>
                  <td style="width:100px; background:#a52a2a; color:#fff; font-weight:bold; font-size:14px; border-right:solid 1px #000; text-align:right; padding:5px 4px;">Cheq./Ref No</td>
                  <td style="width:100px; background:#a52a2a; border-right:solid 1px #000; color:#fff; font-weight:bold; font-size:14px; text-align:right; padding:5px 4px;">WithDrawal</td>
                  <td style="width:100px; background:#a52a2a; border-right:solid 1px #000;  color:#fff; font-weight:bold; font-size:14px; text-align:right; padding:5px 4px;">Deposit</td>
                  <td style="width:100px; background:#a52a2a; border-right:solid 1px #000;  color:#fff; font-weight:bold; font-size:14px; text-align:right; padding:5px 4px;">Balance</td>
               </tr>
               
               <?php 
                  if(is_array($firstresults))
                  {  

                     $srno=0;
                     foreach($firstresults as $row) {
                     $srno++;

                    $color='#f4e4b5'; 
                    if($srno%2==0)
                    $color= '#ffffff';

                    ?>
               <tr>
                  <td style="width:90px; background:<?php echo $color; ?>; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">
                      <?php echo date("d-M-Y",strtotime($row->transaction_date)); ?></td>
                    
                  <td style="width:200px; background:<?php echo $color; ?>; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;"><?php echo $row->narration; ?></td>
                  
                  <td style="width:100px; background:<?php echo $color; ?>; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:<?php echo $color; ?>; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:0 4px;"><?php if($row->debit!=NULL): ?> <?php echo $row->debit; ?><?php endif;?></td>
                  <td style="width:100px; background:<?php echo $color; ?>; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:0 4px;"> <?php if($row->credit!=NULL): ?> <?php echo $row->credit; ?> <?php endif;?></td>
                  <td style="width:100px; background:<?php echo $color; ?>; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:0 4px;"><?php if($row->balance!=NULL): ?> <?php echo $row->balance; ?><?php endif;?></td>
               </tr>
             <?php } } ?>  
             
             <tr>
                  <td style="width:90px; background:<?php echo $color; ?>; border:solid 1px #000;padding-left:10px; text-transform:uppercase;  font-size:14px;">
                      <strong><?php echo date("d-M-Y",strtotime($last_trans_date)); ?></strong></td>
                  <td style="width:200px; background:<?php echo $color; ?>; border:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">&nbsp;</td>
                  <td style="width:100px; background:<?php echo $color; ?>; border:solid 1px #000;text-transform:uppercase; color:#000; font-size:14px; text-align:right;">&nbsp;</td>
                  <td style="width:100px; background:<?php echo $color; ?>; border:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:0 4px;">&nbsp;</td>
                  <td style="width:100px; background:<?php echo $color; ?>; border:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:0 4px;"> &nbsp;</td>
                  <td style="width:100px; background:<?php echo $color; ?>; border:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:0 4px;"><strong><?php if($totalbalance!=NULL): ?> <?php echo $totalbalance; ?><?php endif;?></strong></td>
               </tr>
               
               
               
              
            </table>
       
         </div>
         <!-- Footer-->
         
         <div style="width:936px;">
            <table style="width:100%;">
               <tr>
                    <td width="80%" style="text-align:center;padding:3px; font-family:Arial; font-size:13px; font-weight:400;">
                     The limits and effective available balance as on generated date 
                     <?php
                      $days =  '1';
                      $trans_date=date("Y-m-d",strtotime("+".$days." day",strtotime($end_date))); 
                      echo date("d-M-Y",strtotime($trans_date)).' '.date("H:i");
                     ?>
                   
                  </td>
                   
                  <td width="20%" style="text-align:right;padding:3px 15px; font-family:Arial; font-size:13px; font-weight:500;">

                 <?php
                  $total_results = count($results); 
                  $get_total_pages =round($total_results/14)+1;  
                  $total_pending_results = count($pendingresults);
                  if($total_pending_results==0){ ?> 
                     Page : 1/1 
                   <?php } else { ?>
                     Page : 1/<?php echo $get_total_pages; ?> 
                   <?php } ?>
                  </td>
               </tr>
               <tr>
                  <td colspan="2" style="border:solid 1px #000; padding:3px; font-family:Arial; font-size:16px; font-weight:500;">
                     For any queries of details on out products & services, please call our Phone Banking Numbers: 1860-267-7777 (Within India) and
                     +91 22 4406 6666 (Outside India) or write to us at "reachus@indusind.com" or visit us at www.indusind.com<br>
                     <span style='font-size:15px;'>&#9679;</span> Service Tax Registration Number AAACI1314GST001. <span style='font-size:15px;'>&#9679;</span>  Any discrepancies in this statement may kindly be brought to the notice<br>
                     of the Bank within seven days. <span style='font-size:15px;'>&#9679;</span>  This is a computer generated statement and so valid without signature.<br>
                     Registered office: INDUSIND BANK LTD, 2401, General Thimmayya Road (Cantonment), Maharashtra Pune-411001.<br>
                     Corporate Identity Number (CIN): L65191PN1994PLC076333
                  </td>
               </tr>
            </table>
         </div>
      </page>
       
      
        <?php if($total_results>=13): ?>
                              
      <div style="page-break-after: always;"></div>
       
      <page size="A4">
         <table style="width:936px; background:#981c1e;">
            <tr>
               <td style="text-align:left; padding-left:25px;">
                  <img src="<?php echo base_url(); ?>assets/img/statement/indusind/logo.svg" alt="" style="width:250px;">
               </td>
               <td style="padding-right:25px; color:#fff; text-align:right; font-size:20px; font-style:italic;">
                  Statement Of Account
               </td>
            </tr>
         </table>
         <!-- name -->
         <div style="width:936px; height:1067px;">
            <table style="width:100%;  border-collapse: collapse; margin-bottom:1px;">
               <tr>
                  <td style="border-left:solid 2px #000; padding-left:10px; text-transform:uppercase; color:#0000ff; font-size:14px; font-weight:bold; width:400px;"><?php echo ucfirst(strtolower($candrow->acc_holder_name)); ?></td>
                  <td style="text-transform:uppercase; color:#000; font-size:14px; font-weight:bold; width:200px;">Account Number</td>
                  <td style="text-transform:uppercase; color:#000; font-size:14px; font-weight:bold;">:</td>
                  <td style="border-right:solid 2px #000;  text-transform:uppercase; color:#000; font-size:14px; font-weight:bold;"><?php echo $candrow->bank_account_no; ?></td>
               </tr>
            </table>
            <div style="width:936px;">
            <table style="width:100%;  border-collapse: collapse;">
                
                 <?php 
                  if(is_array($pendingresults))
                  {  

                     $srno=0;
                     foreach($pendingresults as $row) {
                     $srno++;

                    $color='#f4e4b5'; 
                    if($srno%2==0)
                    $color= '#ffffff';

                    ?>
               <tr>
                  <td style="width:90px; background:<?php echo $color; ?>; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">
                      <?php echo date("d-M-Y",strtotime($row->transaction_date)); ?></td>
                    
                  <td style="width:200px; background:<?php echo $color; ?>; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;"><?php echo $row->narration; ?></td>
                  
                  <td style="width:100px; background:<?php echo $color; ?>; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;padding:5px 4px;"></td>
                  <td style="width:100px; background:<?php echo $color; ?>; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:5px 4px;"><?php if($row->debit!=NULL): ?> <?php echo $row->debit; ?><?php endif;?></td>
                  <td style="width:100px; background:<?php echo $color; ?>; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:5px 4px;"> <?php if($row->credit!=NULL): ?> <?php echo $row->credit; ?> <?php endif;?></td>
                  <td style="width:100px; background:<?php echo $color; ?>; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;padding:5px 4px;"><?php if($row->balance!=NULL): ?> <?php echo $row->balance; ?><?php endif;?></td>
               </tr>
             <?php } } ?>   
                
              <!-- <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A106013442886SBINMr
                     RAMESH CHANDER
                     INDUSMOB00005 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">RTGSYESBR52021030178790271VIS
                     HESH SAMA
                     007190200007844PAYMENT TXN
                     000324673991YESB0000001
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">NEFT
                     DebitINDBN01033532087dream
                     weavers ed
                     HDFC000276450200046307444
                     dream weavers edutrackTNNXZGIN
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A106018575093UTIBWARUN
                     DEEP INDUSMOB00005
                     100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#fff; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#fff; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#fff; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#fff; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>
               <tr>
                  <td style="width:90px; background:#f4e4b5; border-left:solid 1px #000; border-right:solid 1px #000; padding-left:10px; text-transform:uppercase;  font-size:14px;">19-Jan-2021</td>
                  <td style="width:200px; background:#f4e4b5; border-right:solid 1px #000; text-transform:uppercase; color:#000; font-size:14px;">IMPSP2A1019116318449002000000
                     31489332111 INWD4800INETAPNA
                     TELELINK PRIVAT 100023272515
                  </td>
                  <td style="width:100px; background:#f4e4b5; text-transform:uppercase; color:#000; font-size:14px; border-right:solid 1px #000; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right;"></td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,000.00</td>
                  <td style="width:100px; background:#f4e4b5; border-right:solid 1px #000;  text-transform:uppercase; color:#000; font-size:14px; text-align:right">36,085.93</td>
               </tr>-->
            </table>
         </div>
         </div>
         <!-- Statement -->
         
         <div style="width:936px;">
            <table style="width:100%;">
               <tr>
                  <td style="text-align:right;padding:3px; font-family:Arial; font-size:13px; font-weight:400;">
                      
                     <?php
                      $total_results = count($results); 
                      $get_total_pages =round($total_results/14)+1;  

                      $total_pending_results = count($pendingresults);
                      if($total_pending_results==0){ ?> 
                      Page : 1/1
                      <?php } else { ?>
                      Page : 2/<?php echo $get_total_pages; ?> 
                    <?php } ?>
                  </td>
               </tr>
               <tr>
                  <td style="border:solid 1px #000; padding:3px; font-family:Arial; font-size:13px; font-weight:400;">
                     For any queries of details on out products & services, please call our Phone Banking Numbers: 1860-267-7777 (Within India) and
                     +91 22 4406 6666 (Outside India) or write to us at "reachus@indusind.com" or visit us at www.indusind.com
                     * Service Tax Registration Number AAACI1314GST001. * Any discrepancies in this statement may kindly be brought to the notice
                     of the Bank within seven days. * This is a computer generated statement and so valid without signature.
                     Registered office: INDUSIND BANK LTD, 2401, General Thimmayya Road (Cantonment), Maharashtra Pune-411001.
                     Corporate Identity Number (CIN): L65191PN1994PLC076333
                  </td>
               </tr>
            </table>
         </div>
      </page>
       
       <?php endif; ?>
      
       
      
   </body>
</html>