<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dataInicial = (($_POST['dataIncio'] == "") ? NULL : $_POST['dataIncio']);
$dataFinal = (($_POST['dataFin'] == "") ? NULL : $_POST['dataFin']);
if(isset($_POST['type']))
{
    include '../../../Utilities/conexao/CallPgSQL.php';
    include '../../../Utilities/conexao/Conectar.php';
    if($_POST['type'] == "loadDados")
    {
//        PAGAS	PAGAS PRAZO	PAGAS FORA PRAZO	NAO PAGAS

        CallPgSQL::functionTable("pay.funct_load_percentagem", "*", array($dataInicial,$dataFinal));
        while ($row = CallPgSQL::getValors()) {
            $pePagas = number_format($row['PAGAS'], 2, ',', '.')."%";
            $pePagaNP = number_format($row['PAGAS PRAZO'], 2, ',', '.')."%";
            $pePagaFP = number_format($row['PAGAS FORA PRAZO'], 2, ',', '.')."%";
            $peNPaga = number_format($row['NAO PAGAS'], 2, ',', '.')."%";
        }CallPgSQL::closeConexao();

        CallPgSQL::functionTable("pay.funct_load_pagamento", "*", array($dataInicial,$dataFinal,null));
        while ($row = CallPgSQL::getValors()) {
            $totalPagas = $row['TOTAL MULTAS'];
            $multasP = $row['MULTAS PAGAS'];
            $multaNaoP = $row['MULTAS NAO PAGAS'];
        }CallPgSQL::closeConexao();
        
//        TOTAL MULTAS	MULTAS PAGAS	MULTAS NAO PAGAS
        $arrayF = array('type'=> "result", "TOTALMULTAS" => $totalPagas ,"MULTASPAGAS" => $multasP, "MULTASNAOPAGAS" => $multaNaoP,
            "PAGAS" => $pePagas ,"NAOPAGAS" => $peNPaga, "PAGASPRAZO" => $pePagaNP, "PAGASFORAPRAZO" => $pePagaFP);
            
        $e = json_encode($arrayF); die($e);
    }
    else if($_POST['type'] == "loadDados2")
    {
        loadTablela($dataFinal, $dataInicial);
    }
}

function loadTablela($dataFinal,$dataInicial)
{
    if( $_POST['relatorio'] == "1" )
    {
        CallPgSQL::functionTable("pay.funct_report_data_multa", "*", array($dataInicial, $dataFinal ,$_POST['agrupamento'],$_POST['relatorio']));
        include '../../../Utilities/validacao/PrintTable.php';
        PrintTable::loadBDTable(array( "DATA"=>"Data", "MULTAS" => "Multas", "PAGAS" => "Pagas", "NAO PAGAS" => "Não pagas", "CRESCENTE MULTA" => "Total multa", "CRESCENTE COBRADOS" => "Total pagamento"), TRUE);
    }
}

