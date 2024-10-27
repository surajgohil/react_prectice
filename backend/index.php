<?php

// error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$class  = !empty($_GET['cls']) ? $_GET['cls'] : '';
$method = !empty($_GET['mtd']) ? $_GET['mtd'] : '';

$_GET = array();

if ($class == '') {

    $response = array(
        'status'  => 0,
        'message' => "l_class_not_exist"
    );
    echo json_encode($response);
    exit;

} elseif ($method == '') {

    $response = array(
        'status'  => 0,
        'message' => "l_api_not_exist"
    );
    echo json_encode($response);
    exit;

} else {

    require_once 'class.Main.php';
    require 'classes/class.' . $class . '.php';

    if (!class_exists($class)) {
        echo json_encode(['status' => 0, 'message' => 'Class not found']);
        exit;
    }

    $obj = new $class();

    if (!method_exists($obj, $method)) {
        echo json_encode(['status' => 0, 'message' => 'Method not found']);
        exit;
    }

    $response = $obj->$method();
    $response = $obj->apiResponse($response);

    echo json_encode($response);exit;
}
?>
