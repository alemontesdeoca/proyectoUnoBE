
<?php

require_once '../config/conexion.php';


class User extends Connect {


    public function get_users(){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM usuarios";
        $sql = $connect->prepare($sql);
        $sql-> execute();

        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }


    public function get_points($idUser){


          $connect = parent::Connection();
          parent::set_names();

        $sql = "SELECT puntos FROM usuario WHERE id_usuario=".$idUser;
        
        $sql = $connect->prepare($sql);
        $sql-> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);

    }
    

       public function update_points($idUser,$points,$addPoints){


          $connect = parent::Connection();
          parent::set_names();

       $newPoints = (int)  $addPoints + (int)$points;
 $sql = "UPDATE usuario SET  
        puntos = ?
        WHERE id_usuario=?;";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1, $newPoints);
        $sql -> bindValue(2,$idUser);
        $sql-> execute();
      
        return $sql ->fetchAll(PDO::FETCH_ASSOC);

    }
    public function get_user_by_customer($idCustomer){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM usuarios WHERE id_encuestado=?";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$idCustomer); 
        $sql-> execute();

        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create_user($email,$password,$state,$rol,$idCustomer){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "INSERT INTO usuarios VALUES (NULL,?,?,?,?,?);";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$email);
        $sql -> bindValue(2,$password);
        $sql -> bindValue(3,$state);
        $sql -> bindValue(4,$rol);
        $sql -> bindValue(5,$idCustomer);
        $sql-> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }


    

    public function update_user($email,$password,$state,$rol,$id){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "UPDATE usuarios SET  
        email = ?,
        contraseña = ?,
        estado = ?, 
        rol = ? 
        WHERE id_encuestado=?;";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$email);
        $sql -> bindValue(2,$password);
        $sql -> bindValue(3,$state);
        $sql -> bindValue(4,$rol);
        $sql -> bindValue(5,$id);
        $sql-> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

}





?>