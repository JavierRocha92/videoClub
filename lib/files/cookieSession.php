<?php
//Conditional to cehck if a extension response exists
if(isset($_POST['optionExtends'])){
        $response = htmlspecialchars($_POST['optionExtends']);
        //Conditinal to know response value
        if($response == 'yes'){//Conditional to extend session more time
            setcookie(getSessionCookieName(session_id(), $id),'sessionActive',time() + 1 * 30,'/');
            header('Location: ./films.php');
        }else{//Conditional to logout 
            require 'logOut.php';
        }
}
$sessionCookie = isset($_COOKIE[getSessionCookieName(session_id(), $id)]) ? $_COOKIE[getSessionCookieName(session_id(), $id)] : null;
//Condtitonal to check if cookie is active
if(isset($sessionCookie)){
    setcookie(getSessionCookieName(session_id(), $id),'sessionActive',time() + 1 * 30,'/');
}else{//Conditional to call form for extend session
    require '../pages/sessionExtends.php';
    exit;
}