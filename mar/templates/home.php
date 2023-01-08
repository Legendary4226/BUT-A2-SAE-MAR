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
        'Spaces' => LINK_SPACE,
        'Log Out' => LINK_CONNECTION_LOGOUT
    );
}
?>
<? require_once("ressources/header.php"); ?>

<main>
    <p>
        Welcome to My Amazing Reminder. 
        <br><br>This website will allow you to easily create and maintain notes spaces, shareable or not, in ordre to note whatever you want to remember.
       You can create as much spaces as you want ! 
        <br><br>Moreover, You can add other users to your spaces in order to generate more boxes and notes in collaboration.
        In every box you create, you can add totally personalisable text fields and checkboxes !
        <br><br> Here is a representation of what you can see in the box page of any space.
    </p>
    
    <img src="<?= MISCIMAGES?>home-presentation2.png" height="450px" width="900px"/>
</main>

<? require_once("ressources/footer.php"); ?>
</body>
</html>