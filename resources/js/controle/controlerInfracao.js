/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var dados="";
$(document).ready(function (e)
{
    infracaoEstadoInicial();
    
    $("#infracaoDe").blur(function ()
    {
        if($(this).val()!=="")
        {
            if(Number($(this).val()<=1))
            {
                showErro("Registro","Valor de De deve ser superior a 1!");
                $("#infracaoReincidente").focus();
                $(this).val("");
            }       
        }     
    });
    $("#infracaoValorA").blur(function ()
    {
        if($(this).val()!=="")
        {
            if(Number($(this).val())<Number($("#infracaoDe").val()))
            {
                $(this).val("");
                showErro("Registro","Valor de A deve ser superior ou igual a De!");
                $("#infracaoReincidente").focus();
            } 
        }
        
    });
    
    $(".registrarInfracao").click(function (e)
    {
       e.preventDefault();
       if(checkEmptyFields() === true)
       {
            if(infracaoValidarCampos() === true)
            {
                infracaoTipoCoimaDados();
                $.ajax
               ({
                   beforeSend: function() 
                   { $('.processamento').css('display','flex');}, 
                   complete: function() 
                   { 
                       $('.processamento').hide();
                   },
                   url: 'controller/InfracaoController.php',
                   type: 'POST',
                   data:dados,
                   cache: false,
                   success: function(result) 
                   {
                        console.log(result);
                       if(result==="Nome de Infração já existe")
                       {
                           showErro("Registro","Nome de infração já existe!");
                           $("#infracaoNome").css("border","1px solid #dc3847");
                       }
                       else if( result === "infração registrada com sucesso")
                       {
                            showSuccess("Registo","Infração "+$("#infracaoNome").val()+" registrado com sucesso!");
                            infracaoEstadoInicial();
                       }
                       else
                       { showErro("Registo Infranção",result); }
            
                   }
               });
            }
       }
    });
    $("input:radio[name='typeInfr']").click(function (e)
    {

        if($(this).val()==="veiculo")
            $("input:radio[name='typeVeiculo']").attr("disabled", false);
        else
        {
            $("input:radio[name='typeVeiculo']").attr("disabled", true);
            $("input:radio[name='typeVeiculo']").attr("checked", false);
        }
    });
    $("input:radio[name='typeCoima']").click(function (e)
    {
        if($(this).val()==="padrao")
        {
            $(".coimaPadrao").attr("disabled", false);
            $(".coimaGravidade").css("border","");
            $(".coimaGravidade").val("");   
            $(".coimaGravidade").attr("disabled", true);
            $(".coimaFrequencia").css("border","");
            $(".coimaFrequencia").val("");
            $(".coimaFrequencia").attr("disabled", true);
           
        }
        else if($(this).val()==="frequencia")
        {
            $(".coimaFrequencia").attr("disabled", false);
            $(".coimaGravidade").css("border","");
            $(".coimaGravidade").val("");   
            $(".coimaGravidade").attr("disabled", true);
            $(".coimaPadrao").css("border","");
            $(".coimaPadrao").val("");
            $(".coimaPadrao").attr("disabled", true);
        }
        else
        {
            $(".coimaGravidade").attr("disabled", false);
            $(".coimaFrequencia").css("border","");
            $(".coimaFrequencia").val("");
            $(".coimaFrequencia").attr("disabled", true);
            $(".coimaPadrao").css("border","");
            $(".coimaPadrao").val("");
            $(".coimaPadrao").attr("disabled", true);
        }
    });
    
    
    
});

   

function infracaoEstadoInicial()
{
    $(".ContentFlex [type=text], select").each(function ()
    {
       $(this).val("");
       $(this).css("border","");    
    });
    $("#infracaoDescricao").val("");
    $("#infracaoDescricao").css("border","");
    $("#infracaoCategoria").load("controller/InfracaoController.php",{type:1},function(e) { });
    $("#infracaoInstrumentoJurido").load("controller/InfracaoController.php",{type:2},function(e) { });
    $(".coimaFrequencia").attr('disabled', true);
    $(".coimaFrequencia").val("");
    $(".coimaFrequencia").css("border","");
    $(".coimaGravidade").attr('disabled', true);
    $(".coimaGravidade").val("");
    $(".coimaGravidade").css("border","");
    $(".coimaPadrao").attr('disabled', true);
    $(".coimaPadrao").val("");
    $(".coimaPadrao").css("border","");
    $("input:radio[name='typeInfr']").attr("checked", true);
    $("input:radio[name='typeVeiculo']").attr("disabled",false);
    $("input:radio[name='typeVeiculo']").attr("checked", true);
    $("input:radio[name='typeCoima']").attr("checked", false);
  
   
}

