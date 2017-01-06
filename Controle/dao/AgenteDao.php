<?php

/**
 * Description of AgenteDao
 *
 * @author Helcio Guadalupe
 */
class AgenteDao 
{
    //put your code here
    
    
    function loadData($operacao)
    {
        
        switch ($operacao)
        {
            case "1":
                CallPgSQL::loadComboBox("t_gender", "gen_id", "gen_desc");
                break;
            case "2":
                CallPgSQL::loadComboBox("ver_estado_civil", "ID", "ESTADO");
                break;
            case "3":
                CallPgSQL::loadComboBox("adm.ver_nivel", "ID", "DESCRICAO");
                break;
            case "4":
                CallPgSQL::loadComboBox("ver_seccao", "ID", "SECCAO");
                break;
            case "5":
                CallPgSQL::loadComboBox("ver_destrito ", "ID", "DESTRITO");
                break;
            case "6":
                CallPgSQL::loadComboBox("ver_esquadra where \"ID SUPER\" = '".$_POST['idDetri']."' ", "ID", "ESQUADRA");
                break;
            case "7":
                CallPgSQL::loadComboBox("adm.ver_categoria_funcionario", "ID", "CATEGORIA");
                break;
        }
    }

    
   function regAgente(Agente $agente)
   {
       session_start();
        CallPgSQL::simplesFuncion("adm.func_reg_agente",array($agente->getNivel(),$agente->getGenero(),  Session::getUserLogado()->getIdUtilizador(),$agente->getNome(),
        $agente->getApelido(),$agente->getCodigo(),$agente->getCodigo(),$agente->getNif(),$agente->getBi(),$agente->getMorada(),$agente->getSeccao(),
       $agente->getEsquadra(),$agente->getCategoria(),$agente->getEstadoCivil(),$agente->getDistrito(), $agente->getDataRecrutamento(),$agente->getDataNasc()));
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
