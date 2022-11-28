<?php

require_once(MODELS . "front/signin.php");

require_once(TEMPLATES . "signin.php");

require_once(LIB . "DatabaseConnection.php");   

if (isset($_GET['action'])) {
    if ($_GET["action"] == "createAccount") {
        echo "CREATING ACCOUNT ";
        
        $db = Database::getInstance();
        $query = "SELECT count(*) FROM users WHERE user_email = ?;";
        $args = array($_POST['email']);

        if ($db->executedQuery($query, $args)->fetchColumn()[0] == 0 && $_POST['password'] == $_POST['confpass']){

            $query = "INSERT INTO users(user_email,user_pseudo,user_pass) VALUES (?,?,?);";
            $args = array($_POST['email'], $_POST['pseudo'], password_hash($_POST['password'],PASSWORD_BCRYPT));
            
            if ($db->executedBooleanQuery($query, $args)){
                header('Location: '.LINK_ERROR);
            }

            else{
                header('Location: '.LINK_BOX);
            } 
        }
        
        else{
            header('Location: '.LINK_ERROR);
        }
    }
}
