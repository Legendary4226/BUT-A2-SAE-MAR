<?php

class Space {
    private $space_id;
    private string $space_name;
    private $space_owner;

    public function __construct($space_id, string $space_name, $space_owner)
    {
        $this->space_id = $space_id;
        $this->space_name = $space_name;
        $this->space_owner = $space_owner;
    }

    // Getters
    public function getSpaceId(){
        return $this->space_id;
    }
    public function getSpaceName(){
        return $this->space_name;
    }
    public function getSpaceOwner(){
        return $this->space_owner;
    }

    // Setters
    public function setSpaceName(string $space_name){
        $this->space_name = $space_name;
    }
    public function setSpaceOwner($space_owner){
        $this->space_owner = $space_owner;
    }
}

class SpaceDAO {
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
    public function createSpace(Space $space)
    {
        $result = $this->db->executeQuery(
            "INSERT INTO space(space_name, space_owner) VALUES(?, ?)",
            array(
                htmlspecialchars($space->getSpaceName()),
                $space->getSpaceOwner()
            )
        );

        return $result != false;
    }
}