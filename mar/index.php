<?php

require_once("configuration/paths.php");


$isActionExisting = !empty($_GET["action"]) && is_readable(CONTROLLERS . $_GET["action"] . ".php");

if ($isActionExisting) {
    try {
        require_once(CONTROLLERS . $_GET["action"] . ".php");
    } catch (Exception $e) {
        echo "Error when loading the page.";
    };
}

if (! $isActionExisting) {
    echo "Need to implement a 404 page";
}
