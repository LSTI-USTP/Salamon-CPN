<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../resources/css/geralStyle.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/X-alert.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/fonts.css">        
        <link rel="stylesheet" type="text/css" href="../resources/css/controle/estiloMenus.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/controle/styleGeral.css">

        
    </head>

    <body>
        <div class="X-Notific modalNotif">	
            <div class="X-type">
                <i></i>
                <Xtag>
                    <h1 class="notifTitle">Title here!</h1>
                    <p class="notifText">
                    </p>
                </Xtag>
                <span class="X-close" title="Fechar">X</span>
            </div>
        </div>

        <!-- Menu principal- Pagina que chama ao clicar -->
        <div class="menu">
            <ul id="controloMenus">
<!--                <li class="visualizacao" >
                    <a href="VisualizaMapa.php">
                        <i class="icon-eye"></i> Visualização 
                    </a>
                </li>-->

                <li class="equipa" id="10202">
                    <a href="equipa.php">
                        <i class="icon-users"></i> Equipa
                    </a>
                </li>

                <li class="infracao" id="10203">
                    <a href="listagemInfracao.php">
                        <i class="icon-warning"></i> Infração
                    </a>
                </li>

                <li class="agente" id="10204">
                    <a href="listagemAgente.php">
                        <i class="icon-man"></i> Agente
                    </a>
                </li>
                <li class="dispositivo" id="10205">
                    <a href="listagemDispositivo.php">
                        <i class="icon-mobile"></i> Dispositivo
                    </a>
                </li>
                <li class="relatorio" id="10206">
                    <a href="relatorios.php">
                        <i class="icon-stats-bars"></i> Relatórios
                    </a>
                </li>
                <li class="administracao" id="10207">
                    <a href="Utility.php">
                        <i class="icon-cog"></i> Administração
                    </a>
                </li>

            </ul>

            <label><a href="#"></a>
                <i class="icon-user"></i> <?php incluirClasseSessao();echo Session::user(); ?>
                <div class="AreaUser">
                    <ul>
                        <li  id="edit-pass">
                            <i class="icon-key" ></i>
                            Editar Palavra-Passe
                        </li>
                        <li id="logout">
                            <i class="icon-exit"></i>
                            Terminar Sessão
                        </li>

                    </ul>
                </div>

            </label>
        </div>
        <section class="modalPage mp-edit-password">
            <div class="modalFrame">
                <div class="modalContainer">

                    <nav class="alert">
                        <nav>
                            <p></p>
                            <label class="icon-arrow-up2 close-modal-alert"></label>
                        </nav>
                    </nav>  

                    <div class="edit-password">
                        <p><?php echo Session::nomeUtilizador(); ?> </p>
                        <p>
                            Senha atual
                            <input type="password" class="component-shadow fieldsChangePassword" >
                        </p>
                        <p>
                            Nova senha
                            <input type="password" class="component-shadow fieldsChangePassword" >
                        </p>
                        <p>
                            Confirme nova senha
                            <input type="password" class="component-shadow fieldsChangePassword">
                        </p>
                    </div>
                    <div class="bt-yes-no-cancel">
                        <button class="yes-edit-password">Confirmar</button>
                        <button class="bt-no-option">Cancelar</button>
                    </div>
                    <div class="modal-header" id="changePassword">
                        <b>Editar senha</b>
                        <span>X</span>
                    </div>
                </div>
            </div>
         </section>
        
        
        <section class="modalPage mp-logout">
            <div class="modalFrame">
                <div class="modalContainer">
                    <p>Deseja realmente terminar a sessão?</p>
                    <div class="bt-yes-no-cancel">
                        <button class="terminarSessao">Sim</button>
                        <button class="bt-no-option">Não</button>
                    </div>

                    <div class="modal-header">
                        <b>Terminar Sessão!</b>
                        <span title="Fechar">X</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="modalPage modal-info">
            <div class="modalFrame">
                <div class="modalContainer">
                    <div class="more-1">
                        <p><span>Type here!</span><span1>Specification here!</span1></p>
                    </div>
                    <div class="modal-header">
                        <b id="title-more-inf">Title here!</b>
                        <span>X</span>
                    </div>
                </div>
            </div>
        </section>
    </body>

    <script type="text/javascript" src="../resources/js/jQuery.js"></script>
    <script type="text/javascript" src="../resources/js/controle/menuPrincipal.js"></script>
    <script type="text/javascript" src="../resources/js/controle/scriptGeral.js"></script>
    <script type="text/javascript" src="../resources/js/geralScript.js"></script>
    <script type="text/javascript" src="../resources/js/Utilizador.js"></script>
    <script type="text/javascript" src="../resources/js/X-alert.js"></script>
    <script type="text/javascript" src="../resources/js/controle/listagemControler.js"></script>
</html>

<?php
 include '../Utilities/CheckSession.php';
    function incluirClasseSessao()
    {
        include '../Utilities/validacao/Session.php';
        include '../Utilities/modelo/Utilizador.php';
    }
?>