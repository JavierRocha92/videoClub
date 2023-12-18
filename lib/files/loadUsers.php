<?php
//Create an array to stroage users in
$users = array();
//$bd = new Database();
//Create a database connection
$bd->connection();
//Get eelect statement by calling function 
$sql = $bd->getSelectQuery(array('id','username','password','rol'), 'usuarios');
//Make statement by calling function 
$results = $bd->makeStatement($bd->getConnection(), $sql);
//Conditinal to check if result exists
if($results){
//    var_dump($results);
//    exit;
    //For eac to create as many object as result element 
    foreach ($results as $user) {
        $user = new Usuario($user['id'],$user['username'],$user['password'],$user['rol']);
        //Storage any user into users array by calling array_push() function
        array_push($users,$user);
//        var_dump($user);
    }
    
//    exit;
}
