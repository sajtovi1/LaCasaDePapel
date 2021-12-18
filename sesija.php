<?php

include 'Baza.php';

session_start();

$baza = new Baza();

if(!isset($_SESSION['planUToku'])){
    $_SESSION['planUToku'] = false;
}

if(!isset($_SESSION['allowNew'])){
    $_SESSION['allowNew'] = false;
}

if(!isset($_SESSION['allowEdit'])){
    $_SESSION['allowEdit'] = false;
}

if(!isset($_SESSION['allowDelete'])){
    $_SESSION['allowDelete'] = false;
}

if(isset($_POST['plan'])){
    $nazivPlana = trim($_POST['nazivPlana']);

    if($nazivPlana == 'Berlin'){
        $_SESSION['allowNew'] = true;
        $_SESSION['planUToku'] = true;
    }

    if($nazivPlana == 'Tokyo'){
        $_SESSION['allowEdit'] = true;
        $_SESSION['planUToku'] = true;
    }

    if($nazivPlana == 'Paris'){
        $_SESSION['allowDelete'] = true;
        $_SESSION['planUToku'] = true;
    }
}