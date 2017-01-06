<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visualização | Lista</title>
     <link rel="stylesheet"  type="text/css" href="../resources/css/controle/visualiza.css">
     <link rel="stylesheet" type="text/css" href="../resources/css/fonts.css">      
     <link rel="stylesheet" type="text/css" href="../resources/css/controle/estiloMenus.css">
     <link rel="stylesheet" type="text/css" href="../resources/css/controle/styleGeral.css">
</head>

<body class="visualizacao">
    
    <div class="menu">
        <ul>
            <li class="lista">
                <a href="VisualizaMapa.php">
                     <i class="icon-location"></i> Mapa
                </a>
           </li>
            <li class="newReg active">
                <a href="#">
                     <i class="icon-list2"></i>  Lista
                </a>
           </li>
           <li>
                <a href="#">
                    <i class="icon-exit"></i>
                     Terminar Sessão
                </a>
            </li>
               
        </ul>
     </div> 

    <div id="corpo" class="corpo">
    	
        <div class="menuFilter">
                <form>
                    <h1>Identificar a Infração</h1>
                    <div class="procurar">
                        <input type="text" name="infracao" class="intracao pesquisarInfracao" id="result" placeholder="Procurar a Infração" value="">
                        <div class="result">
                            <span class="f_janela">X</span>
                            <table class="tabelaInf" id="table-filtro" cellpadding="0"   >
                                <!--<table class="tabela" cellpadding="0" style="display: none;"   >-->
                            </table>
                        </div>
                        <p>
                            <label for="real-time">Tempo real</label>
                            <input type="text" value="15" id="tempoP" >
                        </p>
                    </div><!--procurar-->



                    <h1>Definir Data</h1>
                    <div class="data">
                        <p>
                            Data Início
                            <input type="date" name="inicio" class="txt" value="">
                        </p>
                        <p>
                            Data Fim
                            <input type="date" name="fim" class="txt" value="">
                        </p>
                    </div><!---->
                    <h1>Identificar o Nível</h1>
                    <div class="nivel">
                        <div>
                            <input type="checkbox" name="nivel" class="marcar1" value="" id="n1">
                            <label for="n1">Alto</label>
                            <input type="checkbox" name="nivel" class="marcar2" value="" id="n2">
                            <label for="n2">Médio</label>
                            <input type="checkbox" name="nivel" class="marcar3" value="" id="n3">
                            <label for="n3">Baixo</label>
                        </div><!---->
                    </div>
                    <h1>Pesquisar Por:</h1>
                    <div class="identifica">
                        <p>
                            Numero de carta<input type="text" placeholder="Número de carta de condução" class="txt" name="" value="">
                        </p>
                        <p>
                            Matrícula<input type="text" name="" placeholder="Matrícula do automóvel" class="txt" value="">
                        </p>
                    </div><!---->
                </form>
            </div><!---->
        
    	<div class="conteudo">
            <div class="tabela">
                <table class="tabelafisca" >
                	
                </table>          
            </div>
        </div>
    </div>
    <div class="toolSecond yes">
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
</body>
    <script type="text/javascript" src="../resources/js/jQuery.js"></script>
    <script type="text/javascript" src="../resources/js/controle/geralVisualiza.js"></script>
    <script type="text/javascript" src="../resources/js/controle/Relatorio.js"></script>
</html>