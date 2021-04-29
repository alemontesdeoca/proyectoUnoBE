<?php
require_once '../config/conexion.php';

class Survey extends Connect
{


    public function get_survey_by_user($id)
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

            $sql = "SELECT *,( select sum(a.puntuacion) FROM
             encuesta_cabecera a inner join producto b  WHERE a.id_producto = b.id_producto and a.id_usuario)  as puntuacion_total FROM
             encuesta_cabecera a inner join producto b  WHERE a.id_producto = b.id_producto and a.id_usuario=" . $id;

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


    public function insert_survey_by_user($idUser,$productData)
    {

        $connect = parent::Connection();
     
        
    if(is_string($connect)){

        header("HTTP/1.1 406");
        return "En este momento no es posible realizar la consulta";

    }  else {


    




            for ($i=0; $i<count($productData); $i ++)
        {


           $sql = "INSERT INTO encuesta_cabecera  VALUES (NULL,?,NULL,?,2,?);";
            $sql = $connect->prepare($sql);
            $sql->bindValue(1, $idUser);
            $sql->bindValue(2, $productData[$i]["id_producto"]);
            $sql->bindValue(3, $productData[$i]["puntuacion"]);


            $sql->execute();

        }

      
    }
     
    }


       public function update_survey_header($idHeader,$state){


          $connect = parent::Connection();
          parent::set_names();

 $sql = "UPDATE encuesta_cabecera SET  
        id_estado = ?
        WHERE id_encuesta_cabecera=?;";
        $sql = $connect->prepare($sql);
        $sql -> bindValue(1, $state);
        $sql -> bindValue(2,$idHeader);
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


     public function send_survey_detail($idQuestion,$idAnswer,$headerSurvey)
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

  $sql = "INSERT INTO encuesta_detalles values(NULL,?,?,?,NULL)";

        $sql = $connect->prepare($sql);

            $sql -> bindValue(1,$idQuestion); 
            $sql -> bindValue(2,$idAnswer);
            $sql -> bindValue(3,$headerSurvey); 

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
