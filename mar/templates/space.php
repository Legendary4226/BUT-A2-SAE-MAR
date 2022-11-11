<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Global CSS Files -->
    <?php require_once(TEMPLATES . "ressources/css_files.php") ?>

    <!-- Specific CSS Files -->
</head>
<body>
    <?php require_once("ressources/header.php"); ?>

    <main>
        <div>
            <button>Profile and Settings</button>
            <button>Share my spaces</button>
        </div>

        <div>
            <button>One of my Spaces</button>
            <button>Another Space</button>
        </div>
            
        <div>
            <div>
                <form mehode="get" action="">
                    <label for="OneSpaces" > Space Name:  One of my Spaces</label>
                    <input id="OneSpaces" type="text" name="OneSpaces"> 
                </form>

                <h1>Share with:</h1>

                <p>emails</p>
                
            </div>
            <div>
                <img src="">
            </div>
        </div>
    </main>

    <?php require_once("ressources/footer.php"); ?>
</body>
</html>