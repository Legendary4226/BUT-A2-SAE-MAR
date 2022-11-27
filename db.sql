CREATE DATABASE IF NOT EXISTS todolist;

USE todolist;


CREATE TABLE IF NOT EXISTS users
(
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(50) NOT NULL,
    user_pseudo VARCHAR(25) NOT NULL,
    user_pass VARCHAR(65) NOT NULL
);

CREATE TABLE IF NOT EXISTS space
(
    space_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    space_name VARCHAR(20) NOT NULL,
    space_owner INTEGER NOT NULL,

    FOREIGN KEY (space_owner) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS box
(
    box_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    box_space INTEGER NOT NULL,
    box_name VARCHAR(20) NOT NULL,
    box_owner INTEGER,

    FOREIGN KEY (box_space) REFERENCES space(space_id)
    FOREIGN KEY (box_owner) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS element
(
    element_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    content VARCHAR(500),
    box_id INTEGER,
    element_type VARCHAR(10),

    FOREIGN KEY (box_id) REFERENCES box(box_id)
);

CREATE TABLE IF NOT EXISTS label 
(
    label_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20)
);

/*
*   Commandes pour intéragir avec la db
*/

-- Vérifier qu'un utilisateur n'est pas dans la bdd
SELECT count(*) FROM users WHERE email = ?;

-- Rentrer les informations de l'utilisateur dans la bdd
INSERT INTO users (email,pseudo,pass) VALUES (?,?,?);

-- Changer le mot de passe de l'utilisateur
UPDATE users SET pass=? WHERE email = ?;

-- Changer le mot de passe de l'utilisateur
UPDATE users SET pseudo=? WHERE email = ?;

-- Ajouter un espace
INSERT INTO space ('name',space_id,'owner') VALUES ('nouvel space',?,?)

-- Changer nom de l'espace
UPDATE space SET 'name' = ? WHERE email = ?;

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
