<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methons: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Cars.php';

$database = new Database();
$db = $database->connect();
$cars = new Cars($db);

$data = json_decode(file_get_contents('php://input'));

$cars->id = $data->id;

if($cars->delete()) {
    echo json_encode(
        array('message' => 'Car Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Car not deleted')
    );
}

?>