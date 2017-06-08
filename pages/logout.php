<?php 
    require_once('../app/init.php');
    //$auth = new GoogleAuth();
    //$auth ->logout();
    //unset($_SESSION['emails']);
    session_destroy();
    
    //unsets email user, essentially logging out. 
    header('Location: https://accounts.google.com/logout');

?>