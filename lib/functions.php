<?php

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

//Functions about action user management********************************************************************************************************************************
//*********************************************************************************************************************************************************************

function handleDeleteAction($postValues, $object, $bd, $response, $option) {
    //Conditional to check if response variable is set
    if (isAfrimativeResponse($response)) {
        $sql = $bd->getDeleteQuery('peliculas', array('id'));
        //Create a conecction to database
        $bd->connection();
        $bd->makeStatement($bd->getConnection(), $sql, array($object->getId()));
        //Close DB connection
        $bd->disconnect();
    } else {
        //Calling require document to confirm modification
        require '../lib/files/confirmationOptionForm.php';
        exit;
    }
}

function handleUpdateAction($actionUser, $object, $option) {
    //Calling file to show update form for any film
    require '../lib/files/updatingForm.php';
    exit;
}

function handleInsertAction($actionUser, $option) {
    //Calling file to show insert form for any film
    require '../lib/files/insertingForm.php';
    exit;
}

function handleConfirmAction($postValues, $actionUser, $response, $object, $option, $bd) {
    if (isAfrimativeResponse($response)) {
        //Conditional to check id session ooption variable is for updating
        if ($actionUser == 'update') {
            //Create update statement by calling function
            $sql = $bd->getUpdateQuery($_SESSION['filmOnAction'], 'peliculas', array('id'));
            //Set keywords values
            $keyWords = array($object->getId());
        }
        if ($actionUser == 'insert') {
            //Create insert statement by calling function
            $sql = $bd->getInsertQuery($_SESSION['filmOnAction'], 'peliculas');
            //Set keywords values
            $keyWords = null;
        }
        //Create a conecction to database
        $bd->connection();
        //Make statement by cllign this function
        $bd->makeStatement($bd->getConnection(), $sql, $keyWords);
        //Close DB connection
        $bd->disconnect();
    } else {
        //Stprage into seesion variable values from updating form
        $_SESSION['filmOnAction'] = $postValues;
        //Calling require document to confirm modification
        require '../lib/files/confirmationOptionForm.php';
        exit;
    }
}

function isAfrimativeResponse($response) {
    if (isset($response) && $response === 'yes') {
        return true;
    } else {
        return false;
    }
}

//Final about user action management*******************************************************************************************************************************
//*****************************************************************************************************************************************************************