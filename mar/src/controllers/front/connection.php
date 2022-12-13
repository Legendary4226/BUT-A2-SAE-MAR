<?php

require_once(MODELS . "User.php");

$userPDO = new UserPDO();

$action = null;
$viewToRequire = "signin";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == "signin") {
    $viewToRequire = "signin";

    // Check $_POST values
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {

        $user = $userPDO->getUserByEmail($_POST['email']);
        if ($user != null) {
            
            $validPass = password_verify($_POST['pass'], $user->getUserPass());
            if ($validPass){
                // Define the SESSION variables
                $_SESSION['user_id'] = $user->getUserId();
                $_SESSION['user_email'] = $user->getUserEmail();
                $_SESSION['user_name'] = $user->getUserName();
                $_SESSION['user_pass'] = $user->getUserPass();
            } else {
                echo "Le mot de passe n'est pas valide";
            } 
            
        } else {
            echo "Le compte n'existe pas";
        }
    } else {
        //echo 'Please fill in the fields';
    }
}

if ($action == "signup") {
    $viewToRequire = "signup";

    // Check $_POST values
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['confpass'])) {

        $validPseudo = strlen($_POST['username']) <= 25;
        if ($validPseudo) {

            $validPass = $_POST['pass'] == $_POST['confpass'] && strlen($_POST['pass']) >= 8;
            if ($validPass) {

                $newUser = new User(
                    -1,
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['username']),
                    password_hash($_POST['pass'], PASSWORD_BCRYPT)
                );

                $isEmailNotInDatabase = $userPDO->getUserByEmail($newUser->getUserEmail()) == null;
                if ($isEmailNotInDatabase) {

                    $accountCreated = $userPDO->createUser($newUser);
                    if ($accountCreated) {
                        // TODO Next steps to create the space etc.
                        header("Location: " . LINK_HOME);
                    } else {
                        echo "La création a échoué";
                    }

                } else {
                    echo "Email déjà enregistré.";
                }
            } else {
                echo 'Mot de passes différents ou de moins de 8 caractères.';
            }
        } else {
            echo 'Username with more than 25 characters.';
        }
    } else {
        //echo 'Please fill in the fields';
    }
}

if ($action == "logout") {
    session_destroy();

    header("Location: " . LINK_HOME);
}

require_once(TEMPLATES . $viewToRequire . ".php");
