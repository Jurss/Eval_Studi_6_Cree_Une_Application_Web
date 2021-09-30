<?php
include "../inc/function.php";
include '../inc/header.php';
logged_only();

$table = $_POST['table'];

header('Location: '.$table.'Insert.php');

