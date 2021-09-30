<?php
include 'header.php';
include "../../inc/function.php";

require_once "../../class/ListingData.php";

$req = new ListingData();

$colsMission = $req->getColumns('mission');
$dataSpeciality = $req->getSpecificData('speciality', 'name');

$dataAgentFirstName = $req->getSpecificData('agent', 'firstName');
$dataAgentLastName = $req->getSpecificData('agent', 'lastName');

$dataTargetFirstName = $req->getSpecificData('target', 'firstName');
$dataTargetLastName = $req->getSpecificData('target', 'lastName');

$dataContactFirstName = $req->getSpecificData('contact', 'firstName');
$dataContactLastName = $req->getSpecificData('contact', 'lastName');

$dataSafeHouseCode = $req->getSpecificData('safe_house', 'code');
$dataSafeHouseCountry = $req->getSpecificData('safe_house', 'country');

if(empty($_POST)){
    $fullNameAgent =array();
    $fullNameTarget = array();
    $fullNameContact = array();
    $concatSafeHouse = array();
    for($i = 0; $i<sizeof($dataAgentFirstName); $i++){
        $fullNameAgent[$i] = $dataAgentFirstName[$i] + $dataAgentLastName[$i];
    }
    for($i = 0; $i<sizeof($dataTargetFirstName); $i++){
        $fullNameTarget[$i] = $dataTargetFirstName[$i] + $dataTargetLastName[$i];
    }
    for($i = 0; $i<sizeof($dataContactFirstName); $i++){
        $fullNameContact[$i] = $dataContactFirstName[$i] + $dataContactLastName[$i];
    }
    for($i = 0; $i<sizeof($dataSafeHouseCode); $i++){
        $concatSafeHouse[$i] = $dataSafeHouseCode[$i] + $dataSafeHouseCountry[$i];
    }
}

if(!empty($_POST) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['code_name']) && !empty($_POST['country']) && !empty($_POST['type_assignment']) && !empty($_POST['status']) && !empty($_POST['require_speciality']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
    require_once "../../class/Mission.php";
    require_once "../../class/AssignAgentToMission.php";
    require_once "../../class/AssignContactToMission.php";
    require_once "../../class/AssignSafeHouseToMission.php";
    require_once "../../class/AssignTargetToMission.php";

    $mission = new Mission();
    $agent = new AssignAgentToMission();
    $contact = new AssignContactToMission();
    $safeHouse = new AssignSafeHouseToMission();
    $target = new AssignTargetToMission();

    $agentSepareName = separeName($_POST['assign_agent']);
    $TargetSepareName = separeName($_POST['assign_target']);
    $ContactSepareName = separeName($_POST['assign_contact']);


    if (preg_match("/^([a-zA-Z0-9' ]+)$/", $_POST['title'])) {
        if (preg_match("/^([a-zA-Z0-9',. ]+)$/", $_POST['description'])) {
            if (preg_match("/^([a-zA-Z0-9' ]+)$/", $_POST['code_name'])) {
                if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['country'])) {
                    if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['type_assignment'])) {
                        if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['status'])) {
                            if (isValidDate($_POST['start_date']) === true) {
                                if (isValidDate($_POST['end_date']) === true) {

                                    $mission->setTitle($_POST['title']);
                                    $mission->setDescription($_POST['description']);
                                    $mission->setCodeName($_POST['code_name']);
                                    $mission->setCountry($_POST['country']);
                                    $mission->setTypeAssignment($_POST['type_assignment']);
                                    $mission->setStatus($_POST['status']);
                                    $mission->setDateStart($_POST['start_date']);
                                    $mission->setDateEnd($_POST['end_date']);
                                    $mission->setIdRequireSpeciality($req->getForeignKeyIdSpeciality($_POST['require_speciality']));



                                    if($mission->insertDataMission() === true ){

                                        $idMission = $mission->getUuid($_POST['title']);
                                        $agentId = $req->getForeignKeyFullName('agent', $agentSepareName[0], $agentSepareName[1]);
                                        $targetId = $req->getForeignKeyFullName('target', $TargetSepareName[0], $TargetSepareName[1]);
                                        $contactId = $req->getForeignKeyFullName('contact', $ContactSepareName[0], $ContactSepareName[1]);

                                        $safeHouseName = separeSafeHouse($_POST['assign_safe_house']);
                                        $safeHouseId = $req->getIdSafeHouse($safeHouseName);

                                        $agent->setIdAgent($agentId['id']);
                                        $agent->setIdMission($idMission['id']);

                                        $target->setIdTarget($targetId['id']);
                                        $target->setIdMission($idMission['id']);

                                        $contact->setIdContact($contactId['id']);
                                        $contact->setIdMission($idMission['id']);

                                        $safeHouse->setIdSafeHouse($safeHouseId['id']);
                                        $safeHouse->setIdMission($idMission['id']);

                                        if($agent->insertDataAssignAgent() === true && $target->insertDataAssignTarget() === true && $contact->insertDataAssignContact() === true && $safeHouse->insertDataAssignSafeHouse() === true){
                                            $_SESSION['flash']['success'] = "Success";
                                            header('Location: ../admin.php');
                                            exit();
                                        }else{
                                            $_SESSION['flash']['danger'] = 'An error has occurred';
                                        }
                                    }else{
                                        $_SESSION['flash']['danger'] = 'An error has occurred';
                                    }
                                } else {
                                    $_SESSION['flash']['danger'] = "end_date is incorrect";
                                }
                            } else {
                                $_SESSION['flash']['danger'] = "start_date is incorrect";
                            }
                        } else {
                            $_SESSION['flash']['danger'] = "status is incorrect";
                        }
                    } else {
                        $_SESSION['flash']['danger'] = "type_assignment is incorrect";
                    }
                } else {
                    $_SESSION['flash']['danger'] = "country is incorrect";
                }
            } else {
                $_SESSION['flash']['danger'] = "code_name is incorrect";
            }
        } else {
            $_SESSION['flash']['danger'] = "description is incorrect";
        }
    } else {
        $_SESSION['flash']['danger'] = "title is incorrect";
    }
}
?>

