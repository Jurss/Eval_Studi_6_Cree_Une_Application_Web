<?php
function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "Acces Denied";
        header('Location: ../index.php');
        exit();
    }
}

function isValidDate($date, $format = 'Y-m-d'){
    $dt = DateTime::createFromFormat($format, $date);
    return $dt && $dt->format($format) === $date;
}

function separeName($fullName){
    $index = strpos($fullName, ' ');
    $firstName = substr($fullName, 0, $index);
    $lastName = substr($fullName,$index+1 );
    return $arr = [$firstName, $lastName];
}

function separeSafeHouse($full){
    $index = strpos($full, '-');
    $name = substr($full, 0, $index -1);
    return $name;
}