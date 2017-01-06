/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
idInfraator = "";
var idRegistar = new Array();
$(function ()
{
    $("article").children("ul").find("li").click(function (e)
    {
        carregarInfracoes();
    });
    
    $("#dataPayment").mask("99-99-9999");
    
    initi();
    
    $("div.new-pgto").find("input, select").focus(function (e) { $(this).css("border",""); });
    
//    $('nav').children("i.transition-4").click( function(e){
//	$('.mp-infractions').fadeIn('500');
//    });
    
    /*	control icon arrow to show or hide "more info" 	*/
    $('.show-info').add('.table-selected').click( function(){
            pShowInfor(this);
    });
    
    $("#bt-MulalP").click(pesquisarInfrator);
    
    $("#pesquisa-multa").keyup(function (e)
    {
        if(e.keyCode === 13)
        { pesquisarInfrator(); }
    });
    
    $("table").find("tbody#table-multa").children("tr").click(function (e)
    {
        idInfraator = $(this).attr("id");
        $("section.header-more").find("h1").eq(0).text($(this).find("td").eq(2).text());
        $("#contaPay").text($(this).find("td").eq(2).text());
//        $("#mNaoPagas").text($(this).find("td").eq(3).text());
        $("#typeInfrator").text($(this).find("td").eq(1).text());
//        $("#totalApgar").text(formatted2($(this).attr("value")));
        $(".table-selected").text($(this).find("td").eq(1).text() +" - "+$(this).find("td").eq(2).text());   
    });
    
    $('#payment-OK1').click( function(){
        validarRegistroDeposito();
        if(dValido)
        {
            $.ajax({
                beforeSend: function() 
                { $('#payment-OK1').attr("disabled","disabled"); }, 
                complete: function(e) 
                { $('#payment-OK1').removeAttr("disabled"); },
                url: "bean/Controler/ControlerPagamento.php",
                type: "POST",
                data: {type: "regDeposito",idInfrator : idInfraator,type_I:(($("#typeInfrator").text() !== "VEICULO") ? 1 : 2),data_P: $("#dataPayment").val(), type_P: $("#typePayment").val(), num_P: $("#num-doc").val(), value_P: unformatted($("#total-deposit").val())},
                dataType: "json",
                success: function (e) {
                    if (e.type === "erro")
                    {
                        showModalAlert( $('.mp-new-pgto') , e.msg);
                    }
                    else if(e.type === "sucesso")
                    {
//                        carregarOuhterDataInfrator();
                        $("table").find("tbody#table-multa").children("tr.row-selected").click();
                        carregarInfracoes();
                        total_value = Number(e.value);
                        setTotalValue(total_value);
                        $('.mp-new-pgto').add('.mp-new-pgto2').fadeToggle('500');
                    }
                }
            });
        }
    });
    
    $('.body-pgto2').on('click' , 'button'  , function(){
	var bt = $(this);
	var value_debit = Number($(this).attr("var"));
	if( bt.hasClass('payed') ){
		paying(value_debit , false);
		bt.removeClass('payed');
                var newarray = Array();
                for (var i =0; i < idRegistar.length; i++)
                {
                    if($(this).attr("varId") !== idRegistar[i])
                    { newarray[newarray.length] = idRegistar[i]; }
                }
                idRegistar = newarray;
	}
	else{
		if (isValid(value_debit)) {
			paying(value_debit , true);
			bt.addClass('payed');
                        
                        if(idRegistar)
                            idRegistar[idRegistar.length] = $(this).attr("varId");
                        else
                            idRegistar[idRegistar.length] += ";"+$(this).attr("varId");
		} else
			showModalAlert( $('.mp-new-pgto2') , ' Valor insuficiente na conta!<br> Diferença de ' + formatted2(diferenca) + ' STD');
	}

    });
    
    $(".pRegPay").click(regPagamentoFinal);
});
 function showMoreDetahesInfrator()
{
    if($("table").find("tbody#table-multa").children("tr.row-selected").text() !== "")
    {
        $('.more-info').toggleClass('more-info-showed');

        if( $('.more-info').hasClass('more-info-showed'))
        {
            $('.more-info .icon-arrow-up2').css('position' , 'fixed');
            carregarOuhterDataInfrator();
            carregarInfracoes();
        }
        else
        $('.more-info .icon-arrow-up2').css('position' , 'absolute');
    }
    else
    {   if( !$('.more-info').hasClass('more-info-showed'))
            showInfor("Pagemento","Por favor selecione um registro da Tabela!");
        else
           $('.more-info').toggleClass('more-info-showed');
    }
}
    
