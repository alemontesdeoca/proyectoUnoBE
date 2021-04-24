<?php



require_once "../models/login.php";


$login = new Login();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');



switch($_SERVER['REQUEST_METHOD']){

  

    case 'POST':



       $data = $login->check_user($body['alias'],$body['password']) ;


       if($data!=false){

       echo json_encode($data);

       } else {

echo json_encode("Credenciales incorrectas");
     header("HTTP/1.1 406");

       }
       break;
    
     default:
     header("HTTP/1.1 500");
}


?>