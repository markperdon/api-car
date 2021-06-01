<?php
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Cars.php';

$database = new Database();
$db = $database->connect();

$cars = new Cars($db);

$cars->car_name = isset($_GET['car_name']) ? $_GET['car_name'] : die();

$result = $cars->search();

$num = $result->rowCount();

if($num > 0){
    $cars_arr = array();
    $cars_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $car_item = array(
            'car_id'        => $car_id,
            'car_name'      => $car_name,
            'car_type'  => $car_type,
            'car_model' => $car_model
        );
        array_push($cars_arr['data'], $car_item);
    }
    echo json_encode($cars_arr);
}else{
    echo json_encode(
        array('message' => 'no data')
    );
}
?>