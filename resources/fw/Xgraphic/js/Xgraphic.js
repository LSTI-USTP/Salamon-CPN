/*!Xgraphic v0.0.1 | (c) 2016, 2016 Antunes Xpert, Inc. */

var labelX = $('Xgraphic').attr('LabX');
var labelY = $('Xgraphic').attr('LabY');
var FormatY = $('Xgraphic').attr('FormatY');
var DecimalY = $('Xgraphic').attr('DecimalY');
var Step = $('Xgraphic').attr('StepY');

var originalMax , originalIncremented;
var MaxAxis = getMaxAxis(ArrayValues);
var Interval = (MaxAxis / Step);

setInterval(function(){
 	Estructure(); 
 	setGrowing();
 	autoFixed($('.XpertContainer'));}, 
	3000);

Estructure();

function Estructure(){
	$('Xgraphic').html('');
	$('Xgraphic').wrapInner('<div class="XG-container"></div>');
	$('.XG-container').append('<Xaside> <nav></nav> </Xaside>')
	$('.XG-container').append('<Xarticle> <nav><h1></h1></nav> </Xarticle>')

	for (var i = 0; i <= MaxAxis; i += Interval) {	
		$('Xaside nav').append('<span>' + formatYAxis(i,FormatY,DecimalY) + '</span>');	
	}

	for (var i = 0; i < ArrayContent.length; i++) {		
		$('Xarticle nav').append('<section><span>'+ ArrayContent[i] + '</span><label growY=""></label>' +'</section>');
	}
	$('Xarticle section').css( 'width' , getBiggest($('Xarticle span')) + 'px' );
	$('Xarticle h1').html('Variação de ' + labelY + ' em função de ' + labelX);

};

setGrowing();

function getMaxAxis(array){
	var max = 0;
	for (var i = 0; i < array.length; i++) {
		
		if (max < (array[i] + parseInt(array[i]) / 4)){
			originalIncremented = max = (array[i] + parseInt(array[i] / 4));	
			originalMax = array[i];
		}
		while(max % Step !== 0)
			max++;
	}
	return (max);
}

function getBiggest( element ){
	var biggest = 0;
	element.each(function (){
		if( biggest < $(this).width()) 
			biggest = $(this).width();
	});
	return (biggest + 30);
}
function setGrowing(){
 	var i = 0;
 	$('Xarticle label').each(function (){
		$(this).css('height' , (ArrayValues[i] * 100 / MaxAxis ) + '%');
		if(i < ArrayValues.length)
			$(this).attr('growY' , formatYAxis(ArrayValues[i],FormatY,DecimalY));
		i++;
	});
}
autoFixed($('.XpertContainer'));

function autoFixed( component ){
	component.scroll(function() {
		$('Xaside').css('left' , component.scrollLeft() + 'px');
		$('Xarticle h1').css('right' , -component.scrollLeft() + 'px');
	});
}
/* Function to format numbers with "space" using as parameter a string*/
function formatYAxis( nStr , format , decimal) {
	if (format === 'true' && decimal === 'true')
		return nStr.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ") + ',00';
	else if (format ==='true' && (decimal === 'false' || !decimal))
		return nStr.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
 	 else
 	 	return nStr;
}