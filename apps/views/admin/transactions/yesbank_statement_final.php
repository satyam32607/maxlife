<!DOCTYPE html>
<html lang="en">
   <head>
<title>NiYO_Account_Statement_<?php echo ucfirst($candrow->acc_holder_name); ?>_<?php echo $candrow->bank_account_no; ?>_<?php echo date("d-m-Y",strtotime($end_date)); ?></title>

      <style>
         body{margin:0; padding:0; font-family:calibri}
         page {
         background: #fff;
         display: block;
         margin: 0 auto;
         margin-bottom:150px;
         padding:0;
         }
         page[size="A4"] {  
         width: 22cm;
         height: 29.4cm;
         position: relative;
         }
         @media print {
         body, page {
         margin: 0;
         padding:0;
         }
         }
   @media print {
  @page { margin: 10mm; size:  A4 portrait; }
  .pagebreak{ page-break-after:always;}
}
.pagebreak{ page-break-after:always;}
          
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   </head>
   <body>
      <page size="A4">

         <div style="width:100%; padding:20px 50px 20px 40px">
            <!-- header -->
             <table style="width:823px; border-spacing:0; margin:20px 20px 10px;">
                     <tr>
                        <td style="width:140px; text-align:left; border-bottom:solid 3px #045191; padding-bottom:10px;">
                           <img src="<?php echo base_url(); ?>assets/img/statement/yesbank/yesbank.jpg">
                        </td>
                        <td style="text-align:left; border-bottom:solid 3px #045191;">
                           <img src="<?php echo base_url(); ?>assets/img/statement/yesbank/niyo.jpg">
                        </td>
                     </tr>
                  </table>

                  <div style="height:950px;">
                     <!-- Account Proof -->
                     <table style="width:823px; border-spacing:0; margin:0 20px; font-size:12px;">
                        <tr>
                           <td colspan="3" style="text-align:center; font-weight:700; color:#045191; font-size:18px; padding-bottom:5px;">
                              <span style="padding-left:80px;">Account Proof</span>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-weight:bold; padding-bottom:5px; width:40%;">
                              A/C Number : <span><?php echo $candrow->bank_account_no; ?></span>
                           </td>
                           <td style="font-weight:bold; padding-bottom:5px; width:40%;">
                              A/C Opening Date : <span><span><?php echo date("d/m/Y",strtotime($candrow->acc_opening_date)); ?></span></span>
                           </td>
                           <td rowspan="6" style="font-weight:bold; padding-bottom:5px; width:20%;">
                              <table style="width:100%;">
                                  <tr>
                                    <td style="text-align:right;">
                                        <?php if( ($candrow->candidate_photo!='') ||  ($candrow->candidate_photo!=NULL) ): ?>
                                       <img src="<?php echo base_url(); ?>assets/static/photos/<?php echo $candrow->candidate_photo; ?>" alt="" width="93" height="93">
                                        
                                        <?php endif; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <img src="<?php echo base_url(); ?>assets/img/statement/yesbank/stamp.jpg" alt="">
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              IFSC Code : <span><?php echo $candrow->ifsc_code; ?></span>
                           </td>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              A/C Holder's Name : <span><?php echo ucfirst($candrow->acc_holder_name); ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Bank Name : <span>Yes Bank Limited</span>
                           </td>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Father's Name/Spouse Name: <span><?php echo $candrow->father_name; ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Branch Name : <span><?php echo $candrow->bank_branch_name; ?></span>
                           </td>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Date of Birth : <span><?php echo date("d/m/Y",strtotime($candrow->date_of_birth)); ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Branch Code : <span><?php echo $candrow->branch_code; ?></span>
                           </td>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Contact Number : <span><?php echo $candrow->contact_number; ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-weight:bold; padding-bottom:5px; vertical-align: top;">
                              MICR Code : <span><?php echo $candrow->mirc_code; ?></span>
                           </td>
                           <td style="font-weight:bold; padding-bottom:5px;">
                              Communication Address : <span><?php echo $candrow->bank_address; ?></span>
                           </td>
                        </tr>
                     </table>

                      <!-- notification -->
                     <table style="width:823px; margin:10px auto; font-size:9px; color: #000;">
                        <tr>
                           <td style=" margin:10px auto; font-size:8px;color: #000; padding-left: 40px; font-weight:700;">
                              * THE CONTENT OF THIS PROOF ARE AS PER BANK RECORDS. THIS PROOF IS SYSTEM GENERATED.
                           </td>
                        </tr>
                     </table>

                      <!-- Account Statement -->
                      
                      <table style="width:823px; border-spacing:0; margin:0 20px; font-size:12px;">
                          
                          <tr>
                           <td style="text-align:center; border-top:solid 3px #045191; padding-top:3px; font-weight:bold; color:#045191; font-size:18px;">
                             <span style="padding-left:70px;"> Account Statement</span>
                           </td>
                        </tr>
                       
                         
                      <tr>
                           <td style=" font-size:11px; padding-bottom:10px;">
                              STATEMENT SUMMARY for <span style="font-weight:bold;">Account <?php echo $candrow->bank_account_no; ?></span> as on
                              <span style="font-weight:bold;"><?php echo date("M d Y",strtotime($end_date)); ?></span>
                           </td>
                        </tr>
                        
                        
                     </table>
                      
                     <!-- <table style="width:823px; border-spacing:0; margin:20px 20px 10px;">
                       <tr>
                           <td style="text-align:center; border-top:solid 3px #045191; padding-top:3px; font-weight:bold; color:#045191; font-size:18px;">
                             <span style="padding-left:70px;"> Account Statement</span>
                           </td>
                        </tr>
                        <tr>
                           <td style=" font-size:11px;">
                              <p style="background:#c5c4c4; padding:5px;">
                                 NEVER SHARE your Card number, CVV, PIN, OTP, Password or URN with anyone, even if the caller claims to be a bank employee. 
                                  Sharing these details can lead to unauthorised access to your account.
                              </p>
                           </td>
                        </tr>
                        <tr>
                           <td style=" font-size:11px; padding-bottom:10px;">
                              STATEMENT SUMMARY for <span style="font-weight:bold;">Account <?php echo $candrow->bank_account_no; ?></span> as on
                              <span style="font-weight:bold;"><?php echo date("M d Y",strtotime($end_date)); ?></span>
                           </td>
                        </tr>
                     </table>-->


                     <!-- Statement Summary -->
                     <table style="width:823px ; border:solid 2px #045191; margin: 0 auto; border-spacing:0;">
                        <thead>
                           <tr>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:13px;">
                                 Product
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:13px;">
                                 Opening Balance
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:13px;">
                                 Deposits
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:13px;">
                                 Withdrawals
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:13px;">
                                 Total Balance
                              </th>
                           </tr>
                        </thead>
                         <tbody>
                        <?php 
						  if(is_array($results))
						  {  
                               
							 $x=0;
							 $total_debit=0;
							 $total_credit=0;
							 $opening_balance='';
							 foreach($results as $row) {
                                 
                             //if($row->credit!=NULL)
                            // {
							    $x++;
                            // }
							 
							 if($x=='1')
							 $opening_balance =$row->balance;
							 
							 
							 $total_debit= $total_debit+$row->debit;
							 $total_credit= $total_credit+$row->credit;
							 $total_balance =($total_credit-$total_debit);
							  } } ?>
                           <tr>
                              <td style="padding:8px 10px; font-size:12px; text-align:center;">
                                 Bharat
                              </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:center;">
                                  <i class="fa-solid fa-indian-rupee-sign"></i> <?php echo price_format($opening_balance); ?>
                                  
                              </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:center;">
                                 <i class="fa-solid fa-indian-rupee-sign"></i> <?php echo price_format($total_credit); ?>
                              </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:center;">
                                 <i class="fa-solid fa-indian-rupee-sign"></i> <?php echo price_format($total_debit); ?>
                              </td>
                              <td style="padding:8px 10px; font-size:12px; font-size:12px; text-align:center;">
                                 <i class="fa-solid fa-indian-rupee-sign"></i> <?php echo price_format($total_balance); ?>
                              </td>
                           </tr>
                        </tbody>
                     </table>


                     <!-- Statement summary -->
                     <table style="width:823px; margin:0 auto; font-size:10px; padding:10px 0">
                        <tr>
                           <td style=" font-size:11px;">
                              STATEMENT TRANSACTIONS for <span style="font-weight:bold;">Account <?php echo $candrow->bank_account_no; ?></span> for the period
                              <span style="font-weight:bold;"><?php echo date("M d Y",strtotime($start_date)); ?> - <?php echo date("M d Y",strtotime($end_date)); ?></span>
                           </td>
                        </tr>
                     </table>


                     <!-- Statement Transactions -->
                    <table style="width:823px; margin: 10px auto; border-spacing:0;">
                        <thead>
                           <tr>
                              <th nowrap style="background:#045191; color:#fff; padding:8px 10px; font-size:14px; width:90px;">
                                 Txn Date
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px; width:100px;">
                                 Narration
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Ref No./ <br>Cheque No.
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Withdrawal
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Deposit
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Balance
                              </th>
                           </tr>
                        </thead>
                         
                         <tbody>
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
                           <tr style="background:<?php echo $color; ?>;">
                              <td nowrap style="padding:8px 10px; font-size:12px; text-align:center;">
                                  <span style="color:#333;"> <?php echo date('d-m-Y',strtotime($row->transaction_date));?><br>
                                 <?php echo date('h:i:s A',strtotime($row->transaction_date));?></span>
                             </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:left; width:200px; word-break:break-all;">
                                  <span style="color:#333;"> <?php echo $row->narration; ?></span>
                              </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:center;">
                                   <span style="color:#333;"><?php echo $row->transaction_id; ?></span>
                              </td>
                              
                              <td nowrap style="padding:8px 10px; font-size:12px; text-align:center; color:#FF0503;">
							   <?php if($row->debit!=NULL): ?><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row->debit; ?><?php endif;?> </td>
							   
                              <td nowrap style="padding:8px 10px; font-size:12px; text-align:center; color:#0b8040;">
                                 <?php if($row->credit!=NULL): ?><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row->credit; ?> <?php endif;?>
                              </td>
                               <td  nowrap style="padding:8px 10px; font-size:12px; text-align:center;">
                                  <?php if($row->balance!=NULL): ?><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row->balance; ?><?php endif;?>
                              </td>
                           </tr>
                           <?php } } ?>
                       </tbody>
                       
                     </table>

                  </div>

         </div>
           
              <div style="width:100%; padding:10px 10px 0px 40px">
         		<table style="width:823px; margin:0 auto; font-size:10px;">
                 <tr>
                   <td style="text-align:center; border-top:solid 1px #045191; padding-top:3px; font-weight:bold; color:#045191; font-size:18px;"></td>
                     
                 </tr>
                 </table>  
                 </div>     
              
      
        <table style="width:930px; border-spacing:0;  font-size:15px;">
            <tr>
               <td colspan="2" style="text-align:center; background:#045191; color:#fff; padding:5px;">
                  1 of 2
               </td>
            </tr>
            <tr>
               <td style="color:#fff; width:50%; background:#045191; padding:0px 10px 10px 20px;">
                 <strong> Niyo Solutions</strong>
                 <br>
