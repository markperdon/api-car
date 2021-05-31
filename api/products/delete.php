<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methons: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

$database = new Database();
$db = $database->connect();
$products = new Products($db);

$data = json_decode(file_get_contents('php://input'));

$products->product_sid = $data->product_sid;

if($products->delete()) {
    echo json_encode(
        array('message' => 'Product Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Product not deleted')
    );
}

?>