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
<?php
$headerButtonsLinks = array(
    "Account" => LINK_ACCOUNT,
    "Log out" => LINK_CONNECTION_LOGOUT
);
?>
<?php require_once("ressources/header.php"); ?>

<menu class="left-box-menu" id="left-box-menu">
    <form action="" method="POST" class="form-choose-space">
        <select name="space-id" id="select-space">
            <option value="ID">One of my spaces</option>
            <option value="ID">Another Space</option>
        </select>
    </form>
    
    <form action="" method="POST" class="form-boxs">
        <a href="#" class="selected">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 1">
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
        <a href="#">
            <?php require(ICON_SVG_BOX_LEAF) ?>
            <input type="text" value="Box 2">
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
        <a href="#">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 3">
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
        <a href="#">
            <?php require(ICON_SVG_BOX_ROPE_KNOT) ?>
            <input type="text" value="Box 4">
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
        <a href="#">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box Title">
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
    </form>

    <button class="empty-button transition-simple-jump">
        <?php require(ICON_SVG_PLUS) ?>
        Add Box
    </button>
</menu>

<main>
    <form action="" method="POST" class="form-box-content">
        <input type="text" name="box-title" class="box-title" value="Box title">
        
        <span class="task">
            <input type="checkbox" name="task-1">
            <input type="text" name="task-note-1" value="some text">
        </span>

        <span class="task">
            <input type="checkbox" name="task-1">
            <input type="text" name="task-note-2" value="some text">
        </span>

        <span class="task">
            <input type="checkbox" name="task-3">
            <input type="text" name="task-note-3" value="some text">
        </span>

        <span class="task">
            <input type="checkbox" name="task-4">
            <input type="text" name="task-note-4" value="some text">
        </span>

        <span class="note">
            <textarea name="note-1">
                *A little note
            </textarea>
        </span>

        <span class="note">
            <textarea name="note-2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </textarea>
        </span>

        <button class="transition-simple-bump" id="save-modifications">
            <?php require(ICON_SVG_SAVE) ?>
        </button>
    </form>

    
</main>

<section class="box-management">
    <div class="label">
        <button class="green-button">A Label</button>
        <button class="green-button">Another Label</button>
        <button class="add-label"><?php require(ICON_SVG_PLUS) ?></button>
    </div>
    <button> <?php require(ICON_SVG_SHARE) ?></button>
</section>

<?php require_once("ressources/footer.php"); ?>

<script src="<?= JAVASCRIPT ?>box.js"></script>
</body>
</html>