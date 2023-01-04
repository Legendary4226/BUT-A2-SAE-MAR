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
     * Creates a Space.
     * This function suppose that all informations are correct.
     * @param Space $space 
     * @return bool If created, returns true or return false.
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
     * Get an array with all Spaces of the user.
     * @param string $user_id
     * @return array Containing Spaces of the user associating space_id => Space.
     */
    public function getShareSpaces($share_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM space_sharing WHERE share_space_id = ?",
            array(
                $share_id
            )
        )->fetchAll();

        $spaces = array();
        foreach($result as $space) {
            $spaces[$space[0]] = new SpaceSharing(
                $space[0],
                $space[1],
                $space[2]
            );
        }

        return $spaces;
    }

    /**
     * Get a Space.
     * @param string $space_id
     * @return Space return space corresponding of $space_id
     */
    public function getShareSpace(string $space_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM space_sharing WHERE space_share_id = ?",
            array(
                $space_id
            )
        )->fetch();

        if ($result != false) {
            $result = new Space(
                $result[0],
                $result[1],
                $result[2]
            );
        }

        return $result;
    }

    public function updateShareSpace(SpaceSharing $spacesharing)
    {
        $result = $this->db->executeQuery(
            "UPDATE space_sharing SET share_permission = ? WHERE share_user_id = ? and share_space_id = ? ;",
            array(
                $spacesharing->getPermission(),
                $spacesharing->getUsersId(),
                $spacesharing->getSpaceId()
            )
        );

        return $result != false;
    }

    public function deleteElement($share_user_id, $share_space_id)
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