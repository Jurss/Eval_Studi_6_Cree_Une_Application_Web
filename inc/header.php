<?php
    if(session_status() == PHP_SESSION_NONE ){
        session_start();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/insertData.css">
    <title>Secret agent management</title>
</head>
<body>
<header>

    <div class="navbar navbar-default">
        <h1>Secret Agent mamangement</h1>
        <?php if(isset($_SESSION['auth'])): ?>
            <a href="../auth/logout.php" class="btn btn-danger">Log Out</a>
        <?php else: ?>
            <a href="auth/formAuth.php" class="btn btn-info">Sign up</a>
        <?php endif; ?>
    </div>
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
</header>

