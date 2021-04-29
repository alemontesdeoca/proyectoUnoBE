<?php

require_once "../models/product.php";


$product = new Product();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');



switch($_SERVER['REQUEST_METHOD']){

    case 'GET':

  
echo json_encode($product->get_productS());


   
        break;

     default:


     header("HTTP/1.1 500");
}

?>
