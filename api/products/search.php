<?php
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Products.php';

$database = new Database();
$db = $database->connect();

$products = new Products($db);


$products->product_sid = isset($_GET['id']) ? $_GET['id'] : die();
$products->product_name = isset($_GET['product_name']) ? $_GET['product_name'] : die();
$products->product_desc = isset($_GET['product_desc']) ? $_GET['product_desc'] : die();
$products->product_price = isset($_GET['product_price']) ? $_GET['product_price'] : die();

$result = $products->search();

$num = $result->rowCount();

if($num > 0){
    $products_arr = array();
    $products_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $prod_item = array(
            'product_sid'   => $product_sid,
            'product_name'  => $product_name,
            'product_desc'  => $product_desc,
            'product_price' => $product_price
        );
        array_push($products_arr['data'], $prod_item);
    }
    echo json_encode($products_arr);
}else{
    echo json_encode(
        array('message' => 'no data')
    );
}
?>