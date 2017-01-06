<?php

/**
 * Description of Utilizador
 *
 * @author Helcio Guadalupe
 */
class Utilizador
{
    private $idUtilizador;
    private $nome;
    private $apelido;
    private $palavraPasse;
    private $descricao;
    private $nivel;
    private $codigo;
    private $idEsquadra;
    private $descricaoEsquadra;
    private $aplicacao;
    private $nomeAcesso;
    private $menuAcesso;
    private $senha;
    private $novaSenha;
    public static $SESSION_NAME="USER";
   
    
    function getIdUtilizador() {
        return $this->idUtilizador;
    }

    function setIdUtilizador($idUtilizador) {
        $this->idUtilizador = $idUtilizador;
    }

    function getNome() {
        return $this->nome;
    }
    function getMenuAcesso() {
        return $this->menuAcesso;
    }

    function getSenha() {
        return $this->senha;
    }

    function getNovaSenha() {
        return $this->novaSenha;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setNovaSenha($novaSenha) {
        $this->novaSenha = $novaSenha;
    }

        function setMenuAcesso($menuAcesso) {
        $this->menuAcesso = $menuAcesso;
    }

        function getApelido() {
        return $this->apelido;
    }

    function getPalavraPasse() {
        return $this->palavraPasse;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getIdEsquadra() {
        return $this->idEsquadra;
    }

    function getDescricaoEsquadra() {
        return $this->descricaoEsquadra;
    }

    function getAplicacao() {
        return $this->aplicacao;
    }

    function getNomeAcesso() {
        return $this->nomeAcesso;
    }

    static function getSESSION_NAME() {
        return self::$SESSION_NAME;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setIdEsquadra($idEsquadra) {
        $this->idEsquadra = $idEsquadra;
    }

    function setDescricaoEsquadra($descricaoEsquadra) {
        $this->descricaoEsquadra = $descricaoEsquadra;
    }

    function setAplicacao($aplicacao) {
        $this->aplicacao = $aplicacao;
    }

    function setNomeAcesso($nomeAcesso) {
        $this->nomeAcesso = $nomeAcesso;
    }

    static function setSESSION_NAME($SESSION_NAME) {
        self::$SESSION_NAME = $SESSION_NAME;
    }

        function setPalavraPasse($palavraPasse) {
        $this->palavraPasse = $palavraPasse;
    }


}
