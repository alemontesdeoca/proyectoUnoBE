<?php



require_once "../models/answer.php";
require_once "../models/survey.php";
require_once "../models/user.php";


$survey = new Survey();
$answer = new Answer();
$user = new User();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');



switch($_SERVER['REQUEST_METHOD']){

  

    case 'POST':



       $data = $answer->send_answer($body["respuesta"],$body["id_pregunta"]) ;


       $survey->send_survey_detail($body["id_pregunta"],$data["0"]["id_respuesta"],$body["cabecera"]);

       $points = $user->get_points(4);

     
       break;
    
     default:
     header("HTTP/1.1 500");
}


?>