<?

require_once(MODELS . "User.php");
require_once(MODELS . "Space.php");
require_once(MODELS . "SpaceSharing.php");

$userDAO = new UserDAO();
$spaceDAO = new SpaceDAO();
$spaceSharingDAO = new SpaceSharingDAO();

$action = null;
$viewToRequire = "account";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}



//---  Initialisations



$spaces = $spaceDAO->getSpaces($_SESSION['user_id']);

if (!isset($_SESSION['user_current_space'])) {
    $_SESSION['user_current_space'] = array_key_first($spaces);
}
if (!isset($spaces[$_SESSION['user_current_space']])) {
    $_SESSION['user_current_space'] = array_key_first($spaces);
}

$sharingInfo = $spaceSharingDAO->getSharingInfo($_SESSION['user_current_space']);



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
                "User Name",
                "Your username is longer than 25 characters.",
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
                "Security",
                "Passwords are different or have less than 8 characters.",
                LINK_ACCOUNT
            );
        }
    }

    if ($atLeastOneModified) {
        $userDAO->updateUser($updateUser);
    }

    header("Location: " . LINK_ACCOUNT . "&notification=Modifications saved.");
    exit;
}

if ($action == "manageSpace") {
    $viewToRequire = "space-management";
}

if ($action == "updateSpaceAndShare") {

    if(isset($_POST["space-name"])) {
        $spaceNameLenght = strlen($_POST["space-name"]);
        
        if (0 < $spaceNameLenght && $spaceNameLenght <= 35){
            $spaceDAO->updateSpace(
                new Space($_SESSION['user_current_space'], $_POST["space-name"], $_SESSION['user_id'])
            );
        } else {
            ThrowError::redirect(
                "Space name",
                "The space name can't be empty or can't exceed 35 characters.",
                LINK_ACCOUNT_SPACE_SETTINGS
            );
        }
        
        unset($_POST["space-name"]);
    }

    if (!empty($_POST)) {

        foreach ($_POST as $id => $email)
        {
            @[ $user_id, $tag ] = preg_split("/:/", $id);

            $isDeleted = preg_match("/deleted/", $tag);
            $isNotOtherDatas = $tag == null;
            $isNew = $isNotOtherDatas && $id < 0;
            $isToModify = $isNotOtherDatas && !$isNew && !$isDeleted;

            $newPermission = $isNew || $isToModify ? $_POST[$user_id . ":permission"] : null;

            if ($isDeleted) {
                $debug = $spaceSharingDAO->deleteSpaceSharing($user_id, $_SESSION['user_current_space']);

                if (DEBUG_MODE && $debug == false) {
                    var_dump("Issue deleting SpaceSharing with values : user_id=" . $user_id . "  space_id=" . $_SESSION['user_current_space']);
                }
            }
            
            if ($isNew) {
                $potentialShareUser = $userDAO->getByEmail($email);
                
                if ($potentialShareUser != null && !isset($sharingInfo[$potentialShareUser->getId() . "-" . $_SESSION['user_current_space']])){
                    $debug = $spaceSharingDAO->createSpaceSharing(
                        new SpaceSharing(
                            $potentialShareUser->getId(), 
                            $_SESSION['user_current_space'],
                            $newPermission
                        )
                    );

                    if (DEBUG_MODE && $debug == false) {
                        var_dump("Issue creating SpaceSharing with values : user_id=" . $potentialShareUser->getId() . "  space_id=" . $_SESSION['user_current_space'] . "  newPermission=" . $newPermission);
                    }
                }
            }

            if ($isToModify) {
                $shareId = $id . "-" . $_SESSION["user_current_space"];
                $datasExists = isset($sharingInfo[$shareId]) && isset($_POST[$user_id . ":permission"]);

                $sharingInfoID = $user_id . "-" . $_SESSION['user_current_space'];
                $oldPermission = $datasExists ? $sharingInfo[$sharingInfoID]['share_permission'] : null;
                $datasValid = $datasExists && $newPermission != $oldPermission && ($newPermission == "read" || $newPermission == "edit");

                if ($datasValid) {

                    $debug = $spaceSharingDAO->updateShareSpace(
                        new SpaceSharing(
                            $user_id,
                            $_SESSION['user_current_space'],
                            $newPermission
                        )
                    );

                    if (DEBUG_MODE && $debug == false) {
                        var_dump("Issue updating SpaceSharing with values : user_id=" . $potentialShareUser->getId() . "  space_id=" . $_SESSION['user_current_space'] . "  newPermission=" . $newPermission);
                    }
                }
            }
        }
    }

    header("Location: " . LINK_ACCOUNT_SPACE_SETTINGS . "&notification=Saved.");
    exit;
}

if ($action == "createSpace") {
    $newSpaceNameExists = !empty($_GET["newSpaceName"]) && $_GET["newSpaceName"] != "";
    $isNewSpaceValid = strlen($_GET["newSpaceName"]) <= 35;
    
    if ($newSpaceNameExists && $isNewSpaceValid) {
        $spaceDAO->createSpace(new Space(
            -1, $_GET["newSpaceName"], $_SESSION["user_id"]
        ));
    }
    elseif(!$newSpaceNameExists) {
        ThrowError::redirect(
            "Space name",
            "Please fill the field.",
            LINK_ACCOUNT_SPACE_SETTINGS
        );
    }
    elseif(!$isNewSpaceValid) {
        ThrowError::redirect(
            "Space name",
            "The space name can't exceed 35 characters.",
            LINK_ACCOUNT_SPACE_SETTINGS
        );
    }

    header("Location: " . LINK_ACCOUNT_SPACE_SETTINGS);
    exit;
}

if ($action == "switchSpace") {
    $_SESSION['user_current_space'] = $_GET["space-id"];
    unset($_SESSION["user_current_box"]);

    header("Location: " . LINK_ACCOUNT_SPACE_SETTINGS);
    exit;
}


require_once(TEMPLATES . $viewToRequire . ".php");