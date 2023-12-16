<?php

//Create an empty array to storgae all films object into int
$films = array();
//Create a databse connecion
$bd->connection();
//create a select statement to get all films an its actors
$sql = $bd->getSelectQuery(array('id', 'titulo', 'genero', 'pais', 'anyo', 'cartel'), 'peliculas');
//Calling function to make statemnet by sql got before
$result = $bd->makeStatement($bd->getConnection(), $sql);

//Close Db connection 
$bd->disconnect();
//loop all result to create any film for each row
foreach ($result as $film) {
    //Create a Pelicula object fill all attributes by taking results form $film array
    $peli = new Pelicula($film['id'], $film['titulo'], $film['genero'], $film['pais'], $film['anyo'], $film['cartel']);
    //Create sql to get actor for a peli in thid iteration
    $sql = $bd->getSelectQuery(array('id', 'nombre', 'apellidos', 'fotografia'), 'actores');
    //Calling function to remove final characters
    $sql = removeCharacter($sql, -1);
    //Add charatcer to sql to link a subquery
    $sql .= " WHERE id in (";
    $subsql = $bd->getSelectQuery(array('idActor'), 'actuan', array('idPelicula'));
    $sql .= $subsql;
    //Calling function to remove final characters
    $sql = removeCharacter($sql, -1);
    //Adding close brakets to make perfect sintaxis statement
    $sql .= ')';
    //Create a datbase connection
    $bd->connection();
    //Calling function to make a statement
    $result = $bd->makeStatement($bd->getConnection(), $sql, array($peli->getId()));
    //Close database connecion
    $bd->disconnect();
    //Conditional to check if result variable is an array or not
    if (is_array($result)) {
        foreach ($result as $actor) {
            //Creating an Actor object and fill all attributes
            $act = new Actor($actor['id'], $actor['nombre'], $actor['apellidos'], $actor['fotografia']);
            //Calling funtion to add a new actor for Pelicula object in this foreach iteration
            $peli->addActor($act);
        }
    }

    //Save into $films array eachr film 
    array_push($films, $peli);
}
//final for each

