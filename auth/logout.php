<?php
session_start();
unset($_SESSION['auth']);

$_SESSION['flash']['success'] = "disconnected";
session_destroy();

header('Location: ../index.php');