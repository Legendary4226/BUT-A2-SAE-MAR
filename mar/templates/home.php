<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/home.css">
</head>
<body>
<?

if ($_SESSION['user_id'] == null) {
    $headerButtonsLinks = array(
        'Sign Up' => LINK_CONNECTION_SIGNUP,
        'Sign In' => LINK_CONNECTION_SIGNIN
    );
} else {
    $headerButtonsLinks = array(
        'Account' => LINK_ACCOUNT,
        'Log Out' => LINK_CONNECTION_LOGOUT
    );
}
?>
<? require_once("ressources/header.php"); ?>

<main>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    
    <img src="">
</main>

<? require_once("ressources/footer.php"); ?>
</body>
</html>