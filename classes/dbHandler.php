<?php
    require_once('database.php');
    function emailExists($googEmail){
        $db = Database::getInstance();
        $sql = "SELECT email FROM Users WHERE email =:email";
        $val = $db->prepare($sql);
        $val->bindParam(':email', $googEmail);
        $val->execute();
        $shoop = $val->fetch();
        //echo $sql;
        //var_dump($shoop);
        if($googEmail == $shoop['email']){
            return true;
        }
        else {
            return false;
        }
        //checkboxes, if clicked next to time then we pull time and day
    }



?>