<?php


class Api {


    public static $http_code;

    public static $data;
    

  public  static function getApi($endpoint){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        self::$data = curl_exec($ch);
        self::$http_code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

    }
}

?>