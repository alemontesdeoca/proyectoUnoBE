<?php
require '../config/conexion.php';


class Report extends Connect
{

    public function generate_report($idProduct)
    {

        $connect = parent::Connection();

        if (is_string($connect))
        {

            header("HTTP/1.1 406");
            return "En este momento no es posible realizar la consulta";

        }
        else
        {

            $sql = "select d.descripcion_pregunta,e.descripcion_respuesta,f.nombre,f.apellido,f.alias 
            from encuesta_detalles a join encuesta_cabecera b ON a.id_encuesta_cabecera = b.id_encuesta_cabecera inner join
             pregunta d on d.id_pregunta = a.id_pregunta inner join respuesta e on e.id_respuesta = a.id_respuesta inner join
              usuario f on b.id_usuario = f.id_usuario where id_producto = ?";
              
             $sql = $connect->prepare($sql);
             $sql->bindValue(1, $idProduct);
             
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
