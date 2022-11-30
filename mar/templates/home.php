<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/home.css">
</head>
<body>
<?php
$headerButtonsLinks = array(
    "Sign in" => LINK_SIGNIN,
    "Log in" => LINK_LOGIN
);
?>
<?php require_once("ressources/header.php"); ?>

<main>
    <p>
        Bienvenue sur notre site My Amazing Reminder. Il vous permettra de stocker toutes vos tâches du quotidien sous 
        la forme de listes. L'interface simple et épurée donne une vision optimale sur les différents éléments remplis 
        précédemment. Parmi les fonctionnalités disponibles, vous pourrez également retrouver le partage de boîtes ou 
        les espaces collaboratifs. 
    </p>
    
    <img src="">
</main>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>