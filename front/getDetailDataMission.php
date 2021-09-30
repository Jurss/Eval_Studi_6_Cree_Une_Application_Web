<?php

include "../class/GetDetailMission.php";
$getData = new GetDetailMission();
$data = $getData->getDetailMission($_GET['title']);

echo json_encode($data);