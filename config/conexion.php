<?php

class Connect {

private $db;

public function Connection(){


    try {

        $connect = $this -> db = new PDO("mysql:localhost=localhost;dbname=proyecto_uno","root","");

        return $connect;

        
    } catch(Exception $e){

        print("Error " . $e->getMessage());
    }

}


public function set_names(){

    return $this->db->query("SET NAMES 'utf8'");
}


}

?>