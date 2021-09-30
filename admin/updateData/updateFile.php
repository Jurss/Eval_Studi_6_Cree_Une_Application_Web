<?php

include "../../inc/function.php";
logged_only();

require_once '../../class/Update.php';
include 'header.php';

$id = $_GET['id'];
$table = strtolower($_GET['table']);
$colName = $_GET['colName'];



if(!empty($_POST) && !empty($_POST['colValue'])){
    $req = new Update();
    if($req->update($_POST['table'], $_POST['id'], $_POST['colName'], $_POST['colValue']) === false){
        $_SESSION['flash']['danger'] = 'An error has occurred';
    }else{
        $_SESSION['flash']['success'] = "Success";
        header('Location: ../admin.php');
        exit();
    }

}

?>
<div class="back">
    <a href="update.php" class="btn btn-success">Back</a>
</div>

<form method="post" action="" class="jumbotron" style="padding-left: 50px">
    <legend><?php echo $_GET['colName'] ?></legend>
    <input type="text" name="colValue" class="inputStyle">
    <input type="text" name="id" style="display: none" value="<?php echo $id ?>">
    <input type="text" name="table" style="display: none" value="<?php echo $table ?>">
    <input type="text" name="colName" style="display: none" value="<?php echo $colName ?>">
    <button type="submit" class="btn btn-primary">Send</button>
</form>
