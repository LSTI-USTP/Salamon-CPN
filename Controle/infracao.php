<!DOCTYPE html>
<html>
    <head>
        <title>Infração</title>

    </head>
    <body class="infracao">
        <?php
        include 'includes/menu.php';
        ?>

        <div class="subMenu">
            <ul>
                <li class="lista">
                    <a href="listagemInfracao.php">
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
            <div class="contentBody">
                <div>
                    <article class="contentBetween">
                        <article>
                            <h2>Inputado à</h2>
                            <input name="typeInfr" type="radio" value="condutor" id="1" ><label>Condutor</label></input>
                            <input name="typeInfr" type="radio" value="veiculo" ><label>Veículo</label></input>
                        </article>
                        <article class="areaVeiculo">
                            <h2>Veículo</h2>
                            <input name="typeVeiculo" type="radio" value="motociclo" id="2" ><label>Motociclo</label></input>
                            <input name="typeVeiculo" type="radio" value="carro" id="3" ><label>Carro</label></input>
                        </article>
                    </article>
                    <article class="ContentFlex">
                        <section>
                            <article class="Left">
                                <section>
                                    <label>Nome</label>
                                    <input id="infracaoNome" type="text" class="nome" ></input>
                                </section>
                                <section>
                                    <label>Categoria</label>
                                    <select id="infracaoCategoria"></select>
                                </section>
                            </article>
                            <article>
                            <article>
                                <section>
                                    <label>Valor Minímo</label>
                                    <input class="double formatNumber" id="infracaoValorMinimo" type="text"></input>
                                </section>
                                <section>
                                    <label>Valor Máximo</label>
                                    <input class="double formatNumber" id="infracaoValorMaximo" type="text"></input>
                                </section>
                            </article>
                            <article>
                                <section>
                                    <label>Instrumento Jurídico</label>
                                    <select id="infracaoInstrumentoJurido" ></select>
                                </section>
                                
                            </article>
                            
                                
                               
                            </article>
                            <article>
                                <section>
                                    <label>Artigo</label>
                                    <input id="infracaoArtigo" type="text" class="numeroInterio"></input>
                                </section>
                                <section>
                                    <label>Alínea</label>
                                    <input id="infracaoAlinea" type="text" class="numeroInterio"></input>
                                </section>
                                <section>
                                    <label>Ponto</label>
                                    <input id="infracaoPonto" type="text"></input>
                                </section> 
                            </article>
                        </section>
                        <section class="Right">
                            <label>Descrição</label>
                            <textarea id="infracaoDescricao" ></textarea>
                            
                        </section>
                    </article>
                    <h3>Valor de Coima</h3>
                    <article id="2" class="tipoCoimaFrequencia" >
                        <article class="areaCoimaRadio">
                            <input type="radio" value="frequencia" name="typeCoima" id="2"/><label>Frequência</label></input>
                        </article>
                        <section>
                            <label>Primário</label>
                            <input type="text" class="coimaFrequencia double formatNumber" id="infracaoPrimario" ></input>
                        </section>
                        <section>
                            <label>Reincidente</label>
                            <input type="text" id="infracaoReincidente" class="txtReicidente coimaFrequencia double formatNumber"></input>
                                
                                <div class="areaReicidente">
                                    <section>
                                        <label>De</label>
                                        <input type="text" id="infracaoDe" class="txtReicidente numeroInterio coimaFrequencia">
                                    </section>
                                    <section>
                                         <label>Á</label>
                                        <input type="text" id="infracaoValorA" class="txtReicidente numeroInterio coimaFrequencia">
                                    </section>
                                </div>
                        </section>
                        <section>
                            <label>Multi-Reincidente</label>
                            <input class="coimaFrequencia double formatNumber" id="infracaoMultiReincidente" type="text"></input>
                        </section>
                    </article>
                    <article id="3">
                        <article class="areaCoimaRadio">
                            <input type="radio" value="gravidade" name="typeCoima" id="3"/><label>Gravidade</label></input>
                        </article>

                        <section>
                            <label>Leve</label>
                            <input class="coimaGravidade double formatNumber" id="infracaoValorLeve" type="text"></input>
                        </section>
                        <section>
                            <label>Grave</label>
                            <input class="coimaGravidade double formatNumber" id="infracaoValorGrave" type="text"></input>
                        </section>
                        <section>
                            <label>Muito Grave</label>
                            <input class="coimaGravidade double formatNumber" id="infracaoValorMuitoGrave" type="text"></input>
                        </section>
                    </article>
                    <article id="1">
                        <article class="areaCoimaRadio">
                            <input type="radio" value="padrao" name="typeCoima" id="1"/><label>Padrão</label></input>
                        </article>
                        <section>
                            <label>Valor</label>
                            <input class="coimaPadrao double formatNumber" id="infracaoValorPadrao" type="text"></input>
                        </section>
                        <section>
                        </section>
                        <section>
                        </section>
                    </article>
                </div>
            </div>
            <div class="areaSave">
                <button class="icon-download3 btSave registrarInfracao">  Guardar</button>
            </div>
        </div>
         <div class="processamento modalProcess">
         <img src="../resources/img/earth.gif"class="imageProcess" />
     </div>
    </body>
    <script type="text/javascript" src="../resources/js/controle/controlerInfracao.js"></script>
    <script type="text/javascript">
            $(document).ready(function ()
            {
               $('.areaReicidente').css('display','none');
               $('.txtReicidente').focusin(function()
                {
                     $('.areaReicidente').css('display','flex');
                });

               
               $('input:not(.txtReicidente)').click(function()
                {
                     $('.areaReicidente').css('display','none');
                });
            });

    </script>

</html>