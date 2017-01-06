$(document).ready(function(e)
{
    $(".titleRelat").html("Infração");
    carregarRelatorioInfracao();
    
    $("#tabelaRelatorios").on("click","tr", function (e)
    {
        e.preventDefault();
         $("#relatorioValorPesquisa").val($(this).find('td:first').text());
    });
    $("input").focus(function ()
    {
       $(this).css("border",""); 
    });
    $("li").click(function ()
    {
        $(".titleRelat").html($(this).html());
        $("#relatorioBotaoPesquisa").trigger("click");
    });
  
   $("#relatorioValorPesquisa").keypress(function (e)
   {
      if(e.keyCode === 13)
            searchReport();     
   });
   
   $("#relatorioAgrupamento").change(function (e)
   {
      e.preventDefault();
        searchReport();
   });
   $("#relatorioBotaoPesquisa").click(function (e)
   {
      e.preventDefault();
        searchReport();
   });
   
});

function carregarRelatorioInfracao()
{
    $("#tabelaRelatorios").load("controller/RelatorioController.php",{type:"carregar_infrações"},function(e){});
}

function searchReport()
{
   if(reportValidDate() === true)
   {
        $.ajax({
            url: "controller/RelatorioController.php",
            type: "POST",
            data: {type:$(".titleRelat").html(),dataInicio:$("#relatorioDataInicio").val(),dataFim:$("#relatorioDataFim").val(),
            valorPesquisa:$("#relatorioValorPesquisa").val(),agrupamento:$("#relatorioAgrupamento").val()},
            success: function (e) {
                 $("#tabelaRelatorios").html(e);
            }
        });
   }
}

function reportValidDate()
{
    if($("#relatorioDataInicio").val()!== "")
    {
        if(valideData($("#relatorioDataInicio"))=== false)
        {
             showErro("Relatório","Data de inicio inválido");
            $("#relatorioDataInicio").css("border","1px solid #dc3847");
            return false;
        }
    }
    if($("#relatorioDataFim").val()!== "")
    {
        if(valideData($("#relatorioDataFim"))=== false)
        {
            showErro("Relatório","Data de fim inválido");
            $("#relatorioDataFim").css("border","1px solid #dc3847");
            return false;
        }
    }
    return true;
}