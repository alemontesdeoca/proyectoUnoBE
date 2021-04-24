<?php

require_once "../models/report.php";


$report = new Report();


$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');


switch($_SERVER['REQUEST_METHOD']){

    case 'GET':

      $data =  $report->generate_report($_GET['id']);

      echo json_encode($data);

    break;
     default:
     header("HTTP/1.1 500");
}


?>  