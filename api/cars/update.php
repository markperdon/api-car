<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methons: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Cars.php';

    $database = new Database();
    $db = $database->connect();
    $cars = new Cars($db);

    $data = json_decode(file_get_contents('php://input'));

    $cars->product_sid = $data->car_id;

    $cars->car_name = $data->car_name;
    $cars->car_type = $data->car_type;
    $cars->car_model = $data->car_model;

    if($cars->update()) {
        echo json_encode(
            array('message' => 'Car Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Car not updated')
        );
    }

?>