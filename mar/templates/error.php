<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAR - Error</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/error.css">
    
</head>
<body>
<?
$headerButtonsLinks = array(
    "Home" => LINK_HOME
);
?>
<? require_once("ressources/header.php"); ?>

<main>
    <h1 class="error-title"><?= (!empty($_GET['title'])) ? $_GET['title'] : "Error" ?></h1>

    <div class="error-box">
        <p class="error-message"><?= (!empty($_GET['message'])) ? $_GET['message'] : "Unknown error" ?></p>
    </div>

    <a href="<?= !empty($_SESSION['error_return_link']) ? $_SESSION['error_return_link'] : LINK_HOME ?>">
        <button class="blue-button transition-simple-bump">
            Go Back
        </button>
    </a>
</main>

<? require_once("ressources/footer.php"); ?>
</body>
</html>