function checkEmptyFields() // verifica todos os campos obrigatórios vazios, atribuindo uma borda
{
    var valido= true;
    var tipoInfracao= $("input:radio[name='typeInfr']:checked").val();
    var tipoCoima = $("input:radio[name='typeCoima']:checked").val();

    $(".ContentFlex [type=text], select").each(function ()
    {
       if($(this).val()==="")
       {
           $(this).css("border","1px solid #dc3847");
           valido = false;
       }
    });
    if($("input:radio[name='typeCoima']").is(":checked")===false)
    {
        showInfor("Registro","Selecione o tipo de coima:\n\rfrequência, gravidade ou padrão!");
        valido = false;
    }
    else
    {
        if(tipoCoima==="frequencia") // se o tipo de coima for frequência verifica-se os campos relacionados foram preenchidos
        {
            $(".coimaFrequencia").each(function ()
            {
                if($(this).val()==="")
               {
                   $(this).css("border","1px solid #dc3847");
                   valido = false;
               }
            });
        }
        else if(tipoCoima==="gravidade")
        {
            $(".coimaGravidade").each(function ()
            {
               if($(this).val()==="")
               {
                   $(this).css("border","1px solid #dc3847");
                   valido = false;
               }
            });
        }
        else
        {
            if($(".coimaPadrao").val()==="")
            {
                $(".coimaPadrao").css("border","1px solid #dc3847");
                valido = false;
            }
        }
        if(valido === true)
        {
             if(tipoInfracao==="veiculo")
            {
               if($("input:radio[name='typeVeiculo']").is(":checked")=== false)
               {
                    showInfor("Registro","Selecione o tipo de veiculo!");
                    valido = false;
               }
            }
        }
    }
    return valido;  
}

function infracaoValidarCampos()
{
    var valido = true;
    var tipoCoima = $("input:radio[name='typeCoima']:checked").val();
     if(parseFloat(unformatted($("#infracaoValorMinimo").val()))>parseFloat(unformatted($("#infracaoValorMaximo").val())))
     {
         $("#infracaoValorMinimo").css("border","1px solid #dc3847");
         $("#infracaoValorMaximo").css("border","1px solid #dc3847");
         showErro("Registro","Valor minímo deve ser inferior ao valor máximo!");  
         valido = false;
    }
    else
    {
        if(tipoCoima==="frequencia")
        {
            if((parseFloat(unformatted($("#infracaoPrimario").val()))<parseFloat(unformatted($("#infracaoValorMinimo").val()))) 
                    || parseFloat(unformatted($("#infracaoPrimario").val()))>parseFloat(unformatted($("#infracaoValorMaximo").val())))
            {
                  showErro("Registro","Valor primário deve estar entre o valor minímo e máximo!");  
                  $("#infracaoPrimario").css("border","1px solid #dc3847");
                  valido = false;
            }
            else
            {
                 if((parseFloat(unformatted($("#infracaoReincidente").val()))<=parseFloat(unformatted($("#infracaoValorMinimo").val()))) ||
                     (parseFloat(unformatted($("#infracaoReincidente").val()))>=parseFloat(unformatted($("#infracaoValorMaximo").val()))) ||
                     (parseFloat(unformatted($("#infracaoReincidente").val()))<=parseFloat(unformatted($("#infracaoPrimario").val()))))
                {
                    $("#infracaoReincidente").css("border","1px solid #dc3847");
                      showErro("Registro","Valor reincidente  deve estar entre o valor minímo e máximo e superior ao valor primário!");  
                      valido = false;
                }
                else
                {
                     if((parseFloat(unformatted($("#infracaoMultiReincidente").val()))<=parseFloat(unformatted($("#infracaoValorMinimo").val()))) ||
                     (parseFloat(unformatted($("#infracaoMultiReincidente").val()))>parseFloat(unformatted($("#infracaoValorMaximo").val()))) ||
                     (parseFloat(unformatted($("#infracaoMultiReincidente").val()))<=parseFloat(unformatted($("#infracaoReincidente").val()))))
                    {
                        $("#infracaoMultiReincidente").css("border","1px solid #dc3847");
                          showErro("Registro","Valor multi-reincidente  deve estar entre o valor minímo e máximo e superior ao valor reincidente!");  
                          valido = false;
                    }
                }
            }    
        }
        else if(tipoCoima==="gravidade")
        {
            if((parseFloat(unformatted($("#infracaoValorLeve").val()))<parseFloat(unformatted($("#infracaoValorMinimo").val()))) 
                    || parseFloat(unformatted($("#infracaoValorLeve").val()))>parseFloat(unformatted($("#infracaoValorMaximo").val())))
            {
                  showErro("Registro","Valor leve deve estar entre o valor minímo e máximo!");  
                  $("#infracaoValorLeve").css("border","1px solid #dc3847");
                  valido = false;
            }
            else
            {
                 if((parseFloat(unformatted($("#infracaoValorGrave").val()))<=parseFloat(unformatted($("#infracaoValorMinimo").val()))) ||
                     (parseFloat(unformatted($("#infracaoValorGrave").val()))>=parseFloat(unformatted($("#infracaoValorMaximo").val()))) ||
                     (parseFloat(unformatted($("#infracaoValorGrave").val()))<=parseFloat(unformatted($("#infracaoValorLeve").val()))))
                {
                    $("#infracaoValorGrave").css("border","1px solid #dc3847");
                     showErro("Registro","Valor grave  deve estar entre o valor minímo e máximo e superior ao valor leve!");  
                     valido = false;
                }
                else
                {
                     if((parseFloat(unformatted($("#infracaoValorMuitoGrave").val()))<=parseFloat(unformatted($("#infracaoValorMinimo").val()))) ||
                     (parseFloat(unformatted($("#infracaoValorMuitoGrave").val()))>parseFloat(unformatted($("#infracaoValorMaximo").val()))) ||
                     (parseFloat(unformatted($("#infracaoValorMuitoGrave").val()))<=parseFloat(unformatted($("#infracaoValorGrave").val()))))
                    {
                        $("#infracaoValorMuitoGrave").css("border","1px solid #dc3847");
                          showErro("Registro","Valor muito grave  deve estar entre o valor minímo e máximo e superior ao valor grave!");  
                          valido = false;
                    }
                }
            }    
        }
        else
        {
            if((parseFloat(unformatted($("#infracaoValorPadrao").val()))<parseFloat(unformatted($("#infracaoValorMinimo").val()))) 
                    || parseFloat(unformatted($("#infracaoValorPadrao").val()))>parseFloat(unformatted($("#infracaoValorMaximo").val())))
            {
                $("#infracaoValorPadrao").css("border","1px solid #dc3847");
                  showErro("Registro","Valor padrão  deve estar entre o valor minímo e máximo!");  
                  valido = false;
            }
        }
    }
    return valido;
}

