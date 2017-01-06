<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipa
 *
 * @author Helcio Guadalupe
 */
class Equipa 
{
    private $idtipoFiscalizacao;
    private $idZona;
    private $numAgente;
    private $outrasInf;
    private $distrito;
    private $listaAlocacao;
   
    
    function getIdtipoFiscalizacao() {
        return $this->idtipoFiscalizacao;
    }

    function getIdZona() {
        return $this->idZona;
    }

    function getNumAgente() {
        return $this->numAgente;
    }

    function getOutrasInf() {
        return $this->outrasInf;
    }

    function getDistrito() {
        return $this->distrito;
    }
    
    function getListaAlocacao() {
        return $this->listaAlocacao;
    }

    function setListaAlocacao($listaAlocacao) {
        $this->listaAlocacao = $listaAlocacao;
    }

    
    function setOutrasInf($outrasInf) {
        $this->outrasInf = $outrasInf;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

        function setIdtipoFiscalizacao($idtipoFiscalizacao) {
        $this->idtipoFiscalizacao = $idtipoFiscalizacao;
    }

    function setIdZona($idZona) {
        $this->idZona = $idZona;
    }

    function setNumAgente($numAgente) {
        $this->numAgente = $numAgente;
    }


}
