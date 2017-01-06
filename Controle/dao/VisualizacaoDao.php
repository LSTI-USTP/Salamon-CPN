<?php

/**
 * Description of VisualizacaoDao
 *
 * @author Helcio Guadalupe
 */
class VisualizacaoDao {

    //put your code here

    function carregarInfo($infracao, $valores) {
        CallPgSQL::simplesSelect("adm.ver_infracao","*", array("NOME;Like" => "$infracao%"));

        $pesArray = array();

        if (!$infracao == "") 
        {
            while($linha=CallPgSQL::getValors())
            {
                $pesArray[$linha['ID']]=$linha['NOME'];
            }
        }

        $prinArray = PrintTable::createArray($valores);
        
         PrintTable::printResult($pesArray, $prinArray, (($infracao == "") ? FALSE : TRUE));
    }

}
