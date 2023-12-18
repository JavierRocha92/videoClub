<?php

//Functions about cookies and session*********************************************
//********************************************************************************
/**
 * function to storage user values into session variable
 * 
 * @param array $values
 */
function setSessionVar($values) {
    $_SESSION['rol'] = $values['rol'];
    $_SESSION['username'] = $values['username'];
    $id = $values['id'];
    $_SESSION['id'] = $id;
}

//Final about cookies and sessions************************************************
//********************************************************************************
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
        <input type="hidden" name="object" value="<?= base64_encode((serialize($object))) ?>">
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

function handleDeleteAction($postValues, $object, $bd, $response, $option, $table) {
    //Conditional to check if response variable is set
    if (isAfrimativeResponse($response)) {
        $sql = $bd->getDeleteQuery($table, array('id'));
        //Create a conecction to database
        $bd->connection();
        $bd->makeStatement($bd->getConnection(), $sql, array($object->getId()));
        //Close DB connection
        $bd->disconnect();
    } else {
        //Calling require document to confirm modification
        require '../lib/files/confirmationOptionForm.php';
    }
}

function handleUpdateAction($actionUser, $object, $option, $table) {
    //Calling file to show update form for any film
    require '../lib/files/updatingForm.php';
}

function handleInsertAction($actionUser, $option, $objectIds, $table) {
    //Calling file to show insert form for any film
    require '../lib/files/insertingForm.php';
}

function handleConfirmAction($postValues, $actionUser, $response, $object, $option, $bd, $table) {
//    var_dump($object);
//    exit;
    if (isset($response)) {
        if ($response === 'yes') {
            $object_attributes = getObjectsAttributes($_SESSION['objectOnAction'], $table);
//            DENTRO DE ESTE CONDICIONAL SE DEBE IMPLENTAR UN METODO QUE NOS EXTRAIGA DEL ARRYA POST SOLO LOS VALORES NECESARIOS QUE OCINCIDAN CON EL OBJETO  PARA HACER LA CONULTA
            //Conditional to check id session ooption variable is for updating
            if ($actionUser == 'update') {
                //Create update statement by calling function
                $sql = $bd->getUpdateQuery($object_attributes, $table, array('id'));
                //Set keywords values
                $keyWords = array($object->getId());
            }
            if ($actionUser == 'insert') {
                //Create insert statement by calling function
                $sql = $bd->getInsertQuery($object_attributes, $table);
                //Set keywords values
                $keyWords = null;
            }
//            echo 'esta es la consulta<br>';
//            echo $sql.'<br>';
//            echo 'este es el id <br>';
//            echo $id.'<br>';
//            exit;
            //Create a conecction to database
            $bd->connection();
            //Make statement by cllign this function
            $bd->makeStatement($bd->getConnection(), $sql, $keyWords);
            //Close DB connection
            $bd->disconnect();
        } else {//Conditinal when response is not yes, is not
            header('Location: ./films.php');
        }
    } else {//Condtional when reposne does not exist
        //Stprage into seesion variable values from updating form
        $_SESSION['objectOnAction'] = $postValues;
        //Calling require document to confirm modification
        require '../lib/files/confirmationOptionForm.php';
    }
}

function isAfrimativeResponse($response) {
    if (isset($response) && $response === 'yes') {
        return true;
    } else {
        return false;
    }
}

function getArrayByObject($table, $object) {
    switch ($table) {
        case 'peliculas':
            return array(
                'id' => $object->getId(),
                'titulo' => $object->getTitulo(),
                'genero' => $object->getGenero(),
                'pais' => $object->getPais(),
                'anyo' => $object->getAnyo(),
                'cartel' => $object->getCartel(),
                'actores' => $object->getActores()
            );
        case 'usuarios':
            return array(
                'id' => $object->getId(),
                'username' => $object->getUsername(),
                'password' => $object->getPassword(),
                'rol' => $object->getRol(),
            );
    }
}

function getPathByTable($table) {
    switch ($table) {
        case 'peliculas':
            return './films.php';
        case 'usuarios':
            return './users.php';
    }
}

function getObjectsAttributes($object, $table) {
    switch ($table) {
        case 'peliculas':
            return array('id' => $object['id'],
                'titulo' => $object['titulo'],
                'genero' => $object['genero'],
                'pais' => $object['pais'],
                'anyo' => $object['anyo'],
                'cartel' => $object['cartel']);
        case 'actores':
            return array('id' => $object['id'],
                'nombre' => $object['nombre'],
                'apellidos' => $object['apellidos'],
                'fotografia' => $object['fotografia']);
        case 'usuarios':
            return array('id' => $object['id'],
                'username' => $object['username'],
                'password' => $object['password'],
                'rol' => $object['rol']);
    }
}

//Final about user action management*******************************************************************************************************************************
//*****************************************************************************************************************************************************************
//Function about checking into databse*****************************************************************************************************************************
//*****************************************************************************************************************************************************************

/**
 * function to check if a user with id given as parameter is in databse
 * 
 * @param DaaBase $bd Dtabase class instance
 * @param string $id key value for user who will be serached in database
 * @return PDO 
 */
function idUserExists($bd, $username) {
    //Create a databse connection 
    $bd->connection();
    //Create a select statement
    $sql = $bd->getSelectQuery(array('*'), 'usuarios', array('username'));
//    echo $sql;
//    exit;
    //get result form  statement
    $result = $bd->makeStatement($bd->getConnection(), $sql, array($username));
    $bd->disconnect();
    return $result;
}

//Final about checking into databse********************************************************************************************************************************
//*****************************************************************************************************************************************************************