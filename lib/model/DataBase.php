<?php
class DataBase{
    private $user;
    private $password;
    private $conecction;
    
    public  function __construct($user,$password,$conecction) {
        $this->user = $user;
        $this->password = $password;
        $this->conecction = $connection;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getConecction() {
        return $this->conecction;
    }

    public function setUser($user): void {
        $this->user = $user;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setConecction($conecction): void {
        $this->conecction = $conecction;
    }
    
    public function connect(){
        
    }
    
    public function disconect(){
        
    }
}
