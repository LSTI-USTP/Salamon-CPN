<!DOCTYPE html>
<html>
    <head>
        <title>Dispositivo</title>
        
    </head>
    <body class="dispositivo">
        <?php
        include 'includes/menu.php';
        ?>

        <div class="subMenu">
            <ul>
                
                <li class="lista">
                    <a href="listagemDispositivo.php">
                        <i class="icon-list2"></i>  Listagem
                    </a>
                </li>
                <li class="newReg active">
                    <a href="#">
                        <i class="icon-plus"></i>  Novo registro
                    </a>
                </li>
            </ul>
        </div> 

        <div class="content">
            <div class="areaEscDispositivo">
                <aside>
                    Escolher Dispositivo
                    <div>
                        <table cellspacing="0" cellpadding="15">
                        <thead>
                            <tr>
                                <th>DISPOSITIVO</th>
                                <th>DATA & HORA</th>
                            </tr>
                        </thead>
                            <tbody id="contenerDispo" ></tbody>
                        </table>
                    </div> 
                </aside>
            </div>
            <div>
                <div class="contentLeft">
                    <h3>Dados do Dispositivo</h3>
                    <article>
                        <section>
                            <label>Marca</label>
                            <input type="text" readonly="true" id="disMarca" ></input>
                        </section>
                        <section>
                            <label>Modelo</label>
                            <input type="text" readonly="true" id="disModelo" ></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>Versão</label>
                            <input type="text" readonly="true" id="disVersao" class="TXTVersao"></input>
                        </section>
                        <article class="areaCor">
                            <section>
                                <label>Cor Frente</label>
                                <select id="disCorFre" ></select>
                            </section>
                            <section>
                                <label>Cor Verso</label>
                                <select id="disCorTra" ></select>
                            </section>
                        </article>
                    </article>
                    <article>
                        <section>
                            <label>Polegada</label>
                            <input type="text" readonly="true" id="disPolegada" ></input>
                        </section>
                        <section>
                            <label>MAC</label>
                            <input type="text" readonly="true" id="disIMEI" ></input>
                        </section>
                    </article>
                    <section>
                        <label>Outras Informações</label>
                        <textarea id="disInfor"></textarea>
                    </section>
                </div>
                <div class="contentRight">
                    <h3>Dados do SIM</h3>
                    <article class="areaCartao">
                        <label class="LBcartao">Nº Cartões</label>
                        <article>
                            <label>Um</label>
                            <input name="typeCatao" value="1" checked="true" id="typeCatao" type="radio"></input>
                            <label>Dois</label>
                            <input name="typeCatao" value="2" id="typeCatao" type="radio"></input>
                        </article>
                    </article>
                    <article class="areaAdd">
                        <h4>SIM 1</h4>
                        <label></label>
                        <button class=" icon-plus btAdd" id="addSim" title="Adicionar Cartão"></button>
                    </article>
                    <article>
                        <section>
                            <label>Número</label>
                            <input id="simNum" maxlength="7" class="numeroInterio" type="text"></input>
                        </section>
                        <section>
                            <label>PIN</label>
                            <input id="simPin" minlength="4" maxlength="8" class="numeroInterio" type="text"></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>PUK</label>
                            <input id="simPUK" maxlength="8" type="text" class="numeroInterio"></input>
                        </section>
                    </article>
                    <article class="areaTable">
                        <table cellspacing="0" cellpadding="15">
                        <thead>
                            <tr >
                                <th>Número</th>
                                <th>PIN</th>
                                <th>PUK</th>
                            </tr>
                        </thead>
                            <tbody id="contentSim" align="center" >
                            </tbody>
                        </table>
                    </article>
                </div>
            </div>
            <div class="areaSave">
                <button class="icon-download3 btSave" id="regDispositivo">  Guardar</button>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../resources/js/controle/dispositivoControler.js"></script>
</html>