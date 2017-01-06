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
    elseif(isset($_POST['listaMap']) && $_POST['listaMap'] == "tReal")
    {
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/PrintTable.php';
        
        include '../../Utilities/modelo/Utilizador.php';
        include '../../Utilities/validacao/Session.php'; session_start();
        
//        aCarta ,aCondutor, aLivrete, aVeiculo: hasBorder('#aVeiculo'), alto: isChecked("alto"), media : isChecked("media"), baixo: isChecked("baixo")
        
        CallPgSQL::functionTable("adm.funct_load_fiscalizacao_realtime_map", "*", array(Session::getUserLogado()->getIdUtilizador(),$_POST["timer"], $_POST['aCarta'], $_POST['aVeiculo'], $_POST['aCondutor'], $_POST['aLivrete'], $_POST['baixo'], $_POST['media'], $_POST['alto']));
        $i = 0;
        $ret = "";
        $numRo = CallPgSQL::getNumRow();
        while ($row = CallPgSQL::getValors()) 
        {
            if($i == 0) { $ret .= $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["GRAVIDADE"]; }
            else { $ret .= ";;;". $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["GRAVIDADE"];}
            $i++;
        }
        
        $ATUACAO=""; $MULTAS=""; $LEVES=""; $GRAVES=""; $MUITOGRAVES = "";
        CallPgSQL::functionTable("adm.funct_load_atuacao_estado", "*", array($_POST["timer"],Session::getUserLogado()->getIdUtilizador()));
        while ($row2 = CallPgSQL::getValors())
        {
            $ATUACAO = $row2['ATUACAO'];
            $MULTAS = $row2['MULTAS'];
            $LEVES = $row2['LEVES'];
            $GRAVES = $row2['GRAVES'];
            $MUITOGRAVES = $row2['MUITO GRAVES'];
        }
        
        $e = json_encode(array('type'=> "reultado", "value" => $ret, "ATUACAO" => $ATUACAO, "MULTAS" => $MULTAS ,
            'LEVES' => $LEVES, "GRAVES" => $GRAVES, "MUITOGRAVES" => $MUITOGRAVES )); die($e); 
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
           PrintTable::loadBDTable( $remane, TRUE,array(),"ID","class='ListHeight' style='max-height:700px'");
       }
    elseif (isset($_POST['type']) && $_POST['type'] == "loadDadosPontoMap") 
    {
           include '../../Utilities/modelo/Utilizador.php';
           include '../../Utilities/validacao/Session.php'; session_start();
           include '../../Utilities/conexao/CallPgSQL.php';
           include '../../Utilities/conexao/Conectar.php';
           loadDadosPontoMap();
    }
    elseif (isset($_POST['type']) && $_POST['type'] == "loadDataInfracao") 
    {
           include '../../Utilities/modelo/Utilizador.php';
           include '../../Utilities/validacao/Session.php'; session_start();
           include '../../Utilities/conexao/CallPgSQL.php';
           include '../../Utilities/conexao/Conectar.php';
           loadDadosFiscalizacao();
    }
       
    function loadDadosPontoMap()
    { //CARTA	MATRICULA GRAVIDADE	EQUIPA	OPERACAO	P.CARTA	P.CONDUTOR	P.VEICULO	P.LIVRETE
        CallPgSQL::functionTable("adm.funct_ver_dados", "*", array(Session::getUserLogado()->getIdUtilizador(),$_POST["timer"], $_POST['LATITUDE'], $_POST['LONGITUDE']));
        $ret = "";
        while ($row2 = CallPgSQL::getValors())
        {
            $ret .= ' <section var="'.$row2['ID'].'" class="'.$row2['GRAVIDADE'].'" >';
            $ret .= " <article class='areaInfo'>";
            $ret .= "     <label>".$row2['MATRICULA']."</label>";
            if( $row2['CARTA'] != "" ) { $ret .= "<label>".$row2['CARTA']."</label>"; }
            $ret .= " </article>";
            $ret .= "<article class='areaImg'>";
            if( $row2['P.CARTA'] == "1" ) { $ret .= "<img src='../resources/img/carta.png'>"; }
            if( $row2['P.CONDUTOR'] == "1" ) { $ret .= "<img src='../resources/img/condutor.png'>"; }
            if( $row2['P.LIVRETE'] == "1" ) { $ret .= "<img src='../resources/img/livrete.png'>"; }
            if( $row2['P.VEICULO'] == "1" ) { $ret .= "<img class='veiculo' src='../resources/img/veiculo.png'>"; }
            if( $row2['P.CARTA'] != "1" && $row2['P.CONDUTOR'] != "1" && $row2['P.LIVRETE'] != "1" &&  $row2['P.VEICULO'] != "1")
            { $ret .= '<label class="noAprencao"></label>'; }
            $ret .= " </article>";
            $ret .= ' </section>';
        } $e = json_encode(array('type'=> "reultado", "value" => $ret)); die($e);
    }
    
   function loadDadosFiscalizacao()
    { 
        $CODIGOFISCALIZACAO = "";
        $MATRICULA = ""; $CARTA = ""; $CATEGORIAVEICULO = ""; $CONDUTOR = ""; $ALOCACAO = ""; $ZONA = ""; $ESTADOPAGAMENTO = ""; $MULTA = "";
        $INCOMPATIBLIDADECARTA = "";  $ESTADOCONDUTOR = ""; $EXISTENCIACARTA = ""; $EXISTENCIALIVRETE = ""; $DATA_REGISTRO = "";
        
        CallPgSQL::functionTable("adm.funct_get_fisca_all_information", "*", array($_POST["idFisca"]));
        while ($row2 = CallPgSQL::getValors())
        {
            $CODIGOFISCALIZACAO = $row2['CODIGO FISCALIZACAO'];
            $MATRICULA = $row2['MATRICULA'];
            $CARTA = $row2['CARTA'];
            $CATEGORIAVEICULO = $row2['CATEGORIA VEICULO'];
            $CONDUTOR = $row2['CONDUTOR'];
            $ALOCACAO = $row2['ALOCACAO'];
            $ZONA = $row2['ZONA'];
            $ESTADOPAGAMENTO = $row2['ESTADO PAGAMENTO'];
            $MULTA = $row2['MULTA'];
            $INCOMPATIBLIDADECARTA = $row2['INCOMPATIBLIDADE CARTA'];
            $ESTADOCONDUTOR = $row2['ESTADO CONDUTOR'];
            $EXISTENCIACARTA = $row2['EXISTENCIA CARTA'];
            $EXISTENCIALIVRETE = $row2['EXISTENCIA LIVRETE'];
            $DATA_REGISTRO = $row2['DATA_REGISTRO'];
        } 
        
        $INFRACAO = array(); $INTRUMENTOJURIDICO = array(); $VALORAPLICADO = array(); $GRAVIDADE = array(); $TIPOINFRACAO = array();
//        INFRACAO	INTRUMENTO JURIDICO	VALOR APLICADO	GRAVIDADE	TIPO INFRACAO
        CallPgSQL::functionTable("adm.funct_load_detencao_fisca_infra", "*", array($_POST["idFisca"],Session::getUserLogado()->getIdUtilizador()));
        while ($row2 = CallPgSQL::getValors())
        {
            $INFRACAO[count($INFRACAO)] = $row2['INFRACAO'];
            $INTRUMENTOJURIDICO[count($INTRUMENTOJURIDICO)] = $row2['INTRUMENTO JURIDICO'];
            $VALORAPLICADO[count($VALORAPLICADO)] = $row2['VALOR APLICADO'];
            $GRAVIDADE[count($GRAVIDADE)] = $row2['GRAVIDADE'];
            $TIPOINFRACAO[count($TIPOINFRACAO)] = $row2['TIPO INFRACAO'];
        }
        
        $e = json_encode(array('type'=> "reultado", "CODIGOFISCALIZACAO"  => $CODIGOFISCALIZACAO, "MATRICULA" => $MATRICULA, "CARTA" => $CARTA,
            "CATEGORIAVEICULO" => $CATEGORIAVEICULO, "CONDUTOR" => $CONDUTOR, "ALOCACAO" => $ALOCACAO, "ZONA" => $ZONA, "ESTADOPAGAMENTO" => $ESTADOPAGAMENTO, "MULTA" => $MULTA,
        "INCOMPATIBLIDADECARTA" => $INCOMPATIBLIDADECARTA,  "ESTADOCONDUTOR" => $ESTADOCONDUTOR, "EXISTENCIACARTA" => $EXISTENCIACARTA, "EXISTENCIALIVRETE" => $EXISTENCIALIVRETE, "DATA_REGISTRO" => $DATA_REGISTRO,
            "INFRACAO"  => $INFRACAO, "INTRUMENTOJURIDICO" => $INTRUMENTOJURIDICO,
            "VALORAPLICADO" => $VALORAPLICADO, "GRAVIDADE" => $GRAVIDADE, "TIPOINFRACAO" => $TIPOINFRACAO)); die($e);
    } 
    
   function loadDadosCoimaInformation()
    { 
        $INFRACAO = array(); $INTRUMENTOJURIDICO = array(); $VALORAPLICADO = array(); $GRAVIDADE = array(); $TIPOINFRACAO = array();
//        INFRACAO	INTRUMENTO JURIDICO	VALOR APLICADO	GRAVIDADE	TIPO INFRACAO
        CallPgSQL::functionTable("adm.funct_get_infracao_all_information", "*", array($_POST["idFisca"]));
        while ($row2 = CallPgSQL::getValors())
        {
            $INFRACAO[count($INFRACAO)] = $row2['INFRACAO'];
            $INTRUMENTOJURIDICO[count($INTRUMENTOJURIDICO)] = $row2['INTRUMENTO JURIDICO'];
            $VALORAPLICADO[count($VALORAPLICADO)] = $row2['VALOR APLICADO'];
            $GRAVIDADE[count($GRAVIDADE)] = $row2['GRAVIDADE'];
            $TIPOINFRACAO[count($TIPOINFRACAO)] = $row2['TIPO INFRACAO'];
        } $e = json_encode(array('type'=> "reultado", "INFRACAO"  => $INFRACAO, "INTRUMENTOJURIDICO" => $INTRUMENTOJURIDICO,
            "VALORAPLICADO" => $VALORAPLICADO, "GRAVIDADE" => $GRAVIDADE, "TIPOINFRACAO" => $TIPOINFRACAO)); die($e);
    } 