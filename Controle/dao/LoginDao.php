<?php


/**
 * Description of LoginDao
 *
 * @author Helcio Guadalupe
 */
class LoginDao 
{
    private $idMenu;
    //put your code here
    
    function logar(Utilizador $utilizador) // fun
    {
        session_start();
        CallPgSQL::functionTable("adm.func_login", "*",array($utilizador->getNomeAcesso(), $utilizador->getPalavraPasse()));
        if(CallPgSQL::getNumRow()==0) 
            echo 'sem acesso;negado';
       else
       {
           while ($row=CallPgSQL::getValors())
           {
               $utilizador->setNome($row["NOME"]);
               $utilizador->setApelido($row["APELIDO"]);
               $utilizador->setNivel($row["ACCESS"]);
               $utilizador->setDescricao($row["DESCRICAO"]);
               $utilizador->setNomeAcesso($row["ACCESS_NAME"]);
               $utilizador->setCodigo($row["CODIGO"]);
               $utilizador->setIdEsquadra($row["ESQUADRA"]);
               $utilizador->setDescricaoEsquadra($row["DESCRICAO_ESQUADRA"]);
               $utilizador->setAplicacao($row["APLICACAO"]);
               $utilizador->setIdUtilizador($row["ID"]);

           }
           CallPgSQL::closeConexao();

           if($utilizador->getNivel()==2)
           {
               $_SESSION[Session::USER]= $utilizador; // guarda o objeto utilizador na sessão
               echo 'ativar utilizador'.";".$utilizador->getNome()." ".$utilizador->getApelido().";".$utilizador->getIdUtilizador();
           }
           else 
           {
               if($utilizador->getAplicacao()==52)
                     echo 'sem acesso a essa aplicação;não pode usar essa aplicação';
               else
               {
                   $_SESSION[Session::USER]= $utilizador; // guarda o objeto utilizador na sessão
                   $this->carregarMenuUtilizador($utilizador->getIdUtilizador());
                   $this->enderecarUrl($_SESSION[Session::MENU], $utilizador->getAplicacao());
               }
           }      
       }   
        
    }
    
    /**
     * Ativa o utilizador quando estiver a entrar na aplicação pela primeira vez ou após a sua senha ser redefinida
     * @param Utilizador $utilizador id do utilizador
     */
    function loginAtivar(Utilizador $utilizador)
    {
        session_start();
        CallPgSQL::simplesFuncion("adm.func_agente_activar_pwd",array($utilizador->getIdUtilizador(),$utilizador->getNovaSenha()));
        foreach (CallPgSQL::getValors() as $value)
        {
            $resultado = explode(";", $value);
        }
        if($resultado[0]=="true")
        {
//            echo "dndndn";
            $this->carregarMenuUtilizador($utilizador->getIdUtilizador());
            $this->enderecarUrl($_SESSION[Session::MENU], Session::getUserLogado()->getAplicacao());
        }
        
//        echo $resultado[0] ."  ".CallPgSQL::getSql()." ".$resultado[1];
    }
    /**
     * Carrega todos os menus que o utilizador tem acesso
     */
    function carregarMenuUtilizador($idUtilizador)
    {
        $array = array();
        $indice =0;
        CallPgSQL::functionTable("adm.funct_load_menu_user", "*",array($idUtilizador));
        while ($linha = CallPgSQL::getValors())
        {
            $array[$indice]= $linha["ID"];
            $indice++;
        }
        $menu = implode(";", $array);
        CallPgSQL::closeConexao();
        $_SESSION[Session::MENU]= $menu; // guarda os menus do utilizador na sessão
    }
    
    function enderecarUrl($menuAplicacao,$aplicacao)
    {
        $menuAplicacao = explode(";", $menuAplicacao);
        if($aplicacao==50)
        {
            foreach ($menuAplicacao as $value)
            {
                if($value==10101)
                {
                    echo 'aplicação pagamento;Pagamento/index.php';
                    break;
                }
                else
                {
                    echo 'aplicação pagamento;Pagamento/pgto-rt.php';
                    break;
                }
            }
        }
        else if ($aplicacao==53){
             foreach ($menuAplicacao as $value)
            {
                if($value==10401)//Apresentar menu mapa
                {
                    echo 'aplicação visualização;Visualizacao/VisualizaMapa.php';
                    break;
                }
                else if($value==10402)//Apresentar a menu lista
                {
                    echo 'aplicação visualização;Visualizacao/VisualizaLista.php';
                    break;
                }
            }
        }
        else      
        {
            foreach ($menuAplicacao as $value)
            {
                if($value==10201)
                {
                     echo 'aplicação controlo;Controle/equipa.php';
                    break;
                }
                else if($value==10202)
                {
                    echo 'aplicação controlo;Controle/equipa.php';
                    break;
                }
                else if($value==10203)
                {
                    echo 'aplicação controlo;Controle/infracao.php';
                    break;
                }
                else if($value==10204)
                {
                    echo 'aplicação controlo;Controle/agente.php';
                    break;
                }
                else if($value==10205)
                {
                    echo 'aplicação controlo;Controle/dispositivo.php';
                    break;
                }
                else if($value==10206)
                {
                    echo 'aplicação controlo;Controle/relatorios.php';
                    break;
                }
                else
                {
                    echo 'aplicação controlo;Controle/Utility.php'; 
                    break;
                }
            }
        }
       
       
    }    
    
}
            
    
    

