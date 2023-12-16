<?php

require '../functions.php';
require '../model/DataBase.php';
//Create database object
$bd = new Database();
//Calling function to verify post massage exist and filter it
if (isset($_POST)) {
    $postValues = filter_input_array(INPUT_POST);
    //Calling function to check if user exist in databse based on its id
    if (idUserExists($bd, $postValues['username'])) {
        echo 'esta es la password<br>';
        echo $postValues['password'] . '<br>';
        echo 'esta es el haseho<br>';
        echo hash('sha256', $postValues['password']) . '<br>';
        echo 'este es el id<br>';
        echo $postValues['username'] . '<br>';
        //Creating user values array to make statement
        $userValues = array('username', 'id', 'rol');
        //Calling function to create a new selec statemenet looking for matching user and password
        $sql = $bd->getSelectQuery($userValues, 'usuarios', array('username', 'password'));
        echo 'esta es la consulta<br>';
        echo $sql;
//        exit;
        //Create a databse connection
        $bd->connection();
        //Caling function to make a statement
        $result = $bd->makeStatement($bd->getConnection(), $sql, array($postValues['username'], hash('sha256', $postValues['password'])));
        echo 'este es el resultado<br>';
        echo 'entro en el if<br>';
        var_dump($result);
//        exit;
        //Close connection
        $bd->disconnect();
        //Conditinal to check if result is not false to storage user values in session variable
        if ($result) {
            //Start session an storage necesary values in session variables
            session_start();
            //Callign function to create a session variable and set user values in it
//            setSessionVar($result[0]);
            $_SESSION['rol'] = $result[0]['rol'];
            $_SESSION['username'] = $result[0]['username'];
            $id = $result[0]['id'];
            $_SESSION['id'] = $id;
            //Cookie session creation
            setcookie(getSessionCookieName(session_id(), $id), 'sessionActive', time() + 1 * 600, '/');
            //Redirecting user to private page
            header('Location:../../pages/films.php');
            exit;
        } else {
            header('Location:../../index.php?login&error');
            exit;
        }
    } else {
        header('Location:../../index.php?login&error');
        exit;
    }
}