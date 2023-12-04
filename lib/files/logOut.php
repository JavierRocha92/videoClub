<?php
require '../functions.php';
//Open session to connect
session_start();
//Destroy ccokie session_start() created
setcookie(session_id(),'',time() - 24 * 3600,'/');
//Destroy session 
session_destroy();
//update info to lastVisti cookie
setcookie(getSessionCookieName('', $id),date("d-m-Y H:i"),time() + 24 * 3600,'/');
//Redirecting to index
header('Location: ../../index.php');
