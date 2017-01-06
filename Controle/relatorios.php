<!DOCTYPE html>
<html>
<head>
	<title class="relatorio"> Relatórios</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resources/css/controle/AdmItem2.css">
</head>
<body class="relatorio pageAdm2 administracao">
	<div>
		<?php 
			include 'includes/menu.php';
		 ?>
	</div>
	<div class="bodyRelat">
		<aside>
			<h1>Relatório</h1>
			<div class="lateral-adm2">
				<li claFss="liSelected">Infração</li>
				<li>Veículos</li>
				<li>Cartas</li>
				<li>Fiscalização</li>
			</div>
		</aside>
		<article>
			<div class="headerArticle">
				<h2 class="titleRelat"></h2>
				<div class="search my-personal-search">
                                    <input type="text" placeholder="Faça sua busca aqui..." class="campoPesquisa" id="relatorioValorPesquisa">
                                    <button class="icon-search" id="relatorioBotaoPesquisa"></button>
				</div>
			</div>
			<div class="below">
				<div class="filter">
					<p>
					Agrupar por: 
						<label class="my-personal-select filterSelect">
                                                    <select class="component-shadow agrupar" id="relatorioAgrupamento">
                                                            <option value="3">Diário</option>
                                                            <option value="2">Mensal</option>
                                                            <option value="1">Anual</option>
                                                                
							</select>
						</label>
					</p>
					<nav>
					<p>
						De 
                                                <input type="date"  id="relatorioDataInicio"
                                                       class="component-shadow dataInicio campoData" placeholder="dd-mm-yyyy" maxlength="10">
					</p>
					<p>
						Até 
                                                <input type="date" id="relatorioDataFim" 
                                                       class="component-shadow dataFim campoData" maxlength="10" placeholder="dd-mm-yyyy">
					</p>
					</nav>
				</div>
                                
				<div class="dataRelat" >
                                    <table id="tabelaRelatorios"></table>
				</div>
			</div>
		</article>
	</div>
         <div class="processamento modalProcess">
            <img src="../resources/img/earth.gif"class="imageProcess" />
        </div>
</body>
<script type="text/javascript" src="../resources/js/controle/geralAdm.js"></script>
<script type="text/javascript" src="../resources/js/controle/Relatorio.js"></script>
</html>