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
            'product_sid'        => $product_sid,
            'product_name'      => $product_name,
            'product_desc'  => $product_desc,
            'product_price' => $product_desc
        );
        array_push($car_arr['data'], $car_item);
    }
    echo json_encode($car_arr);
}else{
    echo json_encode(
        array('message' => 'no data')
    );
}