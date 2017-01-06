<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CallMysql
 *
 * @author AhmedJorge
 */
class CallMysql {
    private static $sql;
    private static $rs;
    private static $numRow;
    private static $valors;
    private static $con;
    const FUNC =1;
    const PRC =2;
    const SELE =3;
    private static $queryType;
    

    function __construct() {
        header('Content-type: text/html; charset=UTF-8');
        CallMysql::$con = new Conectar();
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @return String contêm os valores do requisição feita para a <b>BD</b>
     * @example <b>1º</b> CallMysql::getSql() Exemplo "select * from nameTable"
     *  @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getSql() {
        return CallMysql::$sql;
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @return QUERY contêm os valores do requisição feita para a <b>BD</b>
     * @example <b>1º</b> CallMysql::getRs()
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getRs() {
        return CallMysql::$rs;
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @return INTEGER retorna o numero de linha da selecão
     * @example <b>1º</b> CallMysql::getNumRow()
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getNumRow() 
    {
        return mysql_num_rows(CallMysql::$rs);
    }
      
    /**
     * (PHP 4, PHP 5)<br/>
     * @return Connection retorna conexao
     * @example <b>1º</b> CallMysql::getCon()
     * @author JIGAsoft <jigasoft_stp@hotmail.com>
     */
    static function getCon() {
        return CallMysql::$con;
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @return array retorna um array
     * @example <b>1º</b> CallMysql::getValors()[0]
     * @example <b>1º</b> CallMysql::getValors()["NAME"]
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getValors() 
    {
        return mysql_fetch_array(CallMysql::$rs);
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @param $procedureName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @example <b>1º</b> CallMysql::simplesProcedure("nameProcedure",NULL);
     * @example <b>2º</b> CallMysql::simplesProcedure("nameProcedure",array());
     * @example <b>3º</b> CallMysql::simplesProcedure("nameProcedure",array($param1,$param2,$param3,$param4));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesProcedure($procedureName, array $listParam = array()) {
        CallMysql::$queryType = CallMysql::PRC;
        CallMysql::procedureOrFuncion($procedureName, $listParam, "call");
        CallMysql::executeQurey();
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $funcionName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @example <b>1º</b> CallMysql::simplesFuncion("nameFuncion",NULL);
     * @example <b>2º</b> CallMysql::simplesFuncion("nameFuncion",array());
     * @example <b>3º</b> CallMysql::simplesFuncion("nameFuncion",array($param1,$param2,$param3,$param4));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesFuncion($funcionName, array $listParam = array())
    {
        CallMysql::procedureOrFuncion($funcionName, $listParam, "select");
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $tableNameOrView - o nome da Table or Veiw a ser usada
     * @param $selectValor - parametos da View or Table a ser Visualisado
     * @param $condicion - condicão a aplicar a Table or View
     * @example <b>1º</b> CallMysql::simplesSelect("nameViewOrTable","*");
     * @example <b>2º</b> CallMysql::simplesSelect("nameViewOrTable","param1,param2,param3","param1 > 40");
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesSelect($tableNameOrView,$selectValor,$condicion = NULL)
    {
        CallMysql::$queryType = CallMysql::SELE;
        if ($condicion == NULL) {
            CallMysql::$sql = "select " . $selectValor . " from " . $tableNameOrView;
        } else {
            CallMysql::$sql = "SELECT " . $selectValor . " FROM " . $tableNameOrView." WHERE ".$condicion;
        }
        CallMysql::executeQurey();
    }
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $tableNameOrView - o nome da Table or Veiw a ser usada
     * @param $selectValor - parametos da View or Table a ser Visualisado
     * @param $listParam - array com os valores a ser enviados
     * @param $condicion - condicão a aplicar a Table or View
     * @example <b>1º</b> CallMysql::functionTable("nameViewOrTable","*");
     * @example <b>2º</b> CallMysql::functionTable("nameViewOrTable","*",array($param1,$param2,$param3,$param4));
     * @example <b>3º</b> CallMysql::functionTable("nameViewOrTable",array($param1,$param2,$param3,$param4),"param1,param2,param3","param1 > 40");
     * @example <b>4º</b> CallMysql::functionTable("nameViewOrTable",array(),"param1,param2,param3","param1 > 40");
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    protected static function functionTable($tableNameOrView, $selectValor, array $listParam = NULL, $condicion = NULL)
    {
        CallMysql::$queryType = CallMysql::SELE;
        if ($condicion == NULL) 
        {
            CallMysql::$sql = "select ". $selectValor." from " .CallMysql::addParam($tableNameOrView, $listParam);
        } 
        else 
        {
            CallMysql::$sql = "select ". $selectValor. " from " .CallMysql::addParam($tableNameOrView, $listParam). " where ".$condicion;
        }
        CallMysql::executeQurey();
    }
    
    /**
     *(PHP 4, PHP 5)<br/>
     * @param $funcionName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @param $types  - funcao ou procedimento select or call
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    private static function procedureOrFuncion($funcionName, array $listParam, $types) {
        CallMysql::$sql = CallMysql::addParam($types . " " . $funcionName, $listParam);
    }
//
    /**
     * (PHP 4, PHP 5)<br/>
     * @example CallMysql::executeQurey();
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    private static function executeQurey()
    {
        CallMysql::$rs =mysql_query ( CallMysql::$sql, CallMysql::$con->getConecta()) or die (mysql_error());
    }
    
    private static function addParam($sql, array $listParam = NULL)
    {
        $i = 1;
        if ($listParam != NULL || count($listParam)!=0) 
        {
            $k = count($listParam);
            foreach ($listParam as $value) {
                if ($i == 1 && $i != (int) $k) {$sql .= "(" . CallMysql::valideValue($value) . "";} 
                elseif ($i == 1 && $i == (int) $k) {$sql .= "(" . CallMysql::valideValue($value) . "".CallMysql::terminoCallMysql();} 
                elseif ($i == (int) $k) {$sql .= "," . CallMysql::valideValue($value) . "".CallMysql::terminoCallMysql();} 
                else {$sql.= "," . CallMysql::valideValue($value) . "";}
                $i++;
            }
        } else {$sql .="(".CallMysql::terminoCallMysql();}
        return $sql;
    }
    
    private static function terminoCallMysql()
    {
        return ")";
    }
    
    static function toDateSQL($Date, $format = "DD-MM-YYYY")
    {
        return "to_Date('$Date','$format')";
    }
    
    private static function valideValue($value)
    {
        
        if(strpos($value, 'to_Date(')!==FALSE|| is_numeric($value))
        {return $value;}
        if( $value==NULL )
        {return "NULL";}
        else
        {return "'$value'";}
    }
    /**
     * 
     * @param type $dataInicial
     * @param type $dataFinal
     * @return type válido se a data final for superior a inicial
     */
    static function compararDatas($dataInicial, $dataFinal)
    {
   
        if(strtotime($dataFinal)>  strtotime($dataInicial))
            return "válido";
        else
            return "inválido";
    }
        
    static function Connect($hostorName, $user, $password)
    {
        header('Content-type: text/html; charset=UTF-8');
        CallMysql::$con = mysql_connect($hostorName, $user, $password);  
    }
    
    public static function closeConexao()
    {
        mysql_close(CallMysql::$con);
    }
    
    public static function selectBD($bdName)
    {
        mysql_select_db($bdName, CallMysql::$con);
    }
    
}
