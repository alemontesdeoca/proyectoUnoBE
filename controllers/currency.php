<?php


require_once "../models/currency.php";


$currency = new Currency();

$body = json_decode(file_get_contents("php://input"),true);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization');

switch($_SERVER['REQUEST_METHOD']){

    case 'GET':

      if(isset($_GET['from'])){

        if($_GET['from'] == "db"){

          $data =  $currency->get_all_currency();

        } else if($_GET['from'] == "api"){


          $data =  $currency->get_all_currencies_value();

        } else {

          header("HTTP/1.1 406");
        }



      } else {

        
        echo json_encode("Falta parametrO");
        header("HTTP/1.1 406");
      }

      echo json_encode($data);

    break;

    case 'POST':
      if(isset($body['from']) && isset($body['to']) && isset($body['amount'])){

         echo  json_encode( $currency->convert_currency($body['from'],$body['to'],$body['amount']));
      
      } else {

          echo json_encode("Body incompleto");
         header("HTTP/1.1 406");

      }
        break;
        
    case 'PUT':
      $currency->insert_currency();
     break;
     default:
     header("HTTP/1.1 500");
}

?>