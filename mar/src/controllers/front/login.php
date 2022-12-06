<?php

require_once(MODELS . "front/login.php");

require_once(LIB . "DatabaseConnection.php");

$action = null;

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == "connectUser") {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        (new Login())->connectUser($_POST['email'], $_POST['pass']);
    } else {
        echo 'Please fill in the fields';
    }
}

require_once(TEMPLATES . "login.php");
