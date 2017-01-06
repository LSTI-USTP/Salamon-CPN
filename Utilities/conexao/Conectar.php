<?php

/**
 * Description of Conectar
 *
 * @author Helio
 */

class Conectar 
{
  
    static function connetToBd()
    {
//        CallPgSQL::Connect("localhost", "agente", "1234", "policia", "5432");
       CallPgSQL::Connect("192.168.43.28", "agente", "1234", "policia", "5432");
//	CallPgSQL::Connect("192.168.1.101", "agente", "1234", "policia", "5432");
//	CallPgSQL::Connect("192.168.2.196", "agente", "1234", "policia", "5432");
//	CallPgSQL::Connect("192.168.1.176", "agente", "1234", "policia", "5432");
    }
}
