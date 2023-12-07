<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCM_<?php echo $candrow->employee_number; ?>_ <?php echo strtoupper($candrow->acc_holder_name); ?></title>
</head>

<body>
    <table style="width:95%; border:solid 1px #000; margin:0 auto; border-collapse: collapse; border-spacing: 0;">
        <tr>
            <td style="border-top:solid 1px #000;">
               <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 20px; font-weight: bold; text-align: center; margin:0;">SCM GARMENTS PVT LIMITED</h1>
               
            </td>
        </tr>
        <tr>
            <td style="border-bottom:solid 1px #000;">
               <table style="width:100%; border-collapse: collapse;">
                <tr>
                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; font-weight: bold; text-align: right; margin:0;">S.F.No-40, N.G.Palayam, Thekkalur, Avinashi, </td>
                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; font-weight: bold; text-align: right; margin:0;">Tirupur  Thekkalur No : 12345</td>
                    <td style="text-align: right; padding-right:12px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 12px;">DATE:
                    <?php  $get_month_last_day = date("Y-m-t", strtotime($paysliprow->to_period));
                    echo date("d/M/Y",strtotime($get_month_last_day)); ?></td>
                </tr>
               </table>
               
         
            </td>

        </tr>
        <tr>
            <td>
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="width:34%; vertical-align: top;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;">ID NO/ <span style="font-size: 10px;">कर्मचारी सांख्य</span>/<span style="font-size: 08px;"> எண</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;font-size: 15px; padding-bottom:10px;"> <?php echo $candrow->employee_number; ?></td>
                                </tr>
                               
                                <tr>
                                    <td colspan="2" style="font-family:Calibri, sans-serif; font-size: 15px; padding-bottom:05px;">Name of Employee/ <span style="font-size: 10px;">नाम</span>/ <span style="font-size: 08px;">பணவயலளரன சபயர</span></td>
                                </tr>
                                
                                <tr>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;font-size: 15px;"> <?php echo strtoupper($candrow->acc_holder_name); ?></td>
                                   
                                </tr>
                                
                                <tr>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;">&nbsp; </td>
                                   
                                </tr>
                                
                                <tr>
                                    <td colspan="2" style="font-family:Calibri, sans-serif; font-size: 15px; padding-bottom:05px;">F/H Name/ <span style="font-size: 10px;">पिता का नाम/</span>/ <span style="font-size: 08px;">தநனத கணவரன சபயர</span></td>
                                   
                                </tr>
                                
                                <tr>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;font-size: 15px;"> <?php echo strtoupper($candrow->father_name); ?></td>
                                   
                                </tr>
                            </table>
                        </td>
                        <td style="width:33%">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">D.O.b/ <span style="font-size: 10px;">डी ओ बी</span>/ <span style="font-size: 08px;">பவ மததத</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo date("d/M/Y",strtotime($candrow->date_of_birth)); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">DEPT/ <span style="font-size: 10px;">विभाग</span>/ <span style="font-size: 08px;">தனற</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo $candrow->department; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px; padding:5px 0;">DESIG/ <span style="font-size: 10px; ">पद</span>/ <span style="font-size: 08px;">பதவவ</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"><?php echo $candrow->designation; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">ESI No/ <span style="font-size: 10px;">ई एस आई</span>/ <span style="font-size: 08px;">ஈ.எஸ.ஐ என</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"><?php echo $candrow->esi_no; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">PAID/ <span style="font-size: 10px;">भुगतान किया है</span>/ ஈ<span style="font-size: 08px;">.எஸ.ஐ என</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"><?php echo $candrow->bank_account_no; ?></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:33%; vertical-align: top;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">D.O.J/ <span style="font-size: 10px;">डी.ओ.जे./</span>/ <span style="font-size: 08px;">மவ.மச.மததத</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;">
                                     <?php  if(($candrow->date_of_joining!='0000-00-00') && ($candrow->date_of_joining!=NULL)):
									 	 echo date("d/M/Y",strtotime($candrow->date_of_joining)); endif; ?> </td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">PF NO/ <span style="font-size: 10px;"> पीएफ</span>/ <span style="font-size: 08px;">பவ எப என</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"> <?php echo $candrow->pf_no; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px; padding:5px 0;">UAN NO/ <span style="font-size: 10px; ">यू ए एन</span>/ <span style="font-size: 08px;">ய ஏ என</span></td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"><?php echo $candrow->uan_no; ?></td>
                                </tr>
                                
                            </table> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top:solid 1px #000; padding:10px 0;">
               <h1 style="font-size: 20px; font-weight: bold; text-align: center; margin:0;"><span style="font-size: 13px;">சமபள ரசகத</span> &nbsp;(SALARY SLIP) FOR THE PERIOD OF :  <?php echo date("d-M-Y",strtotime($paysliprow->from_period)); ?> TO <?php echo date("d-M-Y",strtotime($paysliprow->to_period)); ?><br>
               <span style="font-size: 13px;">சசனனனகறமஊததயவவததகளபவரவ27(2)னககழ</span></h1>
               
            </td>
        </tr>
        
      
        <tr>
            <td>
             <table style="width:100%; border-collapse: collapse; border-spacing: 0;">
             
                <tr style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-weight: 600;">
                    <td colspan="3" style="padding: 10px; border-right:solid 1px #000; border-top:solid 1px #000; border-bottom:solid 1px #000; text-align: center;">EARNING/ <span style="font-size:10px;">वेतन</span> /<span style="font-size: 08px;">சமபளம</span></td>
                    <td colspan="2" style="padding: 10px; border-right:solid 1px #000; border-top:solid 1px #000; border-bottom:solid 1px #000;">DEDUCTION/ <span style="font-size:10px;">कटौती</span>/<span style="font-size:08px;">பவடததம</span></td>
                    <td colspan="2" style="padding: 10px; border-top:solid 1px #000; border-bottom:solid 1px #000;">
                        ATT.LEAVE O.T. DEATILS/ <span style="font-size:10px;">उपस्थिति विवरण</span>/ <span style="font-size:08px;">வரனகபபததவவவவரஙகள</span>
                    </td>
                    
                </tr>
                   <tr>
                    <td style="width:16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 600; padding:5px 10px; border-bottom: solid 1px #000; border-right: solid 1px #000;">DESC/<span style="font-size:10px;">पववरण</span>/<span style="font-size:08px;">வவபரம </span>
                    </td>
                    <td style="width:14%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 600; padding:5px 10px; border-bottom: solid 1px #000; border-right: solid 1px #000;">RATE/</td>
                    <td style="width:14%; border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 600; padding:5px 10px; border-bottom: solid 1px #000; ">EARNED/ <span style="font-size:10px;">अरजरस</span>
                        /<span style="font-size:08px;">சமபலதததயம</span>
                        </td>
                    <td style="width:14%; border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">P.F/<span style="font-size: 10px;"> पीएफ </span>/<span style="font-size: 08px;">பவ.எப</span></td>
                    <td style=" width:14%;border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">NA</td>
                    <td style=" width:14%; border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">DAYS WORKED
                        दिन काम किया /மவ.நல
                        </td>
                    <td style="text-align:right; width:14%; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"> <?php  echo $paysliprow->working_days;?></td>
                </tr>
                
              
                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">BASIC AND DA/
                       <span style="font-size: 10px;"> बुनियादी </span>/  <span style="font-size: 10px;">महंगाई भत्ता </span>/
                   <span style="font-size: 08px;"> அடபபனட அகவவனலபபட</span>
                    
                    </td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;"><?php echo price_format($paysliprow->candidate_ctc); ?></td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">
                    <?php
					 $calculate_days =  days_difference($paysliprow->from_period,$paysliprow->to_period);
					 $calculatedays = $calculate_days+1;
					 
					  $earned_amount =  ($paysliprow->candidate_ctc/$calculatedays*$paysliprow->working_days);
					  $earned_amount = round($earned_amount,2);
					  echo price_format($earned_amount);
					  ?>
                   
                        </td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">E.S.I/ <span style="font-size: 10px;">ई एस आई</span> /<span style="font-size: 08px;">ஈ.எஸ.ஐ</span></td>
                    
                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">NA</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">NH/FH/<span style="font-size: 10px;">एन एच /एफ एच</span>
                       <span style="font-size: 08px;"> மத வவடமனற /ப. வவடமனற</span> </td>
                    <td style="text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0.00</td>
                </tr>
                
                  
                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">H.R.A/<span style="font-size: 10px;">एच.आर.ए</span>/<span style="font-size: 08px;">வடடவலடனகபபட </span></td> 
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">WELFARE FUND<span style="font-size: 10px;">  कल्याण राशि </span> </td>
    			    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0</td>
					<td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">LEAVE DAYS </td>
                    <td style="text-align: right;font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0.00</td>
               </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">CONV.ALL/<span style="font-size: 10px;"> परिवहन भत्ता</span> /<span style="font-size: 08px;">ஊரததபபட</span></td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00 </td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"></td>
                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"> </td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">EL</td>
                    <td style="text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0.00</td>  
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">SPL.ALL/ <span style="font-size: 10px;">विशेष भत्ता</span>/<span style="font-size: 08px;">சதறபபபபட</span></td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>
				    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">MESS/<span style="font-size: 10px;">गडबड</span>/<span style="font-size: 08px;">உணவ</span> </td>
                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"><?php  echo price_format($paysliprow->mess);?></td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"> TOTAL DAYS<span style="font-size: 10px;"> कुल काम के दिन</span> / <span style="font-size: 08px;">சமல.நலள</span> </td>
                    <td style="text-align: right;font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                    <?php 
					 //echo days_difference($paysliprow->from_period,$paysliprow->to_period);
					  echo $paysliprow->working_days;
					?></td>
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">
                        WASHING ALL/ <span style="font-size: 10px;">धुलाई भत्ता </span>
                    </td>
				    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>
					<td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00 </td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        OTHERS/ <span style="font-size: 10px;">अन्य लोग</span> /<span style="font-size: 08px;">மறறனவகள</span>
                    </td>
			       <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"> OT MINUTES/ <span style="font-size: 10px;">ओ टी घंटे</span></td>
                    <td style="text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"><?php  echo $paysliprow->ot_mins;?></td>
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">OT AMOUNT/ <span style="font-size: 10px;">ओवरटाइम मजदूरी </span> </td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;"> </td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">
                       <?php 
					     $total_ot_amount = $paysliprow->ot_mins/60*$paysliprow->ot_rate;
					     $total_ot_amt= round($total_ot_amount,2);
					     echo price_format($total_ot_amt);?>
                        </td>
				    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">&nbsp;</td>
				    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">&nbsp;</td>
					 <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">OTRATEPERHOUR/<br>
                      <span style="font-size: 10px;">ओवरटाइमप्रतिघंटेकीदरसे </span>/<span style="font-size: 08px;">மத.மந.ப.கல</span></td> 
					 <td style="text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"><?php echo $paysliprow->ot_rate; ?></td>
                   
                    
                </tr>

                <tr style="font-weight:600;">
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">
                        TOTAL/ <span style="font-size: 10px;">पूरी तनख्वा </span>/<span style="font-size: 08px;">சமலதத சமபளம</span></td>
				    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; border-top: solid 1px #000; text-align: right; font-size: 12px;">
                        <?php echo price_format($paysliprow->candidate_ctc); ?> 
                    </td>

                    <td style="border-right:solid 1px #000; border-top:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">
                         <?php 
						  $total_earned_amount = ($earned_amount+$total_ot_amt);
						  echo price_format($total_earned_amount); 
						  ?> 
                        </td>

                    <td style="border-right:solid 1px #000; border-top:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        TOT DED/<span style="font-size: 10px;">कुल कटौती</span> </td>
                    <td style="border-right:solid 1px #000; border-top:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        <?php  echo price_format($paysliprow->mess);?>
                    </td>

                    <td style="border-right:solid 1px #000; border-top:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        NET PAY/ <span style="font-size: 10px;">कुल भुगतान</span> <span style="font-size: 08px;">சமபளம</span> </td>
                    <td style="text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px; border-top:solid 1px #000;">
                         <?php 
						  $total_net_amount = ($total_earned_amount-$paysliprow->mess);
						  echo price_format($total_net_amount); 
						  ?></td>
                </tr>


                <tr>
                    <td colspan="3" style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif; text-align: center; font-weight: 600;">
                        <p>
                            <img src="<?php echo base_url();?>assets/img/payslip/scm/sign.png" alt="sign">
                        </p>
                        Manager Signature/<span style="font-size: 08px;">மமலலளர</span><br>
                        <span style="font-size: 10px;">प्रबंधक हस्ताक्षर</span> </td>
                  
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">ORIGINAL RECEIVE</td>
					<td colspan="3" style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif; text-align: center;">
                    EMPLOYEE SIGNATURE/ <span style="font-size: 10px;">कर्मचारी हस्ताक्षर</span><br><span style="font-size: 08px;"> oபணவயலளரன னகசயலபபம</span> </td>
   			     </tr>
             </table>
               
            </td>
        </tr>
       
    </table>
</body>

</html>