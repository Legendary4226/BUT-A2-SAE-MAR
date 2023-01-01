<?php

define("INDEX_FILE", "index.php?page=");


define("LINK_HOME", INDEX_FILE . "front/home");
define("LINK_ERROR", INDEX_FILE . "front/error");


define("LINK_CONNECTION", INDEX_FILE . "front/connection");
define("LINK_CONNECTION_SIGNIN", LINK_CONNECTION . '&action=signin');
define("LINK_CONNECTION_SIGNUP", LINK_CONNECTION . '&action=signup');
define("LINK_CONNECTION_LOGOUT", LINK_CONNECTION . "&action=logout");


define("LINK_ACCOUNT", INDEX_FILE . "user/account");
define("LINK_ACCOUNT_SPACE_SETTINGS", INDEX_FILE . "user/account&action=manageSpace");


define("LINK_SPACE", INDEX_FILE . "user/space");