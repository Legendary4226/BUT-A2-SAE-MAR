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
    <form action="" method="POST" class="form-choose-space">
        <select name="" id="select-space">
            <option value="">One of my spaces</option>
            <option value="">Another Space</option>
        </select>
    </form>
    
    <form action="" method="POST" class="form-boxs">
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
    <button>A Label</button>
    <button>Another Label</button>
    <button>+</button>
    <button>o-/<</button>
</section>

<?php require_once("ressources/footer.php"); ?>
</body>
</html>