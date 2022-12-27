<?

// Client get classic images with the URL
define("IMAGES", "https://" . $_SERVER["SERVER_NAME"] . "/" . TEMPLATES . "ressources/images/");

// Server require SVG Icons with the local absolute PATH
define("ICON_SVG", $_SERVER["DOCUMENT_ROOT"] . "/" . TEMPLATES . "ressources/images/" . "svg-icons/");

// Action Buttons
define("ICON_SVG_CLOSE", ICON_SVG . "close-svg.php");
define("ICON_SVG_PLUS", ICON_SVG . "plus-svg.php");
define("ICON_SVG_SAVE", ICON_SVG . "save-svg.php");
define("ICON_SVG_MENU", ICON_SVG . "menu-svg.php");
define("ICON_SVG_SHARE", ICON_SVG . "share-svg.php");
define("ICON_SVG_TRASH_CAN", ICON_SVG . "trash-can-svg.php");

// Box Icons
define("ICON_SVG_BOX_BOX", ICON_SVG . "box-box-svg.php");
define("ICON_SVG_BOX_LEAF", ICON_SVG . "box-leaf-svg.php");
define("ICON_SVG_BOX_ROPE_KNOT", ICON_SVG . "box-rope-knot-svg.php");
