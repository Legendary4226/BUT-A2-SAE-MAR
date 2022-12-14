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
                ThrowError::redirect(
                    "Mot de passe",
                    "Le mot de passe n'est pas valide.",
                    LINK_CONNECTION_SIGNIN
                );
            } 
            
        } else {
            ThrowError::redirect(
                "Compte inexistant",
                "Le compte associé à l'email n'existe pas.",
                LINK_CONNECTION_SIGNIN
            );
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
                        ThrowError::redirect(
                            "Echec de la création",
                            "Une erreur avec la base de données nous empêche de créer votre compte, pas de bol.",
                            LINK_CONNECTION_SIGNUP
                        );
                    }

                } else {
                    ThrowError::redirect(
                        "Email déjà enregistré",
                        "L'email donné est déjà associé à un compte.",
                        LINK_CONNECTION_SIGNUP
                    );
                }
            } else {
                ThrowError::redirect(
                    "Sécurité",
                    "Les mots de passes sont différents ou ont moins de 8 caractères.",
                    LINK_CONNECTION_SIGNUP
                );
            }
        } else {
            ThrowError::redirect(
                "Nom d'utilisateur",
                "Votre nom d'utilisateur fait plus de 25 caractères.",
                LINK_CONNECTION_SIGNUP
            );
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
