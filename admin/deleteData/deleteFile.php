<?php
include "../../inc/function.php";
logged_only();

include "../../class/Delete.php";

if(!empty($_GET) && !empty($_GET['id']) && $_GET['table']){
    $table = strtolower($_GET['table']);
    echo $_GET['id'];
    echo $table;
    $req = new Delete();
    if($req->delete($_GET['id'],$table) == false){
        $_SESSION['flash']['danger'] = 'An error has occurred';
    }else{
        $_SESSION['flash']['success'] = "Success";
        header('Location: ../admin.php');
        exit();
    }

}

?>