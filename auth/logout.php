<?php
session_start();
unset($_SESSION['auth']);

$_SESSION['flash']['success'] = "disconnected";

header('Location: ../index.php');