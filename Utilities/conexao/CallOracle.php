<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CallOracle
 *
 * @author AhmedJorge
 */
class CallOracle {
    
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
        CallOracle::$con = new Conectar();
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @return String contêm os valores do requisição feita para a <b>BD</b>
     * @example <b>1º</b> CallOracle::getSql() Exemplo "select * from nameTable"
     *  @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getSql() {
        return CallOracle::$sql;
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @return QUERY contêm os valores do requisição feita para a <b>BD</b>
     * @example <b>1º</b> CallOracle::getRs()
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getRs() {
        return CallOracle::$rs;
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @return INTEGER retorna o numero de linha da selecão
     * @example <b>1º</b> CallOracle::getNumRow()
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getNumRow() {
        return ocirowcount(CallOracle::$rs);
    }
      
    /**
     * (PHP 4, PHP 5)<br/>
     * @return Connection retorna conexao
     * @example <b>1º</b> CallOracle::getCon()
     * @author JIGAsoft <jigasoft_stp@hotmail.com>
     */
    static function getCon() {
        return CallOracle::$con;
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @return array retorna um array
     * @example <b>1º</b> CallOracle::getValors()[0]
     * @example <b>1º</b> CallOracle::getValors()["NAME"]
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getValors() {
        if(CallOracle::$queryType == CallOracle::FUNC)
        {return CallOracle::$valors;}
        return oci_fetch_array(CallOracle::$rs,OCI_RETURN_NULLS+OCI_ASSOC);
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @param $procedureName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @example <b>1º</b> CallOracle::simplesProcedure("nameProcedure",NULL);
     * @example <b>2º</b> CallOracle::simplesProcedure("nameProcedure",array());
     * @example <b>3º</b> CallOracle::simplesProcedure("nameProcedure",array($param1,$param2,$param3,$param4));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesProcedure($procedureName, array $listParam = array()) {
        CallOracle::$queryType = CallOracle::PRC;
        CallOracle::procedureOrFuncion($procedureName, $listParam, "call");
        CallOracle::executeQurey();
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $funcionName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @example <b>1º</b> CallOracle::simplesFuncion("nameFuncion",NULL);
     * @example <b>2º</b> CallOracle::simplesFuncion("nameFuncion",array());
     * @example <b>3º</b> CallOracle::simplesFuncion("nameFuncion",array($param1,$param2,$param3,$param4));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesFuncion($funcionName, array $listParam = array()) {
        CallOracle::$queryType = CallOracle::FUNC;
        CallOracle::procedureOrFuncion($funcionName, $listParam, "begin :bv := ");
        CallOracle::executeQurey();
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $tableNameOrView - o nome da Table or Veiw a ser usada
     * @param $selectValor - parametos da View or Table a ser Visualisado
     * @param $condicion - condicão a aplicar a Table or View
     * @example <b>1º</b> CallOracle::simplesSelect("nameViewOrTable","*");
     * @example <b>2º</b> CallOracle::simplesSelect("nameViewOrTable","param1,param2,param3","param1 > 40");
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesSelect($tableNameOrView,$selectValor,$condicion = NULL)
    {
        CallOracle::$queryType = CallOracle::SELE;
        if ($condicion == NULL) {
            CallOracle::$sql = "select " . $selectValor . " from " . $tableNameOrView;
        } else {
            CallOracle::$sql = "SELECT " . $selectValor . " FROM " . $tableNameOrView." WHERE ".$condicion;
        }
        CallOracle::executeQurey();
    }
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $tableNameOrView - o nome da Table or Veiw a ser usada
     * @param $selectValor - parametos da View or Table a ser Visualisado
     * @param $listParam - array com os valores a ser enviados
     * @param $condicion - condicão a aplicar a Table or View
     * @example <b>1º</b> CallOracle::functionTable("nameViewOrTable","*");
     * @example <b>2º</b> CallOracle::functionTable("nameViewOrTable","*",array($param1,$param2,$param3,$param4));
     * @example <b>3º</b> CallOracle::functionTable("nameViewOrTable",array($param1,$param2,$param3,$param4),"param1,param2,param3","param1 > 40");
     * @example <b>4º</b> CallOracle::functionTable("nameViewOrTable",array(),"param1,param2,param3","param1 > 40");
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function functionTable($tableNameOrView, $selectValor, array $listParam = NULL, $condicion = NULL)
    {
        CallOracle::$queryType = CallOracle::SELE;
        if ($condicion == NULL) 
        {
            CallOracle::$sql = "select ". $selectValor." from TABLE(" .CallOracle::addParam($tableNameOrView, $listParam) .")";
        } 
        else 
        {
            CallOracle::$sql = "select ". $selectValor. " from TABLE(" .CallOracle::addParam($tableNameOrView, $listParam). ") where ".$condicion;
        }
        CallOracle::executeQurey();
    }
    
    /**
     *(PHP 4, PHP 5)<br/>
     * @param $funcionName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @param $types  - funcao ou procedimento select or call
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    private static function procedureOrFuncion($funcionName, array $listParam, $types) {
        CallOracle::$sql = CallOracle::addParam($types . " " . $funcionName, $listParam);
    }
//
    /**
     * (PHP 4, PHP 5)<br/>
     * @example CallOracle::executeQurey();
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    private static function executeQurey()
    {
        CallOracle::$rs = oci_parse(CallOracle::$con,CallOracle::$sql) or die (oci_error());// ( CallOracle::$sql,) or die (oci_error());

        if(CallOracle::$queryType == CallOracle::FUNC)
        { oci_bind_by_name(CallOracle::$rs, ":bv", $v, 100000); }

        elseif(CallOracle::$queryType == CallOracle::PRC)
        { oci_bind_by_name(CallOracle::$rs); }

        oci_execute(CallOracle::$rs);

        if(CallOracle::$queryType == CallOracle::FUNC)
        { CallOracle::$valors = $v; }
    }
    
    private static function addParam($sql, array $listParam = NULL)
    {
        $i = 1;
        if ($listParam != NULL || count($listParam)!=0) 
        {
            $k = count($listParam);
            foreach ($listParam as $value) {
                if ($i == 1 && $i != (int) $k) {$sql .= "(" . CallOracle::valideValue($value) . "";} 
                elseif ($i == 1 && $i == (int) $k) {$sql .= "(" . CallOracle::valideValue($value) . "".CallOracle::terminoQuery();} 
                elseif ($i == (int) $k) {$sql .= "," . CallOracle::valideValue($value) . "".CallOracle::terminoQuery();} 
                else {$sql.= "," . CallOracle::valideValue($value) . "";}
                $i++;
            }
        } else {$sql .="(".CallOracle::terminoQuery();}
        return $sql;
    }
    
    private static function terminoQuery()
    {
        if(CallOracle::$queryType == CallOracle::FUNC)
        {
            return "); end;";
        }
        elseif(CallOracle::$queryType == CallOracle::PRC || CallOracle::$queryType == CallOracle::SELE)
        {
            return ")";
        }
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
    
    static function Connect($username, $password, $connection_string)
    {
        header('Content-type: text/html; charset=UTF-8');
        CallOracle::$con =  oci_connect($username, $password, $connection_string) ;  
    }
    public static function closeConexao()
    {     
        oci_close(CallOracle::$con);
    }
}
