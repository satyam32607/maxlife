<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Account_Statement_<?php echo ucfirst($candrow->acc_holder_name); ?>_<?php echo $candrow->bank_account_no; ?>_<?php echo date("d-m-Y",strtotime($end_date)); ?></title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <style>
         body{margin:0; padding:0; }
         page {
         background: #fff;
         display: block;
         margin: 0 auto;
         margin-bottom:50px;
         padding:0;
         }
         page[size="A4"] {  
         width: 22cm;
         /* height: 29.4cm; */
         position: relative;
         }
         @media print {
         body, page {
         margin: 0;
         padding:0;
         }
         }
          
 @media print {
  @page {size:  A4 portrait; }
  .pagebreak{ page-break-after:always;}
}
.pagebreak{ page-break-after:always;}
          
          
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   </head>
   <body>
      <page size="A4">
         <table style="width:936px; margin-top:100px;">
            <tr>
               <td style="text-align:center; padding-left:25px;">
                  <img src="<?php echo base_url(); ?>assets/img/statement/union/logo.jpg" width="" alt="">
               </td>
            </tr>
            <tr>
               <td style="text-align:center; padding:20px 0 20px 25px; font-size:30px; color:#157dec; font-weight:bold;">
                  DETAILS OF STATEMENT
               </td>
            </tr>
         </table>
         <div style="width:100%; padding:0 50px 20px 40px; height: 1600px;">
            <!-- header -->
            <div style="height:1000px;">
               <!-- Account Proof -->
               <table style="width:100%;">
                  <tr>
                     <td style="text-align:left; padding-left:35px; width:50%; vertical-align:top; ">
                        <table style="border-spacing:0; line-height:17px;margin-top:10px;">
                           <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top; line-height: 27px;">
                                 Name
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top; line-height: 27px;">
                                <span>:</span>  <?php echo strtoupper(strtolower($candrow->acc_holder_name)); ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                               Customer/CIF ID
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->customer_id; ?>
                              </td>
                           </tr>
                              <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                Address
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->address; ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                Account Type
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->account_type; ?>
                              </td>
                           </tr>
                               <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 City
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->city; ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                Account Number
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->bank_account_no; ?>
                              </td>
                           </tr>
                              <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 State
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->state; ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                               Currency
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  INR
                              </td>
                           </tr>
                               <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 Pincode
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->pincode; ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                 Branch Address
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top; line-height: 27px;">
                                <span>:</span> <?php echo $candrow->bank_address; ?> 
                              </td>
                           </tr>
                               <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 Mobile No
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->contact_number; ?> 
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                               
                              </td>
                           </tr> 
                           <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 Email Id
                              </td>
                              <td style="font-size:17px;  width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span> <?php echo $candrow->email_id; ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                               
                              </td>
                           </tr> 
                           <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 Home Branch
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  MITHAPUR ROAD -
                                JALANDHAR
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                               
                              </td>
                           </tr>
                           <tr>
                              <td style="font-size:17px; width:20%; vertical-align:top;    line-height: 27px;">
                                 IFSC 
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:30%; vertical-align:top;    line-height: 27px;">
                                <span>:</span>  <?php echo $candrow->ifsc_code; ?>
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:23%; vertical-align:top;    line-height: 27px;">
                                
                              </td>
                              <td style="font-size:17px; text-transform:uppercase; width:27%; vertical-align:top;    line-height: 27px;">
                               
                              </td>
                           </tr>
                        </table>
                     </td>
                     
                  </tr>
                  <tr>
                     <td style="text-align:left; padding-left:35px; width:50%; vertical-align:top;">
                         <!-- Statement Date -->
               <table style="width:100%; border-spacing: 0; margin:30px 0;">
                  <tr>
                     <td style="width:50%; font-size: 18px;">
                        Statement Date : <span><?php echo date("d/m/Y",strtotime($start_date)); echo ' '.date('h:i A'); ?> </span>
                     </td>
                     <td style="width:50%; font-size: 18px;">
                        Statement Period From -<span><?php echo date("d/m/Y",strtotime($start_date)); ?></span> To <span><?php echo date("d/m/Y",strtotime($end_date)); ?></span>
                     </td>
                  </tr>
               </table>
                     </td>
                  </tr>
               </table>
              <!-- Statement Table -->
               <table style="width:100%;">
                  <tr>
                     <td style="padding:0 25px;">
                        <table style="width:100%; border-spacing:0;">
                           
                           <tr>
                              <td style="background:#c8dcff; color:#000; font-weight:600; font-size:17px; padding:5px; text-align:center;  border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 Tran Id 
                              </td>
                              <td style="background:#c8dcff; color:#000; font-weight:600; font-size:17px; padding:5px; text-align:center;  border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 Tran Date 
                              </td>
                              <td style="background:#c8dcff; color:#000; font-weight:600; font-size:17px; padding:5px; text-align:center;  border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 Remarks
                              </td>
                              <td style="background:#c8dcff; color:#000; font-weight:600; font-size:17px; padding:5px; text-align:center;  border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 Amount (Rs.)  
                              </td>
                              <td style="background:#c8dcff; color:#000; font-weight:600; font-size:17px; padding:5px; text-align:center;  border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 Balance (Rs.)  
                              </td>
                              
                           </tr>
                            
                         
                            <?php
                                                                      
                          if(is_array($results))
						  {  
                            
							 $srno=0;
							 foreach($results as $row) {
							 $srno++;
							 
							$color='#96c8ff'; 
							if($srno%2==0)
							$color= '#c8dcff';
                                 
                        	?>
                          <tr>
                              <td style="background:#96c8ff; color:#000;  font-size:17px; padding:5px; text-align:center;  border-bottom:solid 2px  #fff;">
                                 <?php echo $row->transaction_id; ?>
                              </td>
                              <td style="width:130px; background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                <?php echo date("d/M/Y",strtotime($row->transaction_date)); ?>
                              </td>
                              <td style="width:145px;background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;word-break:break-all;">
                                <?php echo $row->narration; ?>
                              </td>
                              <td style="background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                <?php if($row->debit!=NULL): ?> <?php echo $row->debit; ?> (Dr)<?php endif;?> 
                                <?php if($row->credit!=NULL): ?><?php echo $row->credit; ?> (Cr)<?php endif;?>

                              </td>
                              <td style="background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                <?php if($row->balance!=NULL): ?><?php echo $row->balance; ?> (Cr)<?php endif;?> 
                              </td>
                           </tr>
                            
                            <?php } } ?>
                          <!-- <tr>
                              <td style="background:#c8dcff; color:#000;  font-size:17px; padding:5px; text-align:center;  border-bottom:solid 2px  #fff;">
                                 S90977695
                              </td>
                              <td style="width:130px; background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 15/12/2022
                              </td>
                              <td style="width:90px;background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 UPIAR
                                 /234957187308/DR
                                 /MOBIKWIK/ICIC
                                 /mobikwikaddmon
                              </td>
                              <td style="background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 300.00 (Dr) 
                              </td>
                              <td style="background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 4544.72 (Cr)
                              </td>
                              
                           </tr>
                           <tr>
                              <td style="background:#96c8ff; color:#000;  font-size:17px; padding:5px; text-align:center;  border-bottom:solid 2px  #fff;">
                                 S85981172
                              </td>
                              <td style="width:130px; background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 15/12/2022
                              </td>
                              <td style="width:90px;background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 UPIAR
                                 /234983055470/DR
                                 /Guru Nan/PYTM
                                 /paytmqr2810050
                              </td>
                              <td style="background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 395.00 (Dr) 
                              </td>
                              <td style="background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 4844.72 (Cr)
                              </td>
                              
                           </tr>
                           <tr>
                              <td style="background:#c8dcff; color:#000;  font-size:17px; padding:5px; text-align:center;  border-bottom:solid 2px  #fff;">
                                 S48478811
                              </td>
                              <td style="width:130px; background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 14/12/2022
                              </td>
                              <td style="width:90px;background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 /PARVEEN
                                 /PYTM
                                 /paytmqr2810050
                              </td>
                              <td style="background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 95.00 (Dr) 
                              </td>
                              <td style="background:#c8dcff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 5239.72 (Cr)
                              </td> 
                           </tr>
                           <tr>
                              <td style="background:#96c8ff; color:#000;  font-size:17px; padding:5px; text-align:center;  border-bottom:solid 2px  #fff;">
                                 S85981172
                              </td>
                              <td style="width:130px; background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 15/12/2022
                              </td>
                              <td style="width:90px;background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 UPIAR
                                 /234983055470/DR
                                 /Guru Nan/PYTM
                                 /paytmqr2810050
                              </td>
                              <td style="background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 395.00 (Dr) 
                              </td>
                              <td style="background:#96c8ff; color:#000; font-size:17px; padding:5px; text-align:center; border-left:solid 2px  #fff;  border-bottom:solid 2px  #fff;">
                                 4844.72 (Cr)
                              </td>
                              
                           </tr>-->
                           
                        </table>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
          
       
       
         <table style="width:70%; margin:0 auto; border-spacing:0; border:solid 2px #000;">
            <tr>
               <td colspan="2" style="text-align:center; color:#000; font-weight:bold; font-size: 17px;">
                  Statement Legends:
               </td>
            </tr>
            <tr>
               <td style="color:#000; font-size:10px; width:50%; font-size: 16px; padding:2px 0;">
                  NEFT : National Electronic Fund Transfer
               </td>
               <td style="color:#000; font-size:10px;width:50%; font-size: 16px; padding:2px 0;">
                  UPI : Unified Payment Interface
               </td>
            </tr>
            <tr>
               <td style="color:#000; font-size:10px; width:50%; font-size: 16px; padding:2px 0;">
                  RTGS : Real Time Gross Settlement 
               </td>
               <td style="color:#000; font-size:10px;width:50%; font-size: 16px; padding:2px 0;">
                  UPI : Unified Payment Interface
               </td>
            </tr>
            <tr>
               <td style="color:#000; font-size:10px; width:50%; font-size: 16px; padding:2px 0;">
                  BBPS : Bharat Bill Payment Service 
               </td>
               <td style="color:#000; font-size:10px;width:50%; font-size: 16px; padding:2px 0;">
               </td>
            </tr>

         </table>
         <table style="width:100%; margin:10px auto 0 35px; border-spacing:0; border:solid 1px #000;">
            <tr>
               <td  style="text-align:center; color:#000; font-weight:bold; font-size: 17px;">
                  Statement Legends:
               </td>
            </tr>
           
   
         </table>
                 
       
      </page>
   </body>
</html>