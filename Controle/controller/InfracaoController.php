<?php

if(isset($_POST["type"]))
{
    include '../../Utilities/modelo/Utilizador.php';
    include '../../Utilities/conexao/CallPgSQL.php';
    include '../../Utilities/conexao/Conectar.php';
    include '../../Utilities/validacao/Session.php';
    include '../modelo/Infracao.php';
    include '../dao/InfracaoDao.php';
    
    $operacao = $_POST['type'];
    if($operacao==1)
        CallPgSQL::loadComboBox("adm.ver_categoria_infracao", "ID", "CATEGORIA");
    elseif($operacao==2)
        CallPgSQL::loadComboBox("adm.ver_instrumento_juridico", "ID", "DESCRICAO");
    elseif($operacao==3)
    {
        $infracao = new Infracao();
        $infracaDao = new InfracaoDao();
        
        $infracao->setNomeInfracao(CallPgSQL::toVarchar($_POST['nome']));
        $infracao->setCategoria($_POST['categoria']);
        $infracao->setDescricao(CallPgSQL::toVarchar($_POST['descricao']));
        $infracao->setValorMinimo($_POST['valorMinimo']);
        $infracao->setValorMaximo($_POST['valorMaximo']);
        $infracao->setNumArtigo($_POST['artigo']);
        $infracao->setLinhaArtigo($_POST['alinea']);
        $infracao->setModoInfracao($_POST['modoCoima']);
        $infracao->setModoCoima($_POST['tipoCoima']);
        $infracao->setInstrumentoJuridico($_POST['instrumentojuridico']);
        $infracao->setPonto($_POST['ponto']);
        switch ($infracao->getModoCoima())
        {
            case 2:
                $infracao->setValorPrimario($_POST['valorPrimario']);
                $infracao->setValorReincidente($_POST['reincidente']);
                $infracao->setMultiReincidente($_POST['multiReincidente']);
                $infracao->setValorDe($_POST['valorDe']);
                $infracao->setValorA($_POST['valorA']) ;         
                $infracaDao->registrarInfracao($infracao);
                break;
            case 3:
                $infracao->setValorLeve($_POST['valorLeve']);
                $infracao->setValorGrave($_POST['valorGrave']);
                $infracao->setValorMuitoGrave($_POST['valorMuitoGrave']);
                 $infracaDao->registrarInfracao($infracao);
                 break;
             default :
                 $infracao->setValorPadrao($_POST['valorPadrao']);
                 $infracaDao->registrarInfracao($infracao);
                 break;
        }   
    }
    
}