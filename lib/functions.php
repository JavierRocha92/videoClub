<?php

//Functions about cookies and session*********************************************
//********************************************************************************
/**
 * function to storage user values into session variable
 * 
 * @param array $values
 */
//function setSessionVar($values) {
//    $_SESSION['rol'] = $values['rol'];
//    $_SESSION['username'] = $values['username'];
//    $id = $values['id'];
//    $_SESSION['id'] = $id;
//}
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
    <p class='error text-center'><?= $content ?></p>
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
    if ($value == 'fotografia' || $value == 'genero' || $value == 'titulo' || $value == 'cartel' || $value == 'password') {
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

function getPattern($value) {
    if ($value == 'id' || $value == 'anyo') {
        return '[0-9]{1,11}';
    }
    if ($value == 'rol') {
        return '[0-9]{1,4}';
    }
}

/**
 * Functionto create infput html element b taking values given as parameters
 * 
 * @param string $type
 * @param string $name
 * @param string $value
 * @param string $class
 * @param string $placeholder
 * @param number $maxLenght
 */
function createInput($type, $name, $value, $class, $placeholder, $maxLenght, $pattern) {
    ?>
    <input class="<?= $class ?>" type="<?= $type ?>" name='<?= $name ?>' value='<?= $value ?>' required
           placeholder='<?= $placeholder ?>' 
           maxlength="<?= $maxLenght ?>" 
           <?php
           if ($pattern != '') {
               ?>
               pattern="<?= $pattern ?>"
               <?php
           }
           ?>
           >
    <?php
}

//Functions about action user management********************************************************************************************************************************
//*********************************************************************************************************************************************************************
/**
 * Function to handle delete user action by calling other function and requires such us cinfirmationOption for confirma action to make
 * 
 * @param array $postValues values  from post
 * @param Pelicula/Actor $object Pleicula or Actor object
 * @param Database $bd Database object
 * @param string $response response from user about to make action or not
 * @param string $option option user was taken about modify database elemnet (delete,update,insert or confirm)
 * @param string $table reference table to make statement
 */
function handleDeleteAction($postValues, $object, $bd, $response, $option, $table) {
    //Conditional to check if response variable is set
    if (isAfrimativeResponse($response)) {
        $sql = $bd->getDeleteQuery($table, array('id'));
        //Create a conecction to database
        $bd->connection();
        $bd->makeStatement($bd->getConnection(), $sql, array($object->getId()));
        //Close DB connection
        $bd->disconnect();
        //callign Function to write information into log file
            writeInformation('delete', $object->getId(), substr($table, 0, -1));
    } else {
        //Calling require document to confirm modification
        require '../lib/files/confirmationOptionForm.php';
    }
}

/**
 * Function to handle update user action by calling other functions and requires such us updatingForm to type new values for a object
 * 
 * @param type $actionUser storage action user for callign the next function handleConfirmAction() to get the difference between update, insert or delete
 * @param Pelicula/Actor $object Pleicula or Actor object
 * @param string $option option user was taken about modify database elemnet (delete,update,insert or confirm)
 * @param string $table reference table to make statement
 */
function handleUpdateAction($actionUser, $object, $option, $table) {
    //Calling file to show update form for any film
    require '../lib/files/updatingForm.php';
}

/**
 * Function to handle insert user actio by callign other function and requires such us insertingForm.php for insert values for a new ibject to insert into database
 * 
 * @param type $actionUser storage action user for callign the next function handleConfirmAction() to get the difference between update, insert or delete
 * @param string $option option user was taken about modify database elemnet (delete,update,insert or confirm)
 * @param array $objectIds contains id for a Pelicula or Actor object to use them as palceholder to build a insetion form
 * @param string $table reference table to make statement
 */
function handleInsertAction($actionUser, $option, $objectIds, $table) {
    //Calling file to show insert form for any film
    require '../lib/files/insertingForm.php';
}

/**
 * Function to handle confirmation action from user from cofirmationForm.php
 * @param array $postValues values  from post
 * @param type $actionUser storage action user for callign the next function handleConfirmAction() to get the difference between update, insert or delete
 * @param string $response response from user about to make action or not
 * @param Pelicula/Actor $object Pleicula or Actor object
 * @param string $option option user was taken about modify database element (delete,update,insert or confirm)
 * @param Database $bd Database object
 * @param string $table reference table to make statement
 */
function handleConfirmAction($postValues, $actionUser, $response, $object, $option, $bd, $table) {
    if (isset($response)) {
        if ($response === 'yes') {
            $object_attributes = getObjectsAttributes($_SESSION['objectOnAction'], $table);
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
            //Create a conecction to database
            $bd->connection();
            //Make statement by cllign this function
            $bd->makeStatement($bd->getConnection(), $sql, $keyWords);
            //Close DB connection
            $bd->disconnect();
            //callign Function to write information into log file
            writeInformation($actionUser, $object_attributes['id'], substr($table, 0,-1));
        } else {//Conditinal when response is not yes, is not
            header('Location: ./films.php');
        }
    } else {//Condtional when reposne does not exist
        //Storage into seesion variable values from updating form
        $_SESSION['objectOnAction'] = $postValues;
        //Calling require document to confirm modification
        require '../lib/files/confirmationOptionForm.php';
    }
}

/**
 * Function to detrminate if a variable given as parameter exists and contains 'yes' value  into t
 * 
 * @param string $response
 * @return bool true if response var exists and it is true or false it is not
 */
function isAfrimativeResponse($response) {
    if (isset($response) && $response === 'yes') {
        return true;
    } else {
        return false;
    }
}

/**
 * Function to rreturn an object become to asociative array depending of table parameter evaluation 
 * 
 * @param string $table reference table
 * @param Pelicula/Actor $object 
 * @return array asciative values from a object given as parameter
 */
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

/**
 * Function to return a specific file patha depending of table var evaluation
 * 
 * @param string $table
 * @return string path for a specific file 
 */
function getPathByTable($table) {
    switch ($table) {
        case 'peliculas':
            return './films.php';
        case 'usuarios':
            return './users.php';
    }
}

/**
 * Function to get an array with id and values as Pelicula or Actor object by taking values from post array given as parameter
 * 
 * @param array $object
 * @param string $table
 * @return array asociative array with values and id like Pleicula or Actor object
 */
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
    //get result form  statement
    $result = $bd->makeStatement($bd->getConnection(), $sql, array($username));
    $bd->disconnect();
    return $result;
}

//Final about checking into databse********************************************************************************************************************************
//*****************************************************************************************************************************************************************

function writeInformation($action, $elementId, $element) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/VideoClub_app/lib/model/File.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/VideoClub_app/lib/files/allowManagement.php';
    $currentTime = date("d-m-Y H:i:s");
    $content = "\n$username;$action;$currentTime;$rol;$element;$elementId";
//    echo $content;
//    exit;
    //Create customIFle object
    $file = new CustomFile($_SERVER['DOCUMENT_ROOT'] . '/VideoClub_app/lib/logs/logFile.csv');
    //calling function to write information
    $file->writeFile($content, 'a');
}
