<?php

require_once(MODELS . "User.php");

$userDAO = new UserDAO();

$action = null;
$viewToRequire = "account";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'modifyAccount'){
    $viewToRequire = "account";

    $atLeastOneModified = false;
    $updateUser = new User($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['user_name'], $_SESSION['user_pass']);

    if (!empty($_POST['name'] && $_POST['name'] != $_SESSION['user_name'])) {
        if (strlen($_POST['name']) <= 25) {
            $_SESSION['user_name'] = htmlspecialchars($_POST['name']);
            $updateUser->setUserName($_SESSION['user_name']);
            $atLeastOneModified = true;
        } else {
            ThrowError::redirect(
                "Nom d'utilisateur",
                "Votre nom d'utilisateur fait plus de 25 caractères.",
                LINK_ACCOUNT
            );
        }
    }

    if (!empty($_POST['email']) && $_POST['email'] != $_SESSION['user_email']) {
        $_SESSION['user_email'] = htmlspecialchars($_POST['email']);
        $updateUser->setUserEmail($_SESSION['user_email']);
        $atLeastOneModified = true;
    }

    if (!empty($_POST['changepass']) && !empty($_POST['confpass'])) {

        if (strlen($_POST['changepass']) >= 8 && $_POST['changepass'] == $_POST['confpass']) {
            $_SESSION['user_pass'] = password_hash($_POST['changepass'], PASSWORD_BCRYPT);
            $updateUser->setUserPass($_SESSION['user_pass']);
            $atLeastOneModified = true;
        } else {
            ThrowError::redirect(
                "Sécurité",
                "Les mots de passes sont différents ou ont moins de 8 caractères.",
                LINK_ACCOUNT
            );
        }
    }

    if ($atLeastOneModified) {
        $userDAO->updateUser($updateUser);
    }
}

if ($action == "shareSpace") {
    $viewToRequire = "space-sharing";
}


require_once(TEMPLATES . $viewToRequire . ".php");