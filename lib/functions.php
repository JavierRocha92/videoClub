<?php

/**
 * funtion to connect to data base
 * 
 * @param string $cadena
 * @param strig $user
 * @param string $password
 * @return \PDO
 */
function connectionBBDD($cadena, $user = 'root', $password = '') {
    try {
        $bd = new PDO($cadena, $user, $password);
        return $bd;
    } catch (Exception $ex) {
        displayError('La apicación esta en labores de mantenimiento');
        exit;
    }
}

function getInsertQuery($values, $table) {
    //Slice the last value 
    $values = array_slice($values, 0,-1);
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
        if(is_numeric($value))
        $sql .= "$value, ";
        else
        $sql .= "'$value', ";
    }
    //Remove two last characters
    $sql = removeCharacter($sql, -2);
    $sql .= ');';
    return $sql;
}

function getSelectQuery($values, $table, $keyWords = false) {
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

function makeStatement($bd, $sql, $keyValues = null) {
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

function getUpdateQuery($values, $table, $keyWords) {
    $values = array_slice($values, 0, -2);
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

function getDeleteQuery($table, $keyWords = false) {
    $sql = "DELETE FROM $table WHERE ";
    foreach ($keyWords as $keyWord) {
        $sql .= "$keyWord = ?, ";
    }
    $sql = removeCharacter($sql, -2);
    $sql .= ";";
    return $sql;
}

//Funtions about text process*****************************************************
/**
 * function to create a string by removing amount of character indicated on given parameter
 * 
 * @param string $string
 * @param number $number
 * @return string
 */
function removeCharacter($string, $number) {
    return substr($string, 0, $number);
}

//Funtion about errors*************************************************************

/**
 * funtion to show a error put in a p tag a explanation for the error given as parameter
 * 
 * @param string $content
 */
function displayError($content) {
    ?>
    <p class='error'><?= $content ?></p>
    <?php
}

//Functions about cookies
/**
 * function to create a encrypted string based on session_id and is joining
 * 
 * @param string $session_id
 * @param number $id
 * @return string
 */
function getSessionCookieName($session_id, $id) {
    return hash('sha256', ($session_id . $id));
}

//Funtions about create elements
/**
 * function to create a form with two buttons inside
 * 
 * @param number $id
 */
function createButtonsFilm($object) {
    ?>
    <!--button form-->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="card__buttons d-flex justify-content-around p-2 w-50">
        <!--delete button-->
        <button class="card__button card__button--film m-2 p-1" name="option" value="delete">Eliminar</button>
        <!--update button--> 
        <button class="card__button card__button--film m-2 p-1" name="option" value="update">Modificar</button>
        <!--hidden input to send serialize object-->
        <input type="hidden" name="film" value="<?= base64_encode((serialize($object))) ?>">
    </form><!--final button form-->
    <?php
}

/**
 * function to return maxlenght attribute value by checking value input given as parameter
 * 
 * @param string $value name form input
 * @return int vlaue for maxenght attribute for any input
 */
function getMaxLeght($value) {
    if ($value == 'nombre' || $value == 'apellidos') {
        return 100;
    }
    if ($value == 'fotografia' || $value == 'genero' || $value == 'cartel' || $value == 'password') {
        return 255;
    }
    if ($value == 'id' || $value == 'anyo') {
        return 11;
    }
    if ($value == 'genero' || $value == 'pais' || $value == 'username') {
        return 50;
    }
    if ($value == 'rol') {
        return 4;
    }
}

/**
 * function to return type from a input by checking its value given as parameter
 * 
 * @param string $value value froma input
 * @return string type for a input
 */
function getInputType($value) {
    if ($value == 'id' || $value == 'anyo' || $value == 'rol') {
        return 'number';
    } else {
        if ($value == 'password') {
            return 'password';
        } else {
            return 'text';
        }
    }
}

function createInput($type, $name, $value, $class, $placeholder, $maxLenght) {
    ?>
    <input class="<?= $class ?>" type="<?= $type ?>" name='<?= $name ?>' value='<?= $value ?>' required placeholder='<?= $placeholder ?>' maxlength="<?= $maxLenght ?>">
    <?php
}
