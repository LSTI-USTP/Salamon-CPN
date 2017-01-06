    var infoTableView ="";
    var infoTable ="";
    var lastNumAgente ="";
    var valido = true;
    var disSelecteds= [];
    var agentSelecteds= [];
    var selectedAgente;
    var selectedDipositivo;
    
    $(document).ready(function (e)    
     {
//        $('.AreaEscAgente').text("Agente");
        teamLoadData();
//        $(".asideDevice").attr('disabled', true); // desativa o select dos dispositivos que um determinado agente irá utilizar
        $('#regTeam').bind('click',registarEquipa);                
        $("#teamAddTable").bind('click',addTable);
//        $("#equipaAgente").change(function ()
//        {
//           if($(this).val()!=='')
//           {
//               $.post('controller/EquipaController.php',
//                {
//                    type:6,numeroAgente:$(this).val()
//                },
//                function(result)
//                {
//                    if(result !=='')
//                    {
//                        $("#equipaDispositivo").html(result);
//                        $("#equipaDispositivo").attr('disabled', false);
//                    }
//                });
//           }
//        });
        
        $("#primeiroCabecalho").click(function (e)
        {
            e.preventDefault();
//            console.log("linha selecionada ");
        });
        
        $("#equipaFuncao").change(selectedFuncao);
        
        $("#equipaNumeroAgente").change(valideChangeNumAgente);
        
        $("#equipaDistrito").change(carregarZonas);
    });
    
    
   
    function registarEquipa() // verifica -se todos os select do lado direito e número de agentes estão preenchidos
    {
         valido = true;
         existeDispositivoChefe();
         var dados = { type:7,tipoFiscalizacao:$("#equipaTipo").val(),distrito:$("#equipaDistrito").val(),zona:$("#equipaZona").val(),
                outrasInf:$("#equipaOutrasInf").val(),numAgente:$("#equipaNumeroAgente").val(),
                tableData:infoTable };
            
        if($("#equipaNumeroAgente").val()==='')
        {
            $("#equipaNumeroAgente").css("border","1px solid #dc3847");
            valido = false;
        }
        $('.contentLeft select').each(function ()
        {
            if($(this).val()==='')
            {
                valido = false;
                $(this).css("border","1px solid #dc3847");
            }
        });
        
        if(infoTable === "")
        {
            valido = false;
            showInfor("Equipa","Por favor aloque agentes a equipa");
        }
        else
        {
            if(getNumRowTable() !== Number($("#equipaNumeroAgente").val()))
            {
                valido = false;
                showInfor("Equipa","A gente em falta!");
            }
        }
        
        
        if(valido === true)
        {
           $.ajax
           ({
                beforeSend: function() 
                { $('.processamento').css('display','flex');}, 
                complete: function(e) 
                {
                    $('.processamento').hide();
                },
                url: 'controller/EquipaController.php',
                type: 'POST',
                data:dados,
                cache: false,
                success: function(result) 
                { 
                    showInfor("Equipa",result);
                    infoTable = "";
                    infoTableView = "";
                    constuirTable();
                    $("#equipaTabelaAgente").load('controller/EquipaController.php',{type:4},function(e){});
                    $("select, input:text, textArea").val("");
                }
            });
        }
    }
    
    function teamLoadData() // carrega todas as informações para os select
    {
        $("#equipaTipo").load('controller/EquipaController.php',{type:1},function(e){});
        $("#equipaDistrito").load('controller/EquipaController.php',{type:2},function(e){});
        $("#equipaTabelaAgente").load('controller/EquipaController.php',{type:4},function(e){});
        $("#equipaFuncao").load('controller/EquipaController.php',{type:5},function(e){});
        $("#equipaZona").html("<option value=''>(Selecione)</option>");
        valideFuncioDispositivo();
        loadDiviceOnOpen();
    }
    

    function addTable()// verifica -se o campos agente, dispositivo e função estão preenchidos antes de serem adicionados na tabela
    {
        limpar = false;
        if(isNumber($("#equipaNumeroAgente").val()) && Number($("#equipaNumeroAgente").val()) > 0)
        {
            if(($("#nomeDispositivo").val() !== "" || $("#nomeDispositivo").attr("disabled") === "disabled") && $("#nomeAgente").val() !== "" && $("#equipaFuncao").val() !== "")
            {
                if(getNumRowTable() < Number($("#equipaNumeroAgente").val()))
                {
                    if($("#nomeDispositivo").attr("disabled") === "disabled")
                    { 
                        idDisposi = ""; 
                        selectedDipositivo = $(".fhhfhf");
                    }
                    var fun =  $("#equipaFuncao").val().split("::");
                    fun = $.makeArray(fun);
                    if(infoTableView === "")
                    {
                        infoTableView =  $("#nomeAgente").val()+"::"+fun[1]+"::"+$("#nomeDispositivo").val()+"::"+fun[0]+"::"+idDisposi;
                        infoTable =  idAgente+"::"+fun[0]+"::"+idDisposi;
                    }
                    else
                    {
                        infoTableView += ";;"+$("#nomeAgente").val()+"::"+fun[1]+"::"+$("#nomeDispositivo").val()+"::"+fun[0]+"::"+idDisposi;
                        infoTable += ";;"+idAgente+"::"+fun[0]+"::"+idDisposi;
                    }
                    
                    selectedTr(selectedAgente);
                    selectedTr(selectedDipositivo);
                    
                    disSelecteds[disSelecteds.length] = selectedDipositivo;
                    agentSelecteds[agentSelecteds.length] = selectedAgente;
                    
                    lastNumAgente = $("#equipaNumeroAgente").val();
                    $("#equipaFuncao").removeAttr("disabled");
                    constuirTable();
                    limparTextAlocacao();
                }
                else
                { showErro("Equipa","Imposível alocar mais agentes<br>Por favor aumente a número de agente!"); }
            }
            
            if(!limpar)
            {
                if( $("#nomeAgente").val() === "" )
                { showErro("Equipa","Por Selecione o agente!"); $("#nomeAgente").css("border","1px solid #dc3847"); }           
                else if( $("#equipaFuncao").val() === "" )
                { showErro("Equipa","Por Selecione o função de agente!"); $("#equipaFuncao").css("border","1px solid #dc3847"); }  
                else if($("#nomeDispositivo").val() === "" && $("#nomeDispositivo").attr("disabled") !== "disabled")
                { showErro("Equipa","Por Selecione o dispositivo!"); $("#nomeDispositivo").css("border","1px solid #dc3847"); }
                
                if ($("#equipaFuncao").val() !== "")
                { $("#equipaFuncao").css("border", ""); }

                if ($("#nomeAgente").val() !== "")
                { $("#nomeAgente").css("border", ""); }

                if ($("#nomeDispositivo").val() !== "" || $("#nomeDispositivo").attr("disabled") === "disabled")
                { $("#nomeDispositivo").css("border", ""); }
            }
                
            if(getNumRowTable() < (Number($("#equipaNumeroAgente").val())))
            $("#numForAgente").html("Agente "+(getNumRowTable() + 1));
        }
        else
        {
            if(!isNumber($("#equipaNumeroAgente").val()))
            { showErro("Equipa","Preencha o numero de agente!"); }
        }
    }
    
    var idAgente = "";
    function loadDevice(id, agente, isthis)
    { 
        selectedAgente = isthis;
        if(!sheachValue(id,1))
        {
            idAgente = id;
            $("#nomeAgente").val(agente);
            $('.escAgente').css('display', 'none');
//            $.post("controller/EquipaController.php",{type:6,codigoAgente:id},function(e) 
//            { 
//              $("#equipaCorpoDispositivo").html(e);
////              for (var g = 0; g < disSelecteds.length; g++)
////              { selectedTr(disSelecteds[g]); }
//            });
        }
        else{ showInfor("Equipa","O Agente já foi adicionado!"); }
    }
    var idDisposi = "";
    function selectDevice(id, dispos,isthis)
    {
        selectedDipositivo = isthis;
        if(!sheachValue(id,2))
        {
            $("#nomeDispositivo").val(dispos);
            idDisposi = id;
            $('.escDispositivo').css('display', 'none');
        }
        else{ showInfor("Equipa","O dispositivo já foi adicionado!"); }
    }
    
    function constuirTable()
    {
        var datas = "";
        var array = infoTableView.split(";;");
        array = $.makeArray(array);
        for(var i = 0; i < array.length; i++)
        {
            var dados = array[i].split("::");
            dados = $.makeArray(dados);
            if(dados.length === 5)
            {
                datas+="<tr var='"+dados[3]+"' >"+
                    "<td>"+dados[0]+"</td>"+
                    "<td>"+dados[1]+"</td>"+
                    "<td var='"+dados[4]+"'>"+dados[2]+"</td>"+
                    "<td>"+
                        "<i class='icon-pencil' title='Editar' onclick=\"editTable('"+i+"')\" ></i>"+
                        "<i class='icon-cross' title='Remover'  onclick=\"removeTable('"+i+"')\"></i>"+
                    "</td>"+
                "</tr>";
            }
        }
        $('#tableAlucacao').html(datas);
    }
    
    function editTable(num)
    {
        var fun = $("#tableAlucacao").find("tr").eq(num).attr("var");
        var age = $("#tableAlucacao").find("tr").eq(num).find("td").eq(0).text();
        fun += "::"+$("#tableAlucacao").find("tr").eq(num).find("td").eq(1).text();
        var dis = $("#tableAlucacao").find("tr").eq(num).find("td").eq(2).text();
        idDisposi = $("#tableAlucacao").find("tr").eq(num).find("td").eq(2).attr("var");
 
        selectedAgente = agentSelecteds[num];
        selectedDipositivo = disSelecteds[num];
        
        $("#nomeDispositivo").val(dis);
        $("#nomeAgente").val(age);
        $("#equipaFuncao").val(fun);
        
        var inf = removeFromText(num,infoTable);
        var infView = removeFromText(num,infoTableView);
        infoTable = inf; infoTableView = infView;
        removerSelecao(num);
        $("#tableAlucacao").find("tr").eq(num).remove();
        $("#numForAgente").html("Agente "+(getNumRowTable() + 1));
        
        constuirTable();
        
        selectedFuncao();
    }
    
    function removeTable(num)
    {  
        $("#tableAlucacao").find("tr").eq(num).remove();
        var inf = removeFromText(num,infoTable);
        var infView = removeFromText(num,infoTableView);
        removerSelecao(num);
        infoTable = inf; infoTableView = infView;
        $("#numForAgente").html("Agente "+(getNumRowTable() + 1));
        
        constuirTable();
    }
    
    function removeFromText(n,txt)
    {
        var zero = true;
        var datas = "";
        var array = txt.split(";;");
        array = $.makeArray(array);
        for(var i = 0; i < array.length; i++)
        {
            if(i!==Number(n))
            { 
                if(zero)
                { datas += array[i]; }
                else
                { datas += ";;"+array[i]; }
                zero = false;
            }
            
        }
        if(datas === "")
        { valideFuncioDispositivo(); }
        return datas;
    }
    var limpar = false;
    function limparTextAlocacao()
    {
        limpar = true;
        $("#nomeDispositivo").val("");
        $("#nomeAgente").val("");
        $("#equipaFuncao").val("");
        selectedFuncao();
    }
    
    function selectedFuncao()
    {
        if($("#equipaFuncao").find("option:selected").attr("var") === "1")
        { $("#nomeDispositivo").removeAttr("disabled"); }
        else
        {
            $("#nomeDispositivo").attr("disabled","disabled"); 
            $("#nomeDispositivo").val("");
            idDisposi = "";
        }
        var fun = $("#equipaFuncao").val().split(":");
        fun = $.makeArray(fun);
        if(!addChefe(fun[0]))
        {
            showInfor("Equipa","Só pode ser adicionado um <b>\"Chefe\"</b> de Equipa!");
            $("#equipaFuncao").val("");
        }
    }
    
    function getNumRowTable()
    {
        return Number($("#tableAlucacao").find("tr").length);
    }
    
    var eChefe = false, eDisp = false;
    
    function existeDispositivoChefe()
    {
        eChefe = false; eDisp = false;
         var tesAr = infoTable.split(";;");
         tesAr = $.makeArray(tesAr);
         for (var i = 0; i < tesAr.length ; i++)
         {
             var dados = tesAr[i].split("::");
             dados = $.makeArray(dados);
             if(dados[1] === "1" )
             { eChefe = true; }
             if(dados[2] !== "")
             { eDisp = true;}
         }
         
         if(!eDisp)
         { showErro("Equipa","Por favor aloque dispositivo a um agente"); valido = false; }
         
         if(!eChefe)
         { showErro("Equipa","Por favor adicione um Chefe de Equipa"); valido = false; }
         
    }
    
    function addChefe(h)
    {
        var eChefeI = 0;
        if(h === "1")
        {
            var tesAr = infoTable.split(";;");
            tesAr = $.makeArray(tesAr);
            for (var i = 0; i < tesAr.length ; i++)
            {
                var dados = tesAr[i].split("::");
                dados = $.makeArray(dados);
                if(dados[1] === "1" )
                { eChefeI++; }
            }
        }
        return (eChefeI === 0) ? true : false;
    }
    
    function valideChangeNumAgente()
    {
        if(Number($("#equipaNumeroAgente").val())<getNumRowTable())
        { $(".equipaConfi").show(); }
    }
    
    function resetTableAlocacao()
    {
        $(".equipaConfi").hide();
        infoTable = "";
        infoTableView = "";
        constuirTable();
    }
    
    function resetNumAgente()
    {
        $("#equipaNumeroAgente").val(lastNumAgente);
    }
    
    function sheachValue(valor,type)
    {
        var array = infoTable.split(";;");
        array = $.makeArray(array);
        for(var i = 0; i < array.length; i++)
        {
            var dados = array[i].split("::");
            dados = $.makeArray(dados);
            
            if(type === 1)
            {
                if(valor === dados[0] )
                { return true; }
            }
            else if(type === 2)
            {
                if(valor === dados[2] )
                { return true; }
            }
        }
        
        return false;
    }
    
    function valideFuncioDispositivo()
    {
        //$("#equipaFuncao").val("1::Lider da equipa"); 
//        $("#equipaFuncao").attr("disabled","disabled");
        $("#nomeDispositivo").attr("disabled","disabled");
    }
    
    function carregarZonas()
    { $("#equipaZona").load('controller/EquipaController.php',{type:3,idDistr:$("#equipaDistrito").val()},function(e){}); }
    
    
    function selectedTr(element)
    {  element.css("background","#2DCC70"); }
    
    function unSelectedTr(element)
    { element.css("background",""); }
    
    function removerSelecao(num)
    {
        unSelectedTr(disSelecteds[num]);
        unSelectedTr(agentSelecteds[num]);
        console.log(num);
        /**
         * num a posição a remover
         * 1 para dar certo
         */
        disSelecteds.splice(num,1);
        agentSelecteds.splice(num,1);
    }
    
    function loadDiviceOnOpen()
    {
        $.post("controller/EquipaController.php",{type:6,codigoAgente:1},function(e) 
        { 
              $("#equipaCorpoDispositivo").html(e);
        });
    }