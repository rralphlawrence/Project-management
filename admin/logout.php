<?php

    include_once '../includes/dbprocess.php';
    unset($_SESSION['nameHolder']); 
    unset($_SESSION['usertypeHolder']); 
    $_SESSION ['response'] = "Successfully Logout!";
    $_SESSION ['res_type']= "success";
    header("Location: ../index.php");
?>