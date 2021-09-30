<?php

include "../inc/function.php";
include '../inc/header.php';
logged_only();

require_once '../class/ListingData.php';
$listingCols = new ListingData();
$cols = $listingCols->getColumns('admin');

if(!empty($_POST) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['mail']) && !empty($_POST['password'])){
    require_once '../class/Admin.php';
    $data = new Admin();

    if(preg_match("/^([a-zA-Z' ]+)$/", $_POST['firstName'])){
        if(preg_match("/^([a-zA-Z' ]+)$/", $_POST['lastName'])){
            if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['mail'])){
                    $data->setFirstName($_POST['firstName']);
                    $data->setLastName($_POST['lastName']);
                    $data->setMail($_POST['mail']);
                    $data->setPassword($_POST['password']);

                    if($data->insertDataAdmin() === false){
                        $_SESSION['flash']['danger'] = 'An error has occurred';
                    }else{
                        $_SESSION['flash']['success'] = "Success";
                        header('Location: admin.php');
                        exit();
                    }
            }else{
                $_SESSION['flash']['danger'] = "Mail is inccorect";
            }
        }else{
            $_SESSION['flash']['danger'] = "LastName is inccorect";
        }
    }else{
        $_SESSION['flash']['danger'] = "FirstName is inccorect";
    }
}
?>
    <div class="back">
        <a href="admin.php" class="btn btn-success">Back</a>
    </div>

    <?php if(isset($_SESSION['flash'])):  ?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php unset($_SESSION['flash']); ?>
    <form id="formInsertData" action="" method="post" class="jumbotron form-horizontal">
        <fieldset>
            <legend>Admin</legend>
            <?php foreach ($cols as $col): ?>
                <?php if($col['Field'] != 'id' && $col['Type'] != "date"): ?>
                    <div class="form-group">
                        <label for="<?php echo $col['Field'] ?>" class="col-lg-2 control-label"><?php echo $col['Field'] ?></label>
                        <div class="col-lg-10">
                        <?php if($col['Field'] == 'password'): ?>
                            <input class="inputInsertData" type="password" class="form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        <?php else: ?>
                            <input class="inputInsertData" type="text" class="form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Send Data</button>
        </fieldset>
    </form>
    <?php if(isset($_SESSION['flash'])):  ?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php unset($_SESSION['flash']); ?>


<?php
include '../inc/footer.php';