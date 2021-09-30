<?php
include "../class/getSpecialityRequired.php";
$getData = new getSpecialityRequired();
$data = $getData->getSpecialityRequired($_GET['id']);

echo json_encode($data);