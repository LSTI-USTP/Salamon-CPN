<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfracaoDao
 *
 * @author Helcio Guadalupe
 */
class InfracaoDao 
{
    //put your code here
    
    function registrarInfracao(Infracao $infracao)
    {
        session_start();
        CallPgSQL::simplesFuncion("adm.func_reg_infracao",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getModoInfracao(),
            $infracao->getModoCoima(),$infracao->getCategoria(),$infracao->getNomeInfracao(),$infracao->getDescricao(),
            $infracao->getValorMaximo(),$infracao->getValorMinimo(),$infracao->getNumArtigo(),$infracao->getLinhaArtigo()),$infracao->getInstrumentoJuridico(),$infracao->getPonto());
        foreach (CallPgSQL::getValors() as $value)
        { $resultado = explode(";", $value); }
        CallPgSQL::closeConexao();
        if($resultado[0]=="true")
            $this->registrarCoima ($resultado[1], $infracao);
        else echo $resultado[1];
    }
    /**
     * função que trata do tegistro de infração de uma determinado tipo de coima
     * @param type $idTipoInfracao
     * @param Infracao $infracao
     */
    function registrarCoima($idTipoInfracao,  Infracao $infracao)
    {

        if($infracao->getModoCoima()==2)
        {
			//REGISTRO DE PRIMARIO
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getValorPrimario(),
               2,$idTipoInfracao,1,($infracao->getValorDe()-1))); 
			   
			 //REGISTR DE REINSIDETE
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getValorReincidente(),
                3,$idTipoInfracao,$infracao->getValorDe(),($infracao->getValorA())));
				
			//REGISTRO DE MULT REINSIDETE
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getMultiReincidente(),
                 4,$idTipoInfracao,$infracao->getValorA()+1,null));
			foreach (CallPgSQL::getValors() as $value)
			{
				$resultado = explode(";", $value);
			}
			CallPgSQL::closeConexao();
//			echo $resultado[0];
        }
        else if($infracao->getModoCoima()==3)
        {
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getValorLeve(),
                5,$idTipoInfracao,null,null));
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getValorGrave(),
                6,$idTipoInfracao,null,null));
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getValorMuitoGrave(),
               7,$idTipoInfracao,null,null));
            
            foreach (CallPgSQL::getValors() as $value)
            {
                $resultado=  explode(";", $value);
            }
            CallPgSQL::closeConexao();
//            echo $resultado[0]." ".$resultado[1];
        }
        else
        {
            CallPgSQL::simplesFuncion("adm.func_reg_coima",array(Session::getUserLogado()->getIdUtilizador(),$infracao->getValorPadrao(),
               1,$idTipoInfracao,null,null));
            foreach (CallPgSQL::getValors() as $value)
            {
                $resultado = explode(";", $value);
            }
            CallPgSQL::closeConexao();
//            echo $resultado[0];
        }  
        echo "infração registrada com sucesso";
    }
}
