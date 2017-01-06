  var id=null;
    var itens ="";
    var valores ="";
    var primeiraColuna;
     var segundaColuna = null;
$(document).ready(function() {
    pequisaLista();
    $('.menuFilter #result').on("click", abrir);
    $('.menuFilter .f_janela').on("click", fechar);
    function abrir() {
        $(".menuFilter .result").fadeIn(100);
    }
    function fechar() {
        $(".menuFilter .result").fadeOut(100);
        $(".pesquisarInfracao").val("");
    }

    $(".Smenu li").click(function () {
        $(this).addClass("activo");
    });
	/*menu ativo*/
	/*menu ativo*/
        
    $(".pesquisarInfracao").keyup(function()
    {
        carregarInfracao(); 
    });
    $(".pesquisarInfracao").click(function()
    {
        carregarInfracao(); 
    });
    
//    $(".marcar1").click(forSartTimer);
//    $(".marcar3").click(forStopTimer);
});
        
function getValueLine(varialvel)
{
    primeiraColuna = varialvel.children("td:eq(0)").text();
    segundaColuna = varialvel.attr('class');

    if($("."+"Line"+varialvel.attr('class')).attr("st")==="")
    {
        $("."+"Line"+varialvel.attr('class')).css("background-color","#09f");
        $("."+"Line"+varialvel.attr('class')).css("color","#fff");
        $("."+"Line"+varialvel.attr('class')).attr("st","true");
        valores = valores + primeiraColuna+":"+segundaColuna+";";
    } 
    else if($("."+"Line"+varialvel.attr('class')).attr("st")==="true")
    {
        $("."+"Line"+varialvel.attr('class')).css("background-color","");
        $("."+"Line"+varialvel.attr('class')).css("color","");
        $("."+"Line"+varialvel.attr('class')).attr("st","");
        valores = valores.replace(primeiraColuna+":"+segundaColuna+";","");
    }
    if($(".intracao").val()==="")
        validarSelecao();
    
    createArray();
}
function validarSelecao()
{
    $.post("controller/VisualizacaoController.php",{tdSelected:true,valores:valores},
    function(result)
    {
        $(".tabelaInf").html(result);
    });
}
function createArray()
{
    $.post("controller/VisualizacaoController.php",{array:true,valores:valores},
    function(result)
    {
        /**
         * 
         * @returns {undefined}
         * ´retorna o lista de i string esperada!
         */
//        alert(result);
    });
}
function abrir(){
    $(".menuFilter .result").fadeIn(100);
}
function fechar()
{
    $(".pesquisarInfracao").val("");
    $(".menuFilter .result").fadeOut(100);

}

function carregarInfracao()
{
  
    $.post("controller/VisualizacaoController.php",{infracao:$(".pesquisarInfracao").val(),valores:valores},
    function(result)
    {
        $(".tabelaInf").html(result);
        
    });
}

function infracaoSelecionada()
{
    
}

