<?php

require_once(MODELS . "front/login.php");

require_once(LIB . "DatabaseConnection.php");

if (isset($_GET['action'])) {
    if ($_GET["action"] == "LoggedAccount") {
        echo "LOGING ACCOUNT ";
        
        $db = Database::getInstance();
        $query = "SELECT user_pass FROM users WHERE user_email = ?;";
        $args = array($_POST['email']);
        $mdp= $db->executedSelectArrayQuery($query, $args)[0];

        if (password_verify($_POST['password'],$mdp)){
            $query = "SELECT user_id FROM users WHERE user_email = ?;";
            $user_id = $db->executedSelectArrayQuery($query, $args)[0];
            setcookie('user_id',$user_id);
            header('Location: '. LINK_ACCOUNT);
            /*
            $query = "SELECT user_id FROM users WHERE user_email = ?;";
            $user_id = $db->executedSelectArrayQuery($query, $args)[0];
            echo "</br>id de l'user = " . $user_id;

            $query = "SELECT space_id FROM space WHERE space_owner = ?;";
            $args = array($user_id);
            $test = $db->executedSelectArrayQuery($query, $args)[0];
            echo "</br>id de l'espace = " . $test;

            $query = "SELECT box_id FROM box WHERE box_space = ?;";
            $args = array($test);
            $test = $db->executedSelectArrayQuery($query, $args)[0];
            echo "</br>id de la boite = " . $test;*/
        }

    }
}

require_once(TEMPLATES . "login.php");