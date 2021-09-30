<?php
session_start();
$table = $_POST['table'];
$_SESSION['tableDynamic'] = $_POST['table'];

header('Location: update.php');