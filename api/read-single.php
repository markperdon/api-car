<?php
header('Content-Type: application/json');
include_once '../config/Database.php';
include_once '../models/Cars.php';

$database = new Database();
$db = $database->connect();

$cars = new Cars($db);


$cars->id = isset($_GET['id']) ? $_GET['id'] : die();

$cars->read_single();

$cars_arr = array(
    'id' => $cars->id,
    'name' => $cars->name,
    'car_type' => $cars->car_type,
    'car_model' => $cars->car_model,
);

print_r(json_encode($cars_arr));
?>