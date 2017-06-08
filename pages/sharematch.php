<?php
    require_once("../classes/dbHandler.php");
    session_start();
    $tableOut ='';

        if(isset($_SESSION['displayName']) && isset($_POST['usr_time'])){
            $db = Database::getInstance();
            $email = $_SESSION['emails'];
            $time = $_POST['usr_time'];

            if($_POST['daySelect'] == 'Monday'){
                $sql = "SELECT email,lname,fname,lot,monday,tuesday,wednesday,thursday,friday FROM Users WHERE email != ?
                        AND monday= ?";
            }
            if($_POST['daySelect'] == 'Tuesday'){
                $sql = "SELECT email,lname,fname,lot,monday,tuesday,wednesday,thursday,friday FROM Users WHERE email != ?
                        AND tuesday= ?";
            }
            if($_POST['daySelect'] == 'Wednesday'){
                $sql = "SELECT email,lname,fname,lot,monday,tuesday,wednesday,thursday,friday FROM Users WHERE email != ?
                        AND wednesday = ?";
            }
            if($_POST['daySelect'] == 'Thursday'){
                $sql = "SELECT email,lname,fname,lot,monday,tuesday,wednesday,thursday,friday FROM Users WHERE email != ?
                        AND thursday = ?";
            }
            if($_POST['daySelect'] == 'Friday'){
                $sql = "SELECT email,lname,fname,lot,monday,tuesday,wednesday,thursday,friday FROM Users WHERE email != ?
                        AND friday = ?";
            }



            $tableOut .= '  <h3>Share Pass Matches</h3>
              <div class="table-responsive">
                   <table class="table table-bordered">
                        <tr>
                             <th width="10%">Email</th>
                             <th width="10%">First Name</th>
                             <th width="10%">Last Name</th>
                             <th width="10%">Monday</th>
                             <th width="10%">Tuesday</th>
                             <th width="10%">Wednesday</th>
                             <th width="10%">Thursday</th>
                             <th width="10%">Friday</th>
                             <th width="10%">Preferred Lot</th>
                             <th width="10%">Request to Connect</th>
                        </tr>';
            //for taking into account loop
            $count=0;

            $val = $db->prepare($sql);
                  $val->bindParam(1, $email);
                  $val->bindParam(2, $time);
            if($val->execute()){
                while($retrieval = $val->fetch(PDO::FETCH_ASSOC)){
                  $email = 'onclick="emailUser(\''.$retrieval['email'].'\', \''. $retrieval['fname'].'\');"';
                  $tableOut .= '
                      <tr id = "row"'.$retrieval["email"].'>
                           <td id = "email_'.$retrieval['email'].'" >'.$retrieval["email"].'</td>
                           <td class="first_name" id="'.$retrieval["email"].'" contenteditable>'.$retrieval["fname"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["lname"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["monday"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["tuesday"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["wednesday"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["thursday"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["friday"].'</td>
                           <td class="last_name"  id="'.$retrieval["email"].'" contenteditable>'.$retrieval["lot"].'</td>
                           <td><input id = "emailToUser" name = "email" type="button" class="btn btn-primary" '.$email.' value="Contact!"></td>
                      </tr>
                      ';
                        //deletion button pulled out <td><button type="button" name="delete_btn" data-id3="'.$retrieval["email"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>

                    $count++;
                }
                if($count == 0){
                    echo "Share-Pass match not found, try again later, when we have a larger user base!";
                }
                else{
                    echo $tableOut;
                }
            }
            else{
                echo "Match not found, sorry.";

            }

        }

?>
