<?

class ThrowError {
    public static function redirect(string $title, string $message, string $return_link) {
        header("Location: ". LINK_ERROR . "&title=" . $title . "&message=" . $message . "&return=" . $return_link);
    }
}