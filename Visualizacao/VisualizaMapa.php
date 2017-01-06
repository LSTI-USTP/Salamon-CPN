<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Visualização | Mapa</title>
        <link rel="stylesheet"  type="text/css" href="../resources/css/controle/visualiza.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/fonts.css">      
        <link rel="stylesheet" type="text/css" href="../resources/css/controle/estiloMenus.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/controle/styleGeral.css">
    </head>

    <body class="visualizacao">

        
        <div class="menu">
            <ul>

                <li class="lista active">
                    <a href="#">
                        <i class="icon-location" ></i> Mapa
                    </a>
                </li>

                <li class="newReg">
                    <a href="VisualizaLista.php">
                        <i class="icon-list2"></i>  Lista
                    </a>
                </li>
                <li class="termSecao">
                    <a href="#">
                        <i class="icon-exit"></i>
                         Terminar Sessão
                    </a>
                </li>
            </ul>
        </div> 

        <div id="corpo" class="corpo">

            <div class="menuFilter">
                    <h1>Identificar a Infração</h1>
                    <div class="procurar">
                        <div class="result">
                            <span class="f_janela">X</span>
                            <table class="tabelaInf" id="table-filtro" cellpadding="0"   >
                                <!--<table class="tabela" cellpadding="0" style="display: none;"   >-->
                            </table>
                        </div>
                        <p>
                            <label for="real-time">Tempo real</label>
                            <input type="text" value="15" id="tempoP">
                        </p>
                    </div><!--procurar-->



                  
                    <h1>Identificar o Nivel</h1>
                    <div class="nivel">
                        <div>
                            <input type="checkbox" name="alto" class="marcar1" value="" id="alto">
                            <label for="alto">Alto</label>
                            <input type="checkbox" name="media" class="marcar2" value="" id="media">
                            <label for="media">Médio</label>
                            <input type="checkbox" name="baixo" class="marcar3" value="" id="baixo">
                            <label for="baixo">Baixo</label>
                        </div><!---->
                    </div>
                    <h1>Apreenção</h1>
                    <div>
                        <article class="areaImg" id="apre">
                            <img id="aCarta" src="../resources/img/carta.png" title="Apreenção da Carta">
                            <img id="aCondutor" src="../resources/img/condutor.png" title="Apreenção Condutor">
                            <img id="aLivrete" src="../resources/img/livrete.png" title="Apreenção Livrete">
                            <img id="aVeiculo" class="veiculo" src="../resources/img/veiculo.png" title="Apreenção Veículo">
                        </article>
                    </div>
            </div>

            

            <div class="conteudo">
                <div class="areaMapa" id="mapArea" style=" width: 100%; height:700px;" >

                </div>
            </div>

            <div class="areaValores">
                <article class="atuacao">
                    <label>Atuações</label>
                    <label id="tAtuacao">0</label>
                </article>
                <article class="multas">
                    <label>Multas</label>
                    <label id="tMultas">0</label>
                </article>
                <article class="mgraves">
                    <label>Muito Graves</label>
                    <label id="tMGrave" >0</label>
                </article>
                <article class="graves">
                    <label>Graves</label>
                    <label id="tGrave" >0</label>
                </article>
                <article class="leves">
                    <label>Leves</label>
                    <label id="tLeve" >0</label>
                </article>
            
            </div>

            <div class="areaTolls">
                <div class="tool">
                    <close class="closeToll" id='central'>X</close>
                    <h3>Atuações</h3>
                    <div class="geral loadDataMap" >
                        <section class="grave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="Mgrave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>

                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img src="../resources/img/condutor.png">
                                <img src="../resources/img/livrete.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="leve">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="leve">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/condutor.png">
                            </article>
                        </section>
                        <section class="Mgrave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="mgrave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="grave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                            <label class="noAprencao">Sem Apreenções</label>
                            </article>
                        </section>
                        
                    </div>
                    <div class="areaTotal">
                        <article>
                            <label class="totalR">Total Registros:</label>
                            <label class="total">12</label>
                        </article>
                        <article>
                            <label class="totalR">Equipa 22</label>
                        </article>
                       
                    </div>
                    
                </div>

                <div class="toolSecond">
                    <close class="left icon-arrow-left2"></close>
                     <h3 class="titleV">Mais Informações</h3>
                     <div class="menuV">
                         <p class="geral menuactive">Geral</p>
                         <p class="infracao">Infrações</p>
                     </div>
                    <section class="Mgeral">
                        <article>
                           <label title="Nome Motorista" id="inf-condutor" ><img src="../resources/img/motorista.png" class="imgMotorista"> António Varela</label>
                           <label title="Nº de Carta" id="inf-carta" ><i class="icon-profile"></i> 45555788</label>
                           <label title="Veículo" id="inf-veiculo" >Motorizada</label>
                           <label title="Matrícula" id="inf-maticula" >Matrícula: 12 45 p</label>
                           <label title="Multas" id="inf-multa" ><i class=" icon-warning"></i> 2 multas</label>
                           <label title="Valor Multas"id="inf-multa-valor"  ><i class="icon-coin-dollar"></i> 20.00000</label>
                        </article>
                        <article>
                            <label title="Nº de Atuação" id="inf-atuacao" >Atuação: 122333</label>
                            <label title="Agente" id="inf-agente"><img class="policial" src="../resources/img/policial.png"> Manuel Mendonça</label>
                            <label title="Infrações" id="inf-infracao"> 4 Infrações</label>
                            <article class="infracoes" id="inf-infracao-valores" >
                                <label title="">Falta de Luz</label>
                                <label title="">Retrovisor Partido</label>
                                <label title="">Bebado</label>
                                <label title="">Sem Pneu</label>
                            </article>
                        </article> 
                    </section>
                    <section class="Minfracoes esconde" id="inf-infracao-valores-outros" >
                        <table>
                            <thead>
                            <tr>
                                <th>Infração</th>
                                <th>Lei</th>
                                <th>Valor</th>
                                <th>xxx</th>
                            </tr>   
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ddddddd</td>
                                    <td>fffffffffff</td>
                                    <td>gggggggg</td>
                                    <td>hhhhhhh</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            
            </div>
            <div class="modalValores rightSHOW">
                <div class="tool">
                    <close class="closeToll" id='Right'>X</close>
                    <h3 class="titleTool">Atuações</h3>
                    <div class="geral loadDataMap" >
                        <section class="grave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="Mgrave">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>

                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img src="../resources/img/condutor.png">
                                <img src="../resources/img/livrete.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                        <section class="leve">
                            <article class="areaInfo">
                                <label>STP 12 34 A</label>
                                <label>123456abc</label>
                            </article>
                            <article class="areaImg">
                                <img src="../resources/img/carta.png">
                                <img class="veiculo" src="../resources/img/veiculo.png">
                            </article>
                        </section>
                </div>
            </div>

            
        </div>
</body>
<script type="text/javascript" src="../resources/js/jQuery.js"></script>
<script type="text/javascript" src="../resources/js/controle/geralVisualiza.js"></script>
<script type="text/javascript" src="../resources/js/controle/Relatorio.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVVO0Rt0g7UM0S1UNsQusFFNiTsAiawDs&?sensor=true"></script>

</html>