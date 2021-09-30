<?php
include "../class/ListingData.php";
$req = new ListingData();
$dataAgentFirstName = $req->getSpecificData('agent', 'firstName');
$dataAgentLastName = $req->getSpecificData('agent', 'lastName');

$fullNameAgent = array();
for($i = 0; $i<sizeof($dataAgentFirstName); $i++){
    $fullNameAgent[$i] = $dataAgentFirstName[$i] + $dataAgentLastName[$i];
}

echo json_encode($fullNameAgent);