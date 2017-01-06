<?php
    header('Content-type: text/html; charset=UTF-8');
   
    if(isset($_POST['type']))
    {
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        include '../../Utilities/validacao/Validation.php';
        include '../dao/EquipaDao.php';
        include '../../Utilities/validacao/PrintTable.php';
        include '../modelo/Equipa.php';
        include '../../Utilities/modelo/Utilizador.php';

        $equipaDao = new EquipaDao();
        $operacao = $_POST['type'];
        if($operacao=="8")
        {
            $equipa = new Equipa();
            $equipa->setIdtipoFiscalizacao($_REQUEST['tipoFiscalizacao']);
            $equipa->setIdZona($_REQUEST['zona']);
            $equipa->setNumAgente($_REQUEST['numAgente']);
            $equipa->setOutrasInf($_REQUEST['outrasInf']);
            $equipa->setDistrito($_REQUEST['distrito']);
            $equipa->setListaAlocacao($_REQUEST['tableData']);
        }
        
        switch ($operacao)
        {
            case "1":
                CallPgSQL::loadComboBox("adm.ver_tipo_equipa", "ID", "EQUIPA");
                break;
            case "2":
                 CallPgSQL::loadComboBox("ver_destrito", "ID", "DESTRITO");
                 break;
            case "3":
                 CallPgSQL::loadComboBox("adm.ver_morada where \"ID SUPER\" = '".$_POST['idDistr']."'", "ID", "MORADA");
                 break;
            case "4":
                 EquipaDao::carregarAgentes();
                 break;
            case "5":
//                 CallPgSQL::loadComboBox("adm.ver_agent_funcao", "ID", "FUNCAO");
                    CallPgSQL::simplesSelect("adm.ver_agent_funcao", "*");
                    echo "<option value=''>"."(Selecione)"."</option>";
                    while ($linha=  CallPgSQL::getValors())
                    {
                        echo "<option var='$linha[USE_DIVICE]' value='$linha[ID]::$linha[FUNCAO]'>".$linha['FUNCAO']."</option>";
                    }
                    CallPgSQL::closeConexao();
                 break;  
            case "6":
                $equipaDao->carregarDispositivo($_POST['codigoAgente']);
                break;
            default :
//                type:7,tipoFiscalizacao:$("#equipaTipo").val(),distrito:$("#equipaDistrito").val(),zona:$("#equipaZona").val(),
//                outrasInf:$("#equipaOutrasInf").val(),numAgente:$("#equipaNumeroAgente").val(),
//                tableData:infoTable
                $equipa = new Equipa();
                $equipa->setDistrito($_POST['distrito']);
                $equipa->setIdtipoFiscalizacao($_POST['tipoFiscalizacao']);
                $equipa->setIdZona($_POST['zona']);
                $equipa->setOutrasInf($_POST['outrasInf']);
                $equipa->setListaAlocacao($_POST['tableData']);
                $equipa->setNumAgente($_POST['numAgente']);
                $equipaDao->registrarEquipa($equipa);
                break;
        }
    }
    
    

