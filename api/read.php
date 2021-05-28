<?php
header('Content-Type: application/json');
include_once '../config/Database.php';
include_once '../models/Cars.php';

$database = new Database();
$db = $database->connect();

$cars = new Cars($db);

$result = $cars->read();


$num = $result->rowCount();

if($num > 0){
    $car_arr = array();
    $car_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $car_item = array(
            'id'        => $id,
            'name'      => $name,
            'car_type'  => $car_type,
            'car_model' => $car_model
        );
        array_push($car_arr['data'], $car_item);
    }
    echo json_encode($car_arr);
}else{
    echo json_encode(
        array('message' => 'no data')
    );
}