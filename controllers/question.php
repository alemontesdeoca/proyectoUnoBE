<?php



require_once "../models/question.php";


$question = new Question();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');



switch($_SERVER['REQUEST_METHOD']){

  

    case 'GET':



       $data = $question->get_questions() ;


       if($data!=false){

       echo json_encode($data);

       } else {

             header("HTTP/1.1 406");

       }

       break;
    
     default:
     header("HTTP/1.1 500");
}


?>