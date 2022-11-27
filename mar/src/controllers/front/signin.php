<?php

require_once(MODELS . "front/signin.php");

require_once(TEMPLATES . "signin.php");






if (isset($_GET['action'])) {
    if ($_GET["action"] == "createAccount") {
        echo "CREATING ACCOUNT ";

        $query = $bdd->prepare("INSERT INTO users(user_email,user_pseudo,user_pass) VALUES (?,?,?);");
        $query->execute(array($_POST['email'], $_POST['pseudo'], $_POST['password']));
    }
}