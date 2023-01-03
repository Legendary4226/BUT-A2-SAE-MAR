<?

class ThrowError {
    public static function redirect(string $title, string $message, string $return_link) {
        $_SESSION["error_return_link"] = $return_link;
        header("Location: ". LINK_ERROR . "&title=" . $title . "&message=" . $message);
    }
}