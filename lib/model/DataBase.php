<?php

class DataBase {


    public function __construct() {
      
    }

    public function connection() {
        try {
            // Create a conexion by using PDo object
            return new PDO('mysql:dbname=videoclub;host=127.0.0.1', 'root', '');
        } catch (PDOException) {
            echo displayError('la aplicación esta en labores de mantenimiento');
        }
    }

    public function disconnect() {
//     $this = null;   
    }
}
