<?php



require_once "../models/user.php";


$user = new User();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
       $datos = $user->get_user_by_customer($_GET['id']);
       echo json_encode($datos);
    break;

    case 'POST':
       $datos = $user->create_user($body['email'],$body['password'],$body['estado'],$body['rol'],$body['id_customer']) ;
       echo json_encode($datos);
       break;
        
    case 'PUT':
        $datos = $user->update_user($body['email'],$body['password'],$body['estado'],$body['rol'],$body['id_user']) ;
        echo json_encode($datos);
     break;
     default:
     header("HTTP/1.1 500");
}


?>