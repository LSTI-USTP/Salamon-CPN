<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['type']))
{
    include "../../../Utilities/conexao/CallPgSQL.php";
    include "../../../Utilities/conexao/Conectar.php";
    include "../../../Utilities/modelo/Utilizador.php";
    include "../../../Utilities/validacao/Session.php";
    
    session_start();
    if($_POST['type'] == "init" )
    {
        inicilize();
    }
    elseif($_POST['type'] == "infraDetalhes" )
    {
        showDetalhesPagento($_POST["tView"],$_POST["idInfra"]);
    }
    elseif($_POST['type'] == "detalhesMulta" )
    {
        getDetalhesCoimasInfracao($_POST["numMulta"]);
    }
    elseif($_POST['type'] == "regDeposito" )
    {
        regDeposito();
    }
    elseif($_POST['type'] == "detalhesTypeInfrator" )
    {
        getDetalhesInfrator();
    }
    elseif($_POST['type'] == "pesquisaInfrator")
    {
        pesquisaInfracao();
    }
    elseif($_POST['type'] == "regPagamento")
    {
        regPagemento();
    }
}
function showDetalhesPagento($pesquisa,$idInfra) {
    $valore = "";
    CallPgSQL::functionTable("pay.funct_load_fiscalizacao",  "*" , array(Session::getUserLogado()->getIdUtilizador(),$idInfra,$_POST["typeInfrator"]));
    
    while ($row = CallPgSQL::getValors()) {
//        ID	CODIGO	VALOR	DATA FISCALIZACAO	DATA PAGAMENTO	ESTADO
        if ($pesquisa == "Todas") {
            $valore .= '<section '.(($row["ESTADO"] == "0") ? 'class="is-payed"' : '' ) . '>
                    <nav>
                        <h4 title="Código da multa">'.$row['CODIGO'].'</h4>
                        <i class="transition-4" onclick="showMoreDetalhesMulta(\''.$row['ID'].'\')" >i</i>
                    </nav>
                    <label><span>'.$row['DATA FISCALIZACAO'].'</span><span>- '.$row['DATA PAGAMENTO'].'</span></label>
                    <h1>'.getValueFormated($row['VALOR']).' STD</h1>
                </section>';
        } elseif ($pesquisa == "Não pagas" && $row["ESTADO"] == "1") {
            $valore .= '<section>
                    <nav>
                        <h4 title="Código da multa">'.$row['CODIGO'].'</h4>
                        <i class="transition-4" onclick="showMoreDetalhesMulta(\''.$row['ID'].'\')" >i</i>
                    </nav>
                    <label><span>'.$row['DATA FISCALIZACAO'].'</span><span>- '.$row['DATA PAGAMENTO'].'</span></label>
                    <h1>'.getValueFormated($row['VALOR']).' STD</h1>
                </section>';
        } elseif ($pesquisa == "Pagas" && $row["ESTADO"] == "0" ) {
            $valore .= '<section class="is-payed" >
                    <nav>
                        <h4 title="Código da multa">'.$row['CODIGO'].'</h4>
                        <i class="transition-4" onclick="showMoreDetalhesMulta(\''.$row['ID'].'\')" >i</i>
                    </nav>
                    <label><span>'.$row['DATA FISCALIZACAO'].'</span><span>- '.$row['DATA PAGAMENTO'].'</span></label>
                    <h1>'.getValueFormated($row['VALOR']).' STD</h1>
                </section>';
        }
    }
    
    if($valore == "")
    { $valore = "<h1>Sem registros</h1>"; }
    
    $valores = showViewForPay($idInfra);
    
    $e = json_encode(array('type'=> "result", "value" => $valore ,"value1" => $valores, "php_erro" => pg_last_error())); die($e);
}

