<?php
//Conditional to cehck if a extension response exists
if(isset($_POST['optionExtends'])){
        $response = htmlspecialchars($_POST['sessionExtends']);
        //Conditinal to know response value
        if($response == 'yes'){//Conditional to extend session more time
            setcookie(getSessionCookieName(session_id(), $id),'session',time() * 1 * 60,'/');
        }else{//Conditional to logout 
            require 'logOut.php';
        }
}
//Condtitonal to check if cookie is active
if(isset($_COOKIE[getSessionCookieName(session_id(), $id)])){
    setcookie(getSessionCookieName(session_id(), $id),'session',time() * 1 * 60,'/');
}else{
    require '../../pages/sessionExtends.html';
}
