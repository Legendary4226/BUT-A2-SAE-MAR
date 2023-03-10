<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAR - Sign In</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/login_signin.css">
</head>
<body>
<div class="wrapper-body">
<?
$headerButtonsLinks = array(
    "Home" => LINK_HOME,
    "Sign Up" => LINK_CONNECTION_SIGNUP
);
?>
<? require_once("ressources/header.php"); ?>

<main>
    <form method="POST" action="<?= LINK_CONNECTION_SIGNIN ?>" class="form-login-signin">
        <fieldset>
            <span>
                <label for="email" >Email* :</label>
                <input id="email" type="email" name="email">
            </span>
            
            <span>
                <label for="pass">Password* :</label>
                <input id="pass" type="password" name="pass">
            </span>
        </fieldset>
        
        <input type="submit" value="Log in">
    </form>
</main>

<? require_once("ressources/footer.php"); ?>
</div>
</body>
</html>