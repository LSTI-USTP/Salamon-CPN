var total_value = 2200000;
var diferenca = 0;



(function () {
	//controlPaymentType();
		initialState();
})();

$('#title-page').text('Pagamento')

/* Open modal to add payment to a person's infraction*/
$('.start-payment').click(function(){
    pStartPagamento(this);
});


/*		change placeholder on number document by changing the payment's type 	*/
$('#typePayment').on('change' , function(){
	initialState();
});


/*		first step of a payment 		*/
//$('#payment-OK1').click( function(){
//
//	setTotalValue(total_value);
//	$('.mp-new-pgto').add('.mp-new-pgto2').fadeToggle('500');
//});


// ############		MORE INFO 		###########################

var articleHeight = $('.aside-geral').height() + $('.aside-amount').height() + 33;

$('.container-article').css('min-height' , articleHeight + 'px');
$('.container-article').css('max-height' , (articleHeight + 300) + 'px');
$('.menu-article li').click(function () {
	var index = $(this).index();
	var item = $('.container-article').eq(index);
	$(this).addClass('active-menu-article').siblings().removeClass('active-menu-article');
	item.addClass('active-container-article').siblings().removeClass('active-container-article');
});



function  initialState (){

	$('.formatNumber').val('');
	$('#num-doc').val('');
	$('#num-doc').attr('placeholder' , $('#typePayment').find("option:selected").text());
	$('#total-deposit').attr('disabled',false);

};


function paying(valor_a_descontar , eh_descontar){

	if(eh_descontar){
		total_value = total_value - valor_a_descontar;
	} else {
		total_value = total_value + valor_a_descontar;
	}

	setTotalValue(total_value);
}

function setTotalValue (value){

	$('#total-value').html(formatted2(value));

}
function isValid(value_debit){
	diferenca = -(total_value - value_debit);
	return (value_debit <= total_value);
}

function pStartPagamento(sele)
{
    initialState();
    $('.mp-new-pgto').fadeIn('500');
}


