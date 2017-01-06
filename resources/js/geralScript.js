
function mouseLeaveEx(sele)
{
    $(sele).closest('tr').removeClass('row-hover');
}

function mouseenterEx(sele)
{
    var actualRow = $(sele).closest('tr');
        if (!actualRow.hasClass('row-selected'))
            actualRow.addClass('row-hover').siblings().removeClass('row-hover');
        else
            actualRow.siblings().removeClass('row-hover');
}

function clickEx(sele)
{
    $(sele).closest('tr').addClass('row-selected').siblings().removeClass('row-selected');
    
    //nime
    idInfraator = $(sele).attr("id");
    $("section.header-more").find("h1").eq(0).text($(sele).find("td").eq(2).text());
    $("#contaPay").text($(sele).find("td").eq(2).text());
//        $("#mNaoPagas").text($(this).find("td").eq(3).text());
    $("#typeInfrator").text($(sele).find("td").eq(1).text());
//        $("#totalApgar").text(formatted2($(this).attr("value")));
    $(".table-selected").text($(sele).find("td").eq(1).text() +" - "+$(sele).find("td").eq(2).text());   
}

$(function ()
{
    /* Remove class hover in rows when mouse leave	*/
    $('tbody td').on('mouseleave', function () {
        mouseLeaveEx(this); 
    });
    /* Select a row in a table*/
    $('tbody td').on('mouseenter', function () {
        mouseenterEx(this);
    });
    var rowCount = $('#table-multa tr').length;
    $('#table-found span').html(rowCount);



    /* Select a row in a table*/
    $('tbody td').click(function () {
        clickEx(this);
    });

 


    /*Logout confirmation*/
    $('.formatNumber').on('keyup', function () {

        formatted($(this));

    });
    $('.integer').keypress(function (event) {

        if ((event.which != 44 || $(this).val().indexOf('/') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                        (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }

    });

    $('.double').keypress(function (event) {

        //$( ".integer" ).trigger("keypress ");

        if ((event.which != 44 || $(this).val().indexOf(',') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                        (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }

        var text = $(this).val();

        if
                ((text.indexOf(',') != -1) &&
                        (text.substring(text.indexOf(',')).length > 2) &&
                        (event.which != 0 && event.which != 8) &&
                        ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
        }
    });



    /*Close modal actual*/
    $('.modal-header span').click(function () {
        $(this).closest('section').fadeOut('500');
    });


    /*Close modal actual by clicking "NO" option*/
    $('.bt-no-option').click(function () {
        $(this).closest('section').fadeOut('500');
    });

    /*Close alert of modal if is shown*/
    $('.close-modal-alert').click(function () {
        $(this).parent().parent().slideUp();
//        $(this).parent().parent().fadeOut(1000);
    });


    /*Logout confirmation*/
    $('#logout').click(function () {
        $('.mp-logout').fadeIn('500');
    });

    /*Logout confirmation*/
    $('#edit-pass').click(function () {
        $('.mp-edit-password').fadeIn('500');
    });

    /*		Confirm edit password .......... on menu 		*/
    $('.yes-edit-password').click(function () {
        showModalAlert($('.mp-edit-password'), "Message here!");
    });
});

/* Function to activate a input text by clicking a checkbox */
function activeInputByCheck (check , input ){
	if( check.is(':checked') )
		input.attr('disabled',false).focus();

	 else
		input.attr('disabled',true).val('');
}

/* Function to format numbers with "space" using as parameter a input*/
function formatted(nStr) {

	var num = nStr.val().replace(/(\s)/g, '');
  	nStr.val(num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 "));

}

/* Function to format numbers with "space" using as parameter a string*/
function formatted2(nStr) {

  	return nStr.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
 	 
}

/* Function to unformat numbers with "space" */
function unformatted(nStr) {

    var num = nStr.toString();

    if(num !== '')
            return parseFloat(num.replace(/\s/g , '').replace(/,/g, '.'));
    else
            return 0;

}

function showModalAlert(component , msg) {
	var alert_me = component.find('.alert');
	alert_me.find('p').html(msg);
	alert_me.slideToggle();
}

function menuAccess(application, menu)
{
    var accesMenu = menu.split(";");
    accesMenu = $.makeArray(accesMenu); // transforma num array
     $("#controloMenus li").css("display","none");
     $(".menuPrincipal li").css("display","none");
    if(application==="51")
    {
        $("#controloMenus li").each(function ()
        {         
            for(var i=0;i<accesMenu.length;i++)
            {
                if($(this).attr("id")===accesMenu[i])
                {
                    console.log("menus "+$(this).attr("class"));
                    $(this).css("display","block");
                }
            }
        });
    }
    else if(application==="50")
    {
        $(".menu li").each(function ()
        {
            for(var i=0;i<accesMenu.length;i++)
            {
                if($(this).attr("id")===accesMenu[i])
                {
                    $(this).css("display","");
                }
            }
        });
    }
    
}


