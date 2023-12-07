<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/received/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/footer_classes.css">
</head>
<body>
        <?php
            $date = new DateTime($eventLogObject->date);
        ?>
    <div style="width: 1280px; margin:0 auto;">
        <div class="header">
            <img src="<?php echo base_url();?>assets/emailStyle/received/images/digital-event-oct-23.png" alt="" srcset="">
            <div class="mail-title">
                RE: <?php echo $eventObject->event_name ?>
            </div>
        </div>
        <div class="user-info">
            <div class="user-img">
                <img src="<?php echo base_url();?>assets/emailStyle/received/images/user.png" alt="" srcset="">
            </div>
            <?php
            $dateDay = new DateTime($eventLogObject->date);
            ?>
            <div class="user-desc">
               <p class="date"> <?php echo $dateDay->format("D") ?> <?php echo $eventLogObject->date; ?></p>
               <p class="email"><?php echo $emailFrom ?></p>
               <p class="reply">RE: <?php echo 'Digital events '.$dateDay->format("M").' '.$dateDay->format("y")?></p>
            </div>
        </div>
        <div class="to">
           <p> <span>To</span> <?php echo 'events@dreamweaversindia.com' ?></p>
           <p class="replied"><img src="<?php echo base_url();?>assets/emailStyle/received/images/info.png" alt="" > You replied to this message on <?php echo $date->format("d/m/Y"); ?> <?php echo $date->format("H:i"); ?>. </p>
        </div>

        <div class="attachments">
            <div class="zip">
                <img src="<?php echo base_url();?>assets/emailStyle/received/images/zip.png" alt="">
                <div class="zip-name">
                    Events proof Detail.zip
                    <p class="zip-size"><?php echo $eventLogObject->size ?> MB</p>
                </div>
            </div>
        </div>

        <div class="email-body">
            <?php echo $replaced_sms_body; ?>
            
            <hr>
            <div class="trail">
                <p class="trail-from">
                    From: <a href="#" class="help-link trail-link"><?php echo $previousMail; ?> </a>
                    <a class="help-link trail-link trail-link-account"><span><?php echo $previousMail; ?></span></a>
                </p>
                <p class="trail-from">
                    Sent: <?php echo $previousStepDetails->date; ?>
                </p>
                <p class="trail-from">
                    To: <a href="#" class="help-link trail-link"><?php echo $emailFrom ?> </a></p>
                <p class="trail-from">
                    Subject: <span class="trail-reply">RE: Digital Event: Schedule</span></p>
            </div>
            <div class="email-body" style=" width: 100%; background: transparent; height: auto;margin-top:30px;">
                <?php echo $previous_replaced_sms_body; ?>
            </div>
        </div>
        <?php echo $replaced_sms_footer; ?>
        <div class="<?php echo $eventLogObject->template_footer ?>">
            <div class="footer-time">
            <?php echo $date->format("H:i"); ?>
            </div>
            <div class="footer-date">
            <?php echo $date->format("d/m/Y"); ?>
            </div>
        </div>
    </div>
  
</body>
</html>