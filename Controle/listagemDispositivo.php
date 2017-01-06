<!DOCTYPE html>
<html>
    <head>
        <title>Listagem Dispositivo</title>

    </head>
    <body class="dispositivo">
        <?php
        include 'includes/menu.php';
        ?>

        <div class="subMenu">
            <ul>
                
                <li class="lista active">
                    <a href="#">
                        <i class="icon-list2"></i>  Listagem
                    </a>
                </li>
                <li class="newReg">
                    <a href="dispositivo.php">
                        <i class="icon-plus"></i>  Novo registro
                    </a>
                </li>
            </ul>
        </div> 

        <div class="contentRel">
            <div>
                <div class="SubmenuRel">
                    <ul>
                        <li class="active">Todos</li>
                        <li>Disponíveis</li>
                        <li>Em Operação</li>
                        <li>Inativos</li>
                    </ul>
                </div>

                <div class="areaSearch">
                    <input type="text" class="pesqValue" placeholder="Pesquisar..."></input>
                    <input type="submit" value="" class="pesqBt" ></input>
                </div>
            </div>

            <table cellspacing="0" cellpadding="15" class="loadTable">
                <?php
                include '../Utilities/conexao/CallPgSQL.php';
                include '../Utilities/conexao/Conectar.php';
                include '../Utilities/validacao/PrintTable.php';
                $remane = array("NOME" => "Nome", "MARCA" => "Marca", "MODELO" => "Modelo", "VERSAO" => "Versão", "TAMANHO" => "Tamanho", "ESTADO" => "Estado");
                $acao = array(/*"icon-pencil;Editar" => 'ddd(\'?\')',*/ "icon-info;Mais Informaçãoes" => 'showMoreInfor(\'?\')'/*, "icon-cancel-circle;Desativar" => 'ddd(\'?\')'*/);
                CallPgSQL::simplesSelect("adm.ver_despositivo", "*");
                PrintTable::loadBDTable($remane, TRUE, $acao, "ID", "class='ListHeight'");
                ?>
            </table> 	 
        </div>

    </body>
    <link rel="stylesheet" type="text/css" href="../resources/css/controle/relatorio.css">
</html>