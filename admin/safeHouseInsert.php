<?php

include "../inc/function.php";
include '../inc/header.php';
logged_only();

require_once '../class/ListingData.php';
$listingCols = new ListingData();
$cols = $listingCols->getColumns('safe_house');

if(!empty($_POST) && !empty($_POST['code']) && !empty($_POST['address']) && !empty($_POST['country']) && !empty($_POST['type'])){
    require_once '../class/SafeHouse.php';
    $data = new SafeHouse();
    echo $_POST['code'].'<br>';
    echo $_POST['address'].'<br>';
    echo $_POST['country'].'<br>';
    echo $_POST['type'].'<br>';

    if(preg_match("/^([a-zA-Z' ]+)$/", $_POST['code'])) {
        if (preg_match("/^([a-zA-Z0-9' ]+)$/", $_POST['address'])) {
            if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['country'])) {
                if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['type'])) {
                    $data->setCode($_POST['code']);
                    $data->setAddress($_POST['address']);
                    $data->setCountry($_POST['country']);
                    $data->setType($_POST['type']);

                    if ($data->insertDataSafeHouse() === false) {
                        $_SESSION['flash']['danger'] = 'An error has occurred';
                    } else {
                        $_SESSION['flash']['success'] = "Success";
                        header('Location: admin.php');
                        exit();
                    }
                } else {
                    $_SESSION['flash']['danger'] = "Type is inccorect";
                }
            } else {
                $_SESSION['flash']['danger'] = "Country is inccorect";
            }
        } else {
            $_SESSION['flash']['danger'] = "Address is inccorect";
        }
    } else {
        $_SESSION['flash']['danger'] = "Code is inccorect";
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
            <legend>Target</legend>
            <?php foreach ($cols as $col): ?>
                <?php if($col['Field'] != 'id'): ?>
                    <div class="form-group">
                        <label for="<?php echo $col['Field'] ?>" class="col-lg-2 control-label"><?php echo $col['Field'] ?></label>
                        <div class="col-lg-10">
                            <input type="text" class="inputInsertData form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Send Data</button>
        </fieldset>
    </form>
<?php
include '../inc/footer.php';