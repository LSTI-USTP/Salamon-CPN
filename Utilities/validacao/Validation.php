<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validation
 *
 * @author Helcio Guadalupe
 */
class Validation
{
    //put your code here
    /**
     * função que compara a data inicial com inicial
     * @param type $dataInicial
     * @param type $dataFinal
     * @return int
     * Retorna 1 se a final for superior a inicial e -1 caso contrário
     */
    static function compararDatas($dataInicial, $dataFinal)
    { 
        if((Validation::converterData("Y-m-d", $dataFinal))>(Validation::converterData("Y-m-d", $dataInicial)))
            return 1;
        else
            return -1;      
    }
    
    /**
     * Função que verifica se a data informada é superior a data atual.
     * Retorna 1 se a data informada for superior a data do sistema e 0 caso contrário
     * @param type $data
     * @return string
     */
    static function  compareSystemDate($data)
    {
        $dataAtual = date("Y-m-d");
        
      
        if((Validation::converterData("Y-m-d", $data))>$dataAtual)
            return 1;
        else return 0;
    }
    
    /**
     * Converte a data no formato informado
     * Formato permitidos (dia-mês-ano d-m-Y) (ano-mês-dia Y-m-d)
     * @param type $formato
     * @param type $data
     * @return type
     */
    static function converterData($formato, $data)
    {
        return date($formato,  strtotime($data));
    }


    static function isBissexto($ano)
    {
         return ((($ano%4)==0 && ($ano%100)!=0 ) || ($ano%400)==0);
    }
    
    /**
     * verifica-se uma determinada data informada é válida
     * @param type $date
     * @return type 1 se estiver válido e vazio caso contrário
     */
    static function isValidDate($date)
    {
        $data = explode("-", $date);
        return (checkdate($data[1], $data[0], $data[2]));
    }
    /**
     * Determina a idade da pessoa através da data informada
     * @param type $dataNascimento
     * @return type -1 se estiver inválido
     */
    static function calcularIdade($dataNascimento)
    {
            //Data atual
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y' );
        //Data do aniversário
        $nascimento = explode('-', $dataNascimento);
        $diaNasc = ($nascimento[0]);
        $mesNasc = ($nascimento[1]);
        $anoNasc = ($nascimento[2]);
        if($ano>=$anoNasc)
        {
            //Calculando sua idade
            $idade = $ano - $anoNasc; 
            if ($mes < $mesNasc) // se o mes é menor, só subtrair da idade
            {
                $idade--;
                return $idade;
            }
            elseif ($mes == $mesNasc && $dia <= $diaNasc) // se esta no mes do aniversario mas não passou ou chegou a data, subtrai da idade
            {
                $idade--;
                return $idade;
            }
            else // ja fez aniversario no ano, tudo certo!
                return $idade;    
        }
        else
            return -1;
    }
    
    /**
     * Redireciona para a pagina informada
     * @param type $adress
     */
    static function redirecionar($adress)
    {
        //header("Location:".$adress); 
    }
    
    static function paginaAtual()
    {
         $servidor =$_SERVER["SERVER_NAME"];
        $endereco = $_SERVER["REQUEST_URI"];
        return $endereco;
    }
    
}
