<?php

class Connect {

private $db;

public function Connection(){


    try {

        $connect = $this -> db = new PDO("mysql:localhost=localhost;dbname=trade","root","");

        return $connect;

        
    } catch(Exception $e){

        return ("Error " . $e->getMessage());
    }

}


public function set_names(){

    return $this->db->query("SET NAMES 'utf8'");
}


}

?>