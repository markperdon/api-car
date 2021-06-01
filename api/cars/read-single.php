<?php
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Cars.php';

$database = new Database();
$db = $database->connect();

$cars = new Products($db);

$cars->car_id = isset($_GET['car_id']) ? $_GET['car_id'] : die();

$cars->read_single();

$car_array = [
    'car_name' => $products->car_name,
    'car_type' => $products->car_type,
    'car_model' => $products->car_model,
];

print_r(json_encode($car_array));

?>