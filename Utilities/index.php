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
            include_once './conexao/Conectar.php';
            include_once './conexao/CallPgSQL.php';
////            pg_query_params()
////            if (mysqli_connect_errno()) die(mysqli_connect_error());
////
////            $sql  = "INSERT INTO articles (title, body, date) VALUES (?, ?, NOW())";
////            $stmt = $con->prepare($sql);
////            $ok   = $stmt->bind_param("ss", $_POST[title], $_POST[body]);
////            pg_last_error();
//            
////            select pay.func_reg_deposito(5, to_Date('12-02-2016','DD-MM-YYYY') ,301 ,'44444'::CHARACTER VARYING ,200000 ,1 ,26 ,1 ,1 )
//            
//            
//       CallPgSQL::Connect("DBA", "agente", "1234", "policia", "5432");
//       $ddd = '$1';
//       $result = pg_prepare(CallPgSQL::getCon(), "my_query", "select pay.func_reg_deposito($1, $2 ,$3 ,$4 ,$5 ,$6 ,$7 ,$8 ,$9 )");
//
//        // die vorbereitete Abfrage ausführen. Beachten Sie, dass es
//        // nicht nötig ist, den String "Joe's Widgets" zu maskieren.
////        echo pg_escape_string(CallPgSQL::toDateSQL("10-12-2015"));
//        $result = pg_execute(CallPgSQL::getCon(), "my_query", array(5, "12-02-2016" ,301 ,  "444444" ,200000 ,1 ,26 ,1 ,1));

//            CallPgSQL::simplesFuncion("pay.func_reg_deposito", array(5, "12-02-2016" ,301 ,  "444444" ,200000 ,1 ,26 ,1 ,1));
            
//            CallPgSQL::functionTable("adm.func_login", "*",array("0000","0000"));
//            
//            echo CallPgSQL::existValue("adm.ver_agent_funcao","USE_DIVICE","1");
            
            CallPgSQL::simplesSelect("adm.ver_agent_funcao", "*", array("FUNCAO;>"=>"equipa%","FUNCAO;OR;like"=>"equipa%"));
            echo CallPgSQL::getNumRow();
            echo CallPgSQL::getSql();
////            

//            $dd = array("dd");
//            if(isset($dd[0]))
//            {
//                echo 'false';
//            }
//            else
//            {
//                echo 'true';
//            }
//            
//            while ($row = CallPgSQL::getValors())
//            {
//                echo '<br>';
//                echo '<br>';
//                foreach ($row as $key => $value) {
//                    echo $key.' - '.$value.'<br>';
//                }
//
//            }
////        
//         foreach (pg_fetch_array($result) as $value)
//        {
//            $re = explode(";",$value);
//            if($re[0] == "true")
////            { $e = json_encode(array('type'=> "sucesso", "value" => $re[1] )); die($e); }
//                echo 'true';
//            else 
////            {  $e = json_encode(array('type'=> "erro", "msg" => $re[1] )); die($e); }
//                echo 'false';
//        }
//        
////        pg_last_error();
//        // Dieselbe Abfrage mit einem anderen Parameter nochmal ausführen
////        $result = pg_execute(CallPgSQL::getCon(), "my_query", array("Clothes Clothes Clothes"));     
//       
            
//            $dd = array(2,1);
//            $ddd = array(2,"dd" => 4,1,10);
//            
//            $aa = array_merge($dd, $ddd);
//            
//            foreach ($aa as $key => $value) 
//            {
//                echo $key." -- ".$value ."<br>";
//            }
//            
//            if($dd == array(2))
//            {
//                echo 'true';
//            }
//            else
//                echo 'false';
//                
//        echo ;
//        ?>
    </body>
</html>
