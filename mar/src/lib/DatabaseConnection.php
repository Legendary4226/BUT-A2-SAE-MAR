<?php

class Database {

    private static $_instance = null;

    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new DatabaseConnexion();  
        }

        return self::$_instance;
    }

    public static function release(){
        self::$_instance = null;
    }
}

class DatabaseConnexion{

    private static $_PDO;

    function __construct(){
        self::$_PDO = new PDO('mysql:host='. BD_HOST .';dbname='. BD_DBNAME .';charset=utf8', BD_USER , BD_PWD );
        self::$_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function preparedQuery(string $query, array $options = []){
        $stat = self::$_PDO->prepare($query);
        return $stat;
    }

    public function executedQuery(string $query, array $options = []){
        $stat = self::preparedQuery($query, $options);
        $stat -> execute($options);
        return $stat;
    }
    
    public function executedArrayQuery(string $query, array $options = []){
        $stat = self::preparedQuery($query, $options);
        return $stat->fetchAll();
    }

    public function executedBooleanQuery(string $query, array $options = []){
        $stat = self::preparedQuery($query, $options);
        return $stat->execute($options);;
    }
}