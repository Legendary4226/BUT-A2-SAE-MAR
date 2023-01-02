<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/login_signin.css">
</head>
<body>
<?
$headerButtonsLinks = array(
    "Home" => LINK_HOME,
    "Sign In" => LINK_CONNECTION_SIGNIN
);
?>
<? require_once("ressources/header.php"); ?>

<main>
    <form method="POST" action="<?= LINK_CONNECTION_SIGNUP ?>" class="form-login-signin">
        <fieldset>
            <span>
                <label for="email" > Email* :</label>
                <input id="email" type="email" name="email" required>
            </span>
            <span>
                <label for="username"> Pseudo* :</label>
                <input id="username" type="text" name="username" maxlength="25" required>
            </span>
            <span>
                <label for="pass"> Password* : </label>
                <input id="pass" type="password" name="pass" minlength="8" required>
            </span>
            <span>
                <label for="confpass"> Confirm Pass* : </label>
                <input id="confpass" type="password" name="confpass" minlength="8" required>
            </span>
        </fieldset>

        <input type="submit" value="Sign up">
    </form>
</main>

<? require_once("ressources/footer.php"); ?>
</body>
</html>