<?php

require_once(MODELS . "front/signup.php");


$action = null;

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


if ($action == "createAccount") {
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['confpass'])) {
        (new SignUp())->createAccount($_POST['email'], $_POST['username'], $_POST['pass'], $_POST['confpass']);
    } else {
        echo 'Please fill in the fields';
    }
}

require_once(TEMPLATES . "signup.php");