<span style="font-size:14px; font-weight:300; color:#78B8C8;">Finnew Solutions Private Limited<br>
10th Floor, Gamma Block, Sigma Soft Tech Park,<br>
Varthur Main Road, Whitefield Phase 2,<br>
Bengaluru, Karnataka, 560066<br>
E mail: care@goniyo com Phone: 1800 258 3009</span>
               </td>
               <td style="color:#fff; vertical-align:top; width:50%; background:#045191; padding:0px 20px 10px 10px; text-align:right; ">
                  <strong>Yes Bank Corporate Office :</strong>
                  <br>
<span style="font-size:14px; font-weight:300; color:#78B8C8;">Yes Bank Tower, IFC 2, 15th Floor,<br>
Senapati Bapat Marg, Elphiston (W),<br>
Mumbai 400 013</span>
               </td>
            </tr>
         </table>
      </page>
       
  
  <div>&nbsp;&nbsp;</div>
  <div class="pagebreak"></div>     
          
    <!--------------------------Second Page------------------------------->   
        <page size="A4">

         <div style="width:100%; padding:20px 50px 20px 40px">
            <!-- header -->
             <table style="width:823px; border-spacing:0; margin:20px 20px 10px;">
                     <tr>
                        <td style="width:140px; text-align:left; border-bottom:solid 3px #045191; padding-bottom:10px;">
                           <img src="<?php echo base_url(); ?>assets/img/statement/yesbank/yesbank.jpg">
                        </td>
                        <td style="text-align:left; border-bottom:solid 3px #045191;">
                           <img src="<?php echo base_url(); ?>assets/img/statement/yesbank/niyo.jpg">
                        </td>
                     </tr>
                  </table>

                  <div style="height:950px;">
                
                     <!-- Statement Transactions -->
                    <table style="width:823px; margin: 10px 0 0 20px; border-spacing:0;">
                        <thead>
                           <tr>
                              <th nowrap style="background:#045191; color:#fff; padding:8px 10px; font-size:14px; width:90px;">
                                 Txn Date
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px; width:100px;">
                                 Narration
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Ref No./ <br>Cheque No.
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Withdrawal
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Deposit
                              </th>
                              <th style="background:#045191; color:#fff; padding:8px 10px; font-size:14px;">
                                 Balance
                              </th>
                           </tr>
                        </thead>
                         
                         <tbody>
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
                           <tr style="background:<?php echo $color; ?>;">
                             <td nowrap style="padding:8px 10px; font-size:12px; text-align:center;">
                                <span style="color:#333;"> <?php echo date('d-m-Y',strtotime($row->transaction_date));?><br>
                                 <?php echo date('h:i:s A',strtotime($row->transaction_date));?></span>
                             </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:left; width:200px; word-break:break-all;">
                                <span style="color:#333;"><?php echo $row->narration; ?></span>
                              </td>
                              <td style="padding:8px 10px; font-size:12px; text-align:center;">
                                <span style="color:#333;">  <?php echo $row->transaction_id; ?></span>
                              </td>
                              
                              <td nowrap style="padding:8px 10px; font-size:12px; text-align:center; color:#FF0503;">
							  <?php if($row->debit!=NULL): ?><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row->debit; ?><?php endif;?></span> </td>
							   
                              <td nowrap style="padding:8px 10px; font-size:12px; text-align:center; color:#0b8040;">
                                 <?php if($row->credit!=NULL): ?><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row->credit; ?> <?php endif;?>
                              </td>
                               <td  nowrap style="padding:8px 10px; font-size:12px; text-align:center;">
                                  <?php if($row->balance!=NULL): ?><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row->balance; ?><?php endif;?>
                              </td>
                           </tr>
                           
                           <?php } } ?>
                             
                             
                      <!--  Statement -->
                         <table style="width:823px; margin:0 auto; font-size:12px;">
                       
                        <tr>
                           <td style="font-size:12px;" height="80" align="center">
                             
                                 ********** End of statement *********
                            
                           </td>
                        </tr>
                        
                        </table>
                             
                             
                     <table style="width:823px; margin:0 auto 0 20px; font-size:12px;">
                       
                         <thead>
                           <tr>
                              <th colspan="6" style="background:#045191; color:#fff; padding:8px 10px; font-size:13px; width:90px;" align="left">
                                 Important Information
                              </th>
                             
                           </tr>
                        </thead>
                         
                        <tr>
                           <td style="font-size:10px;"  height="80" align="left">
                             
                               <br>1. All contents of this statement will be deemed to be correct and accepted by you, unless you inform us of any discrepancies within 30 days from the date of this statement<br>
