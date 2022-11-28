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
    <?php require_once("ressources/header.php"); ?>

    <main>
        <form method="POST" action="<?= LINK_SIGNIN . "&action=createAccount" ?>" class="form-login-signin">
            <fieldset>
                <span>
                    <label for="email" > Email* :</label>
                    <input id="email" type="email" name="email" required>
                </span>
                <span>
                    <label for="pseudo"> Pseudo* :</label>
                    <input id="pseudo" type="text" name="pseudo" maxlength="25" required>
                </span>
                <span>
                    <label for="password"> Password* : </label>
                    <input id="password" type="password" name="password" minlength="8" required>
                </span>
                <span>
                    <label for="confpass"> Confirm Pass* : </label>
                    <input id="confpass" type="password" name="confpass" minlength="8" required>
                </span>
            </fieldset>

            <input type="submit" value="Sign in">
        </form>
    </main>

    <?php require_once("ressources/footer.php"); ?>
</body>
</html>