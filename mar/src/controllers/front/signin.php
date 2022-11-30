<?php

require_once(MODELS . "front/signin.php");

require_once(TEMPLATES . "signin.php");

require_once(LIB . "DatabaseConnection.php");   

$user = new SignIn();
if (isset($_GET['action'])) {
    if ($_GET["action"] == "createAccount") {
        $user->inscription();
    }
}