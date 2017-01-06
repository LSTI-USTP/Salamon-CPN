<?php


/**
 * Description of Relatorio
 *
 * @author Helcio Guadalupe
 */
class Relatorio 
{
    //put your code here
    private $dataInicio;
    private $dataFim;
    private $valorPesquisa;
    private $agrupar;
    function __construct($dataInicio, $dataFim, $valorPesquisa, $agrupar) {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->valorPesquisa = $valorPesquisa;
        $this->agrupar = $agrupar;
    }

        function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function getValorPesquisa() {
        return $this->valorPesquisa;
    }
    function getAgrupar() {
        return $this->agrupar;
    }


    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    function setValorPesquisa($valorPesquisa) {
        $this->valorPesquisa = $valorPesquisa;
    }

    function setAgrupar($agrupar) {
        $this->agrupar = $agrupar;
    }



}
