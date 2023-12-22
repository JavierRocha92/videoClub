<?php

//Requires files******************
require '../functions.php';
require '../model/DataBase.php';

//Condional to check if values form post exist
if (isset($_POST)) {
    
    //Filter values an dset into postValues variable
    $postValues = filter_input_array(INPUT_POST);
    
    //Object creation****************************************************
    //Create databse object
    $bd = new Database();
    
    //Calling function to check if a user with this id is already in database
    if (!isUserExists($bd, $postValues['username'])) {
        
        //Storage values from new user in array to give as function parameter later
        $userValues = array('id' => $postValues['id'],
            'username' => $postValues['username'],
            'password' => hash('sha256', $postValues['password']),
            'rol' => $postValues['rol']);
        
        //Database interaction********************************************
        //Create a database connection
        $bd->connection();
        //Get a insert query by calling funciton 
        $sql = $bd->getInsertQuery($userValues, 'usuarios');
        //Make insertion into databse
        $bd->makeStatement($bd->getConnection(), $sql);
        //Close databse connection
        $bd->disconnect();
        
        //Redirection to index
        header('Location:../..//index.php?login');
    }else{//Conditional when user exists in database
        header('Location:../../index.php?errorUser');
        
    }
}

