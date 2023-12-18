<?php
//Conditional to check if user pushed any button to modifiy any film
if (isset($_POST['option']) || isset($_POST['response'])) {
//    var_dump($_POST);
//    exit;
    $postValues = filter_input_array(INPUT_POST);
    $objectIds = isset($postValues['objectIds']) ? unserialize(base64_decode($postValues['objectIds'])) : null;
    $actionUser = isset($_SESSION['option']) ? htmlspecialchars($_SESSION['option']) : null;
    $response = isset($postValues['response']) ? $postValues['response'] : null;
    $object = isset($postValues['object']) ? unserialize(base64_decode(($postValues['object']))) : null;
    $option = isset($postValues['option']) ? htmlspecialchars($postValues['option']) : null;
    switch ($option) {
        case 'delete':
            handleDeleteAction($postValues, $object, $bd, $response, $option,$table);
            break;
        case 'update':
            handleUpdateAction($actionUser, $object, $option,$table);
            break;
        case 'insert':
            handleInsertAction($actionUser, $option,$objectIds,$table);
            break;
        case 'confirm':
            handleConfirmAction($postValues, $actionUser, $response, $object, $option, $bd,$table);
            break;
    }
}
