<?php
require '../config/conexion.php';

class Question extends Connect
{


    public function get_questions()
    {

        $connect = parent::Connection();

        if (is_string($connect))
        {

            header("HTTP/1.1 406");

            return "En este momento no es posible realizar la consulta";

        }
        else
        {

            parent::set_names();

            $sql = "SELECT * FROM pregunta";

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
