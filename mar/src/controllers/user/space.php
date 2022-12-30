<?

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
$user_spaces = $spaceDAO->getSpaces($_SESSION['user_id']);
if (sizeof($user_spaces) == 0) {
    $spaceDAO->createSpace(
        new Space(-1, $_SESSION['user_name'] . "'s space", $_SESSION['user_id'])
    );

    $user_spaces = $spaceDAO->getSpaces($_SESSION['user_id']);
}

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


//--- Actions



if ($action == "saveBox") {
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

if ($action == "saveElements") {
    $updatedBox = clone $current_box;
    $updatedBox->setElementsOrder($_POST['elements-order']);
    unset($_POST['elements-order']);

    foreach($_POST as $id=>$elementType){
        $isId = ! str_contains($id, ":");
        $isNew = $isId && $id < 0;
        $isToDelete = $isId && str_contains($elementType, "deleted");
        $isBoxNotUpdated = false;

        if ($isToDelete) {
            $elementDAO->deleteElement($id);

            unset(
                $updatedBox->getElementsOrder()[
                    array_search($id, $updatedBox->getElementsOrder())
                ]
            );

            $isBoxNotUpdated = true;
        }

        if ($isNew) {
            if ($elementType == 'task'){
                $newElem = new Element(
                    $id,
                    '{"checked": '.(isset($_POST[$id.':task']) ? 'true' : 'false').', "content":"' . $_POST[$id.":tasknote"] .'"}',
                    $_SESSION['user_current_box'],
                    $elementType
                );
            }
            if ($elementType == 'note'){
                $newElem = new Element(
                    $id,
                    '{"content":"' . $_POST[$id.":note"] .'"}',
                    $_SESSION['user_current_box'],
                    $elementType
                );
            }
            $elementDAO->createElement($newElem);
        }

        // Element to modify or do nothing
        if ($isId && ! $isToDelete && ! $isNew) {
            if ($elements[$id] && in_array($elements[$id]->getId(), $current_box->getElementsOrder())){
                if ($_POST[$id] == 'task'){
                    $elements[$id]->setContent('{"checked": '.(isset($_POST[$id.':task']) ? 'true' : 'false').', "content":"' . $_POST[$id.":tasknote"] .'"}');  
                }
                if ($_POST[$id] == 'note'){
                    $elements[$id]->setContent('{"content":"' . $_POST[$id.":note"] .'"}');
                }
                $elementDAO->updateElement($elements[$id]);
            }
        }
    }

    if ($isBoxNotUpdated) {
        $boxDAO->updateBox($updatedBox);
    }

    //header("Location: " . LINK_SPACE);
}



require_once(TEMPLATES . $viewToRequire . ".php");