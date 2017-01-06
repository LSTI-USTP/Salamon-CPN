<!DOCTYPE html>
<html>
    <head>
        <title>Listagem | Infração</title>

    </head>
    <body class="infracao">
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
                    <a href="infracao.php">
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
                        <li>Motorista</li>
                        <li>Veículos</li>
                        <li>Inativos</li>
                    </ul>
                </div>

                <div class="areaSearch">
                    <input type="text" class="pesqValue" placeholder="Pesquisar..."></input>
                    <input type="submit" value="" class="pesqBt" ></input>
                </div>
            </div>

            <table class="loadTable" cellspacing="0" cellpadding="15">
                <?php
                include '../Utilities/conexao/CallPgSQL.php';
                include '../Utilities/conexao/Conectar.php';
                include '../Utilities/validacao/PrintTable.php';
                $remane = array("NOME" => "Nome", "CATEGORIA" => "Categoria", "IMPUTACAO" => "Imputação", "COIMA" => "Coina", "VALOR" => "Valor", "DATA" => "Data", "ESTADO" => "Estado");
                $acao = array(/*"icon-pencil;Editar" => 'ddd(\'?\')',*/ "icon-info;Mais Informaçãoes" => 'showMoreInfor(\'?\')'/*, "icon-cancel-circle;Desativar" => 'ddd(\'?\')'*/);
                CallPgSQL::simplesSelect("adm.ver_infracao", "*");
                PrintTable::loadBDTable($remane, TRUE, $acao, "ID", "class='ListHeight'");
                ?>
            </table> 	 
        </div>
    </body>
    <link rel="stylesheet" type="text/css" href="../resources/css/controle/relatorio.css">
</html>