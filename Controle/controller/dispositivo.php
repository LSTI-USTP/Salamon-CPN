<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST["type"]))
{
    if($_POST["type"] == "listDis")
    {
        getInport();
        DispositivoDao::listDispositivoUnReg();
    }
    if($_POST["type"] == "getDisAllData")
    {
        getInport();
        DispositivoDao::carregarDispositivo($_POST["id"]);
    }
    if($_POST["type"] == "getCorlor")
    {
        getInport();
        DispositivoDao::getCoresDiposito();
    }
    if($_POST["type"] == "regDispo")
    {
        getInport();
        DispositivoDao::regDiposito();
    }
    if($_POST["type"] == "pinTabela")
    {
        include '../../Utilities/validacao/PrintTable.php';
        PrintTable::createTablePHP($_POST["valores"], ";;;", ":::");
    }
}

function getInport()
{
    include '../../Utilities/conexao/CallPgSQL.php';
    include '../../Utilities/conexao/Conectar.php';
    include '../dao/DispositivoDao.php';
}
