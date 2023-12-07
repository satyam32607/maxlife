<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCM_<?php echo $candrow->employee_number; ?>_ <?php echo strtoupper($candrow->acc_holder_name); ?></title>
</head>

<body>
    <table style="width:100%; border:solid 1px #000; margin:0 auto; border-collapse: collapse; border-spacing: 0;">
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
                    <td style="text-align: right; padding-right:12px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;">DATE:
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
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;">ID NO/ <span style="font-size: 10px;">कर्मचारी सांख्य</span>/ எண;</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo $candrow->employee_number; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-family:Calibri, sans-serif; font-size: 15px;">Name of Employee/ <span style="font-size: 10px;">नाम</span>/ பணவயலளரன சபயர</td>
                                   
                                </tr>
                                <tr>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo strtoupper($candrow->acc_holder_name); ?></td>
                                   
                                </tr>
                                <tr>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> &nbsp;</td>
                                   
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-family:Calibri, sans-serif; font-size: 15px;">F/H Name/ <span style="font-size: 10px;">पिता का नाम/</span>/ தநனத கணவரன சபயர;</td>
                                   
                                </tr>
                                <tr>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo strtoupper($candrow->father_name); ?></td>
                                   
                                </tr>
                            </table>
                        </td>
                        <td style="width:33%">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">D.O.b/ <span style="font-size: 10px;">डी ओ बी</span>/ பவ மததத</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo date("d/m/Y",strtotime($candrow->date_of_birth)); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">DEPT/ <span style="font-size: 10px;">विभाग</span>/ தனற</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"> <?php echo $candrow->department; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px; padding:5px 0;">DESIG/ <span style="font-size: 10px; ">पद</span>/ பதவவ</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;"><?php echo $candrow->designation; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">ESI No/ <span style="font-size: 10px;">ई एस आई</span>/ ஈ.எஸ.ஐ என</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"><?php echo $candrow->esi_no; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">PAID/ <span style="font-size: 10px;">भुगतान किया है</span>/ ஈ.எஸ.ஐ என</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"><?php echo $candrow->bank_account_no; ?></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:33%; vertical-align: top;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">D.O.J/ <span style="font-size: 10px;">डी.ओ.जे./</span>/ மவ.மச.மததத</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"> <?php echo date("d/m/Y",strtotime($candrow->date_of_birth)); ?> </td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px;  padding:5px 0;">PF NO/ <span style="font-size: 10px;"> पीएफ</span>/ பவ எப என</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"> <?php echo $candrow->pf_no; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-family:Calibri, sans-serif; font-size: 15px; padding:5px 0;">UAN NO/ <span style="font-size: 10px; ">यू ए एन</span>/ ய ஏ என</td>
                                    <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;"><?php echo $candrow->uan_no; ?></td>
                                </tr>
                                
                            </table> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top:solid 1px #000; padding:20px 0;">
               <h1 style="font-size: 20px; font-weight: bold; text-align: center; margin:0;"><span style="font-size: 15px;">சமபள ரசகத</span>(SALARY SLIP) FOR THE PERIOD OF :  <?php echo date("d-M-Y",strtotime($paysliprow->from_period)); ?> TO <?php echo date("d-M-Y",strtotime($paysliprow->to_period)); ?><br>
               சசனனனகறமஊததயவவததகளபவரவ27(2)னககழ</h1>
               
            </td>
        </tr>
        
      
        <tr>
            <td>
             <table style="width:100%; border-collapse: collapse; border-spacing: 0;">
             
                <tr style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-weight: 600;">
                    <td colspan="3" style="padding: 10px; border-right:solid 1px #000; border-top:solid 1px #000; border-bottom:solid 1px #000; text-align: center;">EARNING/ वेतन /சமபளம</td>
                    <td colspan="2" style="padding: 10px; border-right:solid 1px #000; border-top:solid 1px #000; border-bottom:solid 1px #000;">DEDUCTION/ कटौती/பவடததம</td>
                    <td colspan="2" style="padding: 10px; border-top:solid 1px #000; border-bottom:solid 1px #000;">
                        ATT.LEAVE O.T. DEATILS/ उपस्थिति विवरण/ வரனகப பததவ வவவரஙகள
                    </td>
                    
                </tr>
                   <tr>
                    <td style="width:16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 600; padding:5px 10px; border-bottom: solid 1px #000; border-right: solid 1px #000;"><?php echo $row->category_name; ?>
                    </td>
                    <td style="width:14%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 600; padding:5px 10px; border-bottom: solid 1px #000; border-right: solid 1px #000;">RATE/</td>
                    <td style="width:14%; border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 600; padding:5px 10px; border-bottom: solid 1px #000; ">EARNED/अरजरस
                        /சமபலதததயம
                        </td>
                    <td style="width:14%; border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">P.F/ पीएफ /பவ.எப</td>
                    <td style=" width:14%;border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">NA</td>
                    <td style=" width:14%; border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">DAYS WORKED
                        दिन काम किया /மவ.நல
                        </td>
                    <td style="text-align:right; width:14%; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;"> <?php  echo $paysliprow->working_days;?></td>
                </tr>
                
              
                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">BASIC AND DA/
                        बुनियादी / महंगाई भत्ता /
                    அடபபனட அகவவனலபபட
                    
                    </td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;"><?php echo price_format($paysliprow->candidate_ctc); ?></td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">
                    <?php
					  $earned_amount =  ($paysliprow->candidate_ctc/30*$paysliprow->working_days);
					  $earned_amount = round($earned_amount,2);
					  echo price_format($earned_amount);
					  ?>
                   
                        </td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">E.S.I/ ई एस आई /ஈ.எஸ.ஐ
                    </td>
                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">NA</td>
                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">NH/FH/एन एच /एफ एच
                        மத வவடமனற /ப. வவடமனற
                        
                        </td>
                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0.00</td>
                </tr>
                
                  
                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">H.R.A/एच.आर.ए/வடடவலடனகபபட 
                    </td>

                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00
                        </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">WELFARE FUND

                        कल्याण राशि 
                    
                    </td>

                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0</td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">LEAVE DAYS
                        
                        
                        </td>

                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">0.00</td>
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">CONV.ALL/ परिवहन भत्ता /ஊரததபபட
                    </td>

                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00
                        </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                    
                    </td>

                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        
                    </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        EL
                        </td>

                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                    0.00    
                </td>
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">SPL.ALL/ विशेष भत्ता/சதறபபபபட
                    </td>

                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00
                        </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        MESS/गडबड/உணவ
                    </td>

                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        <?php  echo price_format($paysliprow->mess);?>
                    </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        TOTAL DAYS
                       कुल काम के दिन /சமல.நலள

                        </td>

                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                    <?php 
					 echo days_difference($paysliprow->from_period,$paysliprow->to_period);
					?></td>
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">
                        WASHING ALL/ धुलाई भत्ता 
                    </td>

                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">0</td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">0.00
                        </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        OTHERS/ अन्य लोग /
                        மறறனவகள
                      
                    </td>

                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        0
                    </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        OT MINUTES/ ओ टी घंटे

                        </td>

                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                    <?php  echo $paysliprow->ot_mins;?></td>
                </tr>

                <tr>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">
                        OT AMOUNT/ ओवरटाइम मजदूरी 
                    </td>

                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding:5px 10px;  border-right: solid 1px #000; text-align: right; font-size: 12px;">
                        
                    </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  text-align: right; font-size: 12px;">
                       <?php 
					     $total_ot_amount = $paysliprow->ot_mins/60*$paysliprow->ot_rate;
					     $total_ot_amt= round($total_ot_amount,2);
					     echo price_format($total_ot_amt);?>
                        </td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">&nbsp;</td>

                    <td style="border-right:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">&nbsp;</td>

                    <td style="border-right:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">OTRATEPERHOUR/<br>
                      ओवरटाइमप्रतिघंटेकीदरसे/ 
