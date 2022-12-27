<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <? require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
    <link rel="stylesheet" href="<?= STYLES ?>templates/account.css">
    <link rel="stylesheet" href="<?= STYLES ?>templates/space.css">
</head>
<body>
<?
$headerButtonsLinks = array(
    "Spaces" => LINK_SPACE,
    "Log out" => LINK_CONNECTION_LOGOUT
);
?>
<? require_once("ressources/header.php"); ?>

<main>
    <section class="panel">
        <a href="<?= LINK_ACCOUNT ?>">
            <button>Profile and Settings</button>
        </a>
        <a href="#">
            <button class="button-selected">Share my spaces</button>
        </a>
    </section>

    <section class="panel secondary">
        <a href="#">
            <button class="button-selected">One of my Spaces</button>
        </a>
        <a href="#">
            <button>Another Space</button>
        </a>
        
        
    </section>
    
    <section>
        <form methode="POST" action="" class="form-edit-space-settings">
            <fieldset class="space-name">
                <label for="space-name" >Space Name :</label>
                <input id="space-name" type="text" name="space-name" value="One of my Spaces"> 
            </fieldset>

            <h1>Share with:</h1>

            <fieldset class="space-share">
                <span>
                    <input type="text" name="email-1" value="example@email.com">

                    <label for="permission-1"> Permission :</label>
                    <select name="permission-1" id="permission-1">
                        <option>Read</option>
                        <option>Edit</option>
                    </select>

                    <button class="action-button transition-simple-bump">
                        <? require(ICON_SVG_CLOSE) ?>
                    </button>
                </span>

                <span>
                    <input type="text" name="email-2" value="example@email.com">

                    <label for="permission-2"> Permission :</label>
                    <select name="permission-2" id="permission-2">
                        <option>Read</option>
                        <option>Edit</option>
                    </select>

                    <button class="action-button transition-simple-bump">
                        <? require(ICON_SVG_CLOSE) ?>
                    </button>
                </span>

                <span>
                    <input type="text" name="email-3" value="example@email.com">

                    <label for="permission-3"> Permission :</label>
                    <select name="permission-3" id="permission-3">
                        <option>Read</option>
                        <option>Edit</option>
                    </select>

                    <button class="action-button transition-simple-bump">
                        <? require(ICON_SVG_CLOSE) ?>
                    </button>
                </span>
            </fieldset>

            <fieldset>
                <button class="action-button transition-simple-bump" id="save-modifications">
                    <? require(ICON_SVG_SAVE) ?>
                </button>
            </fieldset>
        </form>

        <form method="POST" action="">
            <fieldset class="space-share">
                    <span>
                        <input class="input-add-people-email" type="text" placeholder="Add a new person">

                        <label for="add-email"> Permission :</label>
                        <select name="add-email" id="add-email">
                            <option>Read</option>
                            <option>Edit</option>
                        </select>

                        <button class="action-button transition-simple-bump" id="add-shared-people">
                            <? require_once(ICON_SVG_PLUS) ?>
                        </button>
                    </span>
            </fieldset>
        </form>
    </section>
</main>

<? require_once("ressources/footer.php"); ?>
</body>
</html>