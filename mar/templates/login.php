<?php require_once("ressources/header.php");  ?>

<main>
    
    <form mehode="get" action="">
        <label for="email" > Email* :</label>
        <input id="email" type="email" name="email">

        <label for="password"> Password* : </label>
        <input id="password" type="password" name="password">
        
        <input type="submit" value="Sign in">
    </form>

</main>

<?php require_once("ressources/footer.php");  ?>