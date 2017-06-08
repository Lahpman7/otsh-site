<?php
session_start();
if(isset($_POST['email']) && !isset($_SESSION['reqSent'])){
    $name = explode(' ',$_SESSION['displayName']);

    $msg = "";
    //html message body below
    $msg .= '<html>';
    $msg .= '<head>';
        $msg.= '<meta charset="utf-8">';
        $msg.='<meta name="viewport" content="width=device-width">';
        $msg.='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $msg.='<meta name="x-apple-disable-message-reformatting">';
        $msg.='<title></title>';

        $msg.='<style>';
          $msg.= 'html,';
          $msg.= 'body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
            }';


          $msg.='
            div[style*="margin: 16px 0"] {
                margin:0 !important;
            }

            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }
            ';
            $msg.='
            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }
            table table table {
                table-layout: auto;
            }
            ';
            $msg.='img {
                -ms-interpolation-mode:bicubic;
            }

            .mobile-link--footer a,
            a[x-apple-data-detectors] {
                color:inherit !important;
                text-decoration: underline !important;
            }

            .button-link {
                text-decoration: none !important;
            }

        </style>';
            $msg.='<style>

            .button-td,
            .button-a {
                transition: all 100ms ease-in;
            }
            .button-td:hover,
            .button-a:hover {
                background: #555555 !important;
                border-color: #555555 !important;
            }

        </style>
    ';
    $msg.='
    </head>
    <body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;">
        <center style="width: 100%; background: #222222;">
    ';
          $msg.='
            <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
                CSUMB\'s first pass sharing app
            </div>

            <div style="max-width: 600px; margin: auto;">

                <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">

                    <tr>
                        <td bgcolor="#ffffff">
                            <img src="https://s13.postimg.org/olffrkbdj/20160830_194919.jpg" width="600" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        </td>
                    </tr>
                    ';
                    $name = explode(' ',$_SESSION['displayName']);
                    $msg.='
                    <tr>
                        <td bgcolor="#ffffff">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding: 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                        <h2>Hey '. $_POST['name'] .', </h2>
                                        <br>
                                        It looks like someone is requesting to pass share with you! Their contact information is below! <br>
                                        <b>Requester Name:</b> ' .$_SESSION['displayName'] . '  <br>
                                        <b>Requester Email:</b> ' . $_SESSION['emails'] . '  <br>
                                        <h3>Thanks for connecting with OtterShare!</h3>
                                        <br><br>
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
                                            <tr>
                                                <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                                                    <a href="http://www.google.com" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                                        <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Check us out&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                    </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#ffffff" align="center" height="100%" valign="top" width="100%" style="padding-bottom: 40px">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:560px;">
                                <tr>
                                    <td align="center" valign="top" width="50%">

                                    </td>
                                    <td align="center" valign="top" width="50%">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;">

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
    ';
                    $msg.='
                    <tr>
                        <td height="40" style="font-size: 0; line-height: 0;">
                            &nbsp;
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#ffffff">

                        </td>
                    </tr>

                </table>

            </div>
        </center>
    </body>
    </html>
    ';
    ///////////
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


        //echo $_POST['email'];
        mail($_POST['email'], "Match Request!", $msg, $headers);
        $_SESSION['reqSent'] = "Sent Request";
        echo "Request Sent!";
    }
    else{
        echo "Sorry, you have already requested once today!";
    }



?>
