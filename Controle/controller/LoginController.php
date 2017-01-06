<?php
    header('Content-type: text/html; charset=UTF-8');
    if(isset($_POST['type']))
    {
        include '../../Utilities/modelo/Utilizador.php';
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/Session.php';
        include '../dao/LoginDao.php';
        
        $operacao = $_POST['type'];
        $utilizador = new Utilizador();
        $loginDao = new LoginDao();
        switch ($operacao)
        {
            case "1":
              $utilizador->setNomeAcesso($_POST['nomeAcesso']);
              $utilizador->setPalavraPasse($_POST['senha']);
              $loginDao->logar($utilizador);  
            break;
            case "2":
                $utilizador->setIdUtilizador($_POST['idAgente']);
                $utilizador->setNovaSenha($_POST['senha']);
                $loginDao->loginAtivar($utilizador);
//                echo "ffnf";
            break;
        }
        
        
    }