function carregarInfracoes()
{
    $.ajax({
        beforeSend: function() 
        { $('.processamento').css('display','flex');}, 
        complete: function(e) 
        {  $('.processamento').hide(); },
        url: "bean/Controler/ControlerPagamento.php",
        type: "POST",
        data: {type: "infraDetalhes", tView: $("li.active-menu-article").text(), idInfra: idInfraator, typeInfrator: (($("#typeInfrator").text() !== "VEICULO") ? 1 : 2)},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            {
                $("article").children("div.content-article").children("div.active-container-article").children("div").html(e.value);
                $("div.body-pgto2").html(e.value1);
            }
        }
    });
}


//function formattedValue(nStr) {
//    var num = nStr.replace(/(\s)/g, '');
//    nStr = num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
//    return nStr;
//}

function showMoreDetalhesMulta(numMulta)
{
    $.ajax({
            beforeSend: function() 
            { $('.processamento').css('display','flex');}, 
            complete: function(e) 
            {  $('.processamento').hide(); },
            url: "bean/Controler/ControlerPagamento.php",
            type: "POST",
            data: {type: "detalhesMulta", numMulta: numMulta},
            dataType: "json",
            success: function (e) {
                if (e.type === "result")
                {
                    $("div.separate").children("div").eq(0).html(e.value1);
                    $("div.separate").children("div").eq(1).html(e.value);
                    $('.mp-infractions').fadeIn('500');
                }
            }
        });
}

function initi()
{
    $.ajax({
        url: "bean/Controler/ControlerPagamento.php",
        type: "POST",
        data: {type: "init"},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            { $("#typePayment").html(e.value); }
        }
    });
}

function carregarOuhterDataInfrator()
{
    $.ajax({
        url: "bean/Controler/ControlerPagamento.php",
        type: "POST",
        data: {type: "detalhesTypeInfrator", idInfra: idInfraator, typeInfrator: (($("#typeInfrator").text() !== "VEICULO") ? 1 : 2)},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            {
                $("#apVeiculo").text((e.eVeiculo === "1") ? "Sim" : "Não");
                $("#apLivrete").text((e.eLivrete === "1") ? "Sim" : "Não");
                $("#apCarta").text((e.eCarta === "1") ? "Sim" : "Não");
                $("#mNaoPagas").text(e.multasNaoPagas);
                $("#mPagas").text(e.multasPagas);
                $("#mAdquerida").text(e.multasAqui);
                $("#totalApgar").text(formatted2(e.totalPagar));

                $("section.header-more").find("h1").eq(1).children("span").text(formatted2(e.deposito));

                $("#veiculoE").css("display", ((e.eVeiculo === "") ? "none" : "flex"));
                $("#cartaE").css("display", ((e.eCarta === "") ? "none" : "flex"));
                $("#livreteE").css("display", ((e.eLivrete === "") ? "none" : "flex"));
            }
        }
    });
}

