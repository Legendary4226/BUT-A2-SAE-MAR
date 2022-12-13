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
    public function getUserId(){
        return $this->user_id;
    }
    public function getUserEmail(){
        return $this->user_email;
    }
    public function getUserName(){
        return $this->user_name;
    }
    public function getUserPass(){
        return $this->user_pass;
    }

    // Setters
    public function setUserEmail(string $user_email){
        $this->user_email = $user_email;
    }
    public function setUserName(string $user_name){
        $this->user_name = $user_name;
    }
    public function setUserPass(string $user_pass){
        $this->user_pass = $user_pass;
    }
}



class UserPDO {
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
    public function getUserByEmail(string $email)
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
    public function getUserByID(string $id)
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
                htmlspecialchars($user->getUserEmail()),
                htmlspecialchars($user->getUserName()),
                $user->getUserPass()
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
                $user->getUserEmail(),
                $user->getUserName(),
                $user->getUserPass(),
                $user->getUserID()
            )
        );

        return $result != false;
    }
}