<?php



require_once "../models/survey.php";


$survey = new Survey();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');



switch($_SERVER['REQUEST_METHOD']){

  

    case 'GET':



       $data = $survey->get_survey_by_user($_GET['id']) ;


       if($data!=false){

       echo json_encode($data);

       } else {

             header("HTTP/1.1 406");

       }

       break;
    case 'POST':

           $data = $survey->update_survey_header($body['id_encuesta_cabecera'],$body['state']) ;
           break;

     default:
     header("HTTP/1.1 500");
}


?>