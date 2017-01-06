/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function (e)
{
    $("div.SubmenuRel").find("li").click(function (e)
    {
        $("div.SubmenuRel").find("li").attr("class","");
        $(this).attr("class","active");
        
        if($("body").attr("class")==="agente active")
        {
            pesquisaForAgente($(this),null);
        }
        else if($("body").attr("class")==="infracao active")
        {
            pesquisaForInfracao($(this),null);
        }
        else if($("body").attr("class")==="equipa active")
        {
            pesquisaForEquipa($(this),null);
        }
        else if($("body").attr("class")==="dispositivo active")
        {
            pesquisaForDispositivo($(this),null);
        }
        
    });
    
    $(".pesqBt").click(goThePes);
    
    $(".pesqValue").keypress(function (e)
    {
         if(e.keyCode===13)
         {  goThePes(); }
    });
});

function pesquisaForAgente(seleted,pes)
{
    if(seleted.html() === "Todos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"agente",view:"Todos",pequis:pes},function(e) { });}
    else if(seleted.html() === "Em Operação")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"agente",view:"Em Operação",pequis:pes},function(e) { });}
    else if(seleted.html() === "Livres")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"agente",view:"Livres",pequis:pes},function(e) { });}
    else if(seleted.html() === "Utilizadores")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"agente",view:"Utilizadores",pequis:pes},function(e) { });}
    else if(seleted.html() === "Inativos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"agente",view:"Inativos",pequis:pes},function(e) { });}
}

function pesquisaForInfracao(seleted,pes)
{
    if(seleted.html() === "Todos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"infracao",view:"Todos",pequis:pes},function(e) { });}
    else if(seleted.html() === "Inativos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"infracao",view:"Inativos",pequis:pes},function(e) { });}
    else if(seleted.html() === "Veículos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"infracao",view:"Veículos",pequis:pes},function(e) { });}
    else if(seleted.html() === "Motorista")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"infracao",view:"Motorista",pequis:pes},function(e) { });}
}

function pesquisaForEquipa(seleted,pes)
{
    if(seleted.html() === "Em Operação")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"equipa",view:"Em Operação",pequis:pes},function(e) { });}
    else if(seleted.html() === "Todos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"equipa",view:"Todos",pequis:pes},function(e) { });}
}

function pesquisaForDispositivo(seleted,pes)
{
    if(seleted.html() === "Todos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"dispositivo",view:"Todos",pequis:pes},function(e) { });}
    else if(seleted.html() === "Disponíveis")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"dispositivo",view:"Disponíveis",pequis:pes},function(e) { });}
    else if(seleted.html() === "Em Operação")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"dispositivo",view:"Em Operação",pequis:pes},function(e) { });}
    else if(seleted.html() === "Inativos")
    {$(".loadTable").load("controller/ListagemControler.php",{typeP:"dispositivo",view:"Inativos",pequis:pes},function(e) { });}
}  
var idEquipaVar;
function terminarFicalizacao(idEquipa)
{
    idEquipaVar = idEquipa;
    $(".teminarEquipa").show();
}

function finalizarEquipa()
{
    $(".teminarEquipa").attr("disabled","disabled");
    $.post("controller/ListagemControler.php",{typeP:"equipa",type:"paraFisca",idEquipa:idEquipaVar},function(e) {
        showInfor("Listagem Equipa",e);
        $(".teminarEquipa").hide();
        pesquisaForEquipa( $("div.SubmenuRel").find("li"));
        $(".teminarEquipa").removeAttr("disabled");
    });
}

function goThePes()
{
    if ($("body").attr("class") === "agente active")
    {
        pesquisaForAgente($("div.SubmenuRel").find("li.active"),$(".pesqValue").val());
    }
    else if ($("body").attr("class") === "infracao active")
    {
        pesquisaForInfracao($("div.SubmenuRel").find("li.active"),$(".pesqValue").val());
    }
    else if ($("body").attr("class") === "equipa active")
    {
        pesquisaForEquipa($("div.SubmenuRel").find("li.active"),$(".pesqValue").val());
    } 
    else if ($("body").attr("class") === "dispositivo active")
    {
        pesquisaForDispositivo($("div.SubmenuRel").find("li.active"),$(".pesqValue").val());
    }
}

function showMoreInfor(idOjct)
{
    if($("body").attr("class")==="agente active")
    {
        showMoreInforAgente(idOjct);
    }
    else if($("body").attr("class")==="infracao active")
    {
        showMoreInforInfracao(idOjct);
    }
    else if($("body").attr("class")==="equipa active")
    {
        showMoreInforEquipa(idOjct);
    }
    else if($("body").attr("class")==="dispositivo active")
    {
        showMoreInforDispositivo(idOjct);
    }
}

function showMoreInforAgente(idOjct)
{
    setTitleInfor("Agente");
}
function showMoreInforDispositivo(idOjct)
{
    setTitleInfor("Dispositivo");
}
function showMoreInforInfracao(idOjct)
{
    setTitleInfor("Infração");
}
function showMoreInforEquipa(idOjct)
{
    setTitleInfor("Equipa");
    $.ajax({
        url: "controller/ListagemControler.php",
        type: "POST",
        data: {type:"Equipa-Operação",id:idOjct},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            {  $(".more-1").html(e.value); }
            $(".modal-info").fadeIn(750);
        }
    });
}
function showMoreInforInfracao(idOjct)
{
    setTitleInfor("Infração");
    $.ajax({
        url: "controller/ListagemControler.php",
        type: "POST",
        data: {type:"informacao-allVeiw",id:idOjct},
        dataType: "json",
        success: function (e) {
            if (e.type === "result")
            {  $(".more-1").html(e.value); }
            $(".modal-info").fadeIn(750);
        }
    });
}
function setTitleInfor(body)
{
    $("#title-more-inf").text(body+" - "+$("div.SubmenuRel").find("li.active").text());
}
