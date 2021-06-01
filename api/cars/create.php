<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methons: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Cars.php';

    $database = new Database();
    $db = $database->connect();
    $products = new Cars($db);

    $data = json_decode(file_get_contents('php://input'));

    $products->car_name = $data->car_name;
    $products->car_type = $data->car_type;
    $products->car_model = $data->car_model;
    if($products->create()) {
        echo json_encode(
            array('message' => 'Car was created')
        );
    } else {
        echo json_encode(
            array('message' => 'Car not created')
        );
    }    

?>