<?php

/**
 * Singleton for the Database containing the PDO instance.
 * @see DatabaseConnection
 */
class Database {
    private static $_instance = null;

    /**
     * Get the DatabaseConnection object.
     * @return DatabaseConnection
     */
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new DatabaseConnection();  
        }

        return self::$_instance;
    }

    /**
     * Delete the PDO Instance.
     */
    public static function release(){
        self::$_instance = null;
    }
}


/**
* DatabaseConnection containing the PDO instance and general methods to make queries to the database.
* Do not use this Object, prefer using the Database singleton object.
* @see prepareStatement() Ensure that DatabaseConnection instance is unique.
*/
class DatabaseConnection{
    private $_PDO;

    function __construct(){
        $this->_PDO = new PDO('mysql:host='. BD_HOST . ';port=' . DB_PORT .';dbname='. BD_DBNAME .';charset=utf8mb4', BD_USER , BD_PWD);
        $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Creates a statement.
     * @param string $query The SQL query
     */
    public function prepareStatement(string $query) {
        return $this->_PDO->prepare($query);
    }

    /**
     * Executes a query using a prepared query and return the result.
     * @param string $query The SQL query
     * @param array $args Optionnal - Argument(s) passed to the execute function of the statement.
     * @return PDOStatement|false
     */
    public function executeQuery(string $query, array $args = []) {
        $statement = $this->prepareStatement($query);
        $statement->execute($args);
        return $statement;
    }
}