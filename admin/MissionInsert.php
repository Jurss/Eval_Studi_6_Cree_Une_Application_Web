<?php
include "../inc/function.php";
include '../inc/header.php';
logged_only();

require_once '../class/ListingData.php';
$listingCols = new ListingData();
$cols = $listingCols->getColumns('mission');

require_once '../class/ListingData.php';
$listing = new ListingData();
$data = $listing->getSpecificData('speciality', 'name');

if(!empty($_POST) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['code_name']) && !empty($_POST['country']) && !empty($_POST['type_assignment']) && !empty($_POST['status']) && !empty($_POST['require_Speciality']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
    require_once '../class/Mission.php';
    $dataS = new Mission();

    if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['title'])) {
        if (preg_match("/^([a-zA-Z',. ]+)$/", $_POST['description'])) {
            if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['code_name'])) {
                if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['country'])) {
                    if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['type_assignment'])) {
                        if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['status'])) {
                                if (isValidDate($_POST['start_date']) === true) {
                                    if (isValidDate($_POST['end_date']) === true) {
                                        $dataS->setTitle($_POST['title']);
                                        $dataS->setDescription($_POST['description']);
                                        $dataS->setCodeName($_POST['code_name']);
                                        $dataS->setCountry($_POST['country']);
                                        $dataS->setTypeAssignment($_POST['type_assignment']);
                                        $dataS->setStatus($_POST['status']);
                                        $dataS->setDateStart($_POST['start_date']);
                                        $dataS->setDateEnd($_POST['end_date']);


                                        $result = $listing->getForeignKeyIdSpeciality($_POST['require_Speciality']);
                                        $dataS->setIdRequireSpeciality($result);

                                        if($dataS->insertDataMission() === false){
                                            $_SESSION['flash']['danger'] = 'An error has occurred';
                                        }else{
                                            $_SESSION['flash']['success'] = "Success";
                                            header('Location: admin.php');
                                            exit();
                                        }
                                    } else {
                                        $_SESSION['flash']['danger'] = "end_date is inccorect";
                                    }
                                } else {
                                    $_SESSION['flash']['danger'] = "start_date is inccorect";
                                }
                        } else {
                            $_SESSION['flash']['danger'] = "status is inccorect";
                        }
                    } else {
                        $_SESSION['flash']['danger'] = "type_assignement is inccorect";
                    }
                } else {
                    $_SESSION['flash']['danger'] = "country is inccorect";
                }
            } else {
                $_SESSION['flash']['danger'] = "code_name is inccorect";
            }
        } else {
            $_SESSION['flash']['danger'] = "description is inccorect";
        }
    } else {
        $_SESSION['flash']['danger'] = "title is inccorect";
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
        <legend>Mission</legend>
        <?php foreach ($cols as $col): ?>
            <?php if($col['Field'] != 'id'): ?>
                <div class="form-group">
                    <?php if($col['Field'] == 'id_require_speciality'): ?>
                        <label for="require Speciality" class="col-lg-2 control-label">require Speciality</label>
                    <?php else: ?>
                        <label for="<?php echo $col['Field'] ?>" class="col-lg-2 control-label"><?php echo $col['Field'] ?></label>
                    <?php endif; ?>
                    <div class="col-lg-10">
                        <?php if($col['Type'] == 'date'): ?>
                            <input type="date"class="inputInsertData form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        <?php elseif($col['Field'] == 'type_assignment'): ?>
                            <input type="text"class="inputInsertData form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" placeholder="Exemple: extraction" required>
                        <?php elseif($col['Field'] == 'id_require_speciality'): ?>
                            <select class="inputInsertData form-control" name="require Speciality" id="require Speciality">
                                <?php foreach ($data as $dataOccurence) { ?>

                                    <?php foreach ($dataOccurence as $d) { ?>

                                        <option><?php echo $d; ?></option>

                                    <?php } ?>

                                <?php } ?>
                            </select>
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
