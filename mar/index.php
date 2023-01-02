<?

session_start();

if (version_compare(PHP_VERSION, "8.0.13") < 0) {
    echo "<p>Your server is running PHP <b>V" . PHP_VERSION . "</b>. Please upgrade to PHP <b>V8.0.13</b> or superior!</p>";
    exit(-1);
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = null;
}

require_once("configuration/paths.php");
require_once("configuration/icons.php");
require_once("configuration/links.php");
require_once("configuration/database.php");

require_once(LIB . "DatabaseConnection.php");
require_once(LIB . "ThrowError.php");


$isControllerExists = !empty($_GET["page"]) && is_readable(CONTROLLERS . $_GET["page"] . ".php");

if ($isControllerExists) {
    try {

        $isPageRequiresLoggedIn = preg_match('/^front\//', $_GET["page"]) != 1;
        // If the user isn't connected AND tries to access a page not in the "front/" controllers folder.
        if ($_SESSION['user_id'] == null && $isPageRequiresLoggedIn) {
            echo "Trying to access a page that require to be connected.";
        } else {
            require_once(CONTROLLERS . $_GET["page"] . ".php");
        }

    } catch (Exception $e) {
        echo "Error when loading the page.";
        echo $e->getMessage();
    };
} else {
    header("Location: " . LINK_HOME);
}
