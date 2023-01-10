<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAR - Space</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/box.css">
</head>
<body>
<div class="wrapper-body">
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
            <optgroup label="My spaces">
                <? ob_start();
                foreach ($user_spaces as $space) {
                ?>
                    <option value="<?= $space->getId() ?>" <?= $space->getId() == $_SESSION['user_current_space'] ? 'selected' : '' ?>>
                        <?= $space->getName() ?>
                    </option>
                <? } ob_end_flush(); ?>
            </optgroup>

            <?= empty($sharedSpace) ? '' : '<optgroup label="Shared spaces">' ?>
                <? ob_start();
                foreach ($sharedSpace as $space_shared) {
                    $space = $spaceDAO->getSpace($space_shared->getSpaceId());
                ?>
                    <option class="shared-space" value="<?= $space->getId() ?>" <?= $space->getId() == $_SESSION['user_current_space'] ? 'selected' : '' ?>>
                        <?= $space->getName() ?>
                    </option>
                <? } ob_end_flush(); ?>
            <?= empty($sharedSpace) ? '' : '</optgroup>' ?>
            
        </select>
    </form>
    
    <form action="<?= LINK_SPACE . "&action=saveBox"?>" method="POST" class="form-boxs">
        <!-- Hidden input used to submit form with JS -->
        <input id="submit-boxs-change" type="submit" style="display: none; visibility: hidden;">


        <a href="#" id="add-box-clone">
            <? include(ICON_SVG_BOX_BOX) ?>
            <input type="text" value="New Box" maxlength="20" required>
            <? include(ICON_SVG_TRASH_CAN) ?>
        </a>

        <? ob_start();

        if (empty($user_boxes)) {
            echo '<p style="text-align: center">No boxs to see here!</p>';
        }

        foreach ($user_boxes as $box) { ?>
            <a href="<?= LINK_SPACE . "&action=switchBox&box-id=" . $box->getId() ?>" <?= $box->getId() == $_SESSION['user_current_box'] ? 'class="selected"' : "" ?>>
                <? include(ICON_SVG_BOX_BOX) ?>
                <input type="text" value="<?= $box->getName() ?>" name="<?= $box->getId() ?>" maxlength="20" required>
                <? include(ICON_SVG_TRASH_CAN) ?>
            </a>
        <? }
        ob_end_flush(); ?>

    </form>

    <button id="save-boxs-change" class="empty-button transition-simple-jump <?= !$hasWritePermission ? 'is-hidden' : '' ?>">
        Save
    </button>

    <button class="empty-button transition-simple-jump <?= !$hasWritePermission ? 'is-hidden' : '' ?>" id="add-box">
        <? include(ICON_SVG_PLUS) ?>
        Add Box
    </button>
    
</menu>

<main>

    <div style="display: none; visibility: hidden;">
        <!-- ELEMENTS HTML TEMPLATES -->

        <!-- TASK -->
        <div class="element" id="template-task">
            <button type="button" class="action-add"> <? include(ICON_SVG_PLUS) ?> </button>
            <button type="button" class="action-delete"> <? include(ICON_SVG_TRASH_CAN) ?> </button>

            <div class="element-body task">
                <input type="hidden" name="task-ID" value="task">

                <input type="checkbox" name="task-ID:task">
                <input type="text" name="task-ID:tasknote" placeholder="Enter text">
            </div>
        </div>

        <!-- NOTE -->
        <div class="element" id="template-note">
            <button type="button" class="action-add"> <? include(ICON_SVG_PLUS) ?> </button>
            <button type="button" class="action-delete"> <? include(ICON_SVG_TRASH_CAN) ?> </button>

            <div class="element-body note">
                <input type="hidden" name="note-ID" value="note">

                <textarea name="note-ID:note" placeholder="Enter text"></textarea>
            </div>
        </div>

        <!-- END ELEMENTS HTML TEMPLATES -->
    </div>

    <form action="<?= LINK_SPACE . "&action=saveElements"?>" method="POST" class="form-box-content <?= !$hasWritePermission ? 'controls-hidden' : '' ?>">
        <h1 class="box-title"><?= $current_box == null ? "It's very empty here?" : $current_box->getName() ?></h1>

        <?= $current_box == null ?
        '<p style="text-align: center; line-height: 1.6em; margin: 0 2rem;">To start using the app, open the left side panel by a clic on the three stacked lines.<br>
        Then clic on « Add Box » to create a new Box, name it and clic « Save ».<br>
        After the reloading of the page you are able to create « elements », it’s for example notes or tasks.
        <br>To do this you must clic on the « + » button under the box title in the middle of the page.<br>
        By default, « + » and « Trash » buttons are transparent, remember the place of the buttons.<br><br>
        Have a great experience with MAR !</p>'
        : ''
        ?>

        <input type="hidden" name="elements-order" id="elements-order" value='<?= $current_box == null ? "[]" : json_encode($current_box->getElementsOrder()) ?>'>
        
        <div class="box-elements">

            <div class="element <?= $current_box == null ? 'is-hidden' : '' ?>" style="min-height: 2rem;">
                <button type="button" class="action-add" <?= sizeof($elements) == 0 ? 'style="opacity: 1;"' : '' ?>> <? include(ICON_SVG_PLUS) ?> </button>
            </div>

            <? ob_start();

            foreach ($current_box == null ? [] : $current_box->getElementsOrder() as $element_id){ 

                $element = $elements[$element_id]; ?>
                
                <div class="element">

                    <button type="button" class="action-add" >
                        <? include(ICON_SVG_PLUS) ?>
                    </button>
                    <button type="button" class="action-delete" >
                        <? include(ICON_SVG_TRASH_CAN) ?>
                    </button>
                    
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
        <button class="transition-simple-bump <?= $current_box == null || !$hasWritePermission ? 'is-hidden' : '' ?>" id="save-modifications">
            <? include(ICON_SVG_SAVE) ?>
        </button>
    </form>

</main>

<!--
<section class="box-management">
    <div class="label">
        <button class="green-button">A Label</button>
        <button class="green-button">Another Label</button>
        <button class="add-label"><\? include(ICON_SVG_PLUS) ?></button>
    </div>
    <button> <\? include(ICON_SVG_SHARE) ?></button>
</section>
-->

<? require_once("ressources/footer.php"); ?>

<script src="<?= JAVASCRIPT ?>box-left-menu.js"></script>
<script src="<?= JAVASCRIPT ?>box-content.js"></script>
<script src="<?= JAVASCRIPT ?>alertUnsave.js"></script>
</div>
</body>
</html>