<!DOCTYPE html>
<html>
    <head>
        <title>Listagem Equipa</title>

    </head>
    <body class="equipa">
        <?php
        include 'includes/menu.php';
        ?>

        <div class="subMenu">
            <ul>
                <li class="newReg">
                    <a href="equipa.php">
                        <i class="icon-plus"></i>  Novo registro
                    </a>
                </li>
                <li class="lista active">
                    <a href="#">
                        <i class="icon-list2"></i>  Listagem
                    </a>
                </li>
            </ul>
        </div> 
        <div class="contentRel">
            <div>
                <div class="SubmenuRel">
                    <ul>
                        <li class="active">Em Operação</li>
                        <li>Todos</li>
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
                $remane = array("TIPO" => "Tipo", "OPERACAO" => "Operação", "ZONA" => "Zona", "AGENTES" => "Agente", "DURACAO" => "Duração");
                $acao = array("icon-info;Mais Informaçãoes" => 'showMoreInfor(\'?\')', "icon-stop;Terminar Fiscalização" => 'terminarFicalizacao(\'?\')');

                CallPgSQL::simplesSelect("adm.ver_equipa_emoperacao", "*");
                PrintTable::loadBDTable($remane, TRUE, $acao, "ID", "class='ListHeight'");
                ?>
            </table> 	 
        </div>

        <section class="modalPage teminarEquipa">
            <div class="modalFrame">
                <div class="modalContainer">

                    <div class="bt-yes-no-cancel">
                        <button onclick="finalizarEquipa();">OK</button>
                        <button class="bt-no-option">Cancelar</button>
                    </div>
                    <div class="modal-header">
                        <b>Terminar Equipa</b>
                        <span>X</span>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <link rel="stylesheet" type="text/css" href="../resources/css/controle/relatorio.css">
</html>