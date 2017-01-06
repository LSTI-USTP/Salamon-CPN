$(document).ready(function(e)
{
    
    $(".numerosReais").keyup(function(e){
        e.preventDefault();
        // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
        if(!$.isNumeric($(this).val()))
            $(this).val("");
   });
    $(".adicionarInfracao").click(function(e)
    {
        verificarCampo($(".tipoInfracao"));
        verificarCampo($(".nomeInfracao"));
        verificarCampo($(".valorCoima"));
        verificarCampo($(".descricaoCoima"));
    });
  
    
    
    //Ao ganhar foco retira a borda vermelha
    $("input:text, select, textarea").focus(function(e)
    {
       $(this).css("border",""); 
    });
});




// função que retorna se o campo estiver preenchido e false caso contrário
function verificarCampo(formField)
{
    var valido = true;
    if(formField.val()==="" || formField.val()==="(Selecione)")
    {
        formField.css("border","1px solid red");
        valido = false;
    }
    return valido;
}