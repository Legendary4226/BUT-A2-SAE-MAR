<?php

require_once(MODELS . "Space.php");
require_once(MODELS . "Box.php");
require_once(MODELS . "Element.php");

$enableLeftBoxMenu = true;

$spaceDAO = new SpaceDAO();
$boxDAO = new BoxDAO();
$elementDAO = new ElementDAO();

$user_spaces = $spaceDAO->getSpaces($_SESSION['user_id']);

// Define default user space
if (sizeof($user_spaces) == 0) {
    $spaceDAO->createSpace(
        new Space(-1, $_SESSION['user_name'] . "'s space", $_SESSION['user_id'])
    );

    $user_spaces = $spaceDAO->getSpaces($_SESSION['user_id']);
}

if (!isset($_SESSION['user_current_space'])) {
    $_SESSION['user_current_space'] = array_key_first($user_spaces);
}

$user_boxes = $boxDAO->getBoxes($_SESSION['user_current_space']);

if (!isset($_SESSION['user_current_box'])) {
    $_SESSION['user_current_box'] = array_key_first($user_boxes);
}

$action = null;
$viewToRequire = "box";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

//var_dump($spaceDAO->getSpaces($_SESSION['user_id']));
//var_dump($boxDAO->getBoxes($_SESSION['user_current_space']));
//var_dump($elementDAO->getElements($_SESSION['user_current_box']));

if ($action == "save") {

}

require_once(TEMPLATES . $viewToRequire . ".php");