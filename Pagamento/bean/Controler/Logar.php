<?php
    if(isset($_POST["valido"]))
    {
        require '../modelo/Utilizador.php';
        require '../modelo/Query.php';
        require '../modelo/Session.php';
        require '../conexao/Conectar.php';
        require '../conexao/typeConneted.php';

        $user = $_POST["user"];
        $pwd  = $_POST["pwd"];
        $query = new Query();
        $query->simplesFuncion("FUNC_LOGIN", array($user,$pwd));

        if($query->getValors()!=null)
        {
            $ar = explode(";", $query->getValors());
            if($ar[0]==="false")
            {
                echo $ar[1];
            }
            else
            {
                $user = new Utilizador();
                $user->setId($ar[1]);
                $user->setNivel($ar[3]);
                $user->setNomeUser($ar[2]);
                $user->setEstado($ar[4]);
                Session::newSession(Session::USER, $user);
                echo 'true';
            }
        }
        else{
            echo "Erro a efetuar o login";
        }
    }
