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
    <form action="<?= LINK_SPACE . "&action=switchSpace"?>" method="POST" class="form-choose-space">
        <!-- Hidden input used to submit form with JS -->
        <input id="submit-space-switch" type="submit" style="display: none; visibility: hidden;">

        <select name="space-id" id="select-space">

            <?php
            ob_start();
            foreach ($user_spaces as $space) {
            ?>
                <option value="<?= $space->getSpaceId() ?>" <?= $space->getSpaceId() == $_SESSION['user_current_space'] ? 'selected' : '' ?>><?= $space->getSpaceName() ?></option>
            <?php
            }
            ob_end_flush();
            ?>
        </select>
    </form>
    
    <form action="<?= LINK_SPACE . "&action=saveBox"?>" method="POST" class="form-boxs">
        <!-- Hidden input used to submit form with JS -->
        <input id="submit-boxs-change" type="submit" style="display: none; visibility: hidden;">


        <a href="#" id="add-box-clone">
            <?php require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="New Box" maxlength="20" required>
            <?php require(ICON_SVG_TRASH_CAN) ?>
        </a>

        <?php 
        ob_start();

        if (empty($user_boxes)) {
            echo '<p style="text-align: center">No boxs to see here!</p>';
        }

        foreach ($user_boxes as $box) {
        ?>
            <a href="<?= LINK_SPACE . "&action=switchBox&box-id=" . $box->getBoxId() ?>" <?= $box->getBoxId() == $_SESSION['user_current_box'] ? 'class="selected"' : "" ?>>
                <?php require(ICON_SVG_BOX_BOX) ?>
                <input type="text" value="<?= $box->getBoxName() ?>" name="<?= $box->getBoxId() ?>" maxlength="20" required>
                <?php require(ICON_SVG_TRASH_CAN) ?>
            </a>
        <?php
        }
        ob_end_flush();
        ?>

    </form>

    <button id="save-boxs-change" class="empty-button transition-simple-jump">Save</button>

    <button class="empty-button transition-simple-jump" id="add-box">
        <?php require(ICON_SVG_PLUS) ?>
        Add Box
    </button>
</menu>

<main>
    <form action="<?= LINK_SPACE . "&action=saveElements"?>" method="POST" class="form-box-content">
        <input type="text" name="box-title" class="box-title" value="<?=$user_boxes[$_SESSION['user_current_box']]->getBoxName()?>">
        
        <?php 
        
        ob_start();
        foreach ($box_elements as $element){
            if ($element->getElementType() == 'checkbox'){
        ?>
                <span class="task">
                    <input type="<?=$element->getElementType()?>"  name="task-<?=$element->getElementId()?>">
                    <input type="text" name="task-note-<?=$element->getElementId()?>" value="<?=$element->getElementContent()?>">
                </span>
        <?php 
            } if ($element->getElementType() == 'note') {
        ?>
                <span class="note">
                    <textarea name="note-<?=$element->getElementId()?>">
                        <?=$element->getElementContent()?>
                    </textarea>
                </span>
        <?php 
            }
        }
        ob_end_flush();
        ?>

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