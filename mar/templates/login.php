<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/login_signin.css">
</head>
<body>
<?php
$headerButtonsLinks = array(
    "Home" => LINK_HOME,
    "Signin" => LINK_SIGNIN
);
?>
<?php require_once("ressources/header.php"); ?>

<main>
    <form method="POST" action="<?= LINK_LOGIN . "&action=LoggedAccount" ?>" class="form-login-signin">
        <fieldset>
            <span>
                <label for="email" >Email* :</label>
                <input id="email" type="email" name="email">
            </span>
            
            <span>
                <label for="password">Password* :</label>
                <input id="password" type="password" name="password">
            </span>
        </fieldset>
        
        <input type="submit" value="Log in">
    </form>
</main>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>