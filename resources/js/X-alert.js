// script to show or hide a notification


//$(document).ready(function(event) {
//    $('.X-Notific').fadeToggle('400', function() {
//            $('.X-type').toggleClass('X-type-slide');
//    });
//    $('.X-Notific').fadeToggle('400', function() {
//            $('.X-type').toggleClass('X-type-slide');
//    });
//        
//});



/*This is a notification's information*/
//selectType( $('.X-type') , 'info' , 'icon-info');

/*This is a notification's error*/
//selectType( $('.X-type') , 'error' , 'icon-cancel-circle');
$('.X-close').add('.X-Notific').click(function(event)
{
    $('.X-Notific').fadeOut('400');
});
/*This is a notification's success*/
selectType( $('.X-type') , 'success' , 'icon-checkmark');

function selectType( me , classMe, classChild){
	me.attr("class","X-type X-type-slide");
	me.addClass(classMe);
	me.find('i').attr("class","");
	me.find('i').addClass(classChild);

}

function showSuccess(title,text)
{
    selectType( $('.X-type') , 'success' , 'icon-checkmark');
    $(".notifTitle").html(title);
    $(".notifText").html(text);
    $('.modalNotif').fadeIn(400);
    setTimeout(timerClose,8000);
}

function showErro(title,text)
{
    selectType( $('.X-type') , 'error' , 'icon-cancel-circle');
    $(".notifTitle").html(title);
    $(".notifText").html(text);
    $('.modalNotif').fadeIn(400);
    setTimeout (timerClose,8000);
}

function showInfor(title,text)
{
    selectType( $('.X-type') , 'info' , 'icon-info');
    $(".notifTitle").html(title);
    $(".notifText").html(text);
    $('.modalNotif').fadeIn(400);
    setTimeout(timerClose,8000);
}

function timerClose()
{
    $('.modalNotif').fadeOut('400');
}