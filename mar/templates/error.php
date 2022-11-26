<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/error.css">
    
</head>
<body>
<?php
$headerButtonsLinks = array(
    "Home" => LINK_HOME
);
?>
<?php require_once("ressources/header.php"); ?>

<main>
    <h1 class="error-title"><?= (!empty($errorTitle)) ? $errorTitle : "Error" ?></h1>

    <div class="error-box">
        <p class="error-message"><?= (!empty($error)) ? $error : "Unknown error" ?></p>
    </div>
</main>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>