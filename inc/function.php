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

function checkNationalityAgentToTarget($agent, $target){
    $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
    $statement = $pdo->prepare('SELECT nationality FROM agent WHERE id = :id');
    $statement->bindParam(':id', $agent, PDO::PARAM_STR);
    if($statement->execute()){
        $agentNationality = $statement->fetch();
    }else{
        return false;
    }
    $statement = $pdo->prepare('SELECT nationality FROM target WHERE id = :id');
    $statement->bindParam(':id', $target, PDO::PARAM_STR);
    if($statement->execute()){
        $targetNationality = $statement->fetch();
    }else{
        return false;
    }

    if($agentNationality['nationality'] !== $targetNationality['nationality']){
        return true;
    }else{
        return false;
    }

}

function checkNationalityContactToCountryMission($contact, $country){
    $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
    $statement = $pdo->prepare('SELECT nationality FROM contact WHERE id = :id');
    $statement->bindParam(':id', $contact, PDO::PARAM_STR);
    if($statement->execute()){
        $contactNationality = $statement->fetch();
    }else{
        return false;
    }
    if($contactNationality['nationality'] === $country){
        return true;
    }else{
        return false;
    }

}
function checkCountrySafeHouseToMission($safeHouse, $country){
    $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
    $statement = $pdo->prepare('SELECT country FROM safe_house WHERE id = :id');
    $statement->bindParam(':id', $safeHouse, PDO::PARAM_STR);
    if($statement->execute()){
        $contactNationality = $statement->fetch();
    }else{
        return false;
    }
    if($contactNationality['nationality'] === $country){
        return true;
    }else{
        return false;
    }

}
function checkSpecialityAgentToMission($agentId, $speciality){
    $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
    $statement = $pdo->prepare('SELECT id_speciality FROM agent WHERE id = :id');
    $statement->bindParam(':id', $agentId, PDO::PARAM_INT);
    if($statement->execute()){
        $idSpeciality = $statement->fetch();
    }else{
        return false;
    }
    $statement = $pdo->prepare('SELECT name FROM speciality WHERE id = :id');
    $statement->bindParam(':id', $idSpeciality['id_speciality'], PDO::PARAM_INT);
    if($statement->execute()){
        $nameSpeciality = $statement->fetch();
    }else{
        return false;
    }

    if($nameSpeciality['name'] === $speciality){
        return true;
    }else {
        return false;
    }



}