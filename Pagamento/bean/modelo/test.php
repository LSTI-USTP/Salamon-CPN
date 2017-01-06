<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$dd ="dhdh dhdh";
//$ff= array("ahmed@dhgd.cdgd","9288855","jorge","dgdggdgd",2);
//
include './Query.php';
include '../conexao/Conectar.php';
include '../conexao/typeConneted.php';
////include './ClienteSocket.php';
//
$d= new Query();
//"FUNC_REG_CONTACTO", array("ahmed@dhgd.cdgd","0001000","jorge","dgdggdgd",2)
$d->simplesSelect("t_agente","*");
//
//$d->simplesSelect("t_contacto","*",NULL);

echo "<table border='1'>";
while ($df=$d->getValors())
{
    echo '<tr>';
    foreach ($df as $ddd)
    {
        echo "<td>".$ddd."</td>";
    }
    echo '</tr>';
}
echo '</table>';
//$conn = oci_connect("system", "qwert", "//kadafi/xe");
//$query = 'select * from ALL_USERS';
//$stid = oci_parse($conn, $query);
//$r = oci_execute($stid);
//
//// Fetch each row in an associative array
//print '<table border="1">';
//while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
//   print '<tr>';
//   foreach ($row as $item) {
//       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
//   }
//   print '</tr>';
//}
//print '</table>';


//include './ClienteSocket.php';

//new ClienteSocket();
    
