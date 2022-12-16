<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/account.css">
</head>
<body>
<?php
$headerButtonsLinks = array(
    "Spaces" => LINK_SPACE,
    "Log out" => LINK_CONNECTION_LOGOUT
);
?>
<?php require_once("ressources/header.php"); ?>

<main>

    <section class="panel">
        <a href="#">
            <button class="button-selected">Profile and Settings</button>
        </a>
        <a href="<?= LINK_ACCOUNT_SPACE_SETTINGS ?>">
            <button>Share my spaces</button>
        </a>
    </section>

    <section>
        <div>
            <form method="post" action="<?= LINK_ACCOUNT . "&action=modifyAccount" ?>">
                <span>
                    <label for="pseudo"> Pseudo:</label>
                    <input id="name" type="text" name="name" placeholder="Pseudo" value="<?= $_SESSION['user_name'] ?>" maxlength="25" required>
                </span>
                <span>
                    <label for="email" > Email:</label>
                    <input id="email" type="email" name="email" placeholder="Email" value="<?= $_SESSION['user_email'] ?>" required>
                </span>
                <span>
                    <label for="changepass"> Change Pass: </label>
                    <input id="changepass" type="password" name="changepass" placeholder="Enter new pass" minlength="8">
                </span>
                <span>
                    <label for="confpass"> Confirm Pass: </label>
                    <input id="confpass" type="password" name="confpass" placeholder="Confirm new pass" minlength="8">
                </span>
                <input type="submit" value="Save" class="save">
            </form>
        </div>
        <div>
            <img src="">
        </div>
    </section>

</main>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>