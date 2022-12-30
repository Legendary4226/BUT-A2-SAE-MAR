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

        // Rename a box
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

$updatedBox = $boxDAO->getBox($_SESSION['user_current_box']);

if ($action == "saveElements") {
    $current_box_elements = $elementDAO->getElements($current_box->getId());
    $updatedBox->setElementsOrder($_POST['elements-order']);
    
    $curentElementsId = [];
    foreach($current_box_elements as $id){
        array_push($curentElementsId, $id->getId());
    }

    foreach($_POST as $id=>$element){
        @[ $elementId, $elementType ] = preg_split("/:/", $id);
        
        // New elements have a negative ID like -1, -2, ...
        if ($elementId < 0){
            if ($_POST[$id] == 'task'){
                $newElem = new Element(
                    $id, 
                    '{"checked": '.(isset($_POST[$id.':task']) ? 'true' : 'false').', "content":"' . $_POST[$id.":tasknote"] .'"}',
                    $_SESSION['user_current_box'], 
                    $_POST[$id]
                );
            }
            if ($_POST[$id] == 'note'){
                $newElem = new Element(
                    $id, 
                    '{"content":"' . $_POST[$id.":note"] .'"}', 
                    $_SESSION['user_current_box'], 
                    $_POST[$id]
                );
            }
            $elementDAO->createElement($newElem);
        }

        // delete elements
        elseif(isset($elementType) && str_contains($elementType, "deleted")){
            $elementDAO->deleteElement($elementId);

            $orderId = $updatedBox->getElementsOrder();
            $supprId = array_search($elementId, $orderId);
            unset($orderId[$supprId]);

            $updatedBox->setElementsOrder(json_encode($orderId));
        }

        // Modify elements
        elseif ($elementId > 0 && $elementId != 'box-title' && $elementId != 'elements-order'){
            $modified_element = $elementDAO->getElement($elementId);
            if ($modified_element && in_array($modified_element->getId(), $curentElementsId)){
                $elem = $elementDAO->getElement($elementId);
                if ($_POST[$elementId] == 'task'){
                    $elem->setContent('{"checked": '.(isset($_POST[$elementId.':task']) ? 'true' : 'false').', "content":"' . $_POST[$elementId.":tasknote"] .'"}');  
                }
                if ($_POST[$elementId] == 'note'){
                    $elem->setContent('{"content":"' . $_POST[$elementId.":note"] .'"}');
                }
                $elementDAO->updateElement($elem);
            }
        }

        $elements = $elementDAO->getElements($updatedBox->getId());
    }
    var_dump($_POST);
    $boxDAO->updateBox($updatedBox);
}



require_once(TEMPLATES . $viewToRequire . ".php");