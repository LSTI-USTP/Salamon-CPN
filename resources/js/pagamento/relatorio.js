/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
$(function ()
{
    $('Xgraphic h1').text('Variação de Valores em função de Anos');
    loadDadosRelatorioPagamento();
    years();
   
    $("#year-2").change(function ()
    {
        graficoAnualConteudos();
    });
    
    $(".ul li").click(function ()
    {
        if($(this).html() ==='Anual')
            $('Xgraphic h1').text('Variação de Valores em função de Anos');
        else if($(this).html() ==='Mensal')
            $('Xgraphic h1').text('Variação de Valores em função de Meses');
        else   $('Xgraphic h1').text('Variação de Valores em função de Dias');
    });
});

function loadDadosRelatorioPagamento()
{
    $.ajax({
        url: "bean/Controler/RelatorioControler.php",
        type: "POST",
        data: {type: "loadDados",relatorio:1,agrupamento:1,dataIncio:"",dataFin:""},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            {
//                "PAGAS" => $pePagas ,"NAOPAGAS" => $peNPaga, "PAGASPRAZO" => $pePagaNP, "PAGASFORAPRAZO", $pePagaFP)
                $(".nPagas").html(e.NAOPAGAS);
                $(".pagas").html(e.PAGAS);
                $(".pagasFP").html(e.PAGASFORAPRAZO);
                $(".pagasNP").html(e.PAGASPRAZO);
                
                $(".MULTASNAOPAGAS").html(e.MULTASNAOPAGAS);
                $(".MULTASPAGAS").html(e.MULTASPAGAS);
                $(".TOTALMULTAS").html(e.TOTALMULTAS);
            }
        }
    });
}

function controlGraphicEndTable(typeGraphic){  
    var v = typev;
    $.ajax({
        url: "bean/Controler/RelatorioControler.php",
        type: "POST",
        data: {type: "loadDados2",relatorio:typev,dataIncio:"",dataFin:"",agrupamento:((typeGraphic === "Diário") ?  1 : ((typeGraphic === "Mensal") ? 2 : 3))},
        dataType: "html",
        success: function (e) {
            if(v === 1)
            {
                $(".tablePagamente").html(e);
            }
            else
            {
                ArrayContent = ['Marco','Junho'];
                ArrayValues = [10000,10000];
                $("Xgraphic").attr("ArrayContent",ArrayContent);
                $("Xgraphic").attr("ArrayValues",ArrayValues);
                console.log("ddh");
            }
        }
    });
}

function graficoAnualConteudos()
{
    	var months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        var anoInicial =  Number($("#year-1").val());
        var anoFinal =  Number($("#year-2").val());
        var arrayAnos = [];
        var index = 0;
        
        if(anoFinal > anoInicial)
        {
            for(var i =anoInicial;i<=anoFinal;i++)
            {
                arrayAnos[index] = i;
            }
        }
        
        
}

function graficArrayValues()
{
    var an
}

function years()
{
    var anos = [2016,2017,2018,2019,2020];
    var index =0;
    
    for (var i = 2016; i <=2050; i++)
    {
        $("#year-1").append('<option value="' +i+ '">' + i + '</option>');
    }
    for (var i = 2016; i <=2050; i++)
    {
        $("#year-2").append('<option value="' +i+ '">' + i + '</option>');
    }
}

function graficoAnualConteudos()
{
    
}

