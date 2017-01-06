    $(document).ready(function (e)
    {
        loadData();
        $("#distritoAgente").change(carregarEsquadra);
        var dados ="";
       $(".registarAgente").click(function (e)
       {
            e.preventDefault();
            if(checkFields() === true && verificarDataNasc()=== true && checkAgentAge() === true && verificarDataRecrutamento() === true) // se todos os campos foram preenchidos envia todas informações usando o ajax post.
            {
                dados = {type:8,nome:$("#nomeAgente").val(),apelido:$("#apelidoAgente").val(),bi:$("#biAgente").val(),
                    nif:$("#nifAgente").val(),genero:$("#generoAgente").val(),morada:$("#moradaAgente").val(),
                    dataNasc:$("#dataNascAgente").val(),estadoCivil:$("#estadoCivilAgente").val(),
                    nivel:$("#nivelAgente").val(),codigo:$("#codigoAgente").val(),
                    seccao:$("#seccaoAgente").val(),dataRec:$("#dataRecrutamentoAgente").val(),
                    esquadra:$("#esquadraAgente").val(),distrito:$("#distritoAgente").val(),
                    categoria:$("#categoriaAgente").val()};
                $.ajax
                ({
                     beforeSend: function() 
                     { $('.processamento').css('display','flex');}, 
                     complete: function() 
                     { $('.processamento').hide(); },
                     url: 'controller/AgenteController.php',
                     type: 'POST',
                     data:dados,
                     cache: false,
                     success: function(result) 
                     {
                        answer(result);
                     }
                 });
            }
       });
       
       $('#dataNascAgente').blur(function ()
       {
           if(valideData($('#dataNascAgente'))===false)
           {
                $(this).css("border","1px solid #dc3847");
                $(this).attr('title','Data de nascimento inválido');
           }
       });
    });
    
    // verifica-se todos os campos foram preenchidos. Retorna true caso todos os campos estarem preenchidos
    function checkFields()
    {
         var valido = true;
         $(".contentLeft [type=text], select").each(function ()
          {
             if($(this).val()==='')
             {
                 valido = false;
                $(this).css("border","1px solid #dc3847");
             }
          });
          $(".contentRight [type=text], select").each(function ()
          {
             if($(this).val()==='')
             {
                 valido = false;
                 $(this).css("border","1px solid #dc3847");
             }
          });
          return valido;
     }

     // função para ser executada quando um novo agente for registrado
    function agenteRegistrado()
    {
        $(".contentLeft [type=text], select").each(function ()
        {
            $(this).val('');
        });
         $(".contentRight [type=text], select").each(function ()
        {
            $(this).val('');
        });
     }
     
    function loadData()// carrega informações para todos os componentes select
    {
        $("#generoAgente").load('controller/AgenteController.php',{type:1},function(e){});
        $("#estadoCivilAgente").load('controller/AgenteController.php',{type:2},function(e){});
        $("#nivelAgente").load('controller/AgenteController.php',{type:3},function(e){});
        $("#seccaoAgente").load('controller/AgenteController.php',{type:4},function(e){});
        $("#distritoAgente").load('controller/AgenteController.php',{type:5},function(e){});
        $("#esquadraAgente").html("<option value=''>(Selecione)</option>");
        $("#categoriaAgente").load('controller/AgenteController.php',{type:7},function(e){});
    }
    
    function answer(result)
    {
        console.log(result);
        if(result ==='bi já existe')
        {
            $('#biAgente').css("border","1px solid #dc3847");
            showErro("Registro","Número de bilhete de identidade já existe!");
        }
        else if(result==='nif já existe')
        {
            $("#nifAgente").css("border","1px solid #dc3847");
            showErro("Registro","Número de identificação fiscal já existe(NIF)!");
        }
        else if(result ==='true')
        {
            agenteRegistrado();
            showSuccess("Registro","Agente registrado com sucesso!");
        }
        else if(result==='data do recrutamento é superior')
        {
            $('#dataRecrutamentoAgente').css("border","1px solid #dc3847");
            showErro("Registro","Data de recrutamento não pode ser superior a data atual!");
        }
        else
        {
            $('#codigoAgente').css("border","1px solid #dc3847");
            showErro("Registro","Código do agente já existe!");
        }     
    }
    
    function checkAgentAge()
    {
        if(getAge($("#dataNascAgente").val())<18)
        {
            $("#dataNascAgente").css("border","1px solid #dc3847");
            showInfor("Registro","Agente deve ter pelo menos 18 anos!");
            return false;
        }
        else return true;
    }
    
    function verificarDataNasc()
    {
        if(valideData($("#dataNascAgente")) === false)
        {
            showErro("Registro","Data de nascimento inválido!");
            return false;
        }
        else return true;
    }
    
    function verificarDataRecrutamento()
    {
        if(valideData($("#dataRecrutamentoAgente"))=== false)
        {
            showErro("Registro","Data de recrutamento inválido!");
            $("#dataRecrutamentoAgente").css("border","1px solid #dc3847");
            return false;
        }
        else return true;
    }
    
   function carregarEsquadra()
   { $("#esquadraAgente").load('controller/AgenteController.php',{type:6,idDetri:$("#distritoAgente").val()},function(e){}); }