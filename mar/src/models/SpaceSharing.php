<?

class SpaceSharing {
    private $share_user_id;
    private $share_space_id;
    private $share_permission;

    public function __construct($share_user_id, $share_space_id, $share_permission)
    {
        $this->share_user_id = $share_user_id;
        $this->share_space_id = $share_space_id;
        $this->share_permission = $share_permission;
    }

    // Getters
    public function getUsersId(){
        return $this->share_user_id;
    }
    public function getSpaceId(){
        return $this->share_space_id;
    }
    public function getPermission(){
        return $this->share_permission;
    }

    // Setters
    public function setUserId($share_user_id){
        $this->share_user_id = $share_user_id;
    }
    public function setPermission($share_permission){
        $this->share_permission = $share_permission;
    }
}

class SpaceSharingDAO {
    private DatabaseConnection $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Creates a SpaceSharing.
     * This function suppose that all informations are correct.
     * @param SpaceSharing $spaceSharing
     * @return bool If created, returns true, otherwise false.
     */
    public function createSpaceSharing(SpaceSharing $spaceSharing)
    {
        $result = $this->db->executeQuery(
            "INSERT INTO space_sharing(share_user_id, share_space_id, share_permission) VALUES(?, ?, ?)",
            array(
                $spaceSharing->getUsersId(),
                $spaceSharing->getSpaceId(),
                $spaceSharing->getPermission()
            )
        );

        return $result != false;
    }

    /**
     * Get an array with all Spaces Shared of the user.
     * @param string $user_id
     * @return array An array containing SpaceSharings.
     */
    public function getSharingsToAUser(string $user_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM space_sharing WHERE share_user_id = ?",
            array(
                $user_id
            )
        )->fetchAll();

        $spaces = array();
        foreach($result as $space) {
            array_push($spaces, new SpaceSharing(
                $space[0],
                $space[1],
                $space[2]
            ));
        }

        return $spaces;
    }

    /**
     * Get following informations about a SpaceSharing : user_id + user_email + space_id + permission.
     * @param string $space_id
     * @return array An array associating '$user_id-$space_id' => $spaceSharing.
     */
    public function getSharingInfo(string $space_id) {
        $result = $this->db->executeQuery(
            "SELECT user_id, share_space_id, share_permission, user_email FROM space_sharing JOIN users ON share_user_id=users.user_id WHERE share_space_id=?;",
            array(
                $space_id
            )
        )->fetchAll();

        $informations = [];
        foreach($result as $share) {
            $informations[$share["user_id"] . "-" . $share["share_space_id"]] = $share;
        }

        return $informations;
    }

    /**
     * Update a SpaceSharing.
     * @param SpaceSharing $spaceSharing
     * @return bool return true if updated otherwise false
     */
    public function updateShareSpace(SpaceSharing $spaceSharing)
    {
        $result = $this->db->executeQuery(
            "UPDATE space_sharing SET share_permission = ? WHERE share_user_id = ? and share_space_id = ? ;",
            array(
                $spaceSharing->getPermission(),
                $spaceSharing->getUsersId(),
                $spaceSharing->getSpaceId()
            )
        );

        return $result != false;
    }

    /**
     * Delete a SpaceSharing.
     * @param string $share_user_id
     * @param string $share_space_id
     * @return bool return true if deleted otherwise false
     */
    public function deleteSpaceSharing($share_user_id, $share_space_id)
    {
        $result = $this->db->executeQuery(
            "DELETE FROM space_sharing WHERE share_user_id = ? and share_space_id = ? ;",
            array(
                $share_user_id,
                $share_space_id
            )
        );

        return $result != false;
    }
}