var  intervalID;
var iii = 0;
function forTimer()
{
    if(location+"" !== local)
    {
        deleteMarkers();
        $.ajax({
            url: "controller/VisualizacaoController.php",
            type: "POST",
            data: {listaMap:"tReal","timer":$("#tempoP").val(),  aCarta : hasBorder("#aCarta"),aCondutor: hasBorder('#aCondutor'),
                aLivrete: hasBorder('#aLivrete'), aVeiculo: hasBorder('#aVeiculo'), alto: isChecked("#alto"), media : isChecked("#media"), baixo: isChecked("#baixo")},
            dataType: "json",
            success: function (e) {
                if (e.type === "reultado")
                {
                    var arr = e.value.split(";;;");
                    arr = $.makeArray(arr);
                    $('#tAtuacao').html(e.ATUACAO); 
                    $('#tMultas').html(e.MULTAS);
                    $('#tLeve').html(e.LEVES);
                    $('#tGrave').html(e.GRAVES);
                    e.MUITOGRAVES;
                    for (var i = 0; i < arr.length; i++)
                    {
                        var dados = arr[i].split(":::");
                        dados = $.makeArray(dados);
                        
                        var marker = new google.maps.Marker({
                            map: map,
                            clickable: true,
                            id: i,
                            la: Number(dados[0]),
                            lo: Number(dados[1]),
                            position: new google.maps.LatLng(Number(dados[0]),Number(dados[1])),
                            title: "Atuação",
                            icon: "../resources/img/iconMap/"+dados[2]+".png"
                        }); //para tirar em comentario
                        
                        markers.push(marker);
                        
                        markers[i].info = new google.maps.InfoWindow({
                            
                        });

                        google.maps.event.addListener(markers[i], 'click', function (e) {
                            loadDataMap(this.la,this.lo);
                        });

//                        markers.push(marker); //para tirar de cometario
                    }
//                    map.fitBounds(bounds);
                }
            }
        });
    }
    else
    {
        $.post("controller/VisualizacaoController.php",{listaDados:"tReal","timer":$("#tempoP").val()},
        function(result)
        {
            $(".tabelafisca").html(result); 
        });
    }
}
function forSartTimer()
{
    if(location+"" !== local)
    { intervalID = setInterval(forTimer,15000);}
    else
    { intervalID = setInterval(forTimer,15000); }
}
function forStopTimer()
{ 
    clearInterval(intervalID);
}

function pequisaLista()
{
    $.post("controller/VisualizacaoController.php",{listaDados:"true"},
    function(result)
    {
        $(".tabelafisca").html(result); 
    });
}

var local = location+"";
$(function ()
{
    local = local.replace("VisualizaMapa.php","");
    
    if(local !== location+"")
        inicializar();
    
    if($("#tempoP").val()!== "")
    {
        forSartTimer();
    }
    else
    {
        forStopTimer();
        showInfor("Listagem Tempo Real","Por defina o tempo a pesquisar!");
        return false;
    }
    
});


    var map;
    var markers = [];
//    var bounds;
    var infoWindow;
    function inicializar()
    {
        if(navigator.geolocation) {
    
        var mapOptions = {
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        console.log($('.menu').height());
        $('#mapArea').height($(document).height()-$('.menu').height());
        map = new google.maps.Map(document.getElementById('mapArea'), mapOptions);
    
        navigator.geolocation.getCurrentPosition(function(position) {
        
        var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);           

        map.setCenter(geolocate);
            
        });
        
    } else { document.getElementById('mapArea').innerHTML = 'Mapa Não Disponivel!'; }
        
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
       
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
	
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}



//   Modal Informação Mapa
$('.areaTolls').hide();

$('#central').click(function(){
    $('.areaTolls').fadeOut(800);
});

//$('.closeToll').click(function(){
//    $('.areaTolls').fadeOut(800);
//});

$('#Right').click(function(){
    $('.modalValores').fadeToggle(800);
});

$('#').click(function(){
  $('.modalValores').fadeToggle(500);
});

$('.areaTolls').on('click', 'section', function(){
    loadDataInfracao($(this).attr('var'));
    console.log($(this).attr('var'));
 });
 
 $('.left').click(function(){
    $('.toolSecond').removeClass('show');
    $('.toolSecond').fadeOut(250);
 });



// Menu Lateral Aparecer
 $('.menuFilter').mouseover(function(){
    $(this).addClass('visible');
 });

 $('.menuFilter').mouseout(function(){
    $(this).removeClass('visible');
 });



//Imagem Apreenção Selecionada
 $('#apre img').click(function(){
    $(this).toggleClass('border');
 });


//Controlo Menu Mais Informações
$('.menuV .infracao').click(function(){
    $('.menuV .geral').removeClass('menuactive');
    $(this).addClass('menuactive');   
    $('.Minfracoes').removeClass('esconde');
    $('.Mgeral').addClass('esconde');   
});

$('.menuV .geral').click(function(){
    $('.menuV .infracao').removeClass('menuactive');
    $(this).addClass('menuactive');
    $('.Minfracoes').addClass('esconde');
    $('.Mgeral').removeClass('esconde');
});
 
