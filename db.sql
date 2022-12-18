CREATE DATABASE IF NOT EXISTS todolist;

USE todolist;


CREATE TABLE IF NOT EXISTS users
(
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(50) UNIQUE NOT NULL,
    user_name VARCHAR(25) NOT NULL,
    user_pass VARCHAR(65) NOT NULL
);

CREATE TABLE IF NOT EXISTS space
(
    space_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    space_name VARCHAR(35) NOT NULL,
    space_owner INTEGER NOT NULL,

    FOREIGN KEY (space_owner) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS space_sharing
(
    share_user_id INTEGER NOT NULL,
    share_space_id INTEGER NOT NULL,
    share_permission INTEGER NOT NULL,

    PRIMARY KEY (share_user_id, share_space_id),
    FOREIGN KEY (share_user_id) REFERENCES users(user_id),
    FOREIGN KEY (share_space_id) REFERENCES space(space_id)
);

CREATE TABLE IF NOT EXISTS box
(
    box_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    box_space INTEGER NOT NULL,
    box_name VARCHAR(20) NOT NULL,

    FOREIGN KEY (box_space) REFERENCES space(space_id),
);

CREATE TABLE IF NOT EXISTS element
(
    element_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    element_content MEDIUMTEXT,
    element_box INTEGER NOT NULL,
    element_type VARCHAR(10),

    FOREIGN KEY (element_box) REFERENCES box(box_id)
);

CREATE TABLE IF NOT EXISTS label 
(
    label_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    label_name VARCHAR(25) NOT NULL
);

CREATE TABLE IF NOT EXISTS label_using
(
    user_id INTEGER NOT NULL,
    label_id INTEGER NOT NULL,

    PRIMARY KEY(user_id,label_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id),
    FOREIGN KEY (label_id) REFERENCES label(label_id)
)

/*
*   Optimisations (à déterminer en fonction des requêtes)
*/

-- CREATE INDEX...


/*
*   Commandes pour intéragir avec la db
*/

-- Vérifier qu'un utilisateur n'est pas dans la bdd
SELECT count(*) FROM users WHERE email = ?;

-- Rentrer les informations de l'utilisateur dans la bdd
INSERT INTO users (user_email,user_name,user_pass) VALUES (?,?,?);

-- Changer le mot de passe de l'utilisateur
UPDATE users SET user_pass=? WHERE id = ?;

-- Changer le mot pseudo de l'utilisateur
UPDATE users SET user_name=? WHERE id = ?;

-- Changer infos utilisateur
UPDATE users SET user_pass=?, user_name=?, user_pass=? where id = ?;

-- Ajouter un espace
INSERT INTO space ('name',space_id,'owner') VALUES ('nouvel space',?,?)

-- Changer nom de l'espace
UPDATE space SET 'name' = ? WHERE id = ?;

-- Ajouter boite
INSERT INTO box (space_id,'owner') VALUES (?,?)

-- Changer le titre de la box
UPDATE box SET 'name'=? WHERE box_id = ?;

-- Ajouter element
INSERT INTO element (box_id,element_type) VALUES (?,?);


/*
* Database cleanup
*/

-- Erase tables content

TRUNCATE TABLE IF EXISTS label;
TRUNCATE TABLE IF EXISTS element;
TRUNCATE TABLE IF EXISTS box;
TRUNCATE TABLE IF EXISTS space;
TRUNCATE TABLE IF EXISTS users;

-- Delete database

DROP DATABASE IF EXISTS todolist;

-- Delete database tables

DROP TABLE IF EXISTS label;
DROP TABLE IF EXISTS element;
DROP TABLE IF EXISTS box;
DROP TABLE IF EXISTS space;
DROP TABLE IF EXISTS users;
