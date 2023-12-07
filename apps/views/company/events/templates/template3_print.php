<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $eventrow->event_name; ?>-<?php echo date("F Y", strtotime($eventrow->event_date)); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <!-- Main -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.jchart.js" type="text/javascript"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        page {
            background: #fff;
            display: block;
            margin: 0 auto;
            margin-bottom: 50px;
            padding: 0;
        }

        page[size="A4"] {
            width: 22cm;
            /* height: 29.4cm; */
            position: relative;
        }

        @media print {

            body,
            page {
                margin: 0;
                padding: 0;
            }

        }

        #element4 {
            width: 340px;
        }
    </style>
</head>

<body style="font-family: 'Roboto', sans-serif; font-size: 13px; margin:0;">
    <page size="A4">
        <table style="width: 100%; margin:0 auto; border-collapse: collapse;">
            <tr>
                <td style="background:url(<?php echo base_url(); ?>assets/img/templates/3/header.jpg); vertical-align: top; height: 270px;  background-repeat: no-repeat; background-size: 100%;">
                    <h1 style="font-weight:500; color:#fff; margin:0; font-size: 25 px; margin-left:420px;">
                        <?php echo date("F Y", strtotime($eventrow->event_date)); ?>
                    </h1>
                    <h2 style="font-size: 44px; margin-top:0;color:white;margin-left:32%"><?php echo $eventrow->event_name ?></h2>
                    <!-- <h2 style="color:#feb801; font-size: 30px; margin:0; margin-left:225px;">
                        <?php echo $eventrow->event_name; ?>
                        <br>
                        <?php echo $eventrow->event_title; ?>
                    </h2> -->

                </td>
            </tr>
            <tr>
                <td>
                    <table style="width:90%; border-collapse: collapse;  margin:14px auto 15px; font-family: 'Montserrat', sans-serif;">
                        <tr>
                            <td style="font-size: 14px;">
                                <p> Dear Participant,</p>

                                <p>Greetings!</p>

                                <?php echo $eventrow->event_header_text; ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat', sans-serif; font-weight: 700; color:#000; font-size: 22px; font-weight: 600; padding:2px 5px; text-align: left; background: url(images/date.jpg) no-repeat;">
                                Date:<?php echo date("d-m-Y", strtotime($eventrow->event_date)); ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="background: #000; padding:10px;">
                                <table style="width: 100%; margin:0 auto; border-collapse: collapse;">
                                    <tr>
                                        <td style="width: 50%; background: #feb801; padding:5px 15px; font-size: 18px; font-family: 'Montserrat', sans-serif; border:solid 1px #feb801; color:#000;">
                                            Time</td>
                                        <td style="width: 50%; background: #feb801; padding:5px 15px; font-size: 18px; font-family: 'Montserrat', sans-serif; border:solid 1px #feb801; color:#000;">
                                            Agenda</td>
                                    </tr>
                                    <?php
                                    if (is_array($sessionsresults)) {
                                        foreach ($sessionsresults as $skey => $sessionrow) {

                                            if ($skey == 0) {
                                                $rand_mins = rand(20, 75);
                                                $rand_seconds = rand(12, 54);
                                                $start_datetime = date('Y-m-d') . ' ' . $sessionrow->start_time;
                                                $printscreentime = date("Y-m-d H:i:s", strtotime("+" . $rand_mins . " minutes", strtotime($start_datetime)));
                                                $print_screen_time = date("Y-m-d H:i:s", strtotime("+" . $rand_seconds . " seconds", strtotime($printscreentime)));

                                                // echo "------------->".$printscreentime;
                                                // echo "------------->".$print_screen_time;
                                                $current_session_time = days_difference($start_datetime, $print_screen_time);
                                                // echo "---current_session_time---------->".$current_session_time;
                                            }





                                    ?>
                                            <tr>
                                                <td style="width: 50%;   padding:5px 15px; font-size: 15px; border:solid 1px #feb801; border-bottom:solid 1px #feb801; color:#feb801; border-right: 0;">
                                                <?php echo date('g:i A', strtotime($sessionrow->start_time)); ?> - <?php echo date('g:i A', strtotime($sessionrow->end_time)); ?></td>
                                                <td style="width: 50%;  padding:5px 15px; font-size: 15px; border-right:solid 1px #feb801;  border-bottom:solid 1px #feb801;  color:#feb801;">
                                                    <?php echo $sessionrow->agenda; ?></td>
                                            </tr>
                                    <?php }
                                    } ?>

                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 14px;">
                                <p style="font-weight:600; margin:10px 0 0;">Please be informed that the session will be attended by the senior leadership hence you need to follow the
                                    below instruction.</p>
                                <br>
                                <br>
                                1. You will receive login details in a separate message.
                                <br>
                                <br>
                                2. Login at least 5 mins before the start time.
                                <br>
                                <br>
                                3. Keep yourself on mute all the time; avoid Admin to keep muting you During the session.
                                <br>
                                <br>
                                4. Put your questions in either Q & A Section or Chat Box.
                                <br>
                                <br>
                                5. We will take a regular attendance, and any drop out during the Session will be marked as absent.
                                <br>
                                <br>
                                6. We expect your active participation during the meeting so that you can get all the clarifications on all
                                the sales performance criteria announced.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="background-image: url(<?php echo base_url(); ?>assets/img/templates/3/footer.jpg); background-repeat: no-repeat; padding:0 15px; height: 56px; background-size: 100%;">

                    <div>
                        <p style="margin:0; font-size: 18px; color:#fff; font-weight: 600;"> For any Clarification reach out @ events@dreamweaversindia.com </p>

                    </div>

                </td>
            </tr>
        </table>
    </page>
    <div style="page-break-after: always;"></div>
    <page size="A4">
        <?php
        if (is_array($sessionsresults)) {
            foreach ($sessionsresults as $skey => $sessionrow) {

                if ($skey == 0) {
                    $rand_mins = rand(20, 75);
                    $rand_seconds = rand(12, 54);
                    $start_datetime = date('Y-m-d') . ' ' . $sessionrow->start_time;
                    $printscreentime = date("Y-m-d H:i:s", strtotime("+" . $rand_mins . " minutes", strtotime($start_datetime)));
                    $print_screen_time = date("Y-m-d H:i:s", strtotime("+" . $rand_seconds . " seconds", strtotime($printscreentime)));

                    // echo "------------->".$printscreentime;
                    // echo "-------------------------->Hello".$print_screen_time;
                    $current_session_time = days_difference($start_datetime, $print_screen_time);
                    // echo "---current_session_time---------->".$current_session_time;
                }
            }
        }



        ?>

        <div align="center" style="color:#333; font-family: Arial, Helvetica, sans-serif; font-size: 26px; margin-top:10px; margin-bottom:15px;text-center;">Participants attending the Webinar Training/Meeting:</div>


        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td style="background:url(<?php echo base_url(); ?>assets/img/templates/1/teams-header.jpg) no-repeat #1a1a1a; height: 60px; background-size: 100%;">
                    <div style="color:#c2c2c2; font-family: Arial, Helvetica, sans-serif; font-size: 8px; margin-top:19px; margin-left:15px;">

                        <?php
                        $randmins = ($rand_mins * 60);

                        $total_session_time = ($randmins + $rand_seconds);
                        echo sectotime($total_session_time);

                        ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td style="background: #1a1a1a;">
                    <div style="width:100%; display: flex; justify-content: space-between; flex-wrap: wrap;">

                        <?php
                        $sr_no = 0;
                        foreach ($pmeeting_colors as $mcolorkey => $mcolorrow) {

                            $sr_no++;
                            if ($sr_no == '1') {
                                $color1 =  $mcolorrow->title;
                            } elseif ($sr_no == '2') {
                                $color2 =  $mcolorrow->title;
                            } elseif ($sr_no == '3') {
                                $color3 =  $mcolorrow->title;
                            } elseif ($sr_no == '4') {
                                $color4 =  $mcolorrow->title;
                            } elseif ($sr_no == '5') {
                                $color5 =  $mcolorrow->title;
                            } elseif ($sr_no == '6') {
                                $color6 =  $mcolorrow->title;
                            } elseif ($sr_no == '7') {
                                $color7 =  $mcolorrow->title;
                            } elseif ($sr_no == '8') {
                                $color8 =  $mcolorrow->title;
                            } elseif ($sr_no == '9') {
                                $color9 =  $mcolorrow->title;
                            }
                        }

                        if (is_array($pmeetingresults)) {
                            $srno = 0;
                            $participant_speak = rand(1, 9);

                            //echo "<pre>";
                            //print_r($pmeeting_colors);
                            //echo "</pre>";

                            foreach ($pmeetingresults as $mkey => $meetingrow) {
                                $srno++;
                                if ($srno == '1') {
                                    $color_array =  explode("|||", $color1);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '2') {
                                    $color_array =  explode("|||", $color2);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '3') {
                                    $color_array =  explode("|||", $color3);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '4') {
                                    $color_array =  explode("|||", $color4);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '5') {
                                    $color_array =  explode("|||", $color5);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '6') {
                                    $color_array =  explode("|||", $color6);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '7') {
                                    $color_array =  explode("|||", $color7);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '8') {
                                    $color_array =  explode("|||", $color8);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                } elseif ($srno == '9') {
                                    $color_array =  explode("|||", $color9);
                                    $bgcolor = $color_array[0];
                                    $color = $color_array[1];
                                }



                                $participantname = explode(" ", $meetingrow->participant_name);
                                $name_first_letter  =  substr($participantname[0], 0, 1);

                                if (count($participantname >= 2)) {
                                    $name_second_letter = substr($participantname[1], 0, 1);
                                }

                                $participant_short_name = strtoupper(strtolower($name_first_letter)) . strtoupper(strtolower($name_second_letter));

                        ?>

                                <div style="width: 17%; margin:10px 5px; display: flex; justify-content: center; flex-wrap: wrap;">
                                    <?php if ($participant_speak == $srno) { ?>
                                        <div style="width:126px; height:126px; border:solid 4px #aaaeff; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                        <?php } else { ?>
                                            <div style="width:126px; height:126px; border:solid 3px #1a1a1a; border-radius: 50%; display: flex; justify-content: center; align-items: center;">

                                            <?php } ?>



                                            <div style="width:120px; height:120px; background:<?php echo $bgcolor; ?>; color:<?php echo $color; ?>; font-size: 60px; border-radius: 50%; display: flex; justify-content: center; 
                  align-items: center; text-transform: uppercase; font-family:Calibri, sans-serif; font-weight: 500;">
                                                <?php echo $participant_short_name; ?></div>

                                            </div>
                                            <div style="height: 18px; color:#fff; font-family: Arial, Helvetica, sans-serif; margin:5px 0 5px 10px; display: flex; align-items: center; font-size:09px;">
                                                <?php

                                                $participantname = explode(" ", $meetingrow->participant_name);

                                                $namefirst = $participantname[0];
                                                $namesecond = $participantname[1];
                                                $participant_name = $namefirst . ' ' . $namesecond;
                                                echo $participant_name;
                                                //  echo substr($meetingrow->participant_name,0,15); 
                                                ?>
                                                <?php if ($participant_speak != $srno) : ?>
                                                    <img src="<?php echo base_url(); ?>assets/img/templates/1/mute.jpg" alt="Mute" width="20" height="20">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                <?php }
                        } ?>



                                <?php
                                if (is_array($participantsresults)) {
                                    $total_joined = 0;
                                    foreach ($participantsresults as $participantrow) {
                                        $srno++;

                                        if ($participantrow->joined == 'Y')
                                            $total_joined++;
                                    }
                                }
                                ?>

                                <div style="width: 17%; margin:10px 5px; display: flex; justify-content: center; flex-wrap: wrap;">
                                    <div style="width:126px; height:126px; border:solid 3px #1a1a1a; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                        <div style="width:120px; height:120px; background:#424242; color:#fff; font-size: 11px; border-radius: 50%; display: flex; justify-content: center; 
                  align-items: center; text-transform: uppercase; font-family:Calibri, sans-serif; font-weight: 500; border:solid 1px #565656;">


                                            <?php $totaljoined = ($total_joined + 2);
                                            $totaljoinedparticipant =  ($totaljoined - 10); ?>


                                            +<?php echo  $totaljoinedparticipant; ?></div>

                                    </div>

                                </div>


                                </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="background: #1a1a1a; text-align: right;">
                    <div style="width: 241px; height:130px; margin-left: auto; margin-top:50px; margin-right:6px; margin-bottom:6px; display: flex; justify-content: center; align-items: center;">
                        <div style="width:60px; height:60px; font-size: 25px; border-radius: 50%; display: flex; justify-content: center; 
            align-items: center; text-transform: uppercase; font-family:Calibri, sans-serif; font-weight: 500;">
                            </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="background: url(<?php echo base_url(); ?>assets/img/templates/taskbar/<?php echo $eventrow->taskbar_footer.".jpg"; ?>) no-repeat; background-size: 100%; height: 25px;">
                    <div style="width:67px; margin-left:auto; font-size: 8.5px; color:#fff; text-align: right; margin-right: 23px; margin-top: -1px;">
                        <p style="margin: 3px 0 -2px 25px;font-size: 9.5x; text-align:center; "><?php echo date("g:i A", strtotime($print_screen_time)); ?></p>
                        <p style="margin:0 2px;"><?php echo date("m/d/Y", strtotime($eventrow->event_date)); ?></p>
                    </div>
                </td>
            </tr>
        </table>
    </page>


    <div style="page-break-after: always;"></div>

    <page size="A4">
        <table style="width: 98%; margin:0 auto; border-collapse: 0;">
            <tr>
                <td style="font-size: 22px; font-family:Calibri, sans-serif; height: 50px;">Session MIS</td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; margin:30px auto 0; border-collapse: collapse; border:solid 1px #000;">
                        <thead>
                            <tr style="color:#fff; font-family:Calibri, sans-serif; font-weight: 500; font-size: 15px;">
                                <th style="background: #215867; padding:5px;">
                                    Sr. No.
                                </th>
                                <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                                    Participants
                                </th>
                                <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                                    Invite Sent
                                </th>
                                <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                                    Joined
                                </th>
                                <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                                    Drop out during the session
                                </th>
                                <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                                    Attended Full Session
                                </th>
                                <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                                    Email ID
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (is_array($participantsresults)) {
                                $srno = 0;
                                $total_invite_sent = 0;
                                $total_joined = 0;
                                $total_absent = 0;
                                $total_attended_full_session = 0;
                                $total_dropout = 0;
                                foreach ($participantsresults as $participantrow) {
                                    $srno++;

                                    if ($participantrow->invite_sent == 'Y')
                                        $total_invite_sent++;

                                    if ($participantrow->joined == 'Y')
                                        $total_joined++;

                                    if ($participantrow->drop_out_session == 'Absent')
                                        $total_absent++;

                                    if ($participantrow->drop_out_session == 'No')
                                        $total_attended_full_session++;

                                    if ($participantrow->drop_out_session == 'Yes')
                                        $total_dropout++;

                            ?>

                                    <tr style="color:#000; font-family:Calibri, sans-serif; font-weight: 500; font-size: 15px;">
                                        <td style="width:50px; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                                            <?php echo $srno; ?>
                                        </td>
                                        <td style="width: 200px; border-left:solid 1px #000; padding:5px; border-bottom: solid 1px #000;">
                                            <?php echo $participantrow->participant_name; ?>
                                        </td>
                                        <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                                            <?php echo $participantrow->invite_sent; ?>
                                        </td>
                                        <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                                            <?php echo $participantrow->joined; ?>
                                        </td>
                                        <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                                            <?php echo $participantrow->drop_out_session; ?>
                                        </td>
                                        <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                                            <?php echo $participantrow->attended_full_session; ?>
                                        </td>
                                        <td style=" border-left:solid 1px #000; padding:5px; border-bottom: solid 1px #000;">
                                            <?php echo $participantrow->participant_email_id; ?>
                                        </td>
                                    </tr>

                            <?php }
                            } ?>


                        </tbody>

                    </table>

                </td>

            </tr>
        </table>
    </page>
    <div style="page-break-after: always;"></div>

    <page size="A4">
        <table style="width:98%; border-collapse: collapse; margin:0 auto;">
            <tr>
                <td style="font-size: 22px; font-family:Calibri, sans-serif; height: 50px;">
                    Attendance at a Glance
                </td>
            </tr>

            <tr>
                <td>
                    <div style="width: 47%;height: 1px;background: #000;position: relative;top: 30px;transform: rotate(5deg);margin: 0 auto 0 212px;"></div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 50%; text-align: center;">
                                <div id="element3" class="element"></div>
                            </td>
                            <td style="width: 50%; text-align: center;">
                                <div id="element4" class="element"></div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div style="display:flex; justify-content: center;">
                                    <div style="display: flex; align-items: center; margin-right:10px;">
                                        <div style="width:10px; height: 10px; background:#4f81bd; margin-right:5px;"></div>
                                        Joined
                                    </div>

                                    <div style="display: flex; align-items: center; margin-right:10px;">
                                        <div style="width:10px; height: 10px; background:#c0504d; margin-right:5px;"></div>
                                        Absent
                                    </div>

                                    <div style="display: flex; align-items: center; margin-right:10px;">
                                        <div style="width:10px; height: 10px; background:#9bbb59; margin-right:5px;"></div>
                                        Complete Session Attended
                                    </div>

                                    <div style="display: flex; align-items: center; margin-right:10px;">
                                        <div style="width:10px; height: 10px; background:#8064a2; margin-right:5px;"></div>
                                        Dropout
                                    </div>

                                </div>

                            </td>
                        </tr>

                    </table>
                    <div style="width: 47%;height: 1px;background: #000;position: relative;top: -58px;transform: rotate(-5deg);margin: 0 auto 0 212px;"></div>
                </td>
            </tr>
        </table>

        <table style="width: 98%; margin:30px auto; border-collapse: collapse; border:solid 1px #000;">
            <thead>
                <tr style="color:#fff; font-family:Calibri, sans-serif; font-weight: 500; font-size: 15px;">
                    <th style="background: #215867; padding:5px;">
                        No of Participants
                    </th>
                    <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                        Invite Sent
                    </th>
                    <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                        Joined
                    </th>
                    <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                        Absent
                    </th>
                    <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                        Complete Session Attended
                    </th>
                    <th style="background: #215867; border-left:solid 1px #000; padding:5px;">
                        Dropout
                    </th>

                </tr>
            </thead>


            <tbody>
                <tr style="color:#000; font-family:Calibri, sans-serif; font-weight: 500; font-size: 15px;">
                    <td style="width:50px; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                        <?php echo count($participantsresults); ?>
                    </td>
                    <td style="width: 200px; border-left:solid 1px #000; text-align: center;  padding:5px; border-bottom: solid 1px #000;">
                        <?php echo $total_invite_sent; ?>
                    </td>
                    <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                        <?php echo $total_joined; ?>
                    </td>
                    <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                        <?php echo $total_absent; ?>
                    </td>
                    <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                        <?php echo $total_attended_full_session; ?>
                    </td>
                    <td style="border-left:solid 1px #000; padding:5px; text-align: center; border-bottom: solid 1px #000;">
                        <?php echo $total_dropout; ?>
                    </td>

                </tr>
            </tbody>

        </table>

    </page>
    <script>
        let jchart3, jchart4;
        $(function() {

            jchart3 = $("#element3").jChart({
                data: [{
                        value: 199,
                        color: {
                            normal: '#4f81bd',
                            active: '#4f81bd',
                        },
                    },
                    {
                        value: 250,
                        color: {
                            normal: '#4bacc6',
                            active: '#4bacc6',
                        },
                    },
                    {
                        value: 5,
                        color: {
                            normal: '#dd5640',
                            active: '#dd5640',
                        },
                    },

                ],
                appearance: {
                    type: 'pie',
                    baseColor: '#ddd',
                    gap: 0
                },

            });
            jchart4 = $("#element4").jChart({
                data: [{
                        value: 199,
                        color: {
                            normal: '#9bbb59',
                            active: '#9bbb59',
                        },
                    },
                    {
                        value: 10,
                        color: {
                            normal: '#8064a2',
                            active: '#8064a2',
                        },
                    },



                ],
                appearance: {
                    type: 'pie',
                    baseColor: '#ddd',
                    gap: 0
                },

            });
        });
    </script>
</body>

</html>