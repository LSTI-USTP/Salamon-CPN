/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var idSelected = "";
var simDatas = "";
var valido = true;
var ar = new Array();
$(document).ready(function (e)
{
    getInicialData();
    
    $("#regDispositivo").on("click", regDisistivo);
    
    $("#addSim").on("click", addSim);
    
    $("#typeCatao").click(function (e) 
    {
        if($("#typeCatao:checked").attr("value")==="1" && ar.length === 2 )
        {
            simDatas = ar[0];
            var arVal = ar[1].split(':::');
            arVal = $.makeArray(arVal);
            $("#simNum").val(arVal[0]);
            $("#simPin").val(arVal[1]);
            $("#simPUK").val(arVal[2]);
            contruirArray();
            creatTable();
        }
    });
    
    $("#simNum").on("change",valideNum);
    $("#simPUK").on("change",validePUK);
    $("#simPin").on("change",validePin);
    
    $("input:text").click(function (e)
    { soCor($(this),""); });
    
});

function getDadosDispositivos(id)
{
   $.post("controller/dispositivo.php",{type:"getDisAllData",id:id},function(e) 
   { 
       var ar = e.split(';;');
       var dados = $.makeArray(ar);
       if(dados.length===5)
       {
            idSelected = id;
            $("#disMarca").val(dados[0]);
            $("#disModelo").val(dados[1]);
            $("#disIMEI").val(dados[2]);
            $("#disVersao").val(dados[3]);
            $("#disPolegada").val(dados[4]);
       }
   }); 
}

function getInicialData()
{
    $.post("controller/dispositivo.php",{type:"getCorlor"},function(e) 
    { 
        $("#disCorTra").html(e);
        $("#disCorFre").html(e);
    });
    getListDispositivo();
}

function getListDispositivo()
{
    $("#contenerDispo").load("controller/dispositivo.php",{type:"listDis"},function(e) {});
}

function regDisistivo()
{
    if(idSelected !== "" && simDatas !== "" && validarCor())
    {  
       $.post("controller/dispositivo.php",
       {type:"regDispo",id:idSelected,inf:$('#disInfor').val(),corTraz:$('#disCorTra').val(),corFran:$('#disCorFre').val(), cartaData : simDatas ,
       numSim : $("#typeCatao:checked").attr("value")},function(e)
       {
           getListDispositivo();
           limparValorSim();
           limparDispositivo();
           simDatas = "";
           creatTable();
           showInfor("Dispositivo", e);
       });
    }
    else
    {
        showErro("Dispositivo","Sem informação suficiente para registar o dispositivo!");
    }
}

function addSim()
{
    contruirArray();
    validarSim();
    if (($("#typeCatao:checked").attr("value") === "1" && simDatas === "") ||
            ($("#typeCatao:checked").attr("value") === "2" && simDatas === ""))
    {
        if(valido)
        {
            simDatas = $("#simNum").val() + ":::" + $("#simPin").val()+ ":::" + $("#simPUK").val();
            limparValorSim();
            creatTable();
        }
    }
    else if (($("#typeCatao:checked").attr("value") === "1" && simDatas !== "") ||
            ($("#typeCatao:checked").attr("value") === "2" && simDatas !== "" && ar.length === 2))
    {
        showErro("Dispositivo","Imposivel adicionar mais destahes de cartão!");
    }
    else if ($("#typeCatao:checked").attr("value") === "2" && simDatas !== "" && ar.length < 2)
    {
        if(valido)
        {
            simDatas += ";;;" + $("#simNum").val() + ":::" + $("#simPin").val()+ ":::" + $("#simPUK").val();
            limparValorSim();
            creatTable();
        }
    }
    contruirArray();
}

function  contruirArray()
{
    ar = simDatas.split(";;;");
    ar = $.makeArray(ar);
}

function testeVasio(variavel)
{
    var teste=true;
    //alert(variavel.val());
    if(variavel.val()==="")
    {
        variavel.css("border","1px solid red");
        variavel.focus();
        teste=false;
    }
    else
    {
        if(valido)
        variavel.css("border","");
    }
    return teste;
}

function limparValorSim()
{
    $("#simNum").val("");
    $("#simPUK").val("");
    $("#simPin").val("");
}

function limparDispositivo()
{
    $("#disMarca").val("");
    $("#disModelo").val("");
    $("#disIMEI").val("");
    $("#disVersao").val("");
    $("#disPolegada").val("");
    $("#disInfor").val("");
}

function creatTable()
{
    $("#contentSim").load("controller/dispositivo.php",{type:"pinTabela",valores:simDatas},function(e) {});
}

function validePin()
{
    if($("#simPin").val().length<4 || $("#simPin").val().length>8)
    {
        valido = false;
        soCor($("#simPin"),"red");
        showInfor("Dispositivo","O número de PIN deve estar \n\r entre os 4 a 8 digitos!");
    }
    else
    { 
        if(valido) {valido = true;}
        soCor($("#simPin"),"");
    } 
}

function validePUK()
{
    if($("#simPUK").val().length!==8)
    {
        valido = false;
        soCor($("#simPUK"),"red");
        showInfor("Dispositivo","O número do PUK deve conter 8 digitos!");
    }
    else
    { 
        if(valido) {valido = true;}
        soCor($("#simPUK"),"");
    }
}

function valideNum()
{
    if($("#simNum").val().length!==7)
    {
        valido = false;
        soCor($("#simNum"),"red");
        showInfor("Dispositivo","O número de Telefone deve conter 7 digitos!");
    }
    else
    { 
        if(valido){valido = true;}
        soCor($("#simNum"),"");
    }
    
    existeNumberPhone();
}

function validarSim(){
    valido = true;
    valideNum();
    validePUK();
    validePin();
}

function soCor(variavel, cor)
{
    if(cor !== "") { variavel.css("border","1px solid "+cor); }
    else { variavel.css("border",cor); }
}

function existeNumberPhone()
{
    for (var i = 0 ; i< ar.length; i++)
    {
        var value = ar[i].split(":::"); 
        value = $.makeArray(value);
        if(value.length===3)
        {
            if(value[0] === $("#simNum").val())
            {
                showErro("Dispositivo","O número de telefone já foi utlizado!");
                valido = false;
                soCor($("#simNum"),"red");
                break;
            }
            else
            {
                if(valido)
                {soCor($("#simNum"),"");}
            }
        }
    }  
}

function validarCor()
{
    var v = true;
    if($('#disCorTra').val() === "")
    { v = false; soCor($('#disCorTra'),"red"); }
    else
    { soCor($('#disCorTra'),""); }
    
    if($('#disCorFre').val() === "")
    { v = false; soCor($('#disCorFre'),"red"); }
    else
    { soCor($('#disCorFre'),""); }
    return v;
}