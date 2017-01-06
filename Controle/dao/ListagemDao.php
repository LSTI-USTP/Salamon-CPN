<?php

class ListagemDao 
{
    

    function relatorioInfracao()
    {

        $renameColumns =  array("NOME" => "NOME","TOTAL" => "TOTAL", "MULTAS" => "MULTAS","PAGO"=>"PAGO",
          "VEICULO TOP"=>"VEICULO TOP","CARTA TOP"=>"CARTA TOP");
       CallPgSQL::functionTable("adm.funct_report_infracao", "*",array(NULL, null));
       PrintTable::loadBDTable($renameColumns, TRUE, $acao= array(),"","class='ListHeight'");
    }
    
    function pesquisarInfracao(Relatorio $relatorio)
    {
        if($relatorio->getDataInicio() === "")
            $relatorio->setDataInicio (null);
        else
        {
            $stringData = strtotime($relatorio->getDataInicio());
            $relatorio->setDataInicio(date("Y-m-d", $stringData));
        }
        if($relatorio->getDataFim() === "")
            $relatorio->setDataFim (null);
        else
        {
            $stringData = strtotime($relatorio->getDataFim());
            $relatorio->setDataFim(date("Y-m-d", $stringData));
        }
        if($relatorio->getValorPesquisa()==null)
        {
             $renameColumns =  array("NOME" => "NOME","TOTAL" => "TOTAL", "MULTAS" => "MULTAS","PAGO" => "PAGO",
               "VEICULO TOP" => "VEICULO TOP","CARTA TOP" => "CARTA TOP");
            CallPgSQL::functionTable("adm.funct_report_infracao", "*", array($relatorio->getDataInicio(),$relatorio->getDataFim()));
            PrintTable::loadBDTable($renameColumns, TRUE, $acao= array(),"","class='ListHeight'");
        }
        else
        {               
            $renameColumns =  array("DATA"=>"DATA","DETENCOES" => "DETENÇÕES","DETENCOES ACUMULADA" => "DETENÇÕES ACUMULADAS",
                "MULTAS" => "MULTAS","MULTA ACUMULADA"=>"MULTA ACUMULADA",
               "PAGOS"=>"PAGOS","PAGO ACUMULADO"=>"PAGO ACUMULADO","ZONA FREQUENCIA"=>"ZONA FREQUÊNCIA");
            
            CallPgSQL::functionTable("adm.funct_report_infracao_detais", "*", array($relatorio->getDataInicio(),$relatorio->getDataFim(),$relatorio->getAgrupar(),$relatorio->getValorPesquisa()));
            PrintTable::loadBDTable($renameColumns, TRUE, $acao= array(),"","class='ListHeight'");
  
        }  
    }
    
    function pesquisarVeiculos(Relatorio $relatorio)
    {
         if($relatorio->getDataInicio() === "")
            $relatorio->setDataInicio (null);
        else
        {
            $stringData = strtotime($relatorio->getDataInicio());
            $relatorio->setDataInicio(date("Y-m-d", $stringData));
        }
        if($relatorio->getDataFim() === "")
            $relatorio->setDataFim (null);
        else
        {
            $stringData = strtotime($relatorio->getDataFim());
            $relatorio->setDataFim(date("Y-m-d", $stringData));
        }
        if($relatorio->getValorPesquisa()==null)
        {
             $renameColumns =  array("MATRICULA" => "MATRICULA","TOTAL FISCALIZACAO" => "TOTAL FISCALIZACAO", "TOTAL MULTAS" => "TOTAL MULTAS","VALOR MULTAS" => "VALOR MULTAS",
               "VALOR PAGO" => "VALOR PAGO","ESTADO VEICULO" => "ESTADO VEICULO");
            CallPgSQL::functionTable("adm.funct_report_veiculo", "*", array($relatorio->getDataInicio(),$relatorio->getDataFim()));
            PrintTable::loadBDTable($renameColumns, TRUE, $acao= array(),"","class='ListHeight'");
        }
        else
        {               
             $renameColumns =  array("MATRICULA" => "MATRICULA","TOTAL FISCALIZACAO" => "TOTAL FISCALIZACAO", "TOTAL MULTAS" => "TOTAL MULTAS","VALOR MULTAS" => "VALOR MULTAS",
               "VALOR PAGO" => "VALOR PAGO","ESTADO VEICULO" => "ESTADO VEICULO");
            
            CallPgSQL::functionTable("adm.funct_report_veiculo", "*", array($relatorio->getDataInicio(),$relatorio->getDataFim(),$relatorio->getAgrupar(),$relatorio->getValorPesquisa()));
            PrintTable::loadBDTable($renameColumns, TRUE, $acao= array(),"","class='ListHeight'");
  
        }  
    }
    function pesquisarCartas(Relatorio $relatorio)
    {
        
    }
    function pesquisarFiscalizacao(Relatorio $relatorio)
    {
        
    }
    
 
    
}