function showViewForPay($idInfrator)
{
    $valores = "";
    CallPgSQL::functionTable("pay.funct_load_fiscalizacao",  "*" , array(Session::getUserLogado()->getIdUtilizador(),$idInfrator,$_POST["typeInfrator"]));
    while ($row = CallPgSQL::getValors()) {
//        ID	CODIGO	VALOR	DATA FISCALIZACAO	DATA PAGAMENTO	ESTADO
        if ($row["ESTADO"] == "1") {
            $valores .= "<section>
                        <label>".$row['CODIGO']."</label>
                        <label>Multa adequerida em ".$row['DATA FISCALIZACAO'].".</label>
                        <label>".  getValueFormated($row['VALOR'])." STD</label>
                        <label><button var='".$row['VALOR']."' varId='".$row['ID']."' ></button></label>
            </section>";
        }
    }
    return $valores;
}

function getDetalhesCoimasInfracao($idMulta)
{
    $valueCaoima = "<div> <nav><b>Valor de Coima</b></nav>";
    $descricaoCaoima = "<div><nav><b>Multa ".$idMulta."</b></nav><ul>";
    
    CallPgSQL::functionTable("pay.funct_load_infracao_fiscalizacao", "*", array(Session::getUserLogado()->getIdUtilizador(), $idMulta));
//    ID INFACAO	INFRACAO	ID GRAVIDADE	VALOR
    while ($row = CallPgSQL::getValors())
    {
        $valueCaoima .= "<xpert>".$row['VALOR']." STD</xpert>";
        $descricaoCaoima .= "<li>".$row['INFRACAO']."</li>";
    }
    
    $valueCaoima .= "</div>";
    $descricaoCaoima .= "</ul></div>";
    
    $e = json_encode(array('type'=> "result", "value" => $valueCaoima ,"value1" => $descricaoCaoima)); die($e);
}

function regDeposito()
{
//    {type: "regDeposito",type_I:(($("#typeInfrator").text() !== "VEICULO") ? 1 : 2),data_P: $("#dataPayment").val(), type_P: $("#typePayment").val(),
//     num_P: $("#num-doc").val(), value_P: unformatted($("#total-deposit").val())},
    CallPgSQL::simplesFuncion("pay.func_reg_deposito", array(Session::getUserLogado()->getIdUtilizador(),  CallPgSQL::toDateSQL($_POST['data_P']), $_POST['type_P'], CallPgSQL::toVarchar($_POST['num_P']),
                                                            $_POST['value_P'], $_POST['type_I'], $_POST['idInfrator'], 1, 1));
//    echo CallPgSQL::getSql();
    foreach (CallPgSQL::getValors() as $value)
    {
        $re = explode(";",$value);
        if($re[0] == "true")
        { $e = json_encode(array('type'=> "sucesso", "value" => $re[1] )); die($e); }
        else 
        {  $e = json_encode(array('type'=> "erro", "msg" => $re[1] )); die($e); }
    }
}

//function existenteDeposito($return)
//{
////    data_P: $("#dataPayment").val(), type_P: $("#typePayment").val(), num_P: $("#num-doc").val(), value_P: unformatted($("#total-deposit").val())
//    if($return == TRUE)
//    { $e = json_encode(array('type'=> "result", "value" => $valueCaoima ,"value1" => $descricaoCaoima)); die($e); }
//}

