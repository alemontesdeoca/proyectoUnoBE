<?php



require_once "../models/customer.php";


$customer = new Customer();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
       $datos = $customer->get_customer($_GET['id']);
       echo json_encode($datos);
    break;

    case 'POST':
       $datos = $customer->create_customer($body['nombre'],$body['apellido'],$body['fecha_nacimiento'],$body['genero'],$body['nacionalidad']) ;
       echo json_encode($datos);
   
       break;
        
    case 'PUT':
        $datos = $customer->update_customer($body['nombre'],$body['apellido'],$body['fecha_nacimiento'],$body['genero'],$body['nacionalidad'],$body['id']) ;
        echo json_encode($datos);
     break;
     default:
     header("HTTP/1.1 500");
}


?>