<?php


if(isset($_POST["typeP"]))
{
    include '../../Utilities/conexao/CallPgSQL.php';
    include '../../Utilities/conexao/Conectar.php';
    include '../../Utilities/validacao/PrintTable.php';
    
    if($_POST["typeP"]=="equipa")
    {
        if(isset($_POST["view"]) && $_POST["view"] == "Em Operação")
        {
//            TIPO	OPERACAO	DISTRITO	ZONA	AGENTES	DURACAO
            $remane =  array("TIPO"=>"Tipo","OPERACAO"=>"Operação", "ZONA"=>"Zona","AGENTES"=>"Agentes", "DURACAO"=>"Duração");
            $acao =  array("icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')',"icon-stop;Terminar Fiscalização"=>'terminarFicalizacao(\'?\')');
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_equipa_emoperacao", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_equipa_emoperacao", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable($remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        if(isset($_POST["view"]) && $_POST["view"] == "Todos")
        {
//            TIPO	OPERACAO	DISTRITO	ZONA	AGENTES	DURACAO
            $remane =  array("TIPO" => "Tipo","OPERACAO" => "Operação","DISTRITO" => "Distrito","ZONA" => "Zona","AGENTES" => "Agentes","DURACAO" => "Duração");
            $acao =  array();
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_equipa_all", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_equipa_all", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable($remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        else if(isset($_POST["type"]) && $_POST["type"] == "paraFisca")
        {
            include '../../Utilities/modelo/Utilizador.php';
            include '../../Utilities/validacao/Session.php';
            session_start();
            CallPgSQL::simplesFuncion("adm.func_terminar_operacao",array(Session::getUserLogado()->getIdUtilizador(),$_POST["idEquipa"]));
            foreach (CallPgSQL::getValors() as $value) 
            {
                $ar = explode(";", $value );
                if($ar[0] == "true")
                { echo 'Operação finalizada com sucesso!'; }
                else
                { echo $ar[1] ; }
            }
        }
    }
    elseif($_POST["typeP"]=="agente")
    {
        if(!isset($_POST["view"]) && $_POST["type"] == "userRedefi")
        {
            include '../../Utilities/modelo/Utilizador.php';
            include '../../Utilities/validacao/Session.php';
            session_start();
            CallPgSQL::simplesFuncion("adm.func_restaurar_utilizador",array(Session::getUserLogado()->getIdUtilizador(),$_POST["idAgente"]));
            foreach (CallPgSQL::getValors() as $value) 
            {
                $ar = explode(";", $value );
                if($ar[0] == "true")
                { $e = json_encode(array('type'=> "sucesso", "msg" => "A palavra-passe do(a) agente foi redefinido com sucesso!")); die($e); }
                else
                { $e = json_encode(array('type'=> "erro", "msg" => $ar[1] )); die($e); }
            }
        }
        else if($_POST["view"] == "Todos")
        {
//           ID	CODIGO	NOME	APELIDO	NIF	DISTRITO	ESQUADRA	REGISTRO	ESTADO
            $remane =  array("CODIGO"=>"Codigo","NOME"=>"Nome", "APELIDO"=>"Apelido","REGISTRO"=>"Registro","ESQUADRA"=>"Esquadra","ESTADO"=>"Estado");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_agente_all", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_agente_all", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable($remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"] == "Em Operação")
        {
//            ID	CODIGO	NOME	APELIDO	OPERACAO	DISTRITO	ZONA	REGISTRO	DURACAO
            echo 'fkfjfjf';
            $remane = array("CODIGO"=>"Codigo","NOME" => "Nome","APELIDO" => "Aplelido" ,"OPERACAO" => "Operação","DISTRITO" => "Distrio","ZONA" => "Zona",
                "REGISTRO" => "Registro", "DURACAO" => "Duração");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]) )
            { CallPgSQL::simplesSelect("adm.ver_agente_emoperacao", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_agente_emoperacao", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable($remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"] == "Livres")
        {
            $remane =  array("CODIGO"=>"Codigo","NOME"=>"Nome","APELIDO"=>"Apelido","NIF"=>"NIF","DISTRITO"=>"Distrito","ESQUADRA"=>"Esquadra","REGISTRO"=>"Registro");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_agente_desponivel_listagem", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_agente_desponivel_listagem", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable($remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"] == "Utilizadores")
        {
            $remane =  array("CODIGO"=>"Codigo","NOME"=>"Nome","APLICACAO" => "Aplicação","ESTADO" => "Esdado", "DATA ACCESSO" => "Data-Acesso");
            $acao =  array("icon-pencil;Editar"=>'editeUser(\'?\',$(this))',"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/,"icon-undo2;Redefinir Senha"=>'userRestar(\'?\')');
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_agente_utilizador", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_agente_utilizador", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");

        }
        elseif($_POST["view"] == "Inativos")
        {
            $remane =  array("CODIGO"=>"Codigo","NOME"=>"Nome", "APELIDO"=>"Apelido","REGISTRO"=>"Registro","ESQUADRA"=>"Esquadra","ESTADO"=>"Estado");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_agente_all", "*",array("ESTADO" => "Inativos")); }
            else
            { PrintTable::PrintTableShearch("adm.ver_agente_all", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable($remane, TRUE,$acao,"ID","class='ListHeight'");
        }
    }
    elseif($_POST["typeP"]=="infracao")
    {
        if($_POST["view"]=="Todos" )
        {
//            ID	NOME	CATEGORIA	IMPUTACAO	COIMA	VALOR	DATA	ESTADO
            $remane =  array("NOME"=>"Nome","CATEGORIA" => "Categoria","IMPUTACAO" => "Imputação", "COIMA" => "Coina","VALOR"=> "Valor","DATA"=>"Data","ESTADO"=>"Estado");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInforInfracao(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_infracao", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_infracao", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"]=="Inativos")
        {
            $remane =  array("NOME"=>"Nome","CATEGORIA" => "Categoria","IMPUTACAO" => "Imputação", "COIMA" => "Coina","VALOR"=> "Valor","DATA"=>"Data","ESTADO"=>"Estado");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInforInfracao(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_infracao", "*",array("ESTADO" => "Inativos")); }
            else
            { PrintTable::PrintTableShearch("adm.ver_infracao", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"]=="Veículos")
        {
            $remane =  array("NOME"=>"Nome","CATEGORIA" => "Categoria", "COIMA" => "Coina","DATA"=>"Data");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInforInfracao(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_infracao_veiculo", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_infracao_veiculo", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"]=="Motorista")
        {
//            ID	NOME	CATEGORIA	COIMA	DATA  adm.ver_infracao_motorista
            $remane =  array("NOME"=>"Nome","CATEGORIA" => "Categoria", "COIMA" => "Coina","DATA"=>"Data");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInforInfracao(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_infracao_motorista", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_infracao_motorista", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
    }
    elseif($_POST['typeP'] == "dispositivo")
    {
        if($_POST["view"] === "Todos")
        {
//            ID	NOME	MARCA	MODELO	VERSAO	CORES	TAMANHO	ESTADO
            $remane =  array("NOME"=>"Nome","MARCA" => "Marca","MODELO" => "Modelo", "VERSAO" => "Versão","TAMANHO"=>"Tamanho","ESTADO"=>"Estado");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_despositivo", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_despositivo", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"] === "Disponíveis")
        {
            $remane =  array("NOME"=>"Nome","MARCA" => "Marca","MODELO" => "Modelo", "VERSAO" => "Verão","CORES"=>"Cores", "TAMANHO" => "Tamanho");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_despositivo_desponivel", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_despositivo_desponivel", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"] === "Em Operação")
        {
            $remane =  array("NOME"=>"Nome","MARCA" => "Marca","MODELO" => "Modelo","AGENTE" => "Agente", "OPERACAO" => "Operação","ZONA" => "Zona");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_despositivo_activo", "*"); }
            else
            { PrintTable::PrintTableShearch("adm.ver_despositivo_activo", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
        elseif($_POST["view"] === "Inativos")
        {
            $remane =  array("NOME"=>"Nome","MARCA" => "Marca","MODELO" => "Modelo", "VERSAO" => "Versão","TAMANHO"=>"Tamanho");
            $acao =  array(/*"icon-pencil;Editar"=>'ddd(\'?\')',*/"icon-info;Mais Informaçãoes"=>'showMoreInfor(\'?\')'/*,"icon-cancel-circle;Desativar"=>'ddd(\'?\')'*/);
            if(empty($_POST["pequis"]))
            { CallPgSQL::simplesSelect("adm.ver_despositivo", "*",  array("ESTADO" => "Inativos")); }
            else
            { PrintTable::PrintTableShearch("adm.ver_despositivo", $_POST["pequis"], $remane, PrintTable::typeSelect); }
            PrintTable::loadBDTable( $remane, TRUE,$acao,"ID","class='ListHeight'");
        }
    }
}
elseif(isset($_POST['type']))
{
    include '../../Utilities/conexao/CallPgSQL.php';
    include '../../Utilities/conexao/Conectar.php';
    if($_POST['type'] == "Equipa-Operação")
    {
        CallPgSQL::functionTable("adm.funct_load_fisca", "*", array($_POST['id']));
        $value = "<p><span>Equipa</span><span1></span1></p>";
        while($i = CallPgSQL::getValors()) 
        {
            foreach ($i as $key => $v)
            { $value .= "<p><span>".$key."</span><span1>".$v."</span1></p>"; }
        }
            
        CallPgSQL::functionTable("adm.funct_load_age_desp", "*", array($_POST['id']));
        $value .= "<p><span>Agentes</span><span1></span1></p>";
        while($i = CallPgSQL::getValors()) 
        {
            $value .= "<p><span>".$i['AGENTE']."</span><span1>".$i['DESPOSITIVO']."</span1></p>";
        }
        $e = json_encode(array('type'=> "result", "value" => $value)); die($e);
    }
    if($_POST['type'] == "informacao-allVeiw")
    {     
        $value = "";
        CallPgSQL::functionTable("adm.funct_get_infracao_all_information", "*", array($_POST['id']));
        while($i = CallPgSQL::getValors()) 
        {
            $value .= "<p><span>Nome</span><span1>".$i['NOME']."</span1></p>";
            $value .= "<p><span>Categoria</span><span1>".$i['CATEGORIA']."</span1></p>";
            $value .= "<p><span>Valor</span><span1>".$i['VALOR']."</span1></p>";
            $value .= "<p><span>Tipo de Coima</span><span1>".$i['MODO_COIMA']."</span1></p>";
            $value .= "<p><span>Tipo de Infração</span><span1>".$i['MODO_INFRACAO']."</span1></p>";
            $value .= "<p><span>Artigo</span><span1>".$i['ARTIGO']."</span1></p>";
            $value .= "<p><span>Linha</span><span1>".$i['ALINEA']."</span1></p>";
            $value .= "<p><span>Estado</span><span1>".$i['ESTADO']."</span1></p>";
            $value .= "<p><span>Data de Registro</span><span1>".$i['DATA_REGISTRO']."</span1></p>";
            $value .= "<p><span>Descrição</span><span1>".$i['DESCRICAO']."</span1></p>";
//            ID	NOME	CATEGORIA	VALOR	MODO_COIMA	MODO_INFRACAO	ARTIGO	ALINEA	DESCRICAO	ESTADO	DATA_REGISTRO
        }
        $e = json_encode(array('type'=> "result", "value" => $value)); die($e);
    }
}
