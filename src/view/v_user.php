<?php require_once('ressource/v_header.php');  ?>

<main>
    
    <div>
        <button>Profile and Settings</button>
        <button>Share my spaces</button>
    </div>
    <div>
        <div>
            <form mehode="get" action="">
                <label for="email" > Email:</label>
                <input id="email" type="email" name="email">
                
                <label for="pseudo"> Pseudo:</label>
                <input id="pseudo" type="text" name="pseudo">

                <label for="changepass"> Change Pass: </label>
                <input id="changepass" type="password" name="changepass">

                <label for="Theme"> Confirm Pass: </label>
                <input id="confpass" type="password" name="confpass">

                <input type="submit" value="Sign in">
            </form>
        </div>
        <div>
            <img src="">
        </div>
    </div>

</main>

<?php require_once('ressource/v_footer.php');  ?>
