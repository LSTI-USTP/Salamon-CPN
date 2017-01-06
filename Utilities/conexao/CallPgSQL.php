<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CallPgSQL
 *
 * @author AhmedJorge
 */
class CallPgSQL {
    private static $sql;
    private static $rs;
    private static $numRow;
    private static $valors;
    public static $con;
    const FUNC =1;
    const PRC =2;
    const SELE =3;
    private static $queryType;
    private static $queryName;
    private static $i = 1;
    

    function __construct() {
        header('Content-type: text/html; charset=UTF-8');
        CallPgSQL::$con = new Conectar();
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @return String contêm os valores do requisição feita para a <b>BD</b>
     * @example <b>1º</b> CallPgSQL::getSql() Exemplo "select * from nameTable"
     *  @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getSql() {
        return CallPgSQL::$sql;
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @return QUERY contêm os valores do requisição feita para a <b>BD</b>
     * @example <b>1º</b> CallPgSQL::getRs()
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getRs() {
        return CallPgSQL::$rs;
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @return INTEGER retorna o numero de linha da selecão
     * @example <b>1º</b> CallPgSQL::getNumRow()
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getNumRow() {
        return pg_num_rows(CallPgSQL::$rs);
    }
      
    /**
     * (PHP 4, PHP 5)<br/>
     * @return Connection retorna conexao
     * @example <b>1º</b> CallPgSQL::getCon()
     * @author JIGAsoft <jigasoft_stp@hotmail.com>
     */
    static function getCon() {
        return CallPgSQL::$con;
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @return array retorna um array
     * @example <b>1º</b> CallPgSQL::getValors()[0]
     * @example <b>1º</b> CallPgSQL::getValors()["NAME"]
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function getValors() {
        return pg_fetch_array(CallPgSQL::$rs,NULL,PGSQL_ASSOC);
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * @param $procedureName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @example <b>1º</b> CallPgSQL::simplesProcedure("nameProcedure",NULL);
     * @example <b>2º</b> CallPgSQL::simplesProcedure("nameProcedure",array());
     * @example <b>3º</b> CallPgSQL::simplesProcedure("nameProcedure",array($param1,$param2,$param3,$param4));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    protected function simplesProcedure($procedureName, array $listParam = array()) {
        CallPgSQL::$queryType = Query::PRC;
        CallPgSQL::procedureOrFuncion($procedureName, $listParam, "call");
        CallPgSQL::executeQurey($listParam, array());
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $funcionName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @example <b>1º</b> CallPgSQL::simplesFuncion("nameFuncion",NULL);
     * @example <b>2º</b> CallPgSQL::simplesFuncion("nameFuncion",array());
     * @example <b>3º</b> CallPgSQL::simplesFuncion("nameFuncion",array($param1,$param2,$param3,$param4));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesFuncion($funcionName, array $listParam = array()) {
        CallPgSQL::procedureOrFuncion($funcionName, $listParam, "select");
        CallPgSQL::executeQurey($listParam, array());
    }
    
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $tableNameOrView - o nome da Table or Veiw a ser usada
     * @param $selectValor - parametos da View or Table a ser Visualisado
     * @param $condicion - condicão a aplicar a Table or View
     * @example <b>1º</b> CallPgSQL::simplesSelect("nameViewOrTable","*");
     * @example <b>2º</b> CallPgSQL::simplesSelect("nameViewOrTable","$param1,$param2,$param3",array("$param4;>","40"));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function simplesSelect($tableNameOrView,$selectValor,array $condicion = array())
    {
        CallPgSQL::$queryType = CallPgSQL::SELE;
        if ($condicion == array()) {
            CallPgSQL::$sql = "select " . $selectValor . " from " . $tableNameOrView;
        } else {
            CallPgSQL::$sql = "SELECT " . $selectValor . " FROM " .$tableNameOrView." WHERE ". CallPgSQL::addCondicion($condicion);
        }
        CallPgSQL::executeQurey(array(), $condicion);
    }
    /**
     * (PHP 4, PHP 5)<br/>
     * @param $tableNameOrView - o nome da Table or Veiw a ser usada
     * @param $selectValor - parametos da View or Table a ser Visualisado
     * @param $listParam - array com os valores a ser enviados
     * @param $condicion - condicão a aplicar a Table or View
     * @example <b>1º</b> CallPgSQL::functionTable("nameViewOrTable","*");
     * @example <b>2º</b> CallPgSQL::functionTable("nameViewOrTable","*",array($param1,$param2,$param3,$param4));
     * @example <b>3º</b> CallPgSQL::functionTable("nameViewOrTable","*",array($param1,$param2,$param3,$param4),array("param1;>" => "40"));
     * @example <b>4º</b> CallPgSQL::functionTable("nameViewOrTable","*",array($param1,$param2,$param3),array("$param1;>" => "40"));
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    static function functionTable($tableNameOrView, $selectValor, array $listParam = array(), array $condicion = array())
    {
        CallPgSQL::$queryType = CallPgSQL::SELE;
        if ($condicion == array()) 
        {
            CallPgSQL::$sql = "select ". $selectValor." from " .CallPgSQL::addParam($tableNameOrView, $listParam);
        } 
        else 
        {
            CallPgSQL::$sql = "select ". $selectValor. " from " .CallPgSQL::addParam($tableNameOrView, $listParam). " where ". CallPgSQL::addCondicion($condicion);
        }
        CallPgSQL::executeQurey($listParam,$condicion);
    }
    
    /**
     *(PHP 4, PHP 5)<br/>
     * @param $funcionName - o nome da funcão a ser usada
     * @param $listParam - array com os valores a ser enviados
     * @param $types  - funcao ou procedimento select or call
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    private static function procedureOrFuncion($funcionName, array $listParam, $types) {
        CallPgSQL::$sql = CallPgSQL::addParam($types . " " . $funcionName, $listParam);
    }
//
    /**
     * (PHP 4, PHP 5)<br/>
     * @example CallPgSQL::executeQurey();
     * @author JIGAsoft STP <jigasoft_stp@hotmail.com>
     */
    private static function executeQurey(array $listParam, array $condicion)
    {
        CallPgSQL::$queryName = md5(time().date("d-m-y h:M:s").microtime());
        Conectar::connetToBd();
        pg_prepare(CallPgSQL::getCon(), CallPgSQL::$queryName, CallPgSQL::$sql);    
//        CallPgSQL::$rs = pg_query(CallPgSQL::$sql);
        $arrayParam = array_merge($listParam,$condicion); 
        CallPgSQL::$rs = pg_execute(CallPgSQL::getCon(), CallPgSQL::$queryName, $arrayParam);
    }
    
    private static function addParam($sql, array $listParam = NULL)
    {
        CallPgSQL::$i = 1;
        if ($listParam != NULL || count($listParam)!=0) 
        {
            $k = count($listParam);
            foreach ($listParam as $value) {
                if (CallPgSQL::$i == 1 && CallPgSQL::$i != (int) $k) {$sql .= "( $" . CallPgSQL::$i . "";} 
                elseif (CallPgSQL::$i == 1 && CallPgSQL::$i == (int) $k) {$sql .= "( $" . CallPgSQL::$i . "".CallPgSQL::terminoQuery();} 
                elseif (CallPgSQL::$i == (int) $k) {$sql .= ", $" . CallPgSQL::$i .CallPgSQL::terminoQuery();} 
                else {$sql.= ", $" . CallPgSQL::$i . "";}
                CallPgSQL::$i++;
            }
        } else {$sql .="(".CallPgSQL::terminoQuery();}
        return $sql;
    }
    
    private static function terminoQuery()
    {
        return ")";
    }
    
    static function toDateSQL($Date, $format = "DD-MM-YYYY")
    {
        return $Date;
    }
    
    static function toVarchar($value)
    {
        return $value;
    }
    
//    private static function valideValue($value)
//    {
//        if(strpos($value, 'to_Date(')!==FALSE)
//            return $value;
//        elseif(is_numeric($value))
//            return $value;
//        elseif( $value==NULL )
//            return "NULL";
//        else
//        {return $value;}
//    }
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
    
    static function Connect($hostName, $userName, $password, $bdName, $port  = 5432) 
    {
        //header('Content-type: text/html; charset=UTF-8');
        CallPgSQL::$con = pg_connect("host=$hostName port=$port dbname=$bdName user=$userName password=$password ");  
    }
    
    public static function closeConexao()
    {
        pg_close(CallPgSQL::$con);
    }
    
    static function loadComboBox($tableView, $id, $descricao)
    {
        CallPgSQL::simplesSelect($tableView, "*");
        echo "<option value=''>"."(Selecione)"."</option>";
        while ($linha=  CallPgSQL::getValors())
        {
            echo "<option value='$linha[$id]'>".$linha[$descricao]."</option>";
        }
        CallPgSQL::closeConexao();
    }
    
    /**
     * VEERIFICA-SE UM DETERMINADO VALOR JÁ EXISTE NA BASE DE DADDOS.
     * RETORNA 1 SE EXISTE E 0 CASO CONTRÁRIO
     * @param type $tableView
     * @param type $field
     * @param type $value
     * @return type
     */
    static function existValue($tableView,$field,$value)
    {
        CallPgSQL::simplesSelect($tableView, "\"$field\"", array($field => $value));
        return CallPgSQL::getNumRow();
    }
    
    private static function addCondicion(array $condicion)
    {
        $cond = "";
        $f = 1;
        foreach ($condicion as $key => $value) {
            $keyOrAnd = explode(";", $key);
            if($f == 1)
            { $cond .= "UPPER(\"".$keyOrAnd[0]."\"::CHARACTER VARYING) ".((isset($keyOrAnd[1])) ? $keyOrAnd[1] : "=" ).(( isset($keyOrAnd[1]) && strtoupper($keyOrAnd[1]) == "LIKE") ? " Upper(" : " ")."$".CallPgSQL::$i.(( isset($keyOrAnd[1]) && strtoupper($keyOrAnd[1]) == "LIKE") ? ")" : ""); }
            else
            { $cond .= ((isset($keyOrAnd[1])) ? " ".$keyOrAnd[1] : " AND" )." UPPER(\"".$keyOrAnd[0]."\"::CHARACTER VARYING) ".((isset($keyOrAnd[2])) ? $keyOrAnd[2] : "=" ).(( isset($keyOrAnd[2]) && strtoupper($keyOrAnd[2]) == "LIKE") ? " Upper(" : " ")."$".CallPgSQL::$i.(( isset($keyOrAnd[2]) && strtoupper($keyOrAnd[2]) == "LIKE") ? ")" : ""); }
            $f = 2;
            CallPgSQL::$i++;
        }
        return $cond;
    }
}