மத.மந.ப.கல</td>

                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                    <?php echo $paysliprow->ot_rate; ?></td>
                </tr>

                <tr style="font-weight:600;">
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">
                        TOTAL/ पूरी तनख्वा /
சமலதத சமபளம

                    </td>

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
                        TOT DED/
                        कुल कटौती 
                    

                      
                    </td>

                    <td style="border-right:solid 1px #000; border-top:solid 1px #000; text-align: right; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        <?php  echo price_format($paysliprow->mess);?>
                    </td>

                    <td style="border-right:solid 1px #000; border-top:solid 1px #000; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px;">
                        NET PAY/ कुल भुगतान
சமபளம


                        </td>

                    <td style="text-align: right
                    ; font-family: Arial, Helvetica, sans-serif; padding:5px 10px; font-size: 12px; border-top:solid 1px #000;">
                        <?php 
						  $total_net_amount = ($total_earned_amount-$paysliprow->mess);
						  echo price_format($total_net_amount); 
						  ?> </td>
                </tr>



                <tr>
                    <td colspan="3" style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px; border-right: solid 1px #000;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif; text-align: center; font-weight: 600;">
                        <p>
                            <img src="images/sign.png" alt="">
                        </p>
                        Manager Signature/மமலலளர<br>
                        प्रबंधक हस्ताक्षर
                        

                    </td>
                    <td style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif;">
                        ORIGINAL RECEIVE

                    </td>
<td colspan="3" style="width: 16%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;  padding:5px 10px;  border-top: solid 1px #000; font-family: Arial, Helvetica, sans-serif; text-align: center;">
    EMPLOYEE SIGNATURE/ कर्मचारी हस्ताक्षर<br>
    oபணவயலளரன னகசயலபபம
    

                    </td>
                   
             
                </tr>
             </table>
               
            </td>
        </tr>
      




        
    </table>
</body>

</html>