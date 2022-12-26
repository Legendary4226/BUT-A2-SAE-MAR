<?php

require_once(MODELS . "Space.php");
require_once(MODELS . "Box.php");
require_once(MODELS . "Element.php");

$enableLeftBoxMenu = true;

$spaceDAO = new SpaceDAO();
$boxDAO = new BoxDAO();
$elementDAO = new ElementDAO();


$action = null;
$viewToRequire = "box";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}



//---  Initialisations



// Define default user space
$user_spaces = $spaceDAO->gets($_SESSION['user_id']);
if (sizeof($user_spaces) == 0) {
    $spaceDAO->createSpace(
        new Space(-1, $_SESSION['user_name'] . "'s space", $_SESSION['user_id'])
    );

    $user_spaces = $spaceDAO->gets($_SESSION['user_id']);
}

// Set the current user space ID
if (!isset($_SESSION['user_current_space'])) {
    $_SESSION['user_current_space'] = array_key_first($user_spaces);
}

// Set the current user box ID
$user_boxes = $boxDAO->getes($_SESSION['user_current_space']);
if (!isset($_SESSION['user_current_box'])) {
    $_SESSION['user_current_box'] = array_key_first($user_boxes);
}

// Set the current elements in box
$elements = array();
if ($_SESSION['user_current_box'] != null) {
    $elements = $elementDAO->gets($_SESSION['user_current_box']);
}

// Determine the Box title
$box_title = "It's empty here?";
if ($_SESSION['user_current_box'] != null) {
    $box_title = $user_boxes[$_SESSION['user_current_box']]->getName();
}


//--- Actions



if ($action == "saveBox") {
    foreach ($_POST as $id=>$boxName){
        $splitted = preg_split("/:/", $id);
        $boxId = $splitted[0];

        // New boxs have a negative ID like -1, -2, ...
        if ($boxId < 0){ 
            $boxDAO->createBox(new Box(-1, $_SESSION['user_current_space'], $boxName));
        } 
        // Delete a box
        elseif(isset($splitted[1]) && str_contains($splitted[1], "deleted")) {
            $boxDAO->deleteBox($boxId);
        }
        // Rename a box
        elseif($user_boxes[$boxId]->getName() != $boxName) {
            $user_boxes[$boxId]->getName($boxName);
            $boxDAO->updateBox($user_boxes[$boxId]);
        }
    }
    
    header("Location: " . LINK_SPACE);
}

if ($action == "switchSpace") {
    $_SESSION['user_current_space'] = $_POST["space-id"];
    unset($_SESSION["user_current_box"]);
    header("Location: " . LINK_SPACE);
}

if ($action == "switchBox") {
    if (isset($_GET['box-id'])) {
        $_SESSION['user_current_box'] = $_GET['box-id'];
    } else {
        unset($_SESSION['user_current_box']);
    }
    header("Location: " . LINK_SPACE);
}

if ($action == "saveElements") {    //var_dump($box_elements);
    
}



require_once(TEMPLATES . $viewToRequire . ".php");