2. Date format in this statement is DD-MM-YYYY<br>
3. This is a system generated output and requires no signature.<br>
4. In the event of any dispute or grievance in relation to the Niyo Prepaid Card, the customer may contact the YES Bank 24 hours Customer Care number at 1800 103 5485 /1800 3000 1113 or  Email:<br>Niyopay.support@yesbank.in.

                            
                           </td>
                        </tr>
                        
                        </table>         

 
                            
                        
                        </tbody>
                         
                       
                     </table>


                  </div>

         </div>

       <table style="width:930px; border-spacing:0;  font-size:15px;">
            <tr>
               <td colspan="2" style="text-align:center; background:#045191; color:#fff; padding:5px;">
                  2 of 2
               </td>
            </tr>
            <tr>
               <td style="color:#fff; width:50%; background:#045191; padding:0px 10px 10px 20px;">
                 <strong> Niyo Solutions</strong>
                 <br>
<span style="font-size:14px; font-weight:300; color:#78B8C8;">Finnew Solutions Private Limited<br>
10th Floor, Gamma Block, Sigma Soft Tech Park,<br>
Varthur Main Road, Whitefield Phase 2,<br>
Bengaluru, Karnataka, 560066<br>
E mail: care@goniyo com Phone: 1800 258 3009</span>
               </td>
               <td style="color:#fff; vertical-align:top; width:50%; background:#045191; padding:0px 20px 10px 10px; text-align:right; ">
                  <strong>Yes Bank Corporate Office :</strong>
                  <br>
<span style="font-size:14px; font-weight:300; color:#78B8C8;">Yes Bank Tower, IFC 2, 15th Floor,<br>
Senapati Bapat Marg, Elphiston (W),<br>
Mumbai 400 013</span>
               </td>
            </tr>
         </table>
      </page>
       
      
   </body>
</html>