
<?php

require '../config/conexion.php';


class Login extends Connect {


    public function check_user($alias,$password){


        $connect = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM usuario where alias=? and pass_word=?";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1,$alias);
        $sql -> bindValue(2,$password);

        if ($sql->execute())
            {

                       return $sql ->fetchAll(PDO::FETCH_ASSOC);


            }
            else
            {
return false;
            }


    }



}





?>