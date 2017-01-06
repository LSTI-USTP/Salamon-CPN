<!DOCTYPE html>
<html>
<head>
	<title>Agente</title>            
</head>
<body class="agente">
	<?php 
		include './includes/menu.php';
	 ?>

	 <div class="subMenu">
     	<ul>
     		
               <li class="lista">
                    <a href="ListagemAgente.php">
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
            <div>
                <div class="contentLeft">
                    <h3>Dados Pessoais</h3>
                    <article >
                        <section>
                            <label>Nome</label>
                            <input type="text" id="nomeAgente"></input>
                        </section>
                        <section>
                            <label>Apelido</label>
                            <input type="text" id="apelidoAgente"></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>BI</label>
                            <input type="text" id="biAgente" class="numeroInterio" maxlength="8"></input>
                        </section>
                        <section>
                            <label>NIF</label>
                            <input type="text" id="nifAgente" maxlength="9" class="numeroInterio"></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>Género</label>
                            <select id="generoAgente">
                                <option label="(Selecione)" />
                            </select>
                        </section>
                        <section>
                            <label>Morada</label>
                            <input type="text" id="moradaAgente"></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>Data de Nascimento</label>
                            <input type="text" id="dataNascAgente"  class="campoData" maxlength="10" placeholder="dd-mm-yyyy" ></input>
                        </section>
                        <section>
                            <label>Estado Civil</label>
                            <select id="estadoCivilAgente">

                            </select>
                        </section>
                    </article>		

                </div>
                <div class="contentRight">
                    <h3>Dados Profissionais</h3>
                    <article>
                        <section>
                            <label>Posto</label>
                            <select id="nivelAgente"></select>
                        </section>
                        <section>
                            <label>Nº Ordem</label>
                            <input type="text" id="codigoAgente" class="numeroInterio"></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>Secção</label>
                            <select id="seccaoAgente">
                            </select>
                        </section>
                        <section>
                            <label>Data de Recrutamento</label>
                            <input type="text" class="campoData" placeholder="dd-mm-yyyy" id="dataRecrutamentoAgente" maxlength="10" ></input>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>Comando</label>
                            <select id="distritoAgente"></select>
                        </section>
                        <section>
                            <label>Esquadra</label>
                            <select id="esquadraAgente"></select>
                        </section>
                    </article>
                    <article>
                        <section>
                            <label>Categoria</label>
                            <select id="categoriaAgente"></select>	
                        </section>
                    </article>
                </div>

            </div>
            <div class="areaSave">
                <button class="icon-download3 btSave registarAgente">  Guardar</button>
            </div>
        </div>
     <div class="processamento modalProcess">
         <img src="../resources/img/earth.gif"class="imageProcess" />
     </div>
</body>
<script type="text/javascript" src="../resources/js/controle/agente.js"></script>
</html>