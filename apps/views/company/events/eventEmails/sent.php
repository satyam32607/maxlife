<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/sent/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/emailStyle/footer_classes.css">
</head>
<body>
<?php
            $date = new DateTime($eventLogObject->date);
        ?>
    <div style="width: 1280px; margin:0 auto;">
        <div class="header">
            <img src="<?php echo base_url();?>assets/emailStyle/sent/images/digital-event-oct-23.png" alt="" srcset="">
            <div class="mail-title">
                RE: <?php echo $templateObject->template_subject ?>
            </div>
        </div>
        <div class="user-info">
            <div class="user-img">
                <img src="<?php echo base_url();?>assets/emailStyle/sent/images/user.png" alt="" srcset="">
            </div>
            <div class="user-desc">
               <p class="date"> <?php echo $date->format("D") ?> <?php echo $eventLogObject->date; ?> </p>
               <p class="email"><?php echo $emailFrom ?></p>
               <p class="reply"><b><?php echo $templateObject->template_subject ?></b></p>
            </div>
        </div>
        <div class="to">
           <p> <span>To</span>'<?php echo $vendorObject->email ?>'</p>
          
        </div>

        <div class="attachments">
            <div class="zip">
                <img src="<?php echo base_url();?>assets/emailStyle/sent/images/zip.png" alt="">
                <div class="zip-name">
                    Schedule & Agenda.zip
                    <p class="zip-size"><?php echo $eventLogObject->size ?> MB</p>
                </div>
            </div>
        </div>
        <?php
            $date1 = new DateTime($eventMasterObject->event_start_date);
            $date2 = new DateTime($eventMasterObject->event_end_date);
        ?>
        <div class="email-body">
            <?php echo $replaced_sms_body; ?>
            <!-- <table border="2px">
                <thead style="background-color: royalblue;color:white;">
                    <th>Event Name</th>
                    <th>Event Time</th>
                    <th>Grand Total</th>
                    <th>Holiday</th>
                </thead>
                <tbody>
                    <?php 
                    foreach ($eventSessions as $key => $eventSession) {
                        echo "<tr>";
                        echo "<th> $eventObject->event_name </th>";
                        echo "<th> $eventSession->start_time"." - ".$eventSession->end_time."</th>";
                        echo "<th>1</th>";
                        echo "<th>Not Holiday</th>";
                        echo "<tr>";
                    }

                    ?>
                </tbody>
            </table> -->
        </div>
        <?php echo $replaced_sms_footer; ?>
        <?php
            $date = new DateTime($eventLogObject->date);
        ?>
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