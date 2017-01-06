<!DOCTYPE html>
<html>
<head>
	<title class="administracao">Administração</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resources/css/controle/Utility.css">
</head>
<body class="pageAdm2">
        <?php 
		include 'includes/menu.php';
	 ?>
	<div class="bodyRelat">
		<aside>
                    <h1>Menu</h1>
                    <div class="lateral-adm2">
                       <?php getAllItem(); ?>
                    </div>
		</aside>
		<article>
                    <div class="headerArticle">
                            <h2 class="titleRelat">Item 1</h2>
                            <div class="search my-personal-search">
                                    <input type="text" id="util_p" placeholder="Faça sua busca aqui...">
                                    <button class="icon-search" id="util_b" ></button>
                            </div>
                    </div>
                    <div class="below">
                            <div class="add-utility">
                                    <select id="loadSelect">
                                        <option value="">(Option here!)</option>
                                    </select>
                                    <input type="text" id="regObj" placeholder="Especificação aqui...">
                                    <input type="button" id="btRegUt" value="+ Adicionar">
                            </div>
                        <div class="dataRelat">
                            <span><label>Content here!</label><b>X</b></span>
                        </div>
                    </div>
		</article>
	</div>
        <section class="modalPage utiConfi">
            <div class="modalFrame">
                <div class="modalContainer">

                    <div class="bt-yes-no-cancel">
                        <button onclick="desaUtilitario();">OK</button>
                        <button class="bt-no-option">Cancelar</button>
                    </div>
                    <div class="modal-header">
                            <b>Utilitário</b>
                            <span>X</span>
                    </div>
                </div>
            </div>
        </section>
</body>

<script type="text/javascript" src="../resources/js/controle/Utility.js"></script>

</html>

<?php
    function getAllItem()
    {
        include "../Utilities/conexao/CallPgSQL.php";
        include "../Utilities/conexao/Conectar.php";
        CallPgSQL::simplesSelect("adm.ver_tipo_objecto", "*");
        $index = 0;
        while ($list = CallPgSQL::getValors())
        {
            if($index == 0)
            {
                echo "<li id='$list[ID]' sup_id='$list[SUP_ID]' sup_desc='$list[DESCRICAO_SUPER]' class='liSelected' >$list[DESCRICAO]</li>";
            }
            else
            {
                echo "<li id='$list[ID]' sup_id='$list[SUP_ID]' sup_desc='$list[DESCRICAO_SUPER]' > $list[DESCRICAO]</li>";
            }
            $index++;
        }
    }
?>

