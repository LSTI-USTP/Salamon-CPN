<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['type']))
{
    include "../../Utilities/conexao/Conectar.php";
    include "../../Utilities/conexao/CallPgSQL.php";
    if($_POST['type']=="loadComobox")
    {
        loadComobox();
    }
    if($_POST['type']=="loadLabel")
    {
        loadLabel();
    }
    if($_POST['type']=="loadLabelP")
    {
        loadLabelP();
    }
    if($_POST['type']=="regUtilitario")
    {
        include "../../Utilities/modelo/Utilizador.php";
        regUtilitario();
    }
    if($_POST['type']=="desaUtilitario")
    {
        desaUtilitario();
    }
}

function loadComobox()
{
//    echo "<li id='$list[ID]' sup_id='$list[SUP_ID]' sup_desc='$list[DESCRICAO_SUPER]' class='liSelected' >$list[DESCRICAO]</li>";
    CallPgSQL::functionTable("adm.funct_load_objecto", "*", array($_POST['sup_id'],NULL));
    echo "<option value=''>$_POST[sup_desc]</option>";
    while ($row = CallPgSQL::getValors()) 
    {
        echo "<option value='$row[ID]'>$row[DESCRICAO]</option>";
    }
}

function loadLabel()
{
    CallPgSQL::functionTable("adm.funct_load_objecto", "*", array($_POST['id'],(($_POST['comoObj'] == "") ? NULL : $_POST['comoObj'])));
    while ($row = CallPgSQL::getValors()) 
    {
        echo "<span><label id='$row[ID]' >$row[DESCRICAO]</label><b onclick=\"desActObj('$row[DESCRICAO]','$row[ID]')\">X</b></span>";
    }
}
function loadLabelP()
{
    CallPgSQL::functionTable("adm.funct_load_objecto", "*", array($_POST['id'],(($_POST['comoObj'] == "") ? NULL : $_POST['comoObj'])), array("DESCRICAO;like" => '%'.$_POST['pesq'].'%'));
    while ($row = CallPgSQL::getValors()) 
    {
        echo "<span><label id='$row[ID]' >$row[DESCRICAO]</label><b onclick=\"desActObj('$row[DESCRICAO]','$row[ID]')\">X</b></span>";
    }
}

function regUtilitario()
{
//   id:$('.liSelected').attr("id"),idSuper:$('#loadSelect').val(),regObj:$('#regObj').val()
    include '../../Utilities/validacao/Session.php'; session_start();
    CallPgSQL::simplesFuncion("adm.func_reg_objecto", array(Session::getUserLogado()->getIdUtilizador() ,  CallPgSQL::toVarchar($_POST['regObj']) ,$_POST['id'] ,  (($_POST['idSuper'] == "") ? NULL : $_POST['idSuper']) ));
    foreach (CallPgSQL::getValors() as $value) 
    {
       $re = explode(";", $value);
       if($re[0]=="true")
       { echo $_POST['regObj']." registrato(a) com sucesso!"; }
       else
       { echo $re[1]; }
    }
}

function desaUtilitario()
{
    CallPgSQL::simplesFuncion("adm.func_desactivar_objecto", array($_POST['obj_id']));
    foreach (CallPgSQL::getValors() as $value) 
    {
        
       $re = explode(";", $value);
       if($re[0] == "true")
       { echo 'desativado(a) com sucesso'; }
       else
       { echo $re[1]; }
    }
}
