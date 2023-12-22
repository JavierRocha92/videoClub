<?php
require_once '../functions.php';
require_once './allowManagement.php';
//Open session to connect
session_start();
//Destroy ccokie session_start() created
setcookie(session_id(),'',time() - 24 * 3600,'/');
//Destroy session 
session_destroy();
//update info to lastVisti cookie
setcookie(hash('sha256',$id),date("d-m-Y H:i"),time() + 24 * 3600,'/');
//Redirecting to index
//Callign function to write ifnfo into log file about los¡g out
writeInformation('log out', '-', '-');
header('Location: ../../index.php');
