<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/space.css">
</head>
<body>
<?php require_once("ressources/header.php"); ?>

<main>
    <section class="panel">
        <span>
            <i></i>
            <button>Profile and Settings</button>
        </span>
        <span>
            <i></i>
            <button class="button-selected">Share my spaces</button>
        </span>

    </section>

    <section class="panel secondary">
        <span>
            <i></i>
            <button class="button-selected">One of my Spaces</button>
        </span>
        <span>
            <i></i>
            <button>Another Space</button>
        </span>
        
        
    </section>
    
    <section>
        <form methode="POST" action="" class="form-edit-space-settings">
            <fieldset class="space-name">
                <label for="space-name">Space Name :</label>
                <input id="space-name" type="text" name="space-name" value="One of my Spaces" maxlength="35" required> 
            </fieldset>

            <h1>Share with:</h1>

            <fieldset class="space-share">

            <span>
                    <input type="email" name="520" placeholder="example@email.com" required>
                    <label for="ID:permission"> Permission :</label>
                    <select name="ID:permission" id="ID:permission">
                        <option value="read">Read</option>
                        <option value="edit">Edit</option>
                    </select>

                    <button class="action-button transition-simple-bump" class="delete-button" type="button">
                        <?php require(ICON_SVG_CLOSE) ?>
                    </button>
                </span>

                <span id="init-clone">
                    <input type="email" name="ID" placeholder="example@email.com" required>
                    <label for="ID:permission"> Permission :</label>
                    <select name="ID:permission" id="ID:permission">
                        <option value="read">Read</option>
                        <option value="edit">Edit</option>
                    </select>

                    <button class="action-button transition-simple-bump" class="delete-button" type="button">
                        <?php require(ICON_SVG_CLOSE) ?>
                    </button>
                </span>
                
            </fieldset>

            <fieldset>
                <button class="action-button transition-simple-bump" id="save-modifications">
                    <?php require(ICON_SVG_SAVE) ?>
                </button>
            </fieldset>
        </form>

        <form id="add-user-form">
            <fieldset class="space-share">
                    <span>
                        <input class="input-add-people-email" type="email" id="new-person" placeholder="example@email.com" maxlength="35">
                        <button class="action-button transition-simple-bump">
                            <?php require_once(ICON_SVG_PLUS) ?>
                        </button>
                    </span>
            </fieldset>
        </form>
    </section>
</main>

<?php require_once("ressources/footer.php"); ?>
<script src="<?= TEMPLATES ?>ressources/JS/space.js"></script>
</body>
</html>