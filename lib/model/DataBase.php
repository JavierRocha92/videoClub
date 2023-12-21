<?php
/**
 * Class to represent a database object with only connection parameter
 */
class Database {

    /**
     * 
     * @var PDO oject to generate a database conecction
     */
    private $connection;
    
    /**
     * Function to construct a database object
     */
    public function __construct() {
        
    }
    /**
     * Fucntion to get connection from a database
     * 
     * @return PDO connection from a database
     */
    public function getConnection() {
        return $this->connection;
    }
    /**
     * Function to set connection value passed as parameters for any database
     * 
     * @param PDO $connection
     * @return PDO database from actor 
     */
    public function setConnection($connection): void {
        $this->connection = $connection;
    }
    /**
     * Funtion to set a PDO object as connection for any database by using the same string connection
     */
    public function connection() {
        try {
            $this->connection = new PDO('mysql:dbname=videoclub;host=127.0.0.1', 'root', '');
            // Catch to control any conecction error
        } catch (PDOException $e) {
            displayError('La aplicaciónn esta en labores de matenimiento');
        }
    }
    /**
     * Funtion to set null value to connection database parameter
     */
    public function disconnect() {
        $this->connection = null;
    }

    /**
     * Funtion to create a insert query builded by taking values given as parameter
     * 
     * @param Array $values contians values to bluid a insert query
     * @param string $table table to reference
     * @return string sql sintax insert
     */
    public function getInsertQuery($values, $table) {
        //Slice the last value 
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
        return $sql;
    }
    /**
     * Funtion to create a select query builded by taking values given as parameter
     * 
     * @param Array $values contians values to bluid a select query
     * @param string $table table to reference
     * @param Array $keyWords contains values to construct conditionals for searching 
     * @return string sql sintax select
     */
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
    /**
     * Function to make a statement on database by taking different values given as parameter
     * 
     * @param PDO $bd PDO object
     * @param string $sql sintax sql statement string
     * @param Array $keyValues contains key values to build prepare statement
     * @return PDO/bool PDO object if result has value or false it does not
     */
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
    /**
     * Funtion to create a update query builded by taking values given as parameter
     * 
     * @param Array $values contians values to bluid a update query
     * @param string $table table to reference
     * @param Array $keyWords contains values to construct conditionals for seraching specific items 
     * @return string sql sintax update
     */
    public function getUpdateQuery($values, $table, $keyWords) {
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
    /**
     * Funtion to create a delete query builded by taking values given as parameter
     * 
     * @param string $table table to reference
     * @param Array $keyWords contains values to construct conditionals for seraching specific items 
     * @return string sql sintax delete
     */
    public function getDeleteQuery($table, $keyWords = false) {
        $sql = "DELETE FROM $table WHERE ";
        foreach ($keyWords as $keyWord) {
            $sql .= "$keyWord = ?, ";
        }
        $sql = removeCharacter($sql, -2);
        $sql .= ";";
        return $sql;
    }
    /**
     * Function to join tow string as query and subquery to create a sql sintax subquery
     * 
     * @param string $sql father query
     * @param string $subsql nest query or subquery
     * @return  string sql sintax subquery
     */
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
