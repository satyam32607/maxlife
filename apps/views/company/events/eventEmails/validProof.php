<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/validProof/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/footer_classes.css">
</head>
<body>
        <?php
            $date = new DateTime($eventLogObject->date);
        ?>
    <div style="width: 1280px; margin:0 auto;">
        <div class="header">
            <img src="<?php echo base_url();?>assets/emailStyle/validProof/images/digital-event-oct-23.png" alt="" srcset="">
            <div class="mail-title">
                <?php echo 'Digital events: Schedule' ?>
            </div>
        </div>
        <div class="user-info">
            <div class="user-img">
                <img src="<?php echo base_url();?>assets/emailStyle/validProof/images/user.png" alt="" srcset="">
            </div>
            <?php
            $dateDay = new DateTime($eventLogObject->date);
            ?>
            <div class="user-desc">
               <p class="date"> <?php echo $dateDay->format("D") ?> <?php echo $eventLogObject->date; ?></p>
               <p class="email"><?php echo $emailFrom ?></p>
               <p class="reply"><?php echo 'Digital events '.$dateDay->format("M").' '.$dateDay->format("y")?></p>
            </div>
        </div>
        <div class="to">
           <p> <span>To</span> <?php echo $vendorObject->email; ?></p>
        </div>

        <!-- <div class="attachments">
            <div class="zip">
                <img src="<?php echo base_url();?>assets/emailStyle/validProof/images/zip.png" alt="">
                <div class="zip-name">
                    Revised Evemts proof Detail.rar
                    <p class="zip-size">2 MB</p>
                </div>
            </div>
        </div> -->

        <div class="email-body">
            <p>Dear <?php echo 'Concern' ?>,</p>
            <br>
            <br>
            <?php echo $replaced_sms_body ?>
            <br>
            <br>
           
            
            <div class="email-signature">
                Regards	
                <br><br>
                Shamsher Rayat

            </div>
            <!-- trail -->
            <!-- <div class="trail">
                <p class="trail-from">
                    From: <a href="#" class="help-link trail-link"><?php echo $emailFrom ?> </a>
                    <a class="help-link trail-link trail-link-account"><span><?php echo $emailFrom ?></span></a>
                </p>
                <p class="trail-from">
                    Sent: <?php echo $date->format('j F Y h:i A'); ?>
                </p>
            </div> -->
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