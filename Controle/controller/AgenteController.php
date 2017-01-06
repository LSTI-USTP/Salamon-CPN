<?php
    header('Content-type: text/html; charset=UTF-8');

    if(isset($_POST['type']))
    {
          include '../dao/AgenteDao.php';
          include '../../Utilities/conexao/CallPgSQL.php';
          include '../../Utilities/conexao/Conectar.php';
          include '../../Utilities/modelo/Utilizador.php';
          include '../../Utilities/validacao/Validation.php';
          include '../../Utilities/validacao/Session.php';
          include '../modelo/Agente.php';
         /**
          *  Define a operação a ser realizada. Valor de 1 a 7 corresponde ao carregamento de informações como sexo
          * e valor 8 corresponde ao registro de um novo agente
          */
          $operacao = $_POST['type'];
         $agenteDao = new AgenteDao();

         if($operacao!=8)
               $agenteDao->loadData($operacao);
         else 
         {
            if(CallPgSQL::existValue("t_agente", "age_bi", $_POST['bi'])==1)
                echo 'bi já existe';
             else if(CallPgSQL::existValue("t_agente", "age_nif", $_POST['nif'])==1)
                 echo 'nif já existe';
             else if(Validation::compareSystemDate($_POST['dataRec'])==1)
                 echo 'data do recrutamento é superior';
             else
             {
                 $agente = new Agente();
                 $agente->setNome(CallPgSQL::toVarchar($_POST['nome']));
                 $agente->setApelido(CallPgSQL::toVarchar($_POST['apelido']));
                 $agente->setBi(CallPgSQL::toVarchar($_POST['bi']));
                 $agente->setNif(CallPgSQL::toVarchar($_POST['nif']));
                 $agente->setGenero($_POST['genero']);
                 $agente->setMorada(CallPgSQL::toVarchar($_POST['morada']));
                 $agente->setDataNasc(CallPgSQL::toVarchar($_POST['dataNasc']));
                 $agente->setEstadoCivil($_POST['estadoCivil']);
                 $agente->setNivel($_POST['nivel']);
                 $agente->setCodigo(CallPgSQL::toVarchar($_POST['codigo']));
                 $agente->setSeccao($_POST['seccao']);
                 $agente->setDataRecrutamento(CallPgSQL::toVarchar($_POST['dataRec']));
                 $agente->setEsquadra($_POST['esquadra']);
                 $agente->setDistrito($_POST['distrito']);
                 $agente->setCategoria($_POST['categoria']);
                 $agenteDao->regAgente($agente);
             }
           
         }
    }
    else
    {
        
    }
  
 
  

  
