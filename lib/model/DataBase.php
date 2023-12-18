<?php

class Database {

    private $connection;

    public function getConnection() {
        return $this->connection;
    }

    public function setConnection($connection): void {
        $this->connection = $connection;
    }

    public function __construct() {
        
    }

    public function connection() {
        try {
            $this->connection = new PDO('mysql:dbname=videoclub;host=127.0.0.1', 'root', '');
            // Catch to control any conecction error
        } catch (PDOException $e) {
            displayError('La aplicaciónn esta en labores de matenimiento');
        }
    }

    public function disconnect() {
        $this->connection = null;
    }

    public function getInsertQuery($values, $table) {
        //Slice the last value 
//        $values = array_slice($values, 0, -1);
        $sql = "INSERT INTO $table (";
        //For each to write fields for any statemente as key
        foreach ($values as $key => $value) {
            $sql .= "$key, ";
        }
        //Remove two last characters
        $sql = removeCharacter($sql, -2);
        $sql .= ') VALUES(';
        //For each to write values
        foreach ($values as $value) {
            if ($value == 'password') {
                $password = hash('sha256', $value);
                $sql .= "'$value', ";
            } else {
                if (is_numeric($value))
                    $sql .= "$value, ";
                if (!is_numeric($value))
                    $sql .= "'$value', ";
            }
        }
        //Remove two last characters
        $sql = removeCharacter($sql, -2);
        $sql .= ');';
        echo $sql;
        exit;
        return $sql;
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
//        echo $sql;
//        exit;
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

    public function getUpdateQuery($values, $table, $keyWords) {
//        $values = array_slice($values, 0, -2);
        $sql = "UPDATE $table SET ";
        //Conditional to check if values variable is an array
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                if (is_numeric($value)) {//Conditional to check if value is numeric
                    $sql .= "$key = $value, ";
                } else {//Contitinal to check if valur is not numeric
                    $sql .= "$key = '$value', ";
                }
            }
        }
        //remove last 2 characters from sql
        $sql = removeCharacter($sql, -2);
        //Conditional to check if values variable is an array
        $sql .= ' WHERE ';
        if (is_array($values)) {
            foreach ($keyWords as $keyWord) {
                $sql .= "$keyWord = ?, ";
            }
        }
        //remove last 2 characters from sql
        $sql = removeCharacter($sql, -2);
        //Adding final statement
        $sql .= ';';
        return $sql;
    }

    public function getDeleteQuery($table, $keyWords = false) {
        $sql = "DELETE FROM $table WHERE ";
        foreach ($keyWords as $keyWord) {
            $sql .= "$keyWord = ?, ";
        }
        $sql = removeCharacter($sql, -2);
        $sql .= ";";
        return $sql;
    }

    public function getSubQuery($sql, $subsql) {
        //Calling function to remove final characters
        $sql = removeCharacter($sql, -1);
        //Add charatcer to sql to link a subquery
        $sql .= " WHERE id in (";
        $sql .= $subsql;
        //Calling function to remove final characters
        $sql = removeCharacter($sql, -1);
        //Adding close brakets to make perfect sintaxis statement
        $sql .= ')';
        return $sql;
    }
}
