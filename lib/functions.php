<?php

/**
 * funtion to connect to data base
 * 
 * @param string $cadena
 * @param strig $user
 * @param string $password
 * @return \PDO
 */
function connectionBBDD($cadena, $user = 0, $password = 0) {
    try {
        $bd = new PDO($cadena, $user, $password);
        return $bd;
    } catch (Exception $ex) {
        displayError('La apicación esta en labores de mantenimiento');
        exit;
    }
}

function getSelectQuery($values, $table, $keyWords) {
    $sql = 'SELECT ';
    foreach ($values as $value) {//For each to bulid fileds 
        $sql .= $value . ', ';
    }
    //calling function to remove the last two character from a string
    $sql = removeCharacter($sql, -2);
    $sql .= " FROM $table WHERE ";
    foreach ($keyWords as $value) {//For each to build keyWords
        $sql .= "$value = ? and ";
    }
    //calling function to remove the last two character from a string
    $sql = removeCharacter($sql, -5);
    $sql .= ";";
    echo $sql;
    return $sql;
}

function makeStatement($bd, $sql, $keyValues) {
    try {
        $result = $bd->prepare($sql);
        $result->execute($keyValues);
        if($result->rowCount() > 0){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    } catch (Exception $ex) {
        displayError('La página esta en mantenimiento, disculpen las molestias');
        return false;
    }
}

//Funtions about text process*****************************************************

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

function getSessionCookieName($session_id,$id){
    return hash('sha256',$session_id.$id);
}