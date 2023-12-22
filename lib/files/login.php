<?php

//Reqiuires files
require '../functions.php';
require '../model/DataBase.php';
require '../model/File.php';

//Object instances
//Create file object to save info about user actions
$file = new CustomFile('../lib/logs/logFile.csv', 'Username;Action;Date;Rol;Element;Element Id');
//Create database object
$bd = new Database();

//Calling function to verify post massage exist and filter it
if (isset($_POST)) {

    //Filter values and set into postValues variable
    $postValues = filter_input_array(INPUT_POST);

    //Calling function to check if user exist in databse based on its id
    if (isUserExists($bd, $postValues['username'])) {

        //Creating user values array to make statement
        $userValues = array('username', 'id', 'rol');

        //Calling function to create a new selec statemenet looking for matching user and password
        $sql = $bd->getSelectQuery($userValues, 'usuarios', array('username', 'password'));

        //Database interaction**********************************************************************
        //Create a databse connection
        $bd->connection();
        //Caling function to make a statement
        $result = $bd->makeStatement($bd->getConnection(), $sql, array($postValues['username'], hash('sha256', $postValues['password'])));
        //Close connection
        $bd->disconnect();

        //Conditinal to check if result is not false to storage user values in session variable
        if ($result) {

            //Start session an storage necesary values in session variables
            session_start();

            //Set values from result about user into $_SESSION variable********************************
            $_SESSION['rol'] = $result[0]['rol'];
            $_SESSION['username'] = $result[0]['username'];
            $id = $result[0]['id'];
            $_SESSION['id'] = $id;

            //Cookie session creation*******************************************************
            setcookie(getSessionCookieName(session_id(), $id), 'sessionActive', time() + 1 * 600, '/');

            //Write info into log file about star session user******************************
            writeInformation('session start', '-', '-');

            //Redirecting user to private page
            header('Location:../../pages/films.php');
            exit;
            
        } else {//Final result conditional (no match password and user)
        //
            //Reirecto user to index if password does not match to username
            header('Location:../../index.php?login&error');
            exit;
        }
    } else {//Final conditional when user does not exist in database
    //
        //Redirecting user to index if username is not in database
        header('Location:../../index.php?register&error');
        exit;
    }
}