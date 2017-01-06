<?php

    include '../Utilities/validacao/Validation.php';
    if(!isset($_SESSION[Session::USER])) //verifica-se não existe informações do utilizador na sessão
         Validation::redirecionar("../index.html"); // redireciona para a tela de login quando não houver sessão.
     else
     {
         echo "<script>menuAccess('".Session::getUserLogado()->getAplicacao()."','".Session::getUserMenu()."')</script>";
     }
    
 
    function validarUrl()
    {
        ///
		//
		////
		
		///
    }
    
    
    
    
    