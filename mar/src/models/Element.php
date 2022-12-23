<?php

class Element {
    private $element_id;
    private string $element_content;
    private $element_box;
    private $element_type;

    public function __construct($element_id, string $element_content, $element_box, $element_type)
    {
        $this->element_id = $element_id;
        $this->element_content = $element_content;
        $this->element_box = $element_box;
        $this->element_type = $element_type;
    }

    // Getters
    public function getElementId(){
        return $this->element_id;
    }

    public function getElementContent(){
        return $this->element_content;
    }

    public function getElementBox(){
        return $this->element_box;
    }

    public function getElementType(){
        return $this->element_type;
    }

    // Setters
    public function setElementContent($element_content){
        $this->element_content = $element_content;
    }

    public function setElementBox($element_box){
        $this->element_box = $element_box;
    }

    public function setElementType($element_type){
        $this->element_type = $element_type;
    }

    
}

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
            "INSERT INTO element(element_content, element_box, element_type) VALUES(?, ?, ?)",
            array(
                htmlspecialchars($element->getElementContent()),
                $element->getElementBox(),
                $element->getElementType()
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