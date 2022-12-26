<?php

class User {
    private $user_id;
    private string $user_email;
    private string $user_name;
    private string $user_pass;

    public function __construct($user_id, string $user_email, string $user_name, string $user_pass)
    {
        $this->user_id = $user_id;
        $this->user_email = $user_email;
        $this->user_name = $user_name;
        $this->user_pass = $user_pass;
    }

    // Getters
    public function getId(){
        return $this->user_id;
    }
    public function getEmail(){
        return $this->user_email;
    }
    public function getName(){
        return $this->user_name;
    }
    public function getPass(){
        return $this->user_pass;
    }

    // Setters
    public function setEmail(string $user_email){
        $this->user_email = $user_email;
    }
    public function setName(string $user_name){
        $this->user_name = $user_name;
    }
    public function setPass(string $user_pass){
        $this->user_pass = $user_pass;
    }
}



class UserDAO {
    private DatabaseConnection $db;

    public function __construct()
    {
       $this->db = Database::getInstance();
    }

    /** 
     * Return a User object if a user exists with the provided email.
     * @param string $email The user's email.
     * @return User|null The User or null.
     */
    public function getByEmail(string $email)
    {
        $statement = $this->db->prepareStatement("SELECT * FROM users WHERE user_email = ?;");
        $statement->execute(array($email));
        $datas = $statement->fetch();

        $user = null;
        if ($datas != false) {
            $user = new User($datas[0], $datas[1], $datas[2], $datas[3]);
        }

        return $user;
    }

    /** 
     * Return a User object if a user exists with the provided ID.
     * @param string $id The user's ID.
     * @return User|null The User or null.
     */
    public function getByID(string $id)
    {
        $statement = $this->db->prepareStatement("SELECT * FROM users WHERE user_id = ?;");
        $statement->execute(array($id));
        $datas = $statement->fetch();

        $user = null;
        if ($datas != false) {
            $user = new User($datas[0], $datas[1], $datas[2], $datas[3]);
        }

        return $user;
    }

    /**
     * Creates a user.
     * This function suppose that all informations are correct.
     * @param User $user 
     * @return bool If created, returns true or return false.
     */
    public function createUser(User $user)
    {
        $result = $this->db->executeQuery(
            "INSERT INTO users(user_email, user_name, user_pass) VALUES(?, ?, ?)",
            array(
                htmlspecialchars($user->getEmail()),
                htmlspecialchars($user->getName()),
                $user->getPass()
            )
        );

        return $result != false;
    }

    /**
     * Update a user datas.
     * This function suppose that all informations are correct.
     * @param User $user The user with modified datas.
     * @return bool If successfully updated, returns true or false otherwise.
     */
    public function updateUser(User $user)
    {
        $result = $this->db->executeQuery(
            "UPDATE users SET user_email = ?, user_name = ?, user_pass = ? where user_id = ?;",
            array(
                $user->getEmail(),
                $user->getName(),
                $user->getPass(),
                $user->getID()
            )
        );

        return $result != false;
    }
}