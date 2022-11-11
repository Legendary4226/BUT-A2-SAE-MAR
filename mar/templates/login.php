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
        <form mehode="get" action="">
            <label for="email" > Email* :</label>
            <input id="email" type="email" name="email">

            <label for="password"> Password* : </label>
            <input id="password" type="password" name="password">
            
            <input type="submit" value="Sign in">
        </form>
    </main>

    <?php require_once("ressources/footer.php"); ?>
</body>
</html>