function getDetalhesInfrator()
{
//    MULTAS	TOTAL MULTAS	PAGAR	TOTAL PAGAR	DEPOSITO	TOTAL DEPOSITO	ESTADO CARTA	ESTADO LIVRETE	ESTADO VEICULO
    $MULTAS =""; $TOTALMULTAS=""; $PAGAR=""; $TOTALPAGAR=""; $DEPOSITO=""; $TOTALDEPOSITO=""; $ESTADOCARTA="";	$ESTADOLIVRETE="";	$ESTADOVEICULO="";
    CallPgSQL::functionTable("pay.funct_load_state_infrator", "*", array(Session::getUserLogado()->getIdUtilizador(),$_POST["idInfra"],$_POST["typeInfrator"]));
    while ($row = CallPgSQL::getValors())
    {
        $MULTAS = $row['MULTAS'];
        $TOTALMULTAS= $row['TOTAL MULTAS'];
        $PAGAR= $row['PAGAR'];
        $TOTALPAGAR= $row['TOTAL PAGAR'];
        $DEPOSITO= $row['DEPOSITO'];
        $TOTALDEPOSITO= $row['TOTAL DEPOSITO'];
        $ESTADOCARTA= $row['ESTADO CARTA'];
        $ESTADOLIVRETE= $row['ESTADO LIVRETE'];
        $ESTADOVEICULO= $row['ESTADO VEICULO'];
    }
    
    $MULTASPagas = $TOTALMULTAS - $MULTAS;
    
    $e = json_encode(array('type'=> "result", "multasNaoPagas" => $MULTAS ,"multasPagas" => $MULTASPagas,"multasAqui" => $TOTALMULTAS,
                            "totalPagar" => $PAGAR,"deposito" => $DEPOSITO, "eCarta" => (($ESTADOCARTA == NULL) ? "" :$ESTADOCARTA) ,
                            "eLivrete" => (($ESTADOLIVRETE == NULL) ? "" :$ESTADOLIVRETE), "eVeiculo" => (($ESTADOVEICULO == NULL) ? "" :$ESTADOVEICULO))); die($e);
}

function getValueFormated($value)
{ return number_format($value, 2, ',', ' '); }

function inicilize()
{
    CallPgSQL::simplesSelect("ver_forma_pagamentos", "*");
    $carregar = "<option value=''>"."(Selecione)"."</option>";
    while ($rs = CallPgSQL::getValors())
    {
        $carregar .= "<option value='".$rs['ID']."'>".$rs['FORMA']."</option>";
    }
    $e = json_encode(array('type'=> "result","value" => $carregar)); die($e);
}

function pesquisaInfracao()
{
    $valores = "";
    include '../../../Utilities/validacao/PrintTable.php';
    if(!empty($_POST["pesquisa"]))
    {
        $remane = array("INFRATOR" => "","NUMERO"  => "","MULTAS"  => "","TOTAL PAGAR" => "","TOTAL FISCALIZACAO"  => "");
        PrintTable::PrintTableShearch("pay.ver_infratores", $_POST["pesquisa"], $remane, PrintTable::typeSelect);
    }
    else { CallPgSQL::simplesSelect("pay.ver_infratores", "*"); }
    
    while ($row = CallPgSQL::getValors())
    {
        $valores .= "<tr value='".$row["VALOR"]."' id='".$row["ID"]."' onclick='clickEx(this)' onmouseenter='mouseenterEx(this);' mouseleave='mouseLeaveEx(this);' >"
        ."<td>"
        .'<i class = "icon-info show-info" onclick="pShowInfor(this)"></i>'
        .'<i class = "icon-box-add start-payment" onclick="pStartPagamento(this)" title = "Novo depósito"></i>'
        ."</td>"
        ."<td>" . $row["INFRATOR"] . "</td>"
        ."<td>" . $row["NUMERO"] . "</td>"
        ."<td>" . $row["MULTAS"] . "</td>"
        ."<td>" . $row["TOTAL PAGAR"] . "</td>"
        ."<td>" . $row["TOTAL FISCALIZACAO"] . "</td>"
        ."</tr>";
    }
    
    $e = json_encode(array('type'=> "result", "value" => $valores)); die($e);
}

function regPagemento()
{
    $idsFisca = explode(";;", $_POST["idFisca"]);
    $re = array();
    foreach ($idsFisca as $idFisca)
    {
        CallPgSQL::simplesFuncion("pay.func_reg_payment", array(Session::getUserLogado()->getIdUtilizador(), $idFisca));
        foreach (CallPgSQL::getValors() as $value)
        {  $re = explode(";",$value); }
    }
    if($re[0] == "true")
    { $e = json_encode(array('type'=> "sucesso", "value" => "Novo de Pagamento de Fiscalização Registrado com sucesso!" )); die($e); }
    else 
    {  $e = json_encode(array('type'=> "erro", "msg" => $re[1] )); die($e); }
}