<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/invoice/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/footer_classes.css">
</head>
<body>
<?php
            $date = new DateTime($eventLogObject->date);
        ?>
    <div style="width: 1280px; margin:0 auto;">
        <div class="header">
            <img src="<?php echo base_url();?>assets/emailStyle/invoice/images/digital-event-oct-23.png" alt="" srcset="">
            <div class="mail-title">
                <?php echo $templateObject->template_subject; ?>
            </div>
        </div>
        <div class="user-info">
            <div class="user-img">
                <img src="<?php echo base_url();?>assets/emailStyle/invoice/images/user.png" alt="" srcset="">
            </div>
            <div class="user-desc">
               <p class="date"> <?php echo $date->format("D") ?> <?php echo $eventLogObject->date; ?></p>
               <p class="email"><?php echo $vendorObject->name; ?> <span class="user-mail-tag"><?php echo $vendorObject->email; ?></span></p>
               <p class="reply"><?php echo $templateObject->template_subject; ?></p>
            </div>
        </div>
        <div class="to">
           <p> <span>To</span> <?php echo $emailFrom ?></p>
                   </div>

        <div class="attachments">
            <div class="zip">
                <img src="<?php echo base_url();?>assets/emailStyle/invoice/images/pdf.png" alt="">
                <div class="zip-name">
                   Dream Weavers
                    <p class="zip-size"><?php echo $eventLogObject->size ?> MB</p>
                </div>
            </div>
        </div>

        <div class="email-body">
            <?php echo $replaced_sms_body ?>
            <br>
           Thanks & Regards
            <br>
            <br>
            <!-- <p class="ganeshdham"><?php echo $vendorObject->name ?></p> -->
            
            
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