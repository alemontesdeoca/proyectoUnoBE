<?php
require_once'../config/conexion.php';

class Answer extends Connect
{


    public function send_answer($answer,$idQuestion)
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

         $sql = "INSERT INTO respuesta VALUES (NULL,?,?);";
        $sql = $connect->prepare($sql);

            $sql -> bindValue(1,$answer); 
            $sql -> bindValue(2,$idQuestion); 


$sql->execute();
           
                
        $sql = "SELECT max(id_respuesta) as id_respuesta from respuesta WHERE descripcion_respuesta = ? and id_pregunta=?;";
        
         $sql = $connect->prepare($sql);

            $sql -> bindValue(1,$answer); 
            $sql -> bindValue(2,$idQuestion); 
            
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
