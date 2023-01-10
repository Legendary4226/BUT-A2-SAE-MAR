<?php

require_once(MODELS . "Space.php");
require_once(MODELS . "SpaceSharing.php");
require_once(MODELS . "Box.php");
require_once(MODELS . "Element.php");

$enableLeftBoxMenu = true;

$spaceDAO = new SpaceDAO();
$spaceSharedDAO = new SpaceSharingDAO();
$boxDAO = new BoxDAO();
$elementDAO = new ElementDAO();


$action = null;
$viewToRequire = "box";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}



//---  Initialisations



// Define default user space
$user_spaces = $spaceDAO->getSpaces($_SESSION['user_id']);
if (sizeof($user_spaces) == 0) {
    $spaceDAO->createSpace(
        new Space(-1, $_SESSION['user_name'] . "'s space", $_SESSION['user_id'])
    );

    $user_spaces = $spaceDAO->getSpaces($_SESSION['user_id']);
}

$sharedSpace = $spaceSharedDAO->getSharingsToAUser($_SESSION['user_id']);

// Set the current user space ID
if (!isset($_SESSION['user_current_space'])) {
    $_SESSION['user_current_space'] = array_key_first($user_spaces);
}

// Set the current user box ID
$user_boxes = $boxDAO->getBoxs($_SESSION['user_current_space']);
if (!isset($_SESSION['user_current_box'])) {
    $_SESSION['user_current_box'] = array_key_first($user_boxes);
}

// Set the current elements in box
$elements = array();
if ($_SESSION['user_current_box'] != null) {
    $elements = $elementDAO->getElements($_SESSION['user_current_box']);
}

// Determine the current Box object
$current_box = null;
if ($_SESSION['user_current_box'] != null) {
    $current_box = $user_boxes[$_SESSION['user_current_box']];
}

// Determine the current permission of the user
$hasWritePermission = true;
if (isset($sharedSpace[$_SESSION['user_current_space']])) {
    $hasWritePermission = $sharedSpace[$_SESSION['user_current_space']]->getPermission() == "edit";
}



//--- Actions



if ($action == "saveBox") {

    if (!$hasWritePermission) {
        ThrowError::redirect(
            "Permission missing",
            "You can only read this space. Ask to the owner to grant you the 'edit' permission.",
            LINK_SPACE
        );
    }

    foreach ($_POST as $id=>$boxName){
        @[ $boxId, $boxDeleted ] = preg_split("/:/", $id);

        // New boxs have a negative ID like -1, -2, ...
        if ($boxId < 0){
            $boxDAO->createBox(new Box(-1, $_SESSION['user_current_space'], $boxName, "[]"));
        }

        // Delete a box
        elseif($boxDeleted != null && $boxDeleted == "deleted") {
            $boxDAO->deleteBox($boxId);
        }

        // Rename a box if values are different
        elseif($user_boxes[$boxId]->getName() != $boxName) {
            $user_boxes[$boxId]->setName($boxName);
            $boxDAO->updateBox($user_boxes[$boxId]);
        }
    }
    
    unset($_SESSION['user_current_box']);
    
    header("Location: " . LINK_SPACE . "&notification=Boxes saved.");
    exit;
}

if ($action == "switchSpace") {
    $_SESSION['user_current_space'] = $_POST["space-id"];
    unset($_SESSION["user_current_box"]);

    header("Location: " . LINK_SPACE);
    exit;
}

if ($action == "switchBox") {
    if (isset($_GET['box-id'])) {
        $_SESSION['user_current_box'] = $_GET['box-id'];
    } else {
        unset($_SESSION['user_current_box']);
    }

    header("Location: " . LINK_SPACE);
    exit;
}

if ($action == "saveElements") {

    if (!$hasWritePermission) {
        ThrowError::redirect(
            "Permission missing",
            "You can only read this space. Ask to the owner to grant you the 'edit' permission.",
            LINK_SPACE
        );
    }

    $updatedBox = clone $current_box;
    $updatedBox->setElementsOrder($_POST['elements-order']);
    unset($_POST['elements-order']);
    $deletedElements = [];

    $isBoxNotUpdated = false;
    $indexInOrder = 0;
    foreach($_POST as $id=>$type)
    {
        $isId = ! str_contains($id, ':');

        if ($isId) {
            $isNew = $id < 0;
            $isToDelete = str_contains($type, "deleted");
            $isToModify = ! $isToDelete && ! $isNew;

            if ($isToDelete) {
                $elementDAO->deleteElement($id);
                $updatedBox->deleteElementFromOrder($id);
                $deletedElements[] = $id;
                if ($indexInOrder > 0) {
                    $indexInOrder--;
                }
                $isBoxNotUpdated = true;
            }
    
            if ($isNew) {
                createNewElement($id, $type);
                $updatedBox->insertElementOrder($indexInOrder, $id);
                $isBoxNotUpdated = true;
            }

            if ($isToModify) {
                modifyElement($id, $type);
            }

            $indexInOrder++;
        }
    }

    if ($isBoxNotUpdated) {
        $newElementsIDs = array_diff($boxDAO->getElementsIDList($_SESSION['user_current_box']), $current_box->getElementsOrder(), $deletedElements);
        sort($newElementsIDs);

        $j = 0;
        for($i = 0; $i < count($updatedBox->getElementsOrder()); $i++) {
            if ($updatedBox->getElementsOrder()[$i] < 0) {
                $updatedBox->replaceElementOrder($i, $newElementsIDs[$j]);
                $j++;
            }
        }

        $boxDAO->updateBox($updatedBox);
    }

    header("Location: " . LINK_SPACE . "&notification=Modifications saved.");
    exit;
}

// REFACTOR : Create a model foreach elements Type ! This change will make these infinite switch shorter and cleaner.
// Create a interface 'Element', because 

function createNewElement($id, $type) {
    global $elementDAO;
    $newElement = null;

    switch ($type)
    {
        case 'task':
            $newElement = new Element( $id, "", $_SESSION['user_current_box'], $type );
            $newElement->setContent([
                "checked" => isset($_POST[$id.':task']),
                "content" => $_POST[$id.":tasknote"]
            ], true);
            break;
        case 'note':
            $newElement = new Element( $id, "", $_SESSION['user_current_box'], $type );
            $newElement->setContent([
                "content" => $_POST[$id.":note"]
            ], true);
            break;
    }
    if ($newElement != null) {
        $elementDAO->createElement($newElement);
    }
}

function modifyElement($id, $type) {
    global $elements, $elementDAO;
    $isModified = false;
    $e = $elements[$id];
    $content = $e->getContent();

    switch ($type)
    {
        case 'task':
            $isValid = isset($_POST[$id . ":tasknote"]);
            $newState = isset($_POST[$id . ":task"]);
            $newContent = $_POST[$id . ":tasknote"];

            if ($isValid && ( $content["checked"] != $newState || $content["content"] != $newContent )) {
                $e->setContent([
                    "checked" => $newState,
                    "content" => $newContent
                ],true);
                $isModified = true;
            }
            break;

        case 'note':
            $isValid = isset($_POST[$id . ":note"]);
            $newContent = $_POST[$id . ":note"];

            if ($isValid && ( $content["content"] != $newContent )) {
                $e->setContent([
                    "content" => $newContent
                ], true);
                $isModified = true;
            }
            break;
    }
    if ($isModified) {
        $elementDAO->updateElement($e);
    }
}


require_once(TEMPLATES . $viewToRequire . ".php");