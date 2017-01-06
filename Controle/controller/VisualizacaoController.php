<?php
    header('Content-type: text/html; charset=UTF-8');
    if(isset($_POST['tdSelected']))
    {
        include '../dao/VisualizacaoDao.php';
        include '../../Utilities/validacao/PrintTable.php';
        $visualizacaoDao = new VisualizacaoDao();
        $arr = PrintTable::createArray($_POST['valores']);
        PrintTable::returnRowTable($arr, $arr);
    }
    elseif(isset($_POST['array']))
    {
        include '../dao/VisualizacaoDao.php';
        include '../../Utilities/validacao/PrintTable.php';
        echo PrintTable::arrayForBD($_POST['valores']);
    }
    elseif(isset($_POST['infracao']))
    {
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../dao/VisualizacaoDao.php';
        include '../../Utilities/validacao/PrintTable.php';
        
        $visualizacaoDao = new VisualizacaoDao();
        $visualizacaoDao->carregarInfo($_POST['infracao'],$_POST['valores']);
    }
    elseif(isset($_POST['listaDados']) && $_POST['listaDados'] == "true")
    {
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/PrintTable.php';
        
        CallPgSQL::functionTable("adm.funct_load_fiscalizacao_filter", "*", array(null,null,null,null,null,null,null,null,null));
        $remane = array("CARTA"=>"Carta","MATRICULA"=>"Matricula","VALOR COIMA"=>"Valor Coima","INFRACOES" => "Infracões","LATITUDE" => "Latitude","LONGITUDE" => "Longitude","ZONA" => "Zona","ESTADO"=>"Estado");
        PrintTable::loadBDTable( $remane, TRUE,array(),"ID","class='ListHeight' style='max-height:500px'");
    }
    elseif(isset($_POST['listaMap']) && $_POST['listaMap'] == "true")
    {
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/PrintTable.php';
        
//        CallPgSQL::functionTable("adm.funct_load_fiscalizacao_realtime", "*", array(null,null));
        CallPgSQL::functionTable("adm.funct_load_fiscalizacao_filter", "*", array(null,null,null,null,null,null,null,null,null));
        $i = 0;
        $ret = "";
        while ($row = CallPgSQL::getValors()) 
        {
            if($i == 0) { $ret = $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["ZONA"]; }
            else { $ret .= ";;;". $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["ZONA"]; }
            $i++;
            
            
        } //echo $ret;
        $e = json_encode(array('type'=> "reultado", "value" => $ret, "value1" => $ret )); die($e);
    }
    elseif(isset($_POST['listaMap']) && $_POST['listaMap'] == "tReal")
    {
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/PrintTable.php';
        
        include '../../Utilities/modelo/Utilizador.php';
        include '../../Utilities/validacao/Session.php'; session_start();

        CallPgSQL::functionTable("adm.funct_load_fiscalizacao_realtime_map", "*", array(Session::getUserLogado()->getIdUtilizador(),$_POST["timer"]));
        $i = 0;$j = 0;
        $ret = "";
        $ret2 = "";
        $numRo = CallPgSQL::getNumRow();
        while ($row = CallPgSQL::getValors()) 
        {
            if($i == 0) { $ret = $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["GRAVIDADE"]; }
            else { $ret .= ";;;". $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["GRAVIDADE"];}
            
            
            $sql = "SELECT * FROM adm.funct_ver_dados(". Session::getUserLogado()->getIdUtilizador() .",". $_POST["timer"] .",". $row['LATITUDE'] .",". $row['LONGITUDE'] .")";
            $quarey = pg_query($sql);
            $j =0;
            while ($row2 = pg_fetch_array($quarey,NULL,PGSQL_ASSOC))
            {
                if($j == 0)
                { $ret2 .= (($row2["CARTA"]=="") ? "" : "Carta ".$row2["CARTA"]."<br>" )."Matricula: ".$row2["MATRICULA"]/*."\nEquipa: ".$row2["EQUIPA"]*/."<br>Agente: ".$row2["AGENTE"]; }
                else
                {  $ret2 .= (($row2["CARTA"]=="") ? "---" : "---Carta ".$row2["CARTA"]."<br>" )."Matricula: ".$row2["MATRICULA"]/*."\nEquipa: ".$row2["EQUIPA"]*/."<br>Agente: ".$row2["AGENTE"]; }
                $j++;
            }
            
            if($j==0)
            {  $ret2 .=  " Sem Dados "; }
            
            $i++;
            if($i != $numRo) { $ret2 .= ";;;"; }
        }
        
        $e = json_encode(array('type'=> "reultado", "value" => $ret, "value1" => $ret2 )); die($e); 
    }
    elseif(isset($_POST['listaDados']) && $_POST['listaDados'] == "tReal")
       {
           include '../../Utilities/conexao/CallPgSQL.php';
           include '../../Utilities/conexao/Conectar.php';
           include '../../Utilities/validacao/PrintTable.php';
           
           include '../../Utilities/modelo/Utilizador.php';
           include '../../Utilities/validacao/Session.php'; session_start();

           CallPgSQL::functionTable("adm.funct_load_fiscalizacao_realtime", "*", array(Session::getUserLogado()->getIdUtilizador(),$_POST["timer"]));
           $remane = array("CARTA"=>"Carta","MATRICULA"=>"Matricula","VALOR COIMA"=>"Valor Coima","INFRACOES" => "Infracões","LATITUDE" => "Latitude","LONGITUDE" => "Longitude","ZONA" => "Zona","ESTADO"=>"Estado");
           PrintTable::loadBDTable( $remane, TRUE,array(),"ID","class='ListHeight' style='max-height:500px'");
       }