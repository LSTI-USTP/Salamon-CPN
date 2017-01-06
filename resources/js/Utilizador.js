
$(document).ready(function (e)
{
    loadApplication();
    $("#utilizadorAplicacao").change(function ()
    {
        loadMenu(); 
    });
    $('.btAddUser').click(function (e)
    {
        e.preventDefault();
        if(checkFieldsAddUser()=== true)
        {
            if(selectedMenus()===null)
                 showInfor("Registro","Selecione pelo menos um(1) menu da aplicação!");
            else
            {
                $.post("../Utilities/controller/UtilizadorController.php",
                {
                    type:5,application:$("#utilizadorAplicacao").val(),agente:$("#agenteNoUser").val(),menu:selectedMenus()
                },
                function(result)
                {
                    if(result==="true")
                    {
                        $(".modalFrameControl").fadeOut("slow");
                        $("#utilizadorAplicacao").val("");
                        $("#agenteNoUser").val("");
                        $("#menus").html("");
                        showSuccess("Registro","Novo utilizador registrado!");
                    }
                });
            }
              
        }
     
    });
    
    $('.terminarSessao').click(function (e) // termina a sessão para as aplicações de contolo e pagamento
    {
        $.post("../Utilities/controller/UtilizadorController.php",
        {
            type:4
        },
        function(result)
        {
            window.location.href="../index.html";
        });
    });
    
    $('.yes-edit-password').click(function (e)
    {
        e.preventDefault();
        changePassword();
    });
});


function loadApplication() // carrega as aplicações que o agente poderá usar
{
    $("#utilizadorAplicacao").load("../Utilities/controller/UtilizadorController.php",{type:1},function(e){});
    $("#agenteNoUser").load("../Utilities/controller/UtilizadorController.php",{type:2},function(e){});

}

function loadMenu() // carrega todos os menus da aplicação, depois de selecionar um determinado agente
{
    $.post("../Utilities/controller/UtilizadorController.php",
    {
        type:3,application:$("#utilizadorAplicacao").val()
    },
    function(result)
    {
       $("#menus").html(result);
    });
    
}

function desselcionarMenus()
{
    $(".menuAplicacao").each(function ()
    {
        $(this).attr("checked", false);  
    });
}

function changePassword() // alterar palavra-passe do utilizador logado no sistema
{
    var preenchido = true;
    $('.fieldsChangePassword').each(function ()
    {
        if($(this).val()==='')
        {
            preenchido =false;
            $(this).css('border','1px solid #dc3847');
        }
    });
    return preenchido;
}

function selectedMenus()
{
    var menu="";
    $(".menuAplicacao").each(function ()
    {
        if($(this).is(":checked"))
        {
           menu = menu+$(this).attr('id')+",";  
        }    
    });
        menu = menu.substring(0,menu.length-1);
    if(menu!=="")
       return menu;
   else return null;

}
/**
 * verifica-se o select de selecionar a aplicação e agente foram selecionados
 * retorna true válido e false inválido
 * @returns {undefined}
 */
function checkFieldsAddUser() 
{
    var valido = true;
    if($("#utilizadorAplicacao").val()==="")
    {
        $("#utilizadorAplicacao").css("border","1px solid #dc3847");
        valido = false;
    }
    if($("#agenteNoUser").val()==="")
    {
        $("#agenteNoUser").css("border","1px solid #dc3847");
        valido = false;
    }
    return valido;
}