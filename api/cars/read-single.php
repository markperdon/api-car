<?php
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Cars.php';

$database = new Database();
$db = $database->connect();

$cars = new Cars($db);

$cars->car_id = isset($_GET['car_id']) ? $_GET['car_id'] : die();

$cars->read_single();

$car_array = [
    'car_name' => $cars->car_name,
    'car_type' => $cars->car_type,
    'car_model' => $cars->car_model,
];

print_r(json_encode($car_array));

?>