var dValido = true;
function validarRegistroDeposito()
{
    $('.mp-new-pgto').find('.alert').slideUp();
    dValido = true;
    try
    {
        $("div.new-pgto").find("input, select").each(function (e)
        {
            if(isEmpty($(this)))
            { 
                showModalAlert( $('.mp-new-pgto') , "Por favor, preencha o campo "+$(this).closest('p').attr('var') );
                dValido=false;
                tt.keys();
            }
        });
    }
    catch(e)
    { }
    
    if(dValido)
    {
        var va = valideData($("#dataPayment"));
        if(!va)
        { showModalAlert( $('.mp-new-pgto') , 'Por favor digite uma data valida!'); dValido = false; }
    }
}

function valideData(data)
{
    var rar = data.val().split('-');
    rar = $.makeArray(rar);
    if( rar.length===3 && rar[0].length===2 && rar[1].length===2 && rar[2].length===4 )
    {
        if( $.isNumeric(rar[0]) && $.isNumeric(rar[1]) && $.isNumeric(rar[2]) && Number(rar[0]) > 0 && Number(rar[1]) > 0  && Number(rar[1]) <= 12 )
        {
            switch (Number(rar[1])) 
            {
                case 1:case 3:case 5:case 7:case 8:case 10:case 12:
                    if( Number(rar[0]) <= 31 )
                    {
                        return true;
                    }
                    return false;
                case 4:case 6:case 9:case 11:
                    if( Number(rar[0])<= 30 )
                    {
                        return true;
                    }
                    return false;
                default:
                    if ( !isBisexto(rar[2]) )
                    {
                        if( Number(rar[0]) <= 28 )
                        {
                            return true; 
                        }
                    }
                    else 
                    {
                        if( Number(rar[0]) <= 29 )
                        { 
                            return true;
                        }
                    }
                    return false;
            }
        }
        else
        { return false; }
    }else
    { return false; }
}

function isBisexto(valor)
    { return (( Number(valor)%4 === 0 && Number(valor)%100 !== 0 ) || (Number(valor)%400 === 0) ); }
    
function isEmpty( element ) {  
    return (element.val().replace(/\s/g , '') === '');
}

function pesquisarInfrator()
{
    $.ajax({
        url: "bean/Controler/ControlerPagamento.php",
        type: "POST",
        data: {type: "pesquisaInfrator", pesquisa:$('#pesquisa-multa').val()},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            { 
                $("#table-multa").html(e.value); 
                var rowCount = $('#table-multa tr').length;
                $('#table-found span').html(rowCount);
            }
        }
    });
}
function regPagamentoFinal()
{
    getStringIsReges();
    if(idSeletedReg !== "")
    {
        $.ajax({
            url: "bean/Controler/ControlerPagamento.php",
            type: "POST",
            data: {type: "regPagamento", idFisca:idSeletedReg},
            dataType: "json",
            success: function (e) {
                if (e.type === "sucesso")
                { 
                    $('.mp-new-pgto2').fadeOut('500'); 
                    showSuccess("Pagamento", e.value);
                    $('#pesquisa-multa').val("");
                    pesquisarInfrator();
                    
                    if( $('.more-info').hasClass('more-info-showed'))
                    { carregarOuhterDataInfrator(); carregarInfracoes(); }
                }
                if (e.type === "erro")
                { showModalAlert( $('.mp-new-pgto2') , e.msg);}
            }
        });
    }
    else
    { showModalAlert( $('.mp-new-pgto2') , 'Por favor, selecione a fiscalização a pagar!'); }
}
var idSeletedReg = "";
function getStringIsReges()
{
    idSeletedReg = "";
    for (var i=0; i < idRegistar.length ; i++)
    {
        if(i === 0)
        { idSeletedReg = idRegistar[i]; }
        else
        { idSeletedReg += ";;"+idRegistar[i]; }
    }
}
var tableTrSele;
function pShowInfor(sele)
{
    
    $("table").find("tbody#table-multa").children("tr.row-selected").trigger("click");
    tableTrSele = $(sele).parent().parent();
//        $("table").find("tbody#table-multa").children("tr.row-selected").trigger("keyup");
        
        setTimeout(showMoreDetahesInfrator,1000);
}