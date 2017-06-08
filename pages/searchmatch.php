<?php
    require_once("../classes/dbHandler.php");
    session_start();
    $tableOut = "";
        if(isset($_SESSION['displayName'])){
            $db = Database::getInstance();
            $email = $_SESSION['emails'];
            $sql = "SELECT lot,monday,tuesday,wednesday,thursday,friday FROM Users WHERE email = :email";

            //Gonna grab every day of the week from logged in user,
            //then I am going to SQL for any match days in all of my database(for any user)
            $val = $db->prepare($sql);
            $val->bindParam(':email', $email);
            $val->execute();
            $retrieval = $val->fetch(PDO::FETCH_ASSOC);

            //retrieval seems to pull info
            $mon = $retrieval['monday'];
            $tue = $retrieval['tuesday'];
            $wed = $retrieval['wednesday'];
            $thurs = $retrieval['thursday'];
            $fri = $retrieval['friday'];

            //Putting random values into variables to make sure they don't equal blank spaces in database
            if(empty($mon)){
                $mon = '--';
            }
            if(empty($tue)){
                $tue = '--';
            }
            if(empty($wed)){
                $wed = '--';
            }
            if(empty($thurs)){
                $thurs = '--';
            }
            if(empty($fri)){
                $fri = '--';
            }
            //we will make a HUGE sql query that will search for each day where email != (our user)email

            $tableOut .= '<h3>Matches (Car pool buddies) </h3>
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
            $count = 0;
            $sql = "SELECT lot,email,lname,fname,monday,tuesday,wednesday,thursday,friday
                    FROM Users WHERE email != ? AND
                    (monday = ? OR tuesday= ? OR wednesday= ?
                    OR thursday= ? OR friday= ?)";
            $val = $db->prepare($sql);
                  $val->bindParam(1, $email);
                  $val->bindParam(2, $mon);
                  $val->bindParam(3, $tue);
                  $val->bindParam(4, $wed);
                  $val->bindParam(5, $thurs);
                  $val->bindParam(6, $fri);
            
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

                        //on button, we have an onClick in jQuery that grabs value (email), sends to a php file via ajax that emails our user
                        //deletion button pulled out <td><button type="button" name="delete_btn" data-id3="'.$retrieval["email"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>

                    $count++;
                }
                if($count == 0){
                    echo "(Car buddy) Match not found, try again later, when we have a larger user base!";
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
