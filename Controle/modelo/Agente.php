<?php

/**
 * Description of Agente
 *
 * @author Helcio Guadalupe
 */
class Agente 
{
    private $nome;
    private $apelido;
    private $bi;
    private $nif;
    private $genero;
    private $morada;
    private $dataNasc;
    private $estadoCivil;
    private $nivel;
    private $codigo;
    private $seccao;
    private $dataRecrutamento;
    private $esquadra;
    private $distrito;
    private $categoria;
    
    function getNome() {
        return $this->nome;
    }

    function getApelido() {
        return $this->apelido;
    }

    function getBi() {
        return $this->bi;
    }

    function getNif() {
        return $this->nif;
    }

    function getGenero() {
        return $this->genero;
    }

    function getMorada() {
        return $this->morada;
    }

    function getDataNasc() {
        return $this->dataNasc;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getSeccao() {
        return $this->seccao;
    }

    function getDataRecrutamento() {
        return $this->dataRecrutamento;
    }

    function getEsquadra() {
        return $this->esquadra;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function setBi($bi) {
        $this->bi = $bi;
    }

    function setNif($nif) {
        $this->nif = $nif;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setMorada($morada) {
        $this->morada = $morada;
    }

    function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setSeccao($seccao) {
        $this->seccao = $seccao;
    }

    function setDataRecrutamento($dataRecrutamento) {
        $this->dataRecrutamento = $dataRecrutamento;
    }

    function setEsquadra($esquadra) {
        $this->esquadra = $esquadra;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    

}
