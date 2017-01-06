<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../resources/css/geralStyle.css">
    <link rel="stylesheet" href="../resources/css/geralTable.css">
    <link rel="stylesheet" href="../resources/css/fonts.css">
    <link rel="stylesheet" href="../resources/css/X-alert.css">
    <link rel="stylesheet" href="../resources/css/pagamento/menuStyle.css">
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
    <div class="menu">
    	<nav class="logo"></nav>
        <ul class="menuPrincipal">
            <li id="10101"><a href="index.php" id="menu-pr" class="activeMenu"    ><i class="icon-home2 ">  </i>Pagamento</a></li>
            <li id="10102"><a href="pgto-rt.php" id="menu-rt" ><i class="icon-stats-bars ">  </i>Relatórios</a></li>
	 </ul>
    </div>
    <div class="menu-2">
    	<h1 id="title-page"></h1>
        <label class="user"><i class="icon-user"></i> <?php incluirClasseSessao();echo Session::user(); ?>
        <ul>
            <li id="edit-pass">Editar senha</li>
            <li id="logout">Sair</li>
        </ul>
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
                        <input type="password" class="component-shadow fieldsChangePassword">
                    </p>
                    <p>
                        Nova senha
                        <input type="password" class="component-shadow fieldsChangePassword">
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
                <div class="modal-header">
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
    <div class="processamento modalProcess">
         <img src="../resources/img/earth.gif"class="imageProcess" />
    </div>
</body>
<script type="text/javascript" src="../resources/js/jQuery.js"></script>
<script type="text/javascript" src="../resources/js/geralScript.js"></script>
<script type="text/javascript" src="../resources/js/Utilizador.js"></script>
<script type="text/javascript" src="../resources/js/X-alert.js"></script>
<script type="text/javascript" src="../resources/js/forMask.js"></script>
</html>

<?php
 include '../Utilities/CheckSession.php';
function incluirClasseSessao()
{
    require '../Utilities/validacao/Session.php';
    require '../Utilities/modelo/Utilizador.php';
}
?>
