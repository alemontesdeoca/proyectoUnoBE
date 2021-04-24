<?php
require_once '../config/connection.php';
require '../config/fixer_config.php';
require_once '../utils/api.php';

class Currency extends Connect
{

    private $endpoint = 'http://data.fixer.io/api/latest?access_key=' . ACCESS_KEY . '&format=0';



    //get all currencies in db
    public function get_all_currency()
    {

        $connect = parent::Connection();

        if(is_string($connect)){

            header("HTTP/1.1 406");
            return "En este momento no es posible realizar la consulta";
 
        }  else {


            parent::set_names();
            $sql = "SELECT * FROM currency";
            $sql = $connect->prepare($sql);


            if( $sql->execute()){


                

            return $sql->fetchAll(PDO::FETCH_ASSOC);

            } else {


                header("HTTP/1.1 406");
                return "En este momento no es posible realizar la consulta";
    

            }
           
        
        }
        
    }




    public function get_id_currency_by_name($currency)
    {

        $connect = parent::Connection();

        if(is_string($connect)){

            header("HTTP/1.1 406");
            return "En este momento no es posible realizar la consulta";
 
        }  else {


            parent::set_names();
            $sql = "SELECT  id_currency FROM currency where currency="."'".$currency."'";
            $sql = $connect->prepare($sql);


            if( $sql->execute()){


                

            return $sql->fetchAll(PDO::FETCH_ASSOC);

            } else {


             return false;
    

            }
           
        
        }
        
    }


        public function get_all_currencies_value()
        {
    
            $connect = parent::Connection();
    
            
            Api::getApi($this->endpoint);
        
            $data = json_decode(Api::$data,true);


            return $data["rates"];

        
           
            
        }

        
        //Save all currencies in db
        public function insert_currency()
        {
    
            $connect = parent::Connection();
         
            
        if(is_string($connect)){

            header("HTTP/1.1 406");
            return "En este momento no es posible realizar la consulta";
 
        }  else {


            Api::getApi($this->endpoint);
        
            $data = json_decode(Api::$data,true);

            if (Api::$http_code == 200) {


                foreach ($data["rates"] as $curr => $value)
            {
    
                $sql = "INSERT INTO currency VALUES (NULL,?);";
                $sql = $connect->prepare($sql);
                $sql->bindValue(1, $curr);
                $sql->execute();
    
            }
    
            } else{

                header("HTTP/1.1 406");
                return "En este momento no es posible realizar la consulta";
            }
            
        }
         
        }

    public function convert_currency($from, $to, $amount)
    {

            Api::getApi($this->endpoint);
        
            $data = json_decode(Api::$data,true);


            if (Api::$http_code == 200) {
                
                $fromValue = '';
                $toValue = '';
                $result = "";
        
                foreach ($data["rates"] as $key => $value)
                {
        
                    if ($key == $from)
                    {
        
                        $fromValue = $value;
        
                    }
                    else if ($key == $to)
                    {
        
                        $toValue = $value;
                    }
                }
        
                $result = $fromValue / $toValue * $amount;
        
        
                
        
                return array( 
                    'from' => $from,
                    'to' => $to,
                    'from_value' => $fromValue,
                    'to_value' => $toValue  , 
                    'result' => $result);
                
            

        
            } else {
                header("HTTP/1.1 406");
                return "En este momento no es posible realizar la consulta";
                        } }


}

?>
