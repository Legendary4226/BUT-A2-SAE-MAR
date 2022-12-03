<?php

require_once("configuration/paths.php");
require_once("configuration/icons.php");
require_once("configuration/links.php");
require_once("configuration/database.php");

require_once(LIB . "DatabaseConnection.php");


$isPageExisting = !empty($_GET["page"]) && is_readable(CONTROLLERS . $_GET["page"] . ".php");

if ($isPageExisting) {
    try {
        require_once(CONTROLLERS . $_GET["page"] . ".php");
    } catch (Exception $e) {
        echo "Error when loading the page. " ;
        echo $e->getMessage();
    };
} else {
    header("Location: index.php?page=front/home");
}
