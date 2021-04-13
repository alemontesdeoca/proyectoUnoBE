
<?php

require '../config/conexion.php';


class Customer extends Connect {


    public function get_customers(){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM encuestado";
        $sql = $connect->prepare($sql);
        $sql-> execute();

        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }


    
    public function get_customer($id){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM encuestado WHERE id_encuestado=?";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$id); 
        $sql-> execute();

        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create_customer($name,$surname,$birthDate,$gender,$nationality){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "INSERT INTO encuestado VALUES (NULL,?,?,?,?,?);";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$name);
        $sql -> bindValue(2,$surname);
        $sql -> bindValue(3,$birthDate);
        $sql -> bindValue(4,$gender);
        $sql -> bindValue(5,$nationality);
        $sql-> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }


    

    public function update_customer($name,$surname,$birthDate,$gender,$nationality,$id){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "UPDATE encuestado SET  
        nombre = ?,
        apellido = ?,
        fecha_nacimiento = ?, 
        genero = ?,
        nacionalidad =? 
        WHERE id_encuestado=?;";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$name);
        $sql -> bindValue(2,$surname);
        $sql -> bindValue(3,$birthDate);
        $sql -> bindValue(4,$gender);
        $sql -> bindValue(5,$nationality);
        $sql -> bindValue(6,$id);
        $sql-> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

}





?>