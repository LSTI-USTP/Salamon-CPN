// script to show or hide a notification

$(document).click(function(event) {
	//$('.X-Notific').fadeToggle('400', function() {
		//$('.X-type').toggleClass('X-type-slide');
	//});
	$('.X-Notific').show();
});

/*This is a notification's information*/
//selectType( $('.X-type') , 'info' , 'icon-info');

/*This is a notification's error*/
selectType( $('.X-type') , 'error' , 'icon-cancel-circle');

/*This is a notification's success*/
//selectType( $('.X-type') , 'success' , 'icon-checkmark');
$('.X-close').click(function(event) {
	$(this).parent('.X-Notific').fadeOut('400');
});

function selectType( me , classMe, classChild){
	me.attr("class","X-type X-type-slide");
	me.addClass(classMe);
	me.find('i').attr("class","");
	me.find('i').addClass(classChild);

}