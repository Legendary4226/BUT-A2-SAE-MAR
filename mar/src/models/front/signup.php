<?php

class SignUp {
    /**
     * Creates an account if all given informations are correct.
     * @param string $email The new user's email
     * @param string $username The new user's username
     * @param string $pass The new user's password
     * @param string $confpass The password confirmation
     */
    public function createAccount(string $email, string $username, string $pass, string $confpass) {
        $db = Database::getInstance();


        $isEmailNotInDatabase = $db->executeQuery(
            "SELECT user_id FROM users WHERE user_email = ?",
            array($email)
        )->rowCount() == 0;

        if ($isEmailNotInDatabase) {

            $validPseudo = strlen($username) <= 25;
            if ($validPseudo) {

                $validPass = $pass == $confpass && strlen($pass) >= 8;
                if ($validPass) {

                    $accountCreation = $db->executeQuery(
                        "INSERT INTO users(user_email, user_pseudo, user_pass) VALUES(?, ?, ?)",
                        array(
                            htmlspecialchars($email),
                            htmlspecialchars($username),
                            password_hash($pass, PASSWORD_BCRYPT)
                        )
                    );
                    $creationSuccess = $accountCreation->rowCount() == 1;

                    if ($creationSuccess) {
                        // REDIRECT LATER TO BOX PAGE
                        //header('Location: ' . LINK_BOX);
                    } else {
                        echo 'La création du compte a échouée.';
                    }

                } else {
                    echo 'Mot de passes différents ou de moins de 8 caractères.';
                }

            } else {
                echo 'Username with more than 25 characters.';
            }
            

        } else {
            echo "Email déjà enregistré.";
        }
    }
}