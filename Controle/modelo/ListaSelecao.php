<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListaSelecao
 *
 * @author Helcio Guadalupe
 */
class ListaSelecao 
{
    function __construct() {
        $this->seleteds = array();
    }

    private $seleteds =  array();
     
    public function changeSeleted($id,$valor)
    {

       if(array_search($id, $this->seleteds))
           $this->seleteds[$id] -=$valor;
       else
       {
            $this->seleteds[$id] =$valor;
       }
    }
    
    public function echoAll()
    {
        $count = 0;
        foreach ($this->seleteds as $var)
        {
            if($count >0)
                echo $var.'<br>';
           $count ++;
        }
    }
    
    function remover($id)
    {
        
    }
    
    function adicionar($id)
    {
        
    }
}
