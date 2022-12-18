<?php

class Box {
    private $box_id;
    private string $box_name;
    private $box_space;

    public function __construct($box_id, string $box_name, $box_space)
    {
        $this->box_id = $box_id;
        $this->box_name = $box_name;
        $this->box_space = $box_space;
    }

    // Getters
    public function getBoxId(){
        return $this->box_id;
    }

    public function getBoxName(){
        return $this->box_name;
    }

    public function getBoxSpace(){
        return $this->box_space;
    }

    // Setters
    public function setBoxName($box_name){
        $this->box_name = $box_name;
    }

    public function setBoxSpace($box_space){
        $this->box_space = $box_space;
    }

    
}

class BoxDAO {
    private DatabaseConnection $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Creates a Box.
     * This function suppose that all informations are correct.
     * @param Box $box
     * @return bool If created, returns true or return false.
     */
    public function createBox(Box $box)
    {
        $result = $this->db->executeQuery(
            "INSERT INTO box(box_name, box_space) VALUES(?, ?)",
            array(
                htmlspecialchars($box->getBoxName()),
                $box->getBoxSpace()
            )
        );

        return $result != false;
    }

    /**
     * Get an array with all Box of the Space.
     * @param string $box_space
     * @return array Containing Boxes of the Space associating box_space => Box.
     */
    public function getBoxes(string $box_space)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM box WHERE box_space = ?",
            array(
                $box_space
            )
        )->fetchAll();

        $boxes = array();
        foreach($result as $box) {
            $boxes[$box[0]] = new Box(
                $box[0],
                $box[1],
                $box[2]
            );
        }

        return $boxes;
    }

    /**
     * Get a Box.
     * @param string $box_id
     * @return Box return box corresponding of $box_id
     */
    public function getBox(string $box_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM box WHERE box_id = ?",
            array(
                $box_id
            )
        )->fetch();

        if ($result != false) {
            $result = new Box(
                $result[0],
                $result[1],
                $result[2]
            );
        }

        return $result;
    }
}