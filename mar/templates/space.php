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
        <section>
            <button> Profile and Settings </button>
            <button class="button-selected"> Share my spaces </button>
        </section>

        <section>
            <button class="button-selected" > One of my Spaces </button>
            <button> Another Space </button>
        </section>
            
        <form methode="POST" action="">
            <fieldset>
                <label for="space-name" > Space Name:</label>
                <input id="space-name" type="text" name="space-name" value="One of my Spaces"> 
            </fieldset>

            <h1>Share with:</h1>

            <fieldset>
                <input type="text" value="email">
                <label for="Email"> Permission: </label>
                <select name="email" size="1" id="Email">
                    <option>Read</option>
                    <option>Edit</option>
                </select>
                <button>add</button>
            </fieldset>

            <fieldset>
                <input type="submit"  value="temp">
            </fieldset>
        </form>
    </main>

    <?php require_once("ressources/footer.php"); ?>
</body>
</html>