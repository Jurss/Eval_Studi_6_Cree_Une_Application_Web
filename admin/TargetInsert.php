<?php
include "../inc/function.php";
include '../inc/header.php';
logged_only();

require_once '../class/ListingData.php';
$listingCols = new ListingData();
$cols = $listingCols->getColumns('target');

if(!empty($_POST) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['birth_date']) && !empty($_POST['code_name']) && !empty($_POST['nationality'])) {
    require_once '../class/Target.php';
    $dataS = new Target();

    if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['firstName'])) {
        if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['lastName'])) {
            if (isValidDate($_POST['birth_date']) === true) {
                if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['code_name'])) {
                    if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['nationality'])) {
                        $dataS->setFirstName($_POST['firstName']);
                        $dataS->setLastName($_POST['lastName']);
                        $dataS->setBirthDate($_POST['birth_date']);
                        $dataS->setCodeName($_POST['code_name']);
                        $dataS->setNationality($_POST['nationality']);

                        if ($dataS->insertDataTarget() === false) {
                            $_SESSION['flash']['danger'] = 'An error has occurred';
                        } else {
                            $_SESSION['flash']['success'] = "Success";
                            header('Location: admin.php');
                            exit();
                        }
                    } else {
                        $_SESSION['flash']['danger'] = "Nationality is inccorect";
                    }
                } else {
                    $_SESSION['flash']['danger'] = "code_name is inccorect";
                }
            } else {
                $_SESSION['flash']['danger'] = "birth_date is inccorect";
            }
        } else {
            $_SESSION['flash']['danger'] = "lastName is inccorect";
        }
    } else {
        $_SESSION['flash']['danger'] = "firstName is inccorect";
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
                        <?php if($col['Type'] == 'date'): ?>
                            <input type="date"class="inputInsertData form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        <?php else: ?>
                            <input type="text" class="inputInsertData form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Send Data</button>
    </fieldset>
</form>
