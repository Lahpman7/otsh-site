<?php
  require_once('../classes/dbHandler.php');
  session_start();

  $monday = '';
  $tuesday ='';
  $wednesday ='';
  $thursday ='';
  $friday = '';
  $lot = '';
  if(isset($_POST['loc'])){
     $lot = $_POST['loc'];
  }
  if(isset($_POST["mon_time"])){
      $monday = $_POST["mon_time"];
  }
  if(isset($_POST["tues_time"])){
      $tuesday = $_POST["tues_time"];
  }
  if(isset($_POST["wed_time"])){
      $wednesday = $_POST["wed_time"];
  }
  if(isset($_POST["thur_time"])){
      $thursday = $_POST["thur_time"];
  }
  if(isset($_POST["fri_time"])){
      $friday = $_POST["fri_time"];
  }
  if(!emailExists($_SESSION['emails']) && isset($_SESSION['displayName'])){
      $db = Database::getInstance();
      $nameArr = explode(' ',$_SESSION['displayName']);
      $fname = $nameArr[0];
      $lname = $nameArr[1];
      $id = $_SESSION['id'];
      $email = $_SESSION['emails'];
      $sql = "INSERT INTO Users (id, email, fname, lname, lot, monday, tuesday, wednesday, thursday, friday)
              VALUES(?,?,?,?,?,?,?,?,?,?)";
      $val = $db->prepare($sql);
      $val->bindParam(1, $id);
      $val->bindParam(2, $email);
      $val->bindParam(3, $fname);
      $val->bindParam(4, $lname);
      $val->bindParam(5, $lot);
      $val->bindParam(6, $monday);
      $val->bindParam(7, $tuesday);
      $val->bindParam(8, $wednesday);
      $val->bindParam(9, $thursday);
      $val->bindParam(10, $friday);


      if($val->execute()){
          //$welcome = "Welcome to OtterShare, ". $_SESSION['displayName'];
      $name = explode(' ',$_SESSION['displayName']);
          //$welcome = "Welcome to OtterShare, " . $name[0];
          ///////////

          $msg = "";

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
                      (Optional) This text will appear in the inbox preview, but not the email body.
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
                                              <h2>Welcome to Ottershare, '. $name[0].' </h2>
                                              <br>
                                              Join us in changing the way parking works here at CSUMB and tell your friends to make matching even easier!
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

          mail($email, "Welcome to OtterShare!", $msg, $headers);
          echo "Insertion Successful!";
      }
      else{
          echo "Insertion Failed!! You must already have an account with us. Head to the home page to login";
      }
  }

?>
