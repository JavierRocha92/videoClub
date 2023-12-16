<?php

require '../functions.php';
require '../model/DataBase.php';
//Create database object
$bd = new Database();
//Calling funciton to connect database
$bd->connection();
//Calling function to verify post massage exist and filter it
if (isset($_POST)) {
    $postValues = filter_input_array(INPUT_POST);
    //Calling function to make a select query to verify if user dani exist in our database
    $sql = $bd->getSelectQuery(array('id'), 'usuarios', array('id'));
    //Calling funciton to make a prepare statement and check if return something and storage into variable
    $result = $bd->makeStatement($bd->getConnection(), $sql, array($postValues['id']));
    if ($result) {
        //Calling function to create a new selec statemenet looking for matching user and password
        $sql = $bd->getSelectQuery(array('username', 'rol', 'id'), 'usuarios', array('id', 'password'));
        $result = $bd->makeStatement($bd->getConnection(), $sql, array($postValues['id'], $postValues['password']));
        //Close connection
        $bd->disconnect();
        if ($result) {
            //Start session an storage necesary values in session variables
            session_start();
            $_SESSION['rol'] = $result[0]['rol'];
            $_SESSION['username'] = $result[0]['username'];
            $id = $result[0]['id'];
            $_SESSION['id'] = $id;
            //Cookie session creation
            setcookie(getSessionCookieName(session_id(), $id), 'sessionActive', time() + 1 * 30, '/');
            //Redirecting user to private page
            header('Location: ../../pages/films.php');
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