<div id="remove-alert" onclick="setTimeout(function () {document.getElementById('remove-alert').style.display='none'}, 1); return false">
    <?php if(isset($_SESSION['flash'])):  ?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php unset($_SESSION['flash']); ?>
</div>
<div class="back">
    <a href="../admin.php" class="btn btn-success">Back</a>
</div>

<div class="jumbotron">
    <form method="post" action="" class="form-horizontal form-style">
        <fieldset>
            <legend>Create Mission</legend>
            <?php foreach ($colsMission as $col) : ?>
                <?php if($col['Field'] != 'id'): ?>
                    <?php if($col['Field'] == 'id_require_speciality'): ?>
                    <div class="form-group">
                        <label for="require_speciality" class="col-lg-2 control-label">Required Speciality</label>
                        <div class="col-lg-10">
                            <select class="inputStyle form-control" name="require_speciality" id="require_speciality" required>
                                <?php foreach ($dataSpeciality as $data) : ?>
                                    <?php foreach ($data as $d) : ?>
                                        <option><?php echo $d; ?></option>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <?php elseif($col['Field'] == 'status'): ?>
                    <div class="form-group">
                        <label for="status" class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-10">
                            <select class="inputStyle form-control" name="status" id="status" required>
                                <option>In preparation</option>
                                <option>In progress</option>
                                <option>Completed</option>
                                <option>Failed</option>
                            </select>
                        </div>
                    </div>
            <?php elseif($col['Type'] == 'date'): ?>
                    <div class="form-group">
                        <label for="<?php echo $col['Field'] ?>" class="col-lg-2 control-label"><?php echo $col['Field'] ?></label>
                        <div class="col-lg-10">
                            <input type="date" class="inputInsertData form-control" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                        </div>
                    </div>

            <?php else: ?>
                <div class="form-group">
                    <label for="<?php echo $col['Field'] ?>" class="col-lg-2 control-label"><?php echo $col['Field'] ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control inputStyle" name="<?php echo $col['Field'] ?>" id="<?php echo $col['Field'] ?>" required>
                    </div>
                </div>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach; ?>

        </fieldset>
        <fieldset>
            <div class="form-group">
                <label for="assign_agent" class="col-lg-2 control-label">assigned an agent</label>
                <div id="dynamic_field" class="col-lg-10">
                    <select class="inputStyle form-control" name="assign_agent" id="assign_agent" required>
                        <?php foreach ($fullNameAgent as $data): ?>
                            <option><?php echo $data['firstName'].' '.$data['lastName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <label for="assign_target" class="col-lg-2 control-label">assigned a target</label>
                <div class="col-lg-10">
                    <select class="inputStyle form-control" name="assign_target" id="assign_target" required>
                        <?php foreach ($fullNameTarget as $data): ?>
                            <option><?php echo $data['firstName'].' '.$data['lastName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <label for="assign_contact" class="col-lg-2 control-label">assigned a contact</label>
                <div class="col-lg-10">
                    <select class="inputStyle form-control" name="assign_contact" id="assign_contact" required>
                        <?php foreach ($fullNameContact as $data): ?>
                            <option><?php echo $data['firstName'].' '.$data['lastName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <label for="assign_safe_house" class="col-lg-2 control-label">assigned a safe house</label>
                <div class="col-lg-10">
                    <select class="inputStyle form-control" name="assign_safe_house" id="assign_safe_house" required>
                        <?php foreach ($concatSafeHouse as $data): ?>
                            <option><?php echo $data['code'].' - '.$data['country'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-success">Send</button>
    </form>