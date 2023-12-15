<?php
//Create bd object from DataBase
$bd = new DataBase();
//Conditional to check if user pushed any button to modifiy any film
if (isset($_POST['option']) || isset($_POST['response'])) {
    //Filter and storage post values
    $postValues = filter_input_array(INPUT_POST);
    //Filter session varibel to know if user confirm a insetion or updating
    $actionUser = htmlspecialchars($_SESSION['option']);
    //storage filtered variables from post
    $option = htmlspecialchars($_POST['option']);
    $response = isset($postValues['response']) ? $postValues['response'] : null;
    $object = isset($postValues['film']) ? unserialize(base64_decode(($postValues['film']))) : null;
    //Coditional to heck value from button user was pressed
    switch ($option) {
        case 'delete':
            //Conditional to check if response variable is set
            if (isset($response)) {
                //Conditional to check if response is yes
                if ($response == 'yes') {
                    //Callign function to create a DB connection
                    $connection = $bd->connection();
                    $sql = getDeleteQuery('peliculas', array('id'));
                    makeStatement($connection, $sql, array($object->getId()));
                    //Close DB connection
                    $bd = null;
                }
            } else {
                //Calling require document to confirm modification
                require '../lib/files/confirmationOptionForm.php';
                exit;
            }
            break;
        case 'update':
            //Calling file to show update form for any film
            require '../lib/files/updatingForm.php';
            exit;
            break;
        case 'insert':
            //Calling file to show update form for any film
            require '../lib/files/insertingForm.php';
            exit;
            break;
        case 'confirm':
            if (isset($response)) {
                //Conditional to check if response is yes
                if ($response == 'yes') {
                    //Callign function to create a DB connection
                    $connection = $bd->connection();
                    //Conditional to check id session ooption variable is for updating
                    if ($actionUser == 'update') {
                        //Create update statement by calling function
                        $sql = getUpdateQuery($_SESSION['filmOnAction'], 'peliculas', array('id'));
                        //Set keywords values
                        $keyWords = array($object->getId());
                    }
                    if ($actionUser == 'insert') {
                        //Create insert statement by calling function
                        $sql = getInsertQuery($_SESSION['filmOnAction'], 'peliculas');
                        //Set keywords values
                        $keyWords = null;
                    }

                    //Make statement by cllign this function
                    makeStatement($connection, $sql, $keyWords);
                    //Close DB connection
                    $bd = null;
                }
            } else {
                //Stprage into seesion variable values from updating form
                $_SESSION['filmOnAction'] = $postValues;
                //Calling require document to confirm modification
                require '../lib/files/confirmationOptionForm.php';
                exit;
            }
            break;
    }
}
