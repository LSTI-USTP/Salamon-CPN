<?php

    if(isset($_REQUEST['type']))
    {
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../dao/ListagemDao.php';
        include '../modelo/Relatorio.php';
        include '../../Utilities/validacao/PrintTable.php';
     
        $tipoRelatorio = $_POST['type'];
        $listagemDao = new ListagemDao();

        switch ($tipoRelatorio)
        {
            case "carregar_infrações":
                $listagemDao->relatorioInfracao();
                break;
            case "Infração":
                $relatorio = new Relatorio($_REQUEST['dataInicio'], $_REQUEST['dataFim'], $_REQUEST['valorPesquisa'], $_REQUEST['agrupamento']);
               $listagemDao->pesquisarInfracao($relatorio);
                break;
            case "Veículos":
                $relatorio = new Relatorio($_REQUEST['dataInicio'], $_REQUEST['dataFim'], $_REQUEST['valorPesquisa'], $_REQUEST['agrupamento']);
                $listagemDao->pesquisarVeiculos($relatorio);
                break;
            case "Cartas":
                $relatorio = new Relatorio($_REQUEST['dataInicio'], $_REQUEST['dataFim'], $_REQUEST['valorPesquisa'], $_REQUEST['agrupamento']);
                $listagemDao->pesquisarCartas($relatorio);
                break;
            case "Fiscalização":
                $relatorio = new Relatorio($_REQUEST['dataInicio'], $_REQUEST['dataFim'], $_REQUEST['valorPesquisa'], $_REQUEST['agrupamento']);
                $listagemDao->pesquisarFiscalizacao($relatorio);
                break;
        }
    }
    else
        header("Location:../AdmItem2.php");
    
  
    


