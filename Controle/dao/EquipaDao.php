<?php



/**
 * Description of EquipaDao
 *
 * @author Helcio Guadalupe
 */
class EquipaDao {
    //put your code here
    
    function carregarDispositivo($idAgente)
    {
        CallPgSQL::functionTable("adm.funct_load_despositivo_disponivel", "*",array($idAgente));
        while($row=  CallPgSQL::getValors())
        {
           echo "<tr onclick=\"selectDevice('$row[ID]','$row[CODIGO]',$(this))\">";
                echo "<td>".$row["CODIGO"].'</td>';
                echo "<td>".$row["NUMERO"].'</td>';
//                echo "<td>".$row["MARCA"].'</td>';
            echo '</tr>';
        }
        CallPgSQL::closeConexao();
    }
    
    /**
     * função que registra uma nova equipa
     * Para registrar uma nova equipa será necessário: tipo de fiscalização, a identificação da pessoa que está a registrar a equipa, o id da zona e
     * o número do agentes que serão alocados num determinado terreno
     * @param Equipa $equipa
     */
    function registrarEquipa(Equipa $equipa)// função que registra uma nova equipa
    {
        include '../../Utilities/validacao/Session.php'; session_start();
        CallPgSQL::simplesFuncion("adm.func_reg_equipa", array($equipa->getIdtipoFiscalizacao(),Session::getUserLogado()->getIdUtilizador(),
            $equipa->getIdZona(),$equipa->getNumAgente(),NULL,NULL,NULL,NULL,  CallPgSQL::toVarchar($equipa->getOutrasInf())));
        foreach (CallPgSQL::getValors() as $value)
        {
            $result = explode(";", $value); 
        }
        if($result[0]=="true")
        {$this->regAlocacao($equipa,$result[1],Session::getUserLogado()->getIdUtilizador());}
        else{ echo $result[1]; }
    }
    
    function regAlocacao(Equipa $equipa,$idEquipa,$idUser)
    {
       $dadosAlocacao = explode(";;",$equipa->getListaAlocacao() );
        foreach ($dadosAlocacao as $dados) 
        {
            $alocacao = explode("::", $dados);
            CallPgSQL::simplesFuncion("adm.func_reg_alocacao", array((($alocacao[2] == "" ) ? NULL : $alocacao[2]) ,$idEquipa,$alocacao[1],$alocacao[0],$idUser,NULL));
            foreach (CallPgSQL::getValors() as $value)
            {
                $result = explode(";", $value); 
                if($result[0]=="false") 
                {
                    echo $result[1];
                    break;
                }
                
            }
           
        }
        echo 'Equipa registrada com sucesso!';
        CallPgSQL::closeConexao();
    }
    /**
     * Carrega todos os agentes disponiveis
     */
    static function carregarAgentes()
    {
        CallPgSQL::simplesSelect("adm.ver_agente_disponivel","*");
        while($linha=  CallPgSQL::getValors())
        {
             echo "<tr var='$linha[ID]' onclick=\"loadDevice('$linha[ID]','$linha[AGENTE]',$(this))\">";
                echo "<td>".$linha["CODIGO"].'</td>';
                echo "<td>".$linha["AGENTE"].'</td>';
                echo "<td>".$linha["ESQUADRA"].'</td>';
            echo '</tr>';
        }     
    }
   
}
