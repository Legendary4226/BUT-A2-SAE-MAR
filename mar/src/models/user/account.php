<?php

class Account{

    public function modifyAccount(){
        $db = Database::getInstance();
        if (!is_null($_POST['changepass']) && $_POST['changepass'] == $_POST['confpass']){
            $query = "UPDATE users SET user_pass=? where user_id = ?;";
            $args = array(password_hash($_POST['changepass'],PASSWORD_BCRYPT), $_COOKIE['user_id']);
            $db->executedQuery($query, $args);        
        }

        $query = "UPDATE users SET user_pseudo= ?, user_email= ? where user_id = ?;";
        $args = array($_POST['pseudo'],$_POST['email'],$_COOKIE['user_id']);

        $db->executedQuery($query, $args);
            
    }

    public function getAccountInfo(){
        $db = Database::getInstance();
        $temp = null;
        if (isset($_COOKIE['user_id'])) {
            $query = "SELECT user_pseudo,user_email FROM users WHERE user_id = ?;";
            $args = array($_COOKIE['user_id']);
            
            $temp = $db->executedSelectArrayQuery($query, $args);
        }
        return $temp;
    }
    
}