<?php
if(!empty($_POST) && !empty($_POST['mail']) && !empty($_POST['password'])) {
    $errors = array();
    $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
    $statement = $pdo->prepare('SELECT * FROM admin;');

    if ($statement->execute() !== false) {
        $testConnexion = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($testConnexion as $testLogin) {
            if ($testLogin['mail'] === $_POST['mail']) {
                if (password_verify($_POST['password'], $testLogin['password'])) {
                    session_start();
                    $_SESSION['auth'] = $_POST['mail'];
                    header('Location: ../admin/admin.php');
                } else {
                    $errors['denied'] = 'Wrong Email/Password';
                }

            } else {
                $errors['denied'] = 'Wrong Email/Password';
            }
        }
    }
}
include '../inc/header.php';
?>
    <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Access denied:</p>
        <?php echo $errors['denied'] ?>
    </div>
    <?php endif; ?>

    <div class="jumbotron">
        <form method="post" class="form-horizontal form-style">
            <fieldset>
                <div class="form-group">
                    <label for="mail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="text" name="mail" id="mail" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php
include '../inc/footer.php';

