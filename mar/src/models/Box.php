<?

class Box {
    private $box_id;
    private $box_space;
    private string $box_name;
    private array $box_elements_order;

    public function __construct($box_id, $box_space, string $box_name, string $box_elements_order)
    {
        $this->box_id = $box_id;
        $this->box_space = $box_space;
        $this->box_name = $box_name;
        $this->box_elements_order = json_decode($box_elements_order, true);
    }

    // Getters
    public function getId(){
        return $this->box_id;
    }

    public function getName(){
        return $this->box_name;
    }

    public function getSpace(){
        return $this->box_space;
    }

    public function getElementsOrder() {
        return $this->box_elements_order;
    }

    // Setters
    public function setName($box_name){
        $this->box_name = $box_name;
    }

    public function setSpace($box_space){
        $this->box_space = $box_space;
    }

    public function setElementsOrder($box_elements_order){
        $this->box_elements_order = json_decode($box_elements_order);
    }


    public function deleteElementFromOrder($id) {
        unset($this->box_elements_order[
            array_search($id, $this->box_elements_order)
        ]);
    }

    public function insertElementOrder($position, $insert) {
        array_splice($this->box_elements_order, $position, 0, $insert);
    }

    public function replaceElementOrder($position, $value) {
        array_splice($this->box_elements_order, $position, 1, $value);
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
            "INSERT INTO box(box_name, box_space, box_elements_order) VALUES(?, ?, ?)",
            array(
                $box->getName(),
                $box->getSpace(),
                json_encode($box->getElementsOrder())
            )
        );

        return $result != false;
    }

    /**
     * Delete a Box.
     * This function suppose that all informations are correct.
     * @param string $box_id
     * @return bool if delete, else return Null
     */
    public function deleteBox(string $box_id)
    {
        $result = $this->db->executeQuery(
            "DELETE FROM box WHERE box_id = ?;",
            array(
                $box_id,
            )
        );

        return $result != false;
    }

    /**
     * Update a box informations.
     * @param Box $box The updated box
     * @return bool True if the box was successfully updated, otherwise false.
     */
    public function updateBox(Box $box)
    {
        $result = $this->db->executeQuery(
            "UPDATE box SET box_name = ?, box_elements_order = ? WHERE box_id = ?;",
            array(
                htmlspecialchars($box->getName()),
                json_encode($box->getElementsOrder()),
                $box->getId()
            )
        );

        return $result != false;
    }

    /**
     * Get an array with all Box of the Space.
     * @param string $box_space
     * @return array Containing Boxes of the Space associating box_space => Box.
     */
    public function getBoxs(string $box_space)
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
                $box[2],
                $box[3]
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
                $result[2],
                $result[3]
            );
        }

        return $result;
    }

    /**
     * Get a Box elements IDs list.
     * @param string $box_id
     * @return array a list of IDs.
     */
    public function getElementsIDList(string $box_id) {
        $elementsIds = $this->db->executeQuery(
            "SELECT element_id FROM element WHERE element_box = ?",
            array(
                $box_id
            )
        )->fetchAll();

        $result = [];
        foreach($elementsIds as $id) {
            $result[] = $id['element_id'];
        }

        return $result;
    }
}