-- ###############
-- CREATION SCRIPT
-- ###############

CREATE DATABASE IF NOT EXISTS todolist;

USE todolist;

/*
* Notice : Some VARCHAR have a huge size but the real size allowed to users is way lower.
* That's because PHP apply the htmlspecialchars() function to each user inputs. For example the character "<" is replaced by "&lt;"
* So the datas saved can be larger than the PHP limit. So PHP manage at 100% the constraints on datas and a margin is provided. 
*/

CREATE TABLE IF NOT EXISTS users
(
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(50) UNIQUE NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_pass VARCHAR(65) NOT NULL
);

CREATE TABLE IF NOT EXISTS space
(
    space_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    space_name VARCHAR(140) NOT NULL,
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
    box_name VARCHAR(80) NOT NULL,
    box_elements_order JSON,

    FOREIGN KEY (box_space) REFERENCES space(space_id),
);

CREATE TABLE IF NOT EXISTS element
(
    element_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    element_datas JSON,
    element_box INTEGER NOT NULL,
    element_type VARCHAR(50),

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
*   Optimisations
*/

CREATE INDEX index_space_sharing ON space_sharing(share_user_id, share_space_id);

-- ###################
-- END CREATION SCRIPT
-- ###################




/*
* Database cleanup
*/

-- Reset tables contents

TRUNCATE TABLE IF EXISTS space_sharing;
TRUNCATE TABLE IF EXISTS label;
TRUNCATE TABLE IF EXISTS element;
TRUNCATE TABLE IF EXISTS box;
TRUNCATE TABLE IF EXISTS space;
TRUNCATE TABLE IF EXISTS users;

-- Delete the entire database

DROP DATABASE IF EXISTS todolist;

-- Delete tables

DROP TABLE IF EXISTS space_sharing;
DROP TABLE IF EXISTS label;
DROP TABLE IF EXISTS element;
DROP TABLE IF EXISTS box;
DROP TABLE IF EXISTS space;
DROP TABLE IF EXISTS users;
