<!DOCTYPE html>
<html>
    <head>
        <title>Pagamentos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../resources/css/pagamento/pgto-pr.css">
        <link rel="stylesheet" href="../resources/css/pagamento/more-info.css">

    </head>
    <body id="page-pgto-pr">
        <div class="pgto-pr">
            <div class="geral-menu">
                <?php
                include 'includes/menu.php';
                ?>
            </div>

            <div class="body-pgto">
                <div class="more-info">
                    <?php
                    include 'includes/more-info.php';
                    ?>
                    <label class="icon-arrow-up2 show-info"></label>
                </div>
                <div>
                    <div class="searchBar">
                        <input type="text" id="pesquisa-multa"  placeholder="Faça sua busca aqui..."/>
                        <button  class="icon-search" id="bt-MulalP" ></button>
                    </div>
                    <div class="list-multa">
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>                    
                                    <th>Acção</th>
                                    <th>Infrator</th>
                                    <th>Infrator Codigo</th>
                                    <th>Multas</th>
                                    <th>Total a pagar</th>
                                    <th>Total Multa</th>
                                </tr>

                            </thead>

                            <tbody id="table-multa" >
                                <?php
                                include '../Utilities/conexao/CallPgSQL.php';
                                include '../Utilities/conexao/Conectar.php';
                                CallPgSQL::simplesSelect("pay.ver_infratores", "*");
                                while ($row = CallPgSQL::getValors()) {
                                    echo "<tr value='".$row["VALOR"]."' id='".$row["ID"]."' >";
                                    echo "<td>";
                                    echo '<i class = "icon-info show-info"></i>';
                                    echo '<i class = "icon-box-add start-payment"  title = "Novo depósito"></i>';
                                    echo "</td>";
                                    echo "<td>" . $row["INFRATOR"] . "</td>";
                                    echo "<td>" . $row["NUMERO"] . "</td>";
                                    echo "<td>" . $row["MULTAS"] . "</td>";
                                    echo "<td>" . $row["TOTAL PAGAR"] . "</td>";
                                    echo "<td>" . $row["TOTAL FISCALIZACAO"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="info-data-selected">
                            <label class="table-selected">(Nenhum selecionado)</label>
                            <label id  ="table-found">Total encontrado: <span> 5 </span></label>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <section class="modalPage mp-new-pgto">
            <div class="modalFrame">
                <div class="modalContainer">
                    <nav class="alert">
                        <nav>
                            <p></p>
                            <label class="icon-arrow-up2 close-modal-alert"></label>
                        </nav>
                    </nav>
                    <div class="new-pgto">
                        <p var="Data de pagamento">
                            Data de pagamento
                            <span>
                                <input type="text" id="dataPayment" >
                            </span>
                        </p>
                        <p var="Tipo de pagamento">
                            Tipo de pagamento
                            <label class="my-personal-select" for="typePayment"> 
                                <select id="typePayment" >
<!--                                    <option>Depósito</option>
                                    <option>POS</option>
                                    <option>Transferência bancária</option>-->
                                </select>
                            </label>
                        </p>
                        <p var="Nº  documento">
                            Nº  documento
                            <span>
                                <input type="text" id="num-doc" class="integer">
                            </span>
                        </p>

                        <p var="Valor" >
                            Valor
                            <span>
                                <input type="text" class="double formatNumber" id="total-deposit">
                                <label><b>STD</b></label>
                            </span>
                        </p>
                        <button class="my-personal-button" id="payment-OK1">Seguinte</button>
                    </div>
                    <div class="modal-header">Efetuar pagamento<span title="Fechar">X</span></div>
                </div>
            </div>
        </section>

        <section class="modalPage mp-new-pgto2">
            <div class="modalFrame">
                <div class="modalContainer">
                    <nav class="alert">
                        <nav>
                            <p></p>
                            <label class="icon-arrow-up2 close-modal-alert"></label>
                        </nav>
                    </nav>
                    <div class="new-pgto2">

                        <label>
                            <label>Conta: <b id="contaPay" >4544864</b></label>
                            <label>Valor: <b id="total-value">1 520 000,00</b><b> STD</b></label>
                        </label>
                        <div class="vvv">
                            <nav class="header-pgto2">
                                <label>Fiscalização</label>
                                <label>Descrição</label>
                                <label>Valor STD</label>
                                <label>Ações</label>
                            </nav>
                            <div class="body-pgto2">
                                <section>
                                    <label>4342432</label>
                                    <label>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. </label>
                                    <label>500 000</label>
                                    <label><button></button></label>
                                </section>
                                <section>
                                    <label>4342432</label>
                                    <label>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. </label>
                                    <label>1 250 000</label>
                                    <label><button></button></label>
                                </section>
                                <section>
                                    <label>4342432</label>
                                    <label>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. </label>
                                    <label>500 000</label>
                                    <label><button></button></label>
                                </section>
                            </div>
                        </div>

                        <div class="bt-yes-no-cancel">
                            <button class="pRegPay">Concluir</button>
                            <button class="bt-no-option">Cancelar</button>
                        </div>

                    </div>
                    <div class="modal-header">Concluir pagamento<span title="Fechar">X</span></div>
                </div>
            </div>
        </section>
    </body>
    <script type="text/javascript" src="../resources/js/geralScript.js"></script>
    <script type="text/javascript" src="../resources/js/pagamento/pgto-pr.js"></script>
    <script type="text/javascript" src="../resources/js/pagamento/pagamentoControl.js"></script>
</html>