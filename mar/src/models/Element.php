<?php

/**
 * Element to make operation between object and the table database.
 * @see ElementDAO
 */
class Element {
    private $element_id;
    private $element_content;
    private $element_box;
    private $element_type;

    public function __construct($element_id, string $element_content, $element_box, $element_type)
    {
        $this->element_id = $element_id;
        $this->element_content = json_decode($element_content, true);
        $this->element_box = $element_box;
        $this->element_type = $element_type;
    }

    // Getters
    public function getId(){
        return $this->element_id;
    }

    public function getContent(){
        return $this->element_content;
    }

    public function getBox(){
        return $this->element_box;
    }

    public function getType(){
        return $this->element_type;
    }

    // Setters
    public function setContent($element_content, $isJSON = false){
        if ($isJSON) {
            $this->element_content = $element_content;
        } else {
            $this->element_content = json_decode($element_content, true);
        }
    }

    public function setBox($element_box){
        $this->element_box = $element_box;
    }

    public function setType($element_type){
        $this->element_type = $element_type;
    }
}

/**
 * ElementDAO to make operation between object and the table database.
 * @see Element
 */
class ElementDAO {
    private DatabaseConnection $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Creates a Element.
     * This function suppose that all informations are correct.
     * @param Element $element
     * @return bool If created, returns true or return false.
     */
    public function createElement(Element $element)
    {
        $result = $this->db->executeQuery(
            "INSERT INTO element(element_data, element_box, element_type) VALUES(?, ?, ?)",
            array(
                json_encode($element->getContent()),
                $element->getBox(),
                $element->getType()
            )
        );

        return $result != false;
    }
    
    /**
     * Update a Element informations.
     * @param Element $Element The updated Element
     * @return bool True if the Element was successfully updated, otherwise false.
     */
    public function updateElement(Element $element)
    {
        $result = $this->db->executeQuery(
            "UPDATE element SET element_data = ?, element_box = ?, element_type = ? WHERE Element_id = ?;",
            array(
                json_encode($element->getContent()),
                $element->getBox(),
                $element->getType(),
                $element->getId()
            )
        );

        return $result != false;
    }

    /**
     * Delete a Element.
     * This function suppose that all informations are correct.
     * @param string $element_id
     * @return bool if delete, else return Null
     */
    public function deleteElement(string $element_id)
    {
        $result = $this->db->executeQuery(
            "DELETE FROM element WHERE element_id = ?;",
            array(
                $element_id,
            )
        );

        return $result != false;
    }

    /**
     * Get an array with all Element of the Box.
     * @param string $element_box
     * @return array Containing Elements of the Box associating element_box => Element.
     */
    public function getElements(string $element_box)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM element WHERE element_box = ?",
            array(
                $element_box
            )
        )->fetchAll();

        $elements = array();
        foreach($result as $element) {
            $elements[$element[0]] = new Element(
                $element[0],
                $element[1],
                $element[2],
                $element[3]
            );
        }

        
        return $elements;
    }

    /**
     * Get a Element.
     * @param string $element_id
     * @return Element return element corresponding of $element_id
     */
    public function getElement(string $element_id)
    {
        $result = $this->db->executeQuery(
            "SELECT * FROM element WHERE element_id = ?",
            array(
                $element_id
            )
        )->fetch();

        if ($result != false) {
            $result = new Element(
                $result[0],
                $result[1],
                $result[2],
                $result[3]
            );
        }

        return $result;
    }



}