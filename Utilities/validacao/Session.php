<?php


/**
 * Description of Session
 *
 * @author AhmedJorge
 */
class Session 
{
    const USER="UTILIZADOR";
    const MENU ="MENU";

    static function newSession($name,$object)
    {
        session_start();
        $_SESSION[$name]=$object;
    }
    
    static function sessionDestroy()
    {
        session_destroy();
    }
    
    static function destruirSessao($nomeSessao)
    {
        unset($_SESSION[$nomeSessao]);
    }
    
    static function getUserLogado()
    {  
        if(isset($_SESSION[Session::USER]))
        {
            return $_SESSION[Session::USER];
        }
        else return null;
    }
    /**
     * Devolve o id de todos os menus que o utilizador tem acesso
     */
    static function getUserMenu()
    {
        if(isset($_SESSION[Session::MENU]))
           return $_SESSION[Session::MENU];
        else return null;
    }
    public function serialize() {
        
    }
    static function  user()
    {
        session_start();
        $user =Session::getUserLogado();
        if($user != null)
           return $user->getNome()." ".$user->getApelido();
        else return null;     
    }
    /**
     * Mostra o nome e apelido do utilizador logado no sistema.
     * Esta função é usada para o mostrar o nome do utilizador na modal de alterar palavra-passe
     */
    static function nomeUtilizador()
    {
         $user =Session::getUserLogado();
        if($user != null)
           return $user->getNome()." ".$user->getApelido();
        else return null;
    }
    /**
     * Remove todas as informações armazenadas na sessão
     */
    static function terminarSessao()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
    
}
