<?php require_once('ressource/v_header.php');  ?>

<main>
    
    <form mehode="get" action="">
        <label for="email" > Email* :</label>
        <input id="email" type="email" name="email">
        
        <label for="pseudo"> Pseudo* :</label>
        <input id="pseudo" type="text" name="pseudo">

        <label for="password"> Password* : </label>
        <input id="password" type="password" name="password">

        <label for="confpass"> Confirm Pass* : </label>
        <input id="confpass" type="password" name="confpass">

        <input type="submit" value="Sign in">
    </form>

</main>

<?php require_once('ressource/v_footer.php');  ?>
