<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methons: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';
include_once '../../models/Customers.php';

$database = new Database();
$db = $database->connect();
$products = new Products($db);
$customers = new Customers($db);

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
//customer
$customers->customer_name = $data->customer_name;
$customers->customer_address = $data->customer_address;



if($customers->create()) {
    echo json_encode(
        array('message' => 'Customer was created')
    );
} else {
    echo json_encode(
        array('message' => 'Customer not created')
    );
}
?>