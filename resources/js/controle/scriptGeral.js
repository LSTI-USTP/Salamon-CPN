    $(document).ready(function ()
    {
           $(document).keypress(function (e)
            {
               if(e.keyCode === 27)
                   $(".modalPage").fadeOut();     
            });
        $('.campoData').keyup(function ()
        {    
            var v = $(this).val(); // Adiciona a mascara para data
            if (v.match(/^\d{2}$/) !== null || v.match(/^\d{2}\-\d{2}$/) !== null) 
                $(this).val(v + '-');
        });

        $("input:text, select, input:password, textarea").focus(function(e)
        {
           $(this).css("border",""); 
        });
        
        $('.numeroInterio').keyup(function ()
        {
            var expre = /[^0-9]/g;
            // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
            if($(this).val().match(expre))
                $(this).val($(this).val().replace(expre, ''));
        });
        $('.numeroReal').keyup(function ()
        {
            if(!$.isNumeric($(this).val()))
            { $(this).val(""); }
        });
    });

    function valideData(data)
    {
        var rar = data.val().split('-');
        rar = $.makeArray(rar);
        if( rar.length===3 && rar[0].length===2 && rar[1].length===2 && rar[2].length===4 )
        {
            if( isNumber(rar[0]) && isNumber(rar[1]) && isNumber(rar[2]) && Number(rar[0]) > 0 && Number(rar[1]) > 0  && Number(rar[1]) <= 12 )
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
    
    function validarEmail(email)
    {
        var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var info = email.val();
        if (filtro.test(info))
            return true;
         else
         {
            email.css("border","1px solid #dc3847");
            return false;
         }

    }

        /**
         * função que devolve a idade através da data de nascimento informada
         * @param {type} dataNascimento
         * @returns {getAge.dataNasc|Array|Number}
         * devolve -1 se a data estiver inválida
         */
    function getAge(dataNascimento)
    {
        var data = new Date();
        var dia = (data.getDate()>=10) ? data.getDate() : '0'+data.getDate();
        var mes = ((data.getMonth()+1)>=10) ? data.getMonth()+1 : '0'+(data.getMonth()+1);
        var ano = data.getFullYear();
        var dataNasc = dataNascimento.split('-');
        dataNasc = $.makeArray(dataNasc);
        var idade;
        if(ano>=dataNasc[2])
        {
            idade = ano - dataNasc[2]; // calcula a idade
            if((mes<dataNasc[1]) || (mes === dataNasc[1] && dia<= dataNasc[0]))
            {
                idade--;
                return idade;
            }
            else return idade;
        }
        else return -1;
    }

    function isNumber(valor)
    {
        return $.isNumeric(valor);
    }

    function isBisexto(valor)
    { return (( Number(valor)%4 === 0 && Number(valor)%100 !== 0 ) || (Number(valor)%400 === 0) ); }

    function getValorComobox(campoSelect)
    {
        $("option").each( function ()
        {            
            if (campoSelect.attr("id")===$(this).attr("id"))
            {
               if(campoSelect.val()===$(this).val())
                {
                    campoSelect.attr("name",$(this).attr("name"));
                }
            }
        });
    }
    
    
    function ocultarMenu()
    {
        $('.infracao').css('display','none');
    }