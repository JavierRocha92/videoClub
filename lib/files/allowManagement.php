<?php
//Conditional to check if these  two variables exists to filter them
if(isset($_SESSION['rol']) && isset($_SESSION['username']) && isset($_SESSION['id'])){
    $rol = htmlspecialchars($_SESSION['rol']);
    $username = htmlspecialchars($_SESSION['username']);
    $id = htmlspecialchars($_SESSION['id']);
}
//Conditional to redirect user to a index cause he is not allowed to be here
else{
    header('Location: ../index.php');
}
