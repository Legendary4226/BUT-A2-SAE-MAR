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
            <button>Profile and Settings</button>
            <button class="button-selected">Share my spaces</button>
        </section>

        <section class="panel">
            <button class="button-selected">One of my Spaces</button>
            <button>Another Space</button>
        </section>
        
        <section>
            <form methode="POST" action="" class="form-edit-space-settings">
                <fieldset class="space-name">
                    <label for="space-name" >Space Name :</label>
                    <input id="space-name" type="text" name="space-name" value="One of my Spaces"> 
                </fieldset>

                <h1>Share with:</h1>

                <fieldset id="space-share">
                    <span>
                        <input type="text" name="email-1" value="example@email.com">

                        <label for="permission-1"> Permission :</label>
                        <select name="permission-1" id="permission-1">
                            <option>Read</option>
                            <option>Edit</option>
                        </select>

                        <button class="action delete-people">Delete</button>
                    </span>

                    <span>
                        <input type="text" name="email-2" value="example@email.com">

                        <label for="permission-2"> Permission :</label>
                        <select name="permission-2" id="permission-2">
                            <option>Read</option>
                            <option>Edit</option>
                        </select>

                        <button class="action delete-people">Delete</button>
                    </span>

                    <span>
                        <input type="text" name="email-3" value="example@email.com">

                        <label for="permission-3"> Permission :</label>
                        <select name="permission-3" id="permission-3">
                            <option>Read</option>
                            <option>Edit</option>
                        </select>

                        <button class="action delete-people">Delete</button>
                    </span>
                </fieldset>

                <fieldset>
                    <input type="submit"  value="" class="action save">
                </fieldset>
            </form>

            <form action="" class="form-add-shared-people">
                <input type="text" placeholder="example@email.com">

                <label for="add-email"> Permission :</label>
                <select name="add-email" id="add-email">
                    <option>Read</option>
                    <option>Edit</option>
                </select>

                <input type="submit" value="" class="action plus">
            </form>
        </section>
    </main>

    <?php require_once("ressources/footer.php"); ?>
</body>
</html>