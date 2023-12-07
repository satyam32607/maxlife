<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proof not correct</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/invalidProof/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/footer_classes.css">
</head>
<body>
<?php
            $date = new DateTime($eventLogObject->date);
        ?>
    <div style="width: 1280px; margin:0 auto;">
        <div class="header">
            <img src="<?php echo base_url();?>assets/emailStyle/invalidProof/images/digital-event-oct-23.png" alt="" srcset="">
            <div class="mail-title">
                RE: <?php echo $eventObject->event_name ?>
            </div>
        </div>
        <?php
            $dateDay = new DateTime($eventLogObject->date);
            ?>
        <div class="user-info">
            <div class="user-img">
                <img src="<?php echo base_url();?>assets/emailStyle/invalidProof/images/user.png" alt="" srcset="">
            </div>
            <div class="user-desc">
               <p class="date"> <?php echo $dateDay->format("D") ?> <?php echo $eventLogObject->date; ?></p>
               <p class="email"><?php echo $emailFrom ?></p>
               <p class="reply">RE: <?php echo 'Digital events '.$dateDay->format("M").' '.$dateDay->format("y")?></p>
            </div>
        </div>
        <div class="to">
           <p> <span>To</span> '<?php echo $emailTo ?></p>'</p>
        </div>

        

        <div class="email-body">
            <p>Dear <?php echo $vendorObject->name ?>,</p>
            <br>
                <?php echo $replaced_sms_body ?>
            
            <br>
            <br>
           
            
            <div class="email-signature">
              Thanks & Regards
                <br>
                <!-- <br>
                Dream Weavers Group
                <br>
                Contact No: 98032-31163
                <br>
                Landline: 0181-7102489 -->
                
            </div>
            <!-- trail -->
            <div class="trail" style="padding-top:10px;">
                <p class="trail-from">
                    From: <a href="#" class="help-link trail-link"><?php echo $emailTo ?> </a>
                    <a class="help-link trail-link trail-link-account"><span><?php echo $emailTo ?></span></a>
                </p>
                <?php
                $previousDate = new DateTime($previousStepDetails->date);
                ?>
                <p class="trail-from">
                    Sent: <?php echo $previousStepDetails->date ?>
                </p>
                <p class="trail-from">
                    To: <a href="#" class="help-link trail-link"><?php echo $emailFrom ?> </a></p>
                    <p class="trail-from">
                        Subject: <span class="trail-reply">RE: <?php echo 'Digital events '.$dateDay->format("M").' '.$dateDay->format("y")?></span></p>
            </div>
<div class="email-body" style=" width: 100%; background: transparent; height: auto;margin-top:30px;">
    <?php echo $previous_replaced_sms_body; ?>
</div>

        </div>
        <?php echo $replaced_sms_footer; ?>
        <div class="<?php echo $eventLogObject->template_footer ?>">
            <div class="footer-time">
            <?php echo $previousDate->format("H:i"); ?>
            </div>
            <div class="footer-date">
            <?php echo $previousDate->format("d/m/Y"); ?>
            </div>
        </div>
    </div>
  
</body>
</html>