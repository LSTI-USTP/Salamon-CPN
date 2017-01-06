
var ArrayContent = getMonths();
var ArrayValues = setValuesCategory();
var typev = 1;
setMonths($('.months'));
setDays($('.days'));
control_List('Anual');


    
$('#title-page').text('Relatório');//adicione ponto e virgula

$('.header-1 li').add('.header-1 i').click(function () {
    var element = $(this);
    if (element.parent().hasClass('ul')) {
        element.addClass('actual-header-1').siblings().removeClass('actual-header-1');
        control_List($(this).text());
        if ($(this).index() > 2)
            $('.header-2 trouble').toggle();
        else {
            $('.header-2 trouble:first-child').show();
            $('.header-2 trouble:last-child').hide();
        }
        controlGraphicEndTable($("li.actual-header-1").text());
    }
    else {
        var elIndex = element.index();
        element.addClass('actual-category').siblings().removeClass('actual-category');
        if (element.hasClass('icon-list2')) {
            $('xpert').slideDown(400);
            $('.periodic').show();
            controlGraphicEndTable($("li.actual-header-1").text());
            typev = 1;
        }
        else {
            $('xpert').slideUp(400);
            typev = 2;
             controlGraphicEndTable($("li.actual-header-1").text());
            $('.periodic').hide();
            if ($('.periodic').hasClass('actual-header-1')) {
                $('.periodic').removeClass('actual-header-1');//adicione ponto e virgula
                $('.periodic').prev().addClass('actual-header-1');
                $('.header-2 trouble:first-child').show();
                $('.header-2 trouble:last-child').hide();
                control_List($("li.actual-header-1").text());
                controlGraphicEndTable($("li.actual-header-1").text());
            }
        }
        $('.primary-article > div').eq(elIndex).addClass('active-type').siblings().removeClass('active-type');
    }

});

$('.header-2 .icon-search').mouseenter(function () {
    $(this).next().toggleClass('extend-search');
    $('.input-search').focus();
});
$('.input-search').focusout(function () {
    $(this).removeClass('extend-search');
});




function control_List(listType) {
    if (listType === 'Anual') {
        aux_controlList(1);
    } else if (listType === 'Mensal') {
        aux_controlList(2);
    } else if (listType === 'Diário') {
        aux_controlList(3);
    }
}
function aux_controlList(final) {
    $('inline').add('span').add('label').show();
    $('inline:nth-child(' + final + ')').nextAll('inline').hide();
    var labelsFinal = $('inline:nth-child(' + final + ')').find('label');
    labelsFinal.eq(0).html('De');
    labelsFinal.eq(1).html('A');

    if (final > 1)
        while (final > 0) {
            var prevHide = $('inline:nth-child(' + (final - 1) + ')').find('span');
            prevHide.prev().html('Em');
            prevHide.eq(0).nextAll().hide();
            final--;
        }
}


function setMonths(select) {

    for (var i = 0; i < getMonths().length; i++) {
        select.append('<option value="' + getMonths()[i] + '">' + getMonths()[i] + '</option>');
    }
}
function setDays(select) {
    for (var i = 1; i <= 31; i++) {
        select.append('<option value="' + i + '">' + i + '</option>');
    }
}
function getMonths(){
	var months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
    return months;
}

function setValuesCategory(){
	var array = [111 , 0 , 3120 , 40 , 1912 , 450 , 2023 , 5125 , 180];
    return array;
}

function getReportParam(startParam) {
    var array = startParam.children().val();
    return array;
}
//alert(getReportParam( $('#day-2') ));

