<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/box.css">
</head>
<body>
<? $headerButtonsLinks = array(
    "Account" => LINK_ACCOUNT,
    "Log out" => LINK_CONNECTION_LOGOUT
); 

$ENABLE_LEFT_BOX_MENU = true; ?>

<? require_once("ressources/header.php"); ?>

<menu class="left-box-menu" id="left-box-menu">
    <form action="<?= LINK_SPACE . "&action=switchSpace"?>" method="POST" class="form-choose-space">
        <!-- Hidden input used to submit form with JS -->
        <input id="submit-space-switch" type="submit" style="display: none; visibility: hidden;">

        <select name="space-id" id="select-space">

            <?
            ob_start();
            foreach ($user_spaces as $space) {
            ?>
                <option value="<?= $space->getId() ?>" <?= $space->getId() == $_SESSION['user_current_space'] ? 'selected' : '' ?>><?= $space->getName() ?></option>
            <? }
            ob_end_flush(); ?>
        </select>
    </form>
    
    <form action="<?= LINK_SPACE . "&action=saveBox"?>" method="POST" class="form-boxs">
        <!-- Hidden input used to submit form with JS -->
        <input id="submit-boxs-change" type="submit" style="display: none; visibility: hidden;">


        <a href="#" id="add-box-clone">
            <? require(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="New Box" maxlength="20" required>
            <? require(ICON_SVG_TRASH_CAN) ?>
        </a>

        <? ob_start();

        if (empty($user_boxes)) {
            echo '<p style="text-align: center">No boxs to see here!</p>';
        }

        foreach ($user_boxes as $box) { ?>
            <a href="<?= LINK_SPACE . "&action=switchBox&box-id=" . $box->getId() ?>" <?= $box->getId() == $_SESSION['user_current_box'] ? 'class="selected"' : "" ?>>
                <? require(ICON_SVG_BOX_BOX) ?>
                <input type="text" value="<?= $box->getName() ?>" name="<?= $box->getId() ?>" maxlength="20" required>
                <? require(ICON_SVG_TRASH_CAN) ?>
            </a>
        <? }
        ob_end_flush(); ?>

    </form>

    <button id="save-boxs-change" class="empty-button transition-simple-jump">Save</button>

    <button class="empty-button transition-simple-jump" id="add-box">
        <? require(ICON_SVG_PLUS) ?>
        Add Box
    </button>
</menu>

<main>

    <div style="display: none; visibility: hidden;">
        <!-- ELEMENTS HTML TEMPLATES -->

        <!-- TASK -->
        <div class="element" id="template-task">
            <button type="button" class="action-add"> <? require(ICON_SVG_PLUS) ?> </button>
            <button type="button" class="action-delete"> <? require(ICON_SVG_TRASH_CAN) ?> </button>

            <div class="element-body task">
                <input type="hidden" name="task-ID" value="task">

                <input type="checkbox" name="task-ID:task">
                <input type="text" name="task-ID:tasknote" placeholder="Enter text">
            </div>
        </div>

        <!-- NOTE -->
        <div class="element" id="template-note">
            <button type="button" class="action-add"> <? require(ICON_SVG_PLUS) ?> </button>
            <button type="button" class="action-delete"> <? require(ICON_SVG_TRASH_CAN) ?> </button>

            <div class="element-body note">
                <input type="hidden" name="note-ID" value="note">

                <textarea name="note-ID:note" placeholder="Enter text"></textarea>
            </div>
        </div>

        <!-- END ELEMENTS HTML TEMPLATES -->
    </div>
    <form action="<?= LINK_SPACE . "&action=saveElements"?>" method="POST" class="form-box-content">
        <input type="text" name="box-title" class="box-title" value="<?= $current_box == null ? "It's empty here?" : $current_box->getName() ?>">

        <input type="hidden" name="elements-order" id="elements-order" value='<?= $current_box == null ? "[]" : json_encode($current_box->getElementsOrder()) ?>'>
        
        <div class="box-elements">

            <div class="element" style="min-height: 2rem; <?= $current_box == null ? "display: none; visibility: hidden;" : "" ?>">
                <button type="button" class="action-add"> <? require(ICON_SVG_PLUS) ?> </button>
            </div>

            <? ob_start();

            foreach ($current_box == null ? [] : $updatedBox->getElementsOrder() as $element_id){ 

                $element = $elements[$element_id]; ?>
                
                <div class="element">

                    <button type="button" class="action-add"> <? require(ICON_SVG_PLUS) ?> </button>
                    <button type="button" class="action-delete"> <? require(ICON_SVG_TRASH_CAN) ?> </button>
                    
                    <div class="element-body <?= $element->getType() ?>">

                        <input type="hidden" name="<?= $element->getId() ?>" value="<?= $element->getType() ?>">

                        <?
                        switch($element->getType()) {
                            
                        case 'task': ?>

                            <input type="checkbox" name="<?= $element->getId() ?>:task" <?= $element->getContent()["checked"] ? "checked" : "" ?>>
                            <input type="text"  placeholder="Enter text" name="<?= $element->getId() ?>:tasknote" value="<?= $element->getContent()["content"] ?>">

                        <? break;
                        case 'note': ?>
                            
                            <textarea placeholder="Enter text" name="<?= $element->getId() ?>:note"><?= $element->getContent()["content"] ?></textarea>

                        <? break;
                        } ?>
                    </div>
                </div>
            <? }
            ob_end_flush(); ?>
        </div>
        <button class="transition-simple-bump" id="save-modifications" <?= $current_box == null ? 'style="display: none; visibility: hidden;"' : "" ?>>
            <? require(ICON_SVG_SAVE) ?>
        </button>
    </form>

    
</main>

<section class="box-management">
    <div class="label">
        <button class="green-button">A Label</button>
        <button class="green-button">Another Label</button>
        <button class="add-label"><? require(ICON_SVG_PLUS) ?></button>
    </div>
    <button> <? require(ICON_SVG_SHARE) ?></button>
</section>

<? require_once("ressources/footer.php"); ?>

<script src="<?= JAVASCRIPT ?>box-left-menu.js"></script>
<script src="<?= JAVASCRIPT ?>box-content.js"></script>
</body>
</html>