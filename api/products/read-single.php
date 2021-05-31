<?php
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Products.php';

$database = new Database();
$db = $database->connect();

$products = new Products($db);


$products->product_sid = isset($_GET['id']) ? $_GET['id'] : die();

$products->read_single();

$num = $result->rowCount();

if($num > 0){
    $products_arr = array();
    $products_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $prod_item = array(
            'product_sid'        => $product_sid,
            'product_name'      => $product_name,
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