<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Infracao
 *
 * @author Helcio Guadalupe
 */
class Infracao 
{
    //put your code here
    private $modoInfracao;
    private $modoCoima;
    private $categoria;
    private $nomeInfracao;
    private $descricao;
    private $valorMinimo;
    private $valorMaximo;
    private $numArtigo;
    private $linhaArtigo;
    private $valorPrimario;
    private $valorReincidente;
    private $MultiReincidente;
    private $valorDe;
    private $valorA;
    private $valorLeve;
    private $valorGrave;
    private $valorMuitoGrave;
    private $valorPadrao;
    private $ponto;
    private $instrumentoJuridico;
    
    function getModoInfracao() {
        return $this->modoInfracao;
    }

    function getModoCoima() {
        return $this->modoCoima;
    }

    function getValorPadrao() {
        return $this->valorPadrao;
    }

    function setValorPadrao($valorPadrao) {
        $this->valorPadrao = $valorPadrao;
    }

        function getCategoria() {
        return $this->categoria;
    }

    function getValorLeve() {
        return $this->valorLeve;
    }

    function getValorGrave() {
        return $this->valorGrave;
    }

    function getValorMuitoGrave() {
        return $this->valorMuitoGrave;
    }

    function setValorLeve($valorLeve) {
        $this->valorLeve = $valorLeve;
    }

    function setValorGrave($valorGrave) {
        $this->valorGrave = $valorGrave;
    }

    function setValorMuitoGrave($valorMuitoGrave) {
        $this->valorMuitoGrave = $valorMuitoGrave;
    }

        function getNomeInfracao() {
        return $this->nomeInfracao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValorDe() {
        return $this->valorDe;
    }

    function getValorA() {
        return $this->valorA;
    }

    function setValorDe($valorDe) {
        $this->valorDe = $valorDe;
    }

    function setValorA($valorA) {
        $this->valorA = $valorA;
    }

        function getValorMinimo() {
        return $this->valorMinimo;
    }

    function getValorMaximo() {
        return $this->valorMaximo;
    }

    function getNumArtigo() {
        return $this->numArtigo;
    }

    function getValorPrimario() {
        return $this->valorPrimario;
    }

    function getValorReincidente() {
        return $this->valorReincidente;
    }

    function getMultiReincidente() {
        return $this->MultiReincidente;
    }

    function setValorPrimario($valorPrimario) {
        $this->valorPrimario = $valorPrimario;
    }

    function setValorReincidente($valorReincidente) {
        $this->valorReincidente = $valorReincidente;
    }

    function setMultiReincidente($MultiReincidente) {
        $this->MultiReincidente = $MultiReincidente;
    }

        function getLinhaArtigo() {
        return $this->linhaArtigo;
    }

    function setModoInfracao($modoInfracao) {
        $this->modoInfracao = $modoInfracao;
    }

    function setModoCoima($modoCoima) {
        $this->modoCoima = $modoCoima;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setNomeInfracao($nomeInfracao) {
        $this->nomeInfracao = $nomeInfracao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValorMinimo($valorMinimo) {
        $this->valorMinimo = $valorMinimo;
    }

    function setValorMaximo($valorMaximo) {
        $this->valorMaximo = $valorMaximo;
    }

    function setNumArtigo($numArtigo) {
        $this->numArtigo = $numArtigo;
    }

    function setLinhaArtigo($linhaArtigo) {
        $this->linhaArtigo = $linhaArtigo;
    }

    function getPonto() {
        return $this->ponto;
    }

    function getInstrumentoJuridico() {
        return $this->instrumentoJuridico;
    }

    function setPonto($ponto) {
        $this->ponto = $ponto;
    }

    function setInstrumentoJuridico($instrumentoJuridico) {
        $this->instrumentoJuridico = $instrumentoJuridico;
    }


}
