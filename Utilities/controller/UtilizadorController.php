<?php

    if(isset($_POST['type']))
    {
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/Validation.php';
        include '../dao/UtilizadorDao.php';
        include '../../Utilities/validacao/Session.php';
        include '../../Utilities/modelo/Utilizador.php';
        $operacao = $_POST['type'];

        switch ($operacao)
        {
            case "1":
                 CallPgSQL::loadComboBox("ver_applications", "ID", "APLICACAO");
                break;
            case "2":
                CallPgSQL::loadComboBox("adm.ver_agente_notuser", "ID", "AGENTE");
                break;
            case "3":
                UtilizadorDao::carregarMenu($_POST['application']);
                break;
            case "4":
                Session::terminarSessao();
                break;
            case "5":
                $utilizador = new Utilizador();
                $utilizador->setAplicacao($_POST['application']);
                $utilizador->setMenuAcesso($_POST['menu']);
                UtilizadorDao::addUser($utilizador, $_POST['agente']);
                break;
        }
    }