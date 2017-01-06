<?php


/**
 * Description of UtilizadorDao
 *
 * @author Helcio Guadalupe
 */
class UtilizadorDao 
{
    //put your code here
    static function carregarMenu($idAplicacao) // carrega todos os menus da aplicação
    {
        session_start();   
        CallPgSQL::functionTable("adm.funct_load_menu", "*",array(Session::getUserLogado()->getIdUtilizador(),(($idAplicacao=="")? null : $idAplicacao)));
        while($row = CallPgSQL::getValors())
        {
            echo ' <article>';
                echo '<input type="checkbox" class=menuAplicacao id='.$row["ID"].' ></input>';
                echo '<label>'.$row["MENU"].'</label>';
            echo '</article>';
        }
    }   
    static function addUser(Utilizador $utilizador,$idAgente)
    {
        session_start();  
        CallPgSQL::simplesFuncion("adm.func_agente_grant_access", array(Session::getUserLogado()->getIdUtilizador(),
            $idAgente,$utilizador->getAplicacao(),  CallPgSQL::toVarchar("{".$utilizador->getMenuAcesso()."}")));
        foreach (CallPgSQL::getValors() as $value)
       {
           $resultado = $value;
       }
        $resultado = explode(";", $value);
       if($resultado[0] == 'true')
           echo 'true';
       else echo $resultado[1];      
    }
    
    
}
