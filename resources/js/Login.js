var idAgente;
var application;
$(document).ready(function (e)
{
    $('#btEntrar').click(function (e)
    {
       e.preventDefault();
        acessarSistema();
    });
    $('.txtPassword').keypress(function (e)
    {
       if(e.keyCode===13)
            $('#btEntrar').trigger("click");
    });
    
    $(".bt-no-option").click(function (e)
    {
        e.preventDefault();
        $(".alterarSenha").fadeOut();
       $("#loginNovaSenha").val("");
       $("#loginNovaSenha").css("border","");
       $("#loginConfirmarSenha").val("");
       $("#loginConfirmarSenha").css("border","");
        $(".alert").fadeOut();
    });
    
    $("#loginConfirmarSenha").keypress(function (e)
    {
        if(e.keyCode===13)
          $(".yes-edit-password").trigger("click");
    });
    $(".modal-header").click(function (e)
    {
       e.preventDefault();
        $(".bt-no-option").trigger("click");
    });
    $(".yes-edit-password").click(function(e)
    {
       e.preventDefault();
    
       if(ativarLogin()=== true)
       {
            $.post("Controle/controller/LoginController.php",
            {
                type:2,senha:$("#loginNovaSenha").val(),idAgente:idAgente
            },
            function(result)
            {
                console.log(result);
                var resultado ="";
                resultado = result.split(";");
                resultado = $.makeArray(resultado);
                if(resultado[0]==="aplicação pagamento" || resultado[0]==="aplicação controlo")
                    window.location.href=resultado[1];
            });
        }
       
    });
    
    $("input:text").focus(function ()
    {
       $(this).css("border",""); 
    });
});


function acessarSistema()
{
    var link;
    if($('.txtUser').val()!=='' && $('.txtPassword').val()!=='')
    {
        $.post("Controle/controller/LoginController.php",
        {
            type:1,nomeAcesso:$(".txtUser").val(),senha:$('.txtPassword').val()
        },
        function(result)
        {
            console.log(result);
            link = result.split(";");
            link = $.makeArray(link);
            switch (link[0])
            {
                case 'sem acesso':
                    $('#loginErrorInfo').css("display","block");
                    $('.txtPassword').focus();
                    break;
                case 'aplicação controlo':
                    $('#loginErrorInfo').css("display","none");
                    window.location.href=link[1];
                    break;
                case 'aplicação pagamento':
                    $('#loginErrorInfo').css("display","none");
                    window.location.href=link[1];
                    break;
                case 'sem acesso a essa aplicação':
                    $('#loginErrorInfo').html('Acesso negado à aplicação!');
                    $('#loginErrorInfo').css("display","block");
                    $('.txtPassword').focus();  
                    break;
                case 'ativar utilizador':
                    idAgente = link[2];
                    $(".userName").html(link[1]);
                    $(".alterarSenha").fadeIn();
                    $("#loginNovaSenha").focus();
                    break;
                case 'aplicação visualização':
                    $('#loginErrorInfo').css("display","none");
                    window.location.href=link[1];
                    break;
            }      
        });
    }
}


function ativarLogin()
{
    var valido = true;
    if($("#loginNovaSenha").val()==="")
    {
        $("#loginNovaSenha").css("border","1px solid #dc3847");
        valido = false;
    }
    if($("#loginConfirmarSenha").val()==="")
    {
        $("#loginConfirmarSenha").css("border","1px solid #dc3847");
        valido = false;
    }

    if(valido === true)
    {
        if($("#loginNovaSenha").val()!==$("#loginConfirmarSenha").val())
        {
            $(".alert").fadeIn();
            $("#loginNovaSenha").val("");
            $("#loginNovaSenha").focus();
            $("#loginConfirmarSenha").val("");
            valido = false;
        }
    }
    return valido;
}
