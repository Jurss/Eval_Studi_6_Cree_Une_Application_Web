<?php
require_once '../class/ListingData.php';

$getData = new ListingData();
$titleMission = $getData->getSpecificData('mission', 'title');

echo json_encode($titleMission);