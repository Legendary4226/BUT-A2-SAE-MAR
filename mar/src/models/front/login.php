<?php

class Login{

    /**
     * log a user if all given informations are correct.
     * @param string $email The user's email
     * @param string $pass The user's password
     */
    public function connectUser(string $email, string $pass){
        $db = Database::getInstance();

        // The function return value
        $userLogged = false;

        $tryQueryUserDatas = $db->executeQuery(
            "SELECT user_id, user_pass FROM users WHERE user_email = ?",
            array($email)
        );

        $isEmailInDatabase = $tryQueryUserDatas->rowCount() == 1;

        if ($isEmailInDatabase){

            $userDatas = $tryQueryUserDatas->fetch();
            $dbPass = $userDatas['user_pass'];
            $validpass = password_verify($pass, $dbpass);

            if ($validPass){
                setcookie('user_id', $userDatas['user_id']);
                $userLogged = true;
                //header('Location: '. LINK_ACCOUNT);           
            } else {
                echo "Le mot de passe n'est pas valide";
            }

        } else {
            echo "l'email n'est pas dans la base de donnée";
        }

        return $userLogged;
    }
}