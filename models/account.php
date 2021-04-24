<?php
require_once '../config/connection.php';
require_once '../utils/api.php';

class Account extends Connect
{


    public function get_detail_account($id)
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
            $sql = "SELECT * FROM account a inner join currency c on a.id_currency = c.id_currency where a.id_account=" . $id;
            $sql = $connect->prepare($sql);

            if ($sql->execute())
            {

                return $sql->fetchAll(PDO::FETCH_ASSOC);

            }
            else
            {

                header("HTTP/1.1 406");
                return "En este momento no es posible realizar la consulta";

            }

        }

    }


        public function get_accounts_by_user($id)
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
            $sql = "SELECT a.id_account,a.name,a.balance,c.currency FROM account a inner join currency c on a.id_currency = c.id_currency where a.id_user=" . $id;
            $sql = $connect->prepare($sql);

            if ($sql->execute())
            {

                return $sql->fetchAll(PDO::FETCH_ASSOC);

            }
            else
            {

                header("HTTP/1.1 406");
                return "En este momento no es posible realizar la consulta";

            }

        }

    }


    
    public function get_account_by_currency($currency,$idUser)
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
            $sql = "SELECT a.id_account,a.name,a.balance,c.currency FROM account a inner join currency c on a.id_currency = c.id_currency where c.currency=" . "'". $currency."'".  " AND a.id_user=" . $idUser ;
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

    
    
    public function get_balance($id_account)
    {

        $connect = parent::Connection();

        if (is_string($connect))
        {

            header("HTTP/1.1 406");
            return false;

        }
        else
        {

            parent::set_names();
            $sql = "SELECT balance FROM account where id_account=" . $id_account;
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


    public function check_balance($balance,$amount){

        $total = $balance - $amount;

        if($total<0){

            return false;

        } else {
            return true;
        }

    
    }


    public function update_balance($amount,$account,$operation="")
    {

        $connect = parent::Connection();



            $balance = $this->get_balance($account);

            if (is_string($connect))
            {
    
                header("HTTP/1.1 406");
                return "En este momento no es posible realizar la consulta";
    
            }
            else
            {
    
                parent::set_names();
                $sql = "UPDATE account SET balance=  ? WHERE id_account= ?";;
                $sql = $connect->prepare($sql);
    

                
                if($operation == "purchase"){

                    $sql->bindValue(1, $balance[0]["balance"] + $amount);


                } else if($operation == "sale"){


                    if($this->check_balance( $balance[0]["balance"],$amount)){

                        $sql->bindValue(1, $balance[0]["balance"] - $amount);

                    } else {

                        return false;

                        die();

                    }


                } else {

                    $sql->bindValue(1, $balance[0]["balance"] + $amount);

                }


                $sql->bindValue(2, $account);
    
    
                if ($sql->execute())
                {
    
                 return   true;
    
                }
                else
                {
    return false;
    
                }
    
            }
        

      

    }


    public function create_account($name, $balance,$idCurrency,$idUser)
    {

        $connect = parent::Connection();


        if (is_string($connect))
        {

            header("HTTP/1.1 406");
            return "En este momento no es posible realizar la consulta";

        }
        else
        {


                $sql = "INSERT INTO account VALUES (NULL,?,?,?,?);";
                $sql = $connect->prepare($sql);
                $sql->bindValue(1, $name);
                $sql->bindValue(2, $balance);
                $sql->bindValue(3, $idCurrency);
                $sql->bindValue(4, $idUser);

                if ($sql->execute())
                {

                    return "Cuenta Creada Exitosamete";
                }
                else
                {

                   return false;
                }
            

        }

    }

}

?>
