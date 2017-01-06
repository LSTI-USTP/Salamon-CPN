<!DOCTYPE html>
<html>
<head>
	<title>Relatório</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../resources/css/pagamento/pgto-rt.css">
	<link rel="stylesheet" type="text/css" href="../resources/fw/Xgraphic/css/Xgraphic.css">

</head>
<body id="page-pgto-rt">
	<div class="rt-menu">
		<?php 
			include 'includes/menu.php';
		 ?>
	 </div>
	<div class="rt-container">
		<article>
		<div class="primary">
			<div class="header-1">
				<span>
					<ul class="ul">
						<li class="actual-header-1 transition-4">Anual</li>
						<li class="transition-4">Mensal</li>
						<li class="transition-4">Diário</li>
						<li class="transition-4 periodic">Periódico</li>
					</ul>
				</span>
				<span>
					<i class="icon-list2 actual-category" title="Lista"></i>
					<i class="icon-stats-dots" title="Gráfico"></i>
				</span>
			</div>

			<div class="header-2">
				<nav>
				<trouble>
				<!-- Relatorio anual -->
					<inline>
						<label>De</label>
						<span>						
							<select name="" id="year-1" >
								<option value="">2016</option>
							</select>
						</span>
						<label>A</label>
						<span>						
							<select name="" id="year-2" >
								<option value="">2016</option>
							</select>
						</span>
					</inline>
					<!-- Relatorio mensal -->
					<inline>
						<label>De</label>
						<span>						
							<select name="" id="month-1" class="months">
							</select>
						</span>
						<label>A</label>
						<span>						
							<select name="" id="month-2" class="months" >
								
							</select>
						</span>
					</inline>
					<!-- Relatorio diádio -->
					<inline>
						<label>De</label>
						<span>						
							<select name=""  id="day-1" class="days">							
															
							</select>
						</span>
						<label>A</label>
						<span>						
							<select name=""  id="day-2" class="days">							
														
							</select>
						</span>
					</inline>
					</trouble>
					<trouble>
					<periodic>
						De
						<input type="text" placeholder="dd-mm-yyyy">
						A
						<input type="text" placeholder="dd-mm-yyyy">
					</periodic>
					</trouble>
				</nav>
				<nav>
					<xpert>
						<i class="icon-search"></i>
						<input type="text" class="transition-4 input-search">
					</xpert>
				</nav>
			</div>
			<div class="primary-article">
				<div class="primary-list active-type">
					<div class="listPayments">						
                                            <table cellpadding="0" class="tablePagamente" cellspacing="0">
                                               <?php 
                                                    include '../Utilities/conexao/CallPgSQL.php';
                                                    include '../Utilities/conexao/Conectar.php';
                                                    include '../Utilities/validacao/PrintTable.php';
                                                    CallPgSQL::functionTable("pay.funct_report_data_multa", "*", array(null,NULL, 1 , 3));
                                                    PrintTable::loadBDTable(array( "DATA"=>"Data", "MULTAS" => "Multa", "PAGAS" => "Pagas", "NAO PAGAS" => "Não pagas","CRESCENTE MULTA" => "Total multa", "CRESCENTE COBRADOS" => "Total pagamento"), TRUE);
                                               ?> 
					    </table>
					</div>
				</div>
				<div class="primary-stats">
					<div class="XpertContainer">
						<Xgraphic LabX = "Meses" LabY = "Valores" StepY = "3" ArrayContent = "" ArrayValues = ""></Xgraphic>
					</div>
				</div>
			</div>	
			</div>
			<div class="secondary">
				<section>
					<nav>
						<label for="">Total de multas</label>
						<span>
							<select name="" id="">
								<option value="">STD</option>
								<option value="">EUR</option>
							</select>
						</span>
					</nav>
                                    <h1 class="TOTALMULTAS" ><?php echo number_format(0,2,',',' ') ?></h1>
				</section>
				<section>
					<nav>
						<label for="">Multas pagas</label>
						<span>
							<select name="" id="">
								<option value="">STD</option>
								<option value="">EUR</option>
							</select>
						</span>
					</nav>
                                    <h1 class="MULTASPAGAS" ><?php echo number_format(0,2,',',' ') ?></h1>
				</section>
				<section>
					<nav>
						<label for="">Multas não pagas</label>
						<span>
							<select name="" id="">
								<option value="">STD</option>
								<option value="">EUR</option>
							</select>
						</span>
					</nav>
					<h1 class="h1-no-payed MULTASNAOPAGAS"><?php echo number_format(0,2,',',' ') ?></h1>
				</section>
			</div>		
		</article>

		<aside>
				<section>
                                    <h1 class="pagas">0%</h1>
					<span>Multas Pagas</span>
				</section>
				<section>
                                    <h1 class="pagasNP">0%</h1>
				    <span>Multas Pagas Dentro do Prazo</span>
				</section>
				<section>
					<h1 class="pagasFP">0%</h1>
                                        <span >Multas Pagas Fora do Prazo</span>
				</section>
				<section>
                                    <h1 class="nPagas">0%</h1>
					<span>Multas Não Pagas</span>
				</section>
		</aside>
	</div>

</body>
<script type="text/javascript" src="../resources/js/pagamento/pgto-rt.js"></script>
<script type="text/javascript" src="../resources/fw/Xgraphic/js/Xgraphic.js"></script>  
<script type="text/javascript" src="../resources/js/pagamento/relatorio.js"></script>
</html> 