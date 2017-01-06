<!DOCTYPE html>
<html>
    <head>
        <title>Equipa</title>

    </head>
    <body class="equipa">
        <?php
        include 'includes/menu.php';
        ?>

        <div class="subMenu">
            <ul>
                <li class="newReg active">
                    <a href="#">
                        <i class="icon-plus"></i>  Novo registro
                    </a>
                </li>
                <li class="lista">
                    <a href="listagemEquipa.php">
                        <i class="icon-list2"></i>  Listagem
                    </a>
                </li>
            </ul>
        </div> 


        <div class="content">
            <div>
                <div class="contentLeft contentLeftMenor">
                    <h3>Dados da Equipa</h3>
                    <section>
                        <label>Tipo de Fiscalização</label>
                        <select class="SelectMenor" id="equipaTipo"  >

                        </select>
                    </section>
                    <section>
                        <label>Distrito</label>
                        <select class="SelectMenor" id="equipaDistrito"></select>
                    </section>
                    <section>
                        <label>Zona</label>
                        <select class="SelectMenor" id="equipaZona"></select>
                    </section>
                    <section>
                        <label>Outras Informações</label>
                        <textarea id="equipaOutrasInf"></textarea>
                    </section>
                </div>

                <div class="contentRight">
                    <h3>Alocação</h3>
                    <article class="areaCartao">
                        <label class="LBcartao">Nº de Agentes</label>
                        <input type="text" id="equipaNumeroAgente" class="numeroInterio" ></input>
                    </article>
                    <article class="areaAdd">
                        <h4 id="numForAgente">Agente 1</h4>
                        <label></label>
                        <button class=" icon-plus btAdd" id="teamAddTable" title="Adicionar Agente"></button>
                    </article>
                    <article>
                        <section>
                            <label>Agente</label>
                            <input type="text" readonly="readonly" class="txtAgente" id="nomeAgente" ></input>
                            <div class="escAgente">
                                <i class="icon-circle-up" id="agenteIcon" title="Subir"></i>
                                <table cellspacing="0" cellpadding="15" class="txtAgente">
                                    <thead>
                                        <tr>
                                            <th>Nº de Ordem</th>
                                            <th>Agente</th>
                                            <th>Esquadra</th>
                                        </tr>
                                    </thead>
                                    <tbody id="equipaTabelaAgente">
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section>
                            <label>Dispositivo</label>
                            <input type="text" readonly="readonly" class="txtDispositivo" id="nomeDispositivo" >

                            <div class="escDispositivo">
                                <i class="icon-circle-up" id="dispositivoIcon" title="Subir"></i>

                                <table cellspacing="0" cellpadding="15">
                                     <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Número</th>
                                        </tr>
                                    </thead>
                                    <tbody id="equipaCorpoDispositivo">
                                    </tbody>
                                </table>
                            </div>
                            </input>
                        </section>
                    </article>
                    <section>
                        <label>Função</label>
                        <select class="SelectMenor" id="equipaFuncao" ></select>
                    </section>
                    <article class="areaTable">
                        <table cellspacing="0" cellpadding="15">
                         <thead>
                            <tr>
                                <th>Agente</th>
                                <th class="trMost">Função</th>
                                <th>Dispositivo</th>
                                <th>Ação</th>
                            </tr>
                         </thead>
                            <tbody id="tableAlucacao"></tbody>
                        </table>
                    </article>
                </div>
            </div>
            <div class="areaSave">
                <button class="icon-download3 btSave" id="regTeam">  Guardar</button>
            </div>
        </div>
        <div class="processamento modalProcess">
            <img src="../resources/img/earth.gif"class="imageProcess" />
        </div>

        <section class="modalPage equipaConfi">
            <div class="modalFrame">
                <div class="modalContainer">
                    <h2>
                        <label>Tens a certeza que queres mudar?</label>
                    </h2>
                    <div class="bt-yes-no-cancel">
                        <button onclick="resetTableAlocacao();">OK</button>
                        <button class="bt-no-option" onclick="resetNumAgente();">Cancelar</button>
                    </div>
                    <div class="modal-header">
                            <b>Equipa!</b>
                            <span>X</span>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script type="text/javascript" src="../resources/js/controle/Equipa.js"></script>

    <script type="text/javascript">
        $(document).ready(function ()
        {

            $('.txtAgente').focusin(function ()
            {
                $('.escAgente').css('display', 'flex');
            });

            $("#agenteIcon").click(function ()
            {
                $('.escAgente').css('display', 'none');

            });


            $('.txtDispositivo').focusin(function ()
            {
                $('.escDispositivo').css('display', 'flex');
            });

            $("#dispositivoIcon").click(function ()
            {
                $('.escDispositivo').css('display', 'none');

            });

        }
        );

    </script>
</html>
