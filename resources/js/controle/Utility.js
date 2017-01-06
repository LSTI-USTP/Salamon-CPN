var objDes, idObjDes;
$(document).ready(function ()
{
    addUtility($(".liSelected").attr("sup_id") !== "",$(".liSelected"));

    /* Control menus in article in ADMItem1*/

    $('.specificList label').click(function(){
            $(this).addClass('activespecific').siblings().removeClass('activespecific');
    });

    $('#btRegUt').click(function(){
        regUtilitario();
    });


    /* Control lateral menu in Utility*/
    $('.lateral-adm2 li').click( function(){
            $(this).addClass('liSelected').siblings().removeClass('liSelected');
            addUtility($(this).attr("sup_id") !== "",$(this));
    });
    
    $("#loadSelect").change(function (e)
    {
        loadLabel($(".liSelected"));
    });
    
    $("#util_b").click(function (e)
    {
        loadLabelP($(".liSelected"));
    });
    
    $("#util_p").keyup(function (e)
    {
        if(e.keyCode === 13)
        { $("#util_b").click(); } 
    });

});

function addUtility (hasCombo,obj) 
{
    if ( hasCombo === true )
    {
        $('.add-utility').addClass('with-select');
        $('.add-utility select').show();
        $("#loadSelect").html("");
        loadComobox(obj);
        loadLabel(obj);
    } else
    {
        $('.add-utility').removeClass('with-select');
        $('.add-utility select').hide();
        $("#loadSelect").html("");
        loadLabel(obj);
    }
    var text = obj.html();
    $("#regObj").attr("placeholder"," Nova "+ text +" ...");
    $('.titleRelat').html( text);
}

function loadLabel(obj)
{ 
    $(".dataRelat").load("controller/Utilitario.php",{type:"loadLabel",id:obj.attr("id"),comoObj:$("#loadSelect").val()},function (e){});
}

function loadLabelP(obj)
{ 
    $(".dataRelat").load("controller/Utilitario.php",{type:"loadLabelP",id:obj.attr("id"),comoObj:$("#loadSelect").val(),pesq:$("#util_p").val()},function (e){});
}

function loadComobox(obj)
{ $("#loadSelect").load("controller/Utilitario.php",{type:"loadComobox",sup_id:obj.attr("sup_id"),sup_desc:obj.attr("sup_desc")},function (e){}); }

function desActObj(desObj, idObj)
{
    $(".utiConfi").show();
    objDes = desObj;
    idObjDes = idObj;
}

function desaUtilitario()
{
    $(".utiConfi").hide();
    $.post("controller/Utilitario.php",{type:"desaUtilitario",obj_id:idObjDes},function (e){
        showSuccess("Utilitario",objDes +" "+e);        
        loadLabel($(".liSelected"));
    });
}

function regUtilitario()
{
    if(($('.add-utility select').attr("style")==="display: none;" && $('#regObj').val() !== "")
    ||($('.add-utility select').attr("style")!=="display: none;" && $('.add-utility select').val() !== "" && $('#regObj').val() !== "") )
    {
        $.post("controller/Utilitario.php",{type:"regUtilitario",id:$('.liSelected').attr("id"),idSuper:$('#loadSelect').val(),regObj:$('#regObj').val()},function (e){
            showSuccess("Utilitario",e);
            loadLabel($(".liSelected"));
            $('#regObj').val("");
        });
    }
    else
    {  showErro("Utilitario", "Por favor preecha o Especificação"+($('.add-utility select').attr("style")!=="display: none;" ? " ou selecione "+ $('.add-utility').find("option").eq(0).html() +"!" : "!" ) ); }
}

