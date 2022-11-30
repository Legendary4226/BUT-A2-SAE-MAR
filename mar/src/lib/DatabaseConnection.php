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

    public function preparedQuery(string $query){
        $stat = self::$_PDO->prepare($query);
        return $stat;
    }

    public function executedQuery(string $query, array $options = []){
        $stat = self::preparedQuery($query);
        $stat->execute($options);
        return $stat;
    }

    public function executedSelectArrayQuery(string $query, array $options = []){
        $stat = self::preparedQuery($query);
        $stat ->execute($options);
        return $stat->fetch();
    }

    //inutilisé
    public function executedBooleanQuery(string $query, array $options = []){
        $stat = self::preparedQuery($query);
        return $stat->execute($options);;
    }

    public function booleanSelectQuery(string $query, array $options = []){
        if (sizeof(self::executedSelectArrayQuery($query, $options)) == 0){
            return true;
        }
        return false;
    }
}