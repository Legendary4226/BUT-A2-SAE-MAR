<?

require_once(MODELS . "User.php");
require_once(MODELS . "Space.php");

$userDAO = new UserDAO();
$spaceDAO = new SpaceDAO();

$action = null;
$viewToRequire = "account";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}



//---  Initialisations



$spaces = $spaceDAO->getSpaces($_SESSION['user_id']);

if (! isset($_SESSION['user_current_space'])) {
    $_SESSION['user_current_space'] = array_key_first($spaces);
}



//--- Actions



if ($action == 'modifyAccount'){
    $viewToRequire = "account";

    $atLeastOneModified = false;
    $updateUser = new User($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['user_name'], $_SESSION['user_pass']);

    if (!empty($_POST['name'] && $_POST['name'] != $_SESSION['user_name'])) {
        if (strlen($_POST['name']) <= 25) {
            $_SESSION['user_name'] = htmlspecialchars($_POST['name']);
            $updateUser->setName($_SESSION['user_name']);
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
        $updateUser->setEmail($_SESSION['user_email']);
        $atLeastOneModified = true;
    }

    if (!empty($_POST['changepass']) && !empty($_POST['confpass'])) {

        if (strlen($_POST['changepass']) >= 8 && $_POST['changepass'] == $_POST['confpass']) {
            $_SESSION['user_pass'] = password_hash($_POST['changepass'], PASSWORD_BCRYPT);
            $updateUser->setPass($_SESSION['user_pass']);
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

    header("Location: " . LINK_ACCOUNT . "&notification=Modifications saved.");
}

if ($action == "manageSpace") {
    $viewToRequire = "space-management";
}

if ($action == "createSpace") {
    if (!empty($_GET["newSpaceName"]) && $_GET["newSpaceName"] != "") {
        $spaceDAO->createSpace(new Space(
            -1, $_GET["newSpaceName"], $_SESSION["user_id"]
        ));
    }

    header("Location: " . LINK_ACCOUNT_SPACE_SETTINGS);
}

if ($action == "switchSpace") {
    $_SESSION['user_current_space'] = $_GET["space-id"];
    unset($_SESSION["user_current_box"]);

    header("Location: " . LINK_ACCOUNT_SPACE_SETTINGS);
}


require_once(TEMPLATES . $viewToRequire . ".php");