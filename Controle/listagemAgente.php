<!DOCTYPE html>
<html>
    <head>
        <title>Agente</title>

    </head>
    <body class="agente">
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
                    <a href="agente.php">
                        <i class="icon-plus"></i>  Novo registro
                    </a>
                </li>
                
            </ul>
        </div> 

        <!--<form>-->
        <div class="contentRel">
            <div class="areaAddUser">
                <input type="submit" class="OpenModal" value="Atribuir Privilégio"></input>
            </div>

            <div>

                <div class="SubmenuRel">
                    <ul>
                        <li class="active">Todos</li>
                        <li>Em Operação</li>
                        <li>Livres</li>
                        <li>Utilizadores</li>
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
                $remane = array("CODIGO" => "Nº Ordem", "NOME" => "Nome", "APELIDO" => "Apelido", "REGISTRO" => "Registro", "ESQUADRA" => "Esquadra", "ESTADO" => "Estado");
                $acao = array(/*"icon-pencil;Editar" => 'ddd(\'?\')',*/ "icon-info;Mais Informaçãoes" => 'showMoreInfor(\'?\')'/*, "icon-cancel-circle;Desativar" => 'ddd(\'?\')'*/);

                CallPgSQL::simplesSelect("adm.ver_agente_all", "*");
                PrintTable::loadBDTable($remane, TRUE, $acao, "ID", "class='ListHeight'");
                ?>
            </table> 	 
        </div>

        <div class="modalFrameControl">
            <div class="modalConteiner">
                <article class="areaTitle">
                    <h5 id="userF" >Adicionar Utilizador</h5>
                    <p class="CloseModal" title="Fechar">X</p>
                </article>
                <div class="BobyModal">
                    <div class="formUser">
                        <section>
                            <label>Escolher Aplicação</label>
                            <select id="utilizadorAplicacao"></select>
                            <label>Agente</label>
                            <select id="agenteNoUser"></select>
                        </section>
                        <label class="LBMenu">Privilégio</label>
                        <div id="menus">


                        </div>

                        <button class="icon-download3 btAddUser"> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <link rel="stylesheet" type="text/css" href="../resources/css/controle/relatorio.css">
    <script type="text/javascript" src="../resources/js/Utilizador.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.OpenModal').click(function () {

                $('.modalFrameControl').css('display', 'flex');
                $("#agenteNoUser").css("display","flex");
                $("div.formUser").find("label").eq(1).css("display","flex");
                $("#userF").text("Adicionar Utilizador");
                return false;
            });
            $('.CloseModal').click(function () {
                $('.modalFrameControl').css('display', 'none');
            });
        });
//        controller/ListagemControler.php",{typeP:"equipa",type:"paraFisca",idEquipa:idEquipaVar
        function userRestar(idAgente)
        {
            $.ajax({
                url: "controller/ListagemControler.php",
                type: "POST",
                data: {typeP:"agente",type:"userRedefi",idAgente:idAgente},
                dataType: "json",
                success: function (e) {
                    if (e.type === "erro")
                    {  showErro("Listagem de Agente", e.msg); }
                    else if (e.type === "sucesso")
                    { 
                        showSuccess("Listagem de Agente", e.msg);
                        pesquisaForAgente($("div.SubmenuRel").find("li.active"),null);
                    }
                }
            });
        }
        
        function editeUser(idAgente,thiss)
        {
           var nome = thiss.closest("tr").find("td").eq(1).text() ;
           $("#agenteNoUser").html("<option value='"+idAgente+"'>"+nome+"</option>");
           $('.modalFrameControl').css('display', 'flex');
           $("#agenteNoUser").css("display","none");
           $("div.formUser").find("label").eq(1).css("display","none");
           $("#userF").text("Editando Utilizador - "+nome);
        }
    </script>
</html>