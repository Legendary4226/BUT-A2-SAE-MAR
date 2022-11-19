<?php

require_once("configuration/paths.php");
require_once("configuration/icons.php");


$isActionExisting = !empty($_GET["action"]) && is_readable(CONTROLLERS . $_GET["action"] . ".php");

if ($isActionExisting) {
    try {
        require_once(CONTROLLERS . $_GET["action"] . ".php");
    } catch (Exception $e) {
        echo "Error when loading the page.";
    };
}

if (! $isActionExisting) {
    header("Location: index.php?action=front/home");
}
