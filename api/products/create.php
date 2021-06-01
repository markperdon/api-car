<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methons: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

$database = new Database();
$db = $database->connect();
$products = new Products($db);

$data = json_decode(file_get_contents('php://input'));
if($data->product_name != null || $products->product_desc != null || $products->product_price != null)
{
    $products->product_name = $data->product_name;
    $products->product_desc = $data->product_desc;
    $products->product_price = $data->product_price;
    if($products->create()) {
        echo json_encode(
            array('message' => 'Product was created')
        );
    } else {
        echo json_encode(
            array('message' => 'Product not created')
        );
    }    
}

?>