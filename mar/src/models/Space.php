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
    public function getId(){
        return $this->space_id;
    }
    public function getName(){
        return $this->space_name;
    }
    public function getOwner(){
        return $this->space_owner;
    }

    // Setters
    public function setName(string $space_name){
        $this->space_name = $space_name;
    }
    public function setOwner($space_owner){
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
                htmlspecialchars($space->getName()),
                $space->getOwner()
            )
        );

        return $result != false;
    }

    /**
     * Get an array with all Spaces of the user.
     * @param string $user_id
     * @return array Containing Spaces of the user associating space_id => Space.
     */
    public function gets(string $user_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM space WHERE space_owner = ?",
            array(
                $user_id
            )
        )->fetchAll();

        $spaces = array();
        foreach($result as $space) {
            $spaces[$space[0]] = new Space(
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
    public function get(string $space_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM space WHERE space_id = ?",
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
}