<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DispositivoDao
 *
 * @author AhmedJorge
 */
class DispositivoDao 
{
    public static $MARCA = "MARCA";
    public static $MODELO = "MODELO";	
    public static $IMEI = "IMEI";
    public static $POLEGADA = "POLEGADA";
    public static $VERSAO = "VERSAO";
    //put your code here
    public static function listDispositivoUnReg()
    {
        CallPgSQL::functionTable("adm.funct_load_despositivo", "*" , array(2) ); 
        while ($row =CallPgSQL::getValors()) 
        {
            echo "<tr onclick=\"getDadosDispositivos('$row[ID]')\">";
            echo "<td>".$row["DESPOSITIVO"].'</td>';
            echo "<td>".$row["DATA"]." ".$row["HORA"].'</td>';
            echo '</tr>';
        }
        CallPgSQL::closeConexao();
    }
    
    public static function carregarDispositivo($id)
    {
        CallPgSQL::functionTable("adm.func_get_despositivo_req","*", array($id));
        while ($row = CallPgSQL::getValors()) 
        {
            echo $row[DispositivoDao::$MARCA].";;".$row[DispositivoDao::$MODELO].";;".$row[DispositivoDao::$IMEI].";;".$row[DispositivoDao::$VERSAO].";;".$row[DispositivoDao::$POLEGADA];
        }
        CallPgSQL::closeConexao();
    }
    
    public static function getCoresDiposito()
    {
        CallPgSQL::simplesSelect("ver_cor", "*");
        echo "<option value='' >Selecione</option>";
        while ($row = CallPgSQL::getValors()) 
        {
            echo "<option value='$row[ID]' >".$row['COR']."</option>";
        }
        CallPgSQL::closeConexao();
    }
    
    public static function regDiposito()
    {
        include '../../Utilities/modelo/Utilizador.php';
        include '../../Utilities/validacao/Session.php'; session_start();
        CallPgSQL::simplesFuncion("adm.func_reg_despositivo", 
        array(Session::getUserLogado()->getIdUtilizador(),$_POST['id'], $_POST['corFran'], $_POST['corTraz'], CallPgSQL::toVarchar($_POST['inf']),$_POST['numSim']));
        
        foreach (CallPgSQL::getValors() as $value)
        {
            $arr = explode(";", $value); 
            echo ($arr[0]=="true") ? "Registro do dispositivo efetuado com sucesso \n\r" : $arr[1];
        }
        
        $cartoes = explode(";;;", $_POST['cartaData']);
        foreach ($cartoes as $dados) 
        {
            $cartao = explode(":::", $dados);
            CallPgSQL::simplesFuncion("adm.func_reg_sim", array($_POST['id'],"'$cartao[0]'","'$cartao[1]'","'$cartao[2]'"));
            foreach (CallPgSQL::getValors() as $value)
            { $a = explode(";", $value);  echo ($a[0]=="true") ? "" : $a[1]; }
        }
        CallPgSQL::closeConexao();
    }
    
}
