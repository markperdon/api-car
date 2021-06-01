<?php
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Products.php';

$database = new Database();
$db = $database->connect();

$products = new Products($db);

$products->product_sid = isset($_GET['id']) ? $_GET['id'] : die();

$products->read_single();

$prod_array = [
    'product_name' => $products->product_name,
    'product_desc' => $products->product_desc,
    'product_price' => $products->product_price,
];

print_r(json_encode($prod_array));

?>