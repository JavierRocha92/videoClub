<?php

//Conditional to check if user pushed any button to modifiy any film
if (isset($_POST['option']) || isset($_POST['response'])) {
    //Filter and storage post values
    $postValues = filter_input_array(INPUT_POST);
    //Variable to detect if a update is active at that moment
    $updateingActive = false;
    //storage filtered variables from post
    $option = htmlspecialchars($_POST['option']);
    $response = isset($postValues['response']) ? $postValues['response'] : null;
    $object = unserialize(base64_decode(($postValues['film'])));
    //Coditional to heck value from button user was pressed
    switch ($option) {
        case 'delete':
            //Conditional to check if response variable is set
            if (isset($response)) {
                //Conditional to check if response is yes
                if ($response == 'yes') {
                    $sql = getDeleteQuery('peliculas', array('id'));
                    makeStatement($bd, $sql, array($object->getId()));
                }
            } else {
                //Calling require document to confirm modification
                require '../lib/files/confirmationOptionForm.php';
            }
            break;
        case 'update':
            //Calling file to show update form for any film
            require '../lib/files/updatingForm.php';
            exit;
            break;
        case 'insert':
            //LLamar a una funcion para insertar la pelicula del formularioi que le tenemos que mandar cuando pulse esta opcion
            break;
        case 'confirm':
            if (isset($response)) {
                //Conditional to check if response is yes
                if ($response == 'yes') {
//                    echo 'esto es lo que vale post values <br>';
//                    var_dump($_SESSION['filmUpdating']);
//                    exit;
                    $sql = getUpdateQuery($_SESSION['filmUpdating'], 'peliculas', array('id'));
                    echo 'este es el id de la pelicula <br>';
                    echo $object->getId();
                    //TENEMOS QUE MIRAR POQUE NO MODIFICA TODAS LAS PELICULAS ASIQUE HAY QUE MIRAR EL ID DE LA CONDICION
                    exit;
                    makeStatement($bd, $sql, array($object->getId()));
                }
            } else {
                //Stprage into seesion variable values from updating form
                $_SESSION['filmUpdating'] = $postValues;
                //Calling require document to confirm modification
                require '../lib/files/confirmationOptionForm.php';
                exit;
            }
            break;
    }
}
