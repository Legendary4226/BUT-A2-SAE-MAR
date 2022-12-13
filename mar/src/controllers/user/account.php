<?php

require_once(MODELS . "User.php");

$userPDO = new UserPDO();

$action = null;
$viewToRequire = "account.php";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'modifyAccount'){

    $updateUser = new User($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['user_name'], $_SESSION['user_pass']);

    if (!empty($_POST['name'])) {
        
        if (strlen($_POST['name']) <= 25) {
            $_SESSION['user_name'] = htmlspecialchars($_POST['name']);
            $updateUser->setUserName($_SESSION['user_name']);
        } else {
            echo "Le nom d'utilisateur a plus de 25 caractères.";
        }
    }

    if (!empty($_POST['email'])) {
        $_SESSION['user_email'] = htmlspecialchars($_POST['email']);
        $updateUser->setUserEmail($_SESSION['user_email']);
    }

    if (!empty($_POST['changepass']) && !empty($_POST['confpass'])) {

        if (strlen($_POST['changepass']) >= 8 && $_POST['changepass'] == $_POST['confpass']) {
            $_SESSION['user_pass'] = password_hash($_POST['changepass'], PASSWORD_BCRYPT);
            $updateUser->setUserPass($_SESSION['user_pass']);

        } else {
            echo "Les mot de passe sont différent ou ont moins de 8 caractères.";
        }
    }

    $userPDO->updateUser($updateUser);
}

require_once(TEMPLATES . $viewToRequire);