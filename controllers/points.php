<?php

require_once "../models/user.php";


$user = new User();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');



switch($_SERVER['REQUEST_METHOD']){

    case 'GET':

  
echo json_encode($user->get_points($_GET['id']));


   
        break;


    case 'POST':


$points =  $user->get_points($body["id_user"])[0]["puntos"];


echo json_encode($user->update_points($body["id_user"],$points,$body["puntos"]));



  


   
        break;

     default:


     header("HTTP/1.1 500");
}

?>
