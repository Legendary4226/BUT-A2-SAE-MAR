<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/account.css">
</head>
<body>
<?php
$headerButtonsLinks = array(
    "Log out" => LINK_LOGOUT
);
?>
<?php require_once("ressources/header.php"); ?>

<main>
    
    <div>
        <button class="button-selected">Profile and Settings</button>
        <button>Share my spaces</button>
    </div>
    <div>
        <div>
            <form method="post" action="<?= LINK_ACCOUNT . "&action=modifiedAccount" ?>">
                <span>
                    <label for="pseudo"> Pseudo:</label>
                    <input id="pseudo" type="text" name="pseudo" placeholder="Pseudo" value="<?= $accountInfos[0] ?>" maxlength="25" required>
                </span>
                <span>
                    <label for="email" > Email:</label>
                    <input id="email" type="email" name="email" placeholder="Email" value="<?= $accountInfos[1] ?>" required>
                </span>
                <span>
                    <label for="changepass"> Change Pass: </label>
                    <input id="changepass" type="password" name="changepass" placeholder="Enter new pass" minlength="8">
                </span>
                <span>
                    <label for="confpass"> Confirm Pass: </label>
                    <input id="confpass" type="password" name="confpass" placeholder="Confirm new pass" minlength="8">
                </span>
                <span>
                    <label for="theme" class="test"> Theme: </label>
                    <select name="theme" class="theme">
                        <option>Default-White</option>
                        <option>Dark</option>
                    </select>
                </span>
                <input type="submit" value="Save" class="save">
            </form>
        </div>
        <div>
            <img src="">
        </div>
    </div>

</main>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>