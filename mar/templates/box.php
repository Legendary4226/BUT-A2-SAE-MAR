<?php
$ENABLE_LEFT_BOX_MENU = true;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/box.css">
</head>
<body>
<?php require_once("ressources/header.php"); ?>

<menu class="left-box-menu">
    <form action="" method="POST">
        <select name="" id="select-space">
            <option value="">One of my spaces</option>
            <option value="">Another Space</option>
        </select>
    </form>
    
    <form action="" method="POST">
        <span>
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 1">
        </span>
        <span>
            <?php require(ICON_SVG_BOX_LEAF) ?>
            <input type="text" value="Box 2">
        </span>
        <span>
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 3">
        </span>
        <span>
            <?php require(ICON_SVG_BOX_ROPE_KNOT) ?>
            <input type="text" value="Box 4">
        </span>
        <span>
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box Title">
        </span>
    </form>

    <button>Add Box</button>
</menu>

<main>
    <div>
        <h1>Box Title</h1>
        <div>
            <p>Work</p>
            <p>Dishes</p>
            <p>Buy stuff</p>
            <p>Clean the floor</p>
            <button>add new element</button>
        </div>
        <div>
            <p>*A little note </br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>7
    <div>
        <button>A Label</button>
        <button>Another Label</button>
        <button>+</button>
        <button>o-/<</button>
    </div>
</main>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>