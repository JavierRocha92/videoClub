<?php
//Conditional to cehck if a extension response exists
if(isset($_POST['optionExtends'])){
        $response = htmlspecialchars($_POST['optionExtends']);
        //Conditinal to know response value
        if($response == 'yes'){//Conditional to extend session more time
            setcookie(getSessionCookieName(session_id(), $id),'sessionActive',time() + 1 * 600,'/');
            header('Location: '.$_SERVER['PHP_SELF']);
        }else{//Conditional to logout 
            require 'logOut.php';
        }
}
$sessionCookie = isset($_COOKIE[getSessionCookieName(session_id(), $id)]) ? $_COOKIE[getSessionCookieName(session_id(), $id)] : null;
//Condtitonal to check if cookie is active
if(isset($sessionCookie)){
    setcookie(getSessionCookieName(session_id(), $id),'sessionActive',time() + 1 * 600,'/');
}else{//Conditional to call form for extend session
    require $_SERVER['DOCUMENT_ROOT'].'/VideoClub_app/pages/sessionExtends.php';
}