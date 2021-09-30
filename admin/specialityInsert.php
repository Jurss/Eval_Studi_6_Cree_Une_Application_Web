<?php
include "../inc/function.php";
include '../inc/header.php';
logged_only();

require_once '../class/ListingData.php';
$listingCols = new ListingData();
$cols = $listingCols->getColumns('speciality');

if(!empty($_POST) && !empty($_POST['name'])){
    require_once '../class/Speciality.php';
    $data = new Speciality();

    if(preg_match("/^([a-zA-Z' ]+)$/", $_POST['name'])){
        $data->setName($_POST['name']);

        if($data->insertDataSpeciality() === false){
            $_SESSION['flash']['danger'] = 'An error has occurred';
        }else{
            $_SESSION['flash']['success'] = "Success";
            header('Location: admin.php');
            exit();
        }
    }else{
        $_SESSION['flash']['danger'] = "Name is inccorect";
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
        <legend>Speciality</legend>
        <?php foreach ($cols as $col): ?>
            <?php if($col['Field'] != 'id'): ?>
                <div class="form-group">
                    <label for="<?php echo $col['Field'] ?>" class="col-lg-2 control-label"><?php echo $col['Field'] ?></label>
                    <div class="col-lg-10">
                            <input class="inputInsertData" type="text" class="form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
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