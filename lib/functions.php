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

function getSessionCookieName($session_id, $id) {
    return hash('sha256', ($session_id . $id));
}

//Funtions about create elements

function createButtonsFilm($id) {
    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="card__buttons d-flex justify-content-around p-2 w-50">
        <button class="btn bg-primary text-light" name="delete" value="<?= $id ?>">Eliminar</button>
        <button class="btn bg-primary text-light" name="update" value="<?= $id ?>">Modificar</button>
    </form>
    <?php
}
