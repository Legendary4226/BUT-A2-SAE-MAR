<?

require_once(MODELS . "User.php");

$userDAO = new UserDAO();

$action = null;
$viewToRequire = "signin";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == "signin") {
    $viewToRequire = "signin";

    // Check $_POST values
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {

        $user = $userDAO->getByEmail($_POST['email']);
        if ($user != null) {
            
            $validPass = password_verify($_POST['pass'], $user->getPass());
            if ($validPass){
                // Define the SESSION variables
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_email'] = $user->getEmail();
                $_SESSION['user_name'] = $user->getName();
                $_SESSION['user_pass'] = $user->getPass();

                header("Location: " . LINK_SPACE);
                exit;
            } else {
                ThrowError::redirect(
                    "Password",
                    "Wrong password.",
                    LINK_CONNECTION_SIGNIN
                );
            } 
            
        } else {
            ThrowError::redirect(
                "Non-existent account",
                "The account associated with the email does not exist.",
                LINK_CONNECTION_SIGNIN
            );
        }
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
                    htmlspecialchars($_POST['email'],  ENT_HTML5),
                    htmlspecialchars($_POST['username'], ENT_HTML5),
                    password_hash($_POST['pass'], PASSWORD_BCRYPT)
                );

                $isEmailNotInDatabase = $userDAO->getByEmail($newUser->getEmail()) == null;
                if ($isEmailNotInDatabase) {

                    $accountCreated = $userDAO->createUser($newUser);
                    if ($accountCreated) {
                        header("Location: " . LINK_CONNECTION_SIGNIN);
                        exit;
                    } else {
                        ThrowError::redirect(
                            "Failure of the creation",
                            "An error with the database prevents us from creating your account, no luck.",
                            LINK_CONNECTION_SIGNUP
                        );
                    }

                } else {
                    ThrowError::redirect(
                        "Email already registered",
                        "The given email is already associated with an account.",
                        LINK_CONNECTION_SIGNUP
                    );
                }
            } else {
                ThrowError::redirect(
                    "Security",
                    "Passwords are different or have less than 8 characters.",
                    LINK_CONNECTION_SIGNUP
                );
            }
        } else {
            ThrowError::redirect(
                "User name",
                "Your username is longer than 25 characters.",
                LINK_CONNECTION_SIGNUP
            );
        }
    }
}

if ($action == "logout") {
    session_destroy();

    header("Location: " . LINK_HOME);
    exit;
}

require_once(TEMPLATES . $viewToRequire . ".php");
