

/* Control menus in article in ADMItem1*/
$(document).ready(function ()
{
    $('.specificList label').click(function(){
	$(this).addClass('activespecific').siblings().removeClass('activespecific');
});


/* Control lateral menu in ADMItem2*/
$('.lateral-adm2 li').click( function(){
	$(this).addClass('liSelected').siblings().removeClass('liSelected');
	var text = $(this).html();
});

    
});

