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
            <option name="SPACE_ID">One of my spaces</option>
            <option name="SPACE_ID">Another Space</option>
        </select>
    </form>
    
    <form action="" method="POST" class="form-boxs">
        <!-- Hidden input used to submit form with JS -->
        <input id="submit-boxs-change" type="submit" style="display: none; visibility: hidden;">


        <a href="#" id="add-box-clone">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="New Box" maxlength="20" required>
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>

        
        <a href="#" class="selected">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 1" name="2" maxlength="20" required>
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
        <a href="#">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 2" name="500" maxlength="20" required>
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
        <a href="#">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="Box 3" name="812" maxlength="20" required>
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>
    </form>

    <button id="save-boxs-change" class="empty-button transition-simple-jump">Save</button>

    <button class="empty-button transition-simple-jump" id="add-box">
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