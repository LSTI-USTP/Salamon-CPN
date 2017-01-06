<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        include '../../Utilities/conexao/CallPgSQL.php';
        include '../../Utilities/conexao/Conectar.php';
        
        CallPgSQL::functionTable("adm.funct_load_fiscalizacao_realtime_map", "*", array(5,10000));
        $i = 0;$j = 0;
        $ret = "";
        $ret2 = "";
        $numRo = CallPgSQL::getNumRow();
        while ($row = CallPgSQL::getValors()) 
        {
            if($i == 0) { $ret = $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["GRAVIDADE"].":::".$i; }
            else { $ret .= ";;;". $row["LATITUDE"].":::".$row["LONGITUDE"].":::".$row["GRAVIDADE"].":::".$i;}
            
            
            $sql = "SELECT * FROM adm.funct_ver_dados(". 5 .",". 10000 .",". $row['LATITUDE'] .",". $row['LONGITUDE'] .")";
            $quarey = pg_query($sql);
            $j =0;
            while ($row2 = pg_fetch_array($quarey,NULL,PGSQL_ASSOC))
            {
                if($j == 0)
                { $ret2 .= "Carta ".$row2["CARTA"]."\nMatricula: ".$row2["MATRICULA"]."\nEquipa: ".$row2["EQUIPA"]."\n Agente: ".$row2["AGENTE"].":::".$i; }
                else
                {  $ret2 .= "---Carta ".$row2["CARTA"]."\nMatricula: ".$row2["MATRICULA"]."\nEquipa: ".$row2["EQUIPA"]."\n Agente: ".$row2["AGENTE"].":::".$i; }
                $j++;
            }
            if($j==0)
            {  $ret2 .=  ";;; ::: ::: ::: "; }
            
            $i++;
            if($i != $numRo) { $ret2 .= ";;;"; }
        }
        
//        echo '<label style="color:red">'.$ret."</label><br>";
//        echo '<label>'.$ret2."</label><br>";
        
        $arrCordenadas = explode(";;;", $ret);
        $arrCordenadasDes = explode(";;;", $ret2);
        
        echo '<label style="color:red">'. count($arrCordenadas)."</label><br>";
        echo '<label>'.count($arrCordenadasDes)."</label><br>";
//        echo $ret2;
        echo '<table border="2" >';
        for ($index = 0; $index < count($arrCordenadas); $index++) {
            echo "<tr>";
            echo "<td>".$arrCordenadas[$index]."</td>";
            echo "<td>";
            echo '<table border="3" >';
            $ar = explode("---", $arrCordenadasDes[$index]);
            for ($i1 = 0; $i1 < count($ar); $i1++) {
                echo "<tr>";
                echo "<td>".$ar[$i1]."</td>";
                echo "<tr>";
            }
            echo '</table>';
            echo "</td>";
            echo "</tr>";
        }
        echo '</table>';
        ?>
    </body>
</html>
