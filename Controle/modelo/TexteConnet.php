<?php
echo'<head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../../resources/css/X-alert.css">
        <link rel="stylesheet" type="text/css" href="../../resources/css/fonts.css">
        
        <link rel="stylesheet" type="text/css" href="../../resources/css/controle/estiloMenus.css">
        <link rel="stylesheet" type="text/css" href="../../resources/css/controle/styleGeral.css">

        
  </head>';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TexteConnet
 *
 * @author AhmedJorge
 */
CallPgSQL::simplesSelect("adm.ver_agente_disponivel", "*");

//$reulteDB =& CallPgSQL::getValors();
//ID	NOME COMPLETO	CODIGO APLICAÇAO	APLICAÇAO	NIVEL	DATA INICIO	ESTADO
//7	""	7	Fiscalização	Administrador	2016-04-01 18:59:38.382	ativo

//while ($array = $reulteDB) {
//    foreach ($array as $key => $value) 
//    {
//        echo $value;
//    }
//}
//ID	AGENTE	CODIGO	ESQUADRA
//27	Emanuel Costa	737829	DBA Center

$remane =  array("ID" => "Numero","AGENTE"=>"Agente","CODIGO"=>"Codigo", "ESQUADRA"=>"Esquadra");
$parametro =  array("ID","AGENTE","CODIGO", "ESQUADRA");
$acao =  array("icon-pencil;Editar"=>'ddd(\'?\')',"icon-info;Mais Informaçãoes"=>'ddd(\'?\')',"icon-cancel-circle;Desativar"=>'ddd(\'?\')');

PrintTable::loadBDTable($parametro, $remane, TRUE,$acao,"ID","cellpadding=\"15\" cellspacing=\"0\"");

//$String ="?djdjjd?";
//$StringD ="";
//
//$StringD = str_replace( "?", " Ahmed", $String);
//
//echo $StringD;


//$users_array = array(
//    "total_users" => 3,
//    "users" => array(
//        array(
//            "id" => 1,
//            "name" => "Nitya",
//            "address" => array(
//                "country" => "India",
//                "city" => "Kolkata",
//                "zip" => 700102,
//            )
//        ),
//        array(
//            "id" => 2,
//            "name" => "John",
//            "address" => array(
//                "country" => "USA",
//                "city" => "Newyork",
//                "zip" => "NY1234",
//            ) 
//        ),
//        array(
//            "id" => 3,
//            "name" => "Viktor",
//            "address" => array(
//                "country" => "Australia",
//                "city" => "Sydney",
//                "zip" => 123456,
//            ) 
//        ),
//    )
//);

////function defination to convert array to xml
//function array_to_xml($array, &$xml_user_info) {
//    foreach($array as $key => $value) {
//        if(is_array($value)) {
//            if(!is_numeric($key)){
//                $subnode = $xml_user_info->addChild("$key");
//                array_to_xml($value, $subnode);
//            }else{
//                $subnode = $xml_user_info->addChild("item$key");
//                array_to_xml($value, $subnode);
//            }
//        }else {
//            $xml_user_info->addChild("$key",htmlspecialchars("$value"));
//        }
//    }
//}
//
////creating object of SimpleXMLElement
/*$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");*/
////$xml_user_info->addAttribute($name)
////function call to convert array to xml
//array_to_xml($users_array,$xml_user_info);
//
////saving generated xml file
//$xml_file = $xml_user_info->asXML();
//echo $xml_file;
//
//////success and error message based on xml creation
////if($xml_file){
////    echo 'XML file have been generated successfully.';
////}else{
////    echo 'XML file generation error.';
////}