$('.areaValores article').click(function(){
    $('.titleTool').text($(this).find("label").eq(0).text());
    $('.modalValores').removeClass('rightSHOW');
    $('.areaTolls').fadeOut(500);
});

$('.yes').fadeOut();

$('table').click(function(){
    alert('Clicou');
    // $('.yes').fadeIn(500);
});

 
 function loadDataMap(lat,log)
 {
     $.ajax({
            url: "controller/VisualizacaoController.php",
            type: "POST",
            data: { type : "loadDadosPontoMap", "timer" : $("#tempoP").val(),'LATITUDE' : lat, 'LONGITUDE' : log},
            dataType: "json",
            success: function (e) { 
                if (e.type === "reultado") {  $(".loadDataMap").html(e.value); } 
                $('.areaTolls').show();
                $('.toolSecond').hide();
            }
        });
 }
 
 function loadDataInfracao(ids)
 {
     $.ajax({
            url: "controller/VisualizacaoController.php",
            type: "POST",
            data: { type : "loadDataInfracao", idFisca : ids},
            dataType: "json",
            success: function (e) { 
                if (e.type === "reultado")
                {
                    
                    $('#inf-atuacao').html("Atuação: "+e.CODIGOFISCALIZACAO);
                    $('#inf-maticula').html("Matrícula: "+e.MATRICULA);
                    $('#inf-carta').html('<i class="icon-profile"></i> '+((e.CARTA === null) ? "" : e.CARTA) );
                    $('#inf-veiculo').html(e.CATEGORIAVEICULO);
                    $('#inf-condutor').html('<img src="../resources/img/motorista.png" class="imgMotorista"> '+((e.CONDUTOR === null) ? "": e.CONDUTOR));
                    $('#inf-agente').html('<img class="policial" src="../resources/img/policial.png"> '+ e.ALOCACAO);
//                    $('').html(e.ZONA);
//                    $('').html(e.ESTADOPAGAMENTO);
                    $('#inf-multa-valor').html('<i class="icon-coin-dollar"></i> '+e.MULTA);
                    $('#inf-infracao').html(e.INFRACAO.length+" Infrações");
//                    $('').html(e.ESTADOCONDUTOR);
//                    $('').html(e.EXISTENCIACARTA);
//                    $('').html(e.EXISTENCIALIVRETE);
//                    $('').html(e.DATA_REGISTRO);


                    var tabela = "<table>  <thead> <tr> <th>Infração</th><th>I. Jurídico</th><th>Valor Aplicado</th><th>Gravidade</th><th>Tipo Infração</th> </tr> </thead>";
                    tabela += "<tbody>";
                    
                    for (var i=0; i < e.INFRACAO.length; i++)
                    {
                       tabela +=  '<tr>';
                       tabela +=  '<td>'+e.INFRACAO[i]+'</td>';
                       tabela +=  '<td>'+e.INTRUMENTOJURIDICO[i]+'</td>';
                       tabela +=  '<td>'+e.VALORAPLICADO[i]+'</td>';
                       tabela +=  '<td>'+e.GRAVIDADE[i]+'</td>';
                       tabela +=  '<td>'+e.TIPOINFRACAO[i]+'</td>';
                       tabela +=  '</tr>';
                    }
                    tabela += "<table>";
            
                    var label = "";
                    
                    $('#inf-infracao-valores-outros').html(tabela);
                    
                    $('#inf-infracao-valores').html(label);
                    
                    $('.tool section').removeClass('Selected');
                    $(this).addClass('Selected');
                    $('.toolSecond').show();
                    $('.toolSecond').addClass('show');
                } 
            }
        });
 }

 function hasBorder(idd)
 {
     if($(idd).hasClass("border"))  return 1;
     else   return 0;
 }
 
 function isChecked(idd)
 {
     if($(idd).is(':checked')) return 1;
     else   return 0;
 }