function infracaoTipoCoimaDados()
{
    var tipoCoima = $("input:radio[name='typeCoima']:checked").val();
    var idTipoCoima = $("input:radio[name='typeCoima']:checked").attr("id");
    if(tipoCoima==="frequencia")
      {

        dados = {type:3,nome:$("#infracaoNome").val(),categoria:$("#infracaoCategoria").val(),descricao:$("#infracaoDescricao").val(),
               valorMinimo:unformatted($("#infracaoValorMinimo").val()),valorMaximo:unformatted($("#infracaoValorMaximo").val()),artigo:$("#infracaoArtigo").val(),
               alinea:$("#infracaoAlinea").val(),tipoCoima:idTipoCoima,valorPrimario:unformatted($("#infracaoPrimario").val()),
               reincidente:unformatted($("#infracaoReincidente").val()),
               multiReincidente:unformatted($("#infracaoMultiReincidente").val()),valorDe:$("#infracaoDe").val(),
               valorA:$("#infracaoValorA").val(),modoCoima:( $("input:radio[name='typeVeiculo']").is(":checked")? $("input:radio[name='typeVeiculo']:checked").attr("id") 
                      :$("input:radio[name='typeInfr']:checked").attr("id")), ponto: $("#infracaoPonto").val(), instrumentojuridico: $("#infracaoInstrumentoJurido").val()};
       }
      else if(tipoCoima==="gravidade")
      {
             dados = {type:3,nome:$("#infracaoNome").val(),categoria:$("#infracaoCategoria").val(),descricao:$("#infracaoDescricao").val(),
               valorMinimo:unformatted($("#infracaoValorMinimo").val()),valorMaximo:unformatted($("#infracaoValorMaximo").val()),artigo:$("#infracaoArtigo").val(),
               alinea:$("#infracaoAlinea").val(),tipoCoima:idTipoCoima,valorLeve:unformatted($("#infracaoValorLeve").val()),valorGrave:unformatted($("#infracaoValorGrave").val()),
               valorMuitoGrave:unformatted($("#infracaoValorMuitoGrave").val()),modoCoima:( $("input:radio[name='typeVeiculo']").is(":checked")? $("input:radio[name='typeVeiculo']:checked").attr("id") 
                      :$("input:radio[name='typeInfr']:checked").attr("id")),ponto: $("#infracaoPonto").val(), instrumentojuridico: $("#infracaoInstrumentoJurido").val()};
      }
      else
      {
           dados = {type:3,nome:$("#infracaoNome").val(),categoria:$("#infracaoCategoria").val(),descricao:$("#infracaoDescricao").val(),
               valorMinimo:unformatted($("#infracaoValorMinimo").val()),valorMaximo:unformatted($("#infracaoValorMaximo").val()),artigo:$("#infracaoArtigo").val(),
               alinea:$("#infracaoAlinea").val(),tipoCoima:idTipoCoima,
               valorPadrao:unformatted($("#infracaoValorPadrao").val()),modoCoima:( $("input:radio[name='typeVeiculo']").is(":checked")? $("input:radio[name='typeVeiculo']:checked").attr("id") 
                      :$("input:radio[name='typeInfr']:checked").attr("id")), ponto: $("#infracaoPonto").val(), instrumentojuridico: $("#infracaoInstrumentoJurido").val()};
      }
}