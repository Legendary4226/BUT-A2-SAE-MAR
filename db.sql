CREATE DATABASE IF NOT EXISTS todolist;

USE todolist;


CREATE TABLE IF NOT EXISTS users
(
    id_user INTEGER PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR,
    pseudo VARCHAR(25),
    pass VARCHAR
);

CREATE TABLE IF NOT EXISTS space
(
    space_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR,
    owner VARCHAR
);

CREATE TABLE IF NOT EXISTS box
(
    box_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    space_id INTEGER,
    name VARCHAR,
    owner VARCHAR,
    FOREIGN KEY (space_id) REFERENCES space(space_id)
);

CREATE TABLE IF NOT EXISTS element
(
    element_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    content VARCHAR,
    box_id INTEGER,
    element_type VARCHAR,
    FOREIGN KEY (box_id) REFERENCES box(box_id)
);

CREATE TABLE IF NOT EXISTS label 
(
    label_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR
);

CREATE TABLE IF NOT EXISTS CheckBox
(
    state_checkbox BOOLEAN
);

CREATE TABLE IF NOT EXISTS TextBox
(
    content TEXT
);

/*
*   Commandes pour intéragir avec la bdd
*/

/* Vérifier qu'un utilisateur n'est pas dans la bdd */
SELECT count(*) FROM users WHERE email = ?;

/* Rentrer les informations de l'utilisateur dans la bdd */
INSERT INTO users (email,pseudo,pass) VALUES (?,?,?);

/* Changer le mot de passe de l'utilisateur */
UPDATE users SET pass=? WHERE email = ?;

/* Changer le mot de passe de l'utilisateur */
UPDATE users SET pseudo=? WHERE email = ?;

/* Ajouter un espace */
INSERT INTO space ('name',space_id,'owner') VALUES ('nouvel space',?,?)

/* Changer nom de l'espace */
UPDATE space SET 'name' = ? WHERE email = ?;

/* Ajouter boite */
INSERT INTO box (space_id,'owner') VALUES (?,?)

/* Changer le titre de la box */
UPDATE box SET 'name'=? WHERE box_id = ?;

/* Ajouter element */
INSERT INTO element (box_id,element_type) VALUES (?,?);