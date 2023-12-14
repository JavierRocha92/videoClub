<?php

class DataBase {

    private $user;
    private $password;
    private $database;
    private $servername;

    public function __construct($user, $password, $database, $servername) {
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->servername = $servername;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getServername() {
        return $this->servername;
    }

    public function setUser($user): void {
        $this->user = $user;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setDatabase($database): void {
        $this->database = $database;
    }

    public function setServername($servername): void {
        $this->servername = $servername;
    }

    public function connect() {
        try {
            // Create a conexion by using PDo object
            $connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->user, $this->password);
        } catch (PDOException) {
            echo displayError('la aplicación esta en labores de mantenimiento');
        }
    }

    public function getSelectQuery($values, $table, $keyWords = false) {
        $sql = 'SELECT ';
        foreach ($values as $value) {//For each to bulid fileds 
            $sql .= $value . ', ';
        }
        //calling function to remove the last two character from a string
        $sql = removeCharacter($sql, -2);
        $sql .= " FROM $table";
        //Conditinal to check if $keywords exists
        if ($keyWords) {
            $sql .= " WHERE ";
            foreach ($keyWords as $value) {//For each to build keyWords
                $sql .= "$value = ? and ";
            }
            //calling function to remove the last two character from a string
            $sql = removeCharacter($sql, -5);
        }
        $sql .= ";";
        return $sql;
    }

    public function makeStatement($bd, $sql, $keyValues = null) {
        try {
            $result = $bd->prepare($sql);
            if (isset($keyValues)) {
                $result->execute($keyValues);
            } else {
                $result->execute();
            }
            if ($result->rowCount() > 0) {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (Exception $ex) {
            displayError('La página esta en mantenimiento, disculpen las molestias');
            return false;
        }
    }

    public function disconect() {
        
    }
}
