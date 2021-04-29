<?php



require_once "../models/user.php";
require_once "../models/product.php";
require_once "../models/survey.php";


$user = new User();
$product = new Product();
$survey = new Survey();


$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
       $datos = $user->get_user_by_customer($_GET['id']);
       echo json_encode($datos);
    break;
    case 'POST':
       if(!$user->create_user($body['email'],$body['password'],$body['nombre'],$body['apellido'],$body['telefono'],$body['direccion'])){

          header("HTTP/1.1 406");

         echo "El usuario ya existe";
       }  else {

         $userData = $user ->get_user_by_alias($body['email'])[0]["id_usuario"];
         $productData = $product ->get_products();
            $survey->insert_survey_by_user($userData,$productData);
       }

       break;
        
    case 'PUT':
        $datos = $user->update_user($body['email'],$body['password'],$body['estado'],$body['rol'],$body['id_user']) ;
        echo json_encode($datos);
     break;
     default:
     header("HTTP/1.1 500");
}


?>