<?php
require_once '../config/conexion.php';

class Product extends Connect
{

    public function get_products()
    {

        $connect = parent::Connection();

        if (is_string($connect))
        {

            header("HTTP/1.1 406");

            return "En este momento no es posible realizar la consulta";

        }
        else
        {


            $sql = "SELECT * FROM PRODUCTO WHERE ESTADO = 1 ";

            $sql = $connect->prepare($sql);


            if ($sql->execute())
            {

                return $sql->fetchAll(PDO::FETCH_ASSOC);

            }
            else
            {
return false;
            }

        }

    }

}

?>
