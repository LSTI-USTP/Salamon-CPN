
var labelX = $('Xgraphic').attr('LabX');
var labelY = $('Xgraphic').attr('LabY');
var ArrayContent = ['Janeiro' , 'Fevereiro' , 'Março' , 'Abril' , 'Maio' ];
var ArrayValues = [5 , 2 , 3 , 4 , 1 ];
var Step = $('Xgraphic').attr('StepY');

var originalMax , originalIncremented;
var MaxAxis = getMaxAxis(ArrayValues);
var Interval = (MaxAxis / Step);

//alert(originalMax +" "+ originalIncremented +" "+ MaxAxis);


(function Estructure(){
	$('Xgraphic').wrapInner('<div class="XG-container"></div>');
	$('.XG-container').append('<Xaside> <nav></nav> </Xaside>')
	$('.XG-container').append('<Xarticle> <nav></nav> </Xarticle>')

	for (var i = 0; i <= MaxAxis; i += Interval) {		
		$('Xaside nav').append('<span>' + i + '</span>');		
	}

	for (var i = 0; i < ArrayContent.length; i++) {		
		$('Xarticle nav').append('<section><span>'+ ArrayContent[i] + '</span><label growY=""></label>' +'</section>');
	}
	$('Xarticle section').css( 'width' , getBiggest() + 'px' );	

})();

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

function getBiggest(){
	var biggest = 0;
	$('Xarticle span').each(function (){
		if( biggest < $(this).width()) 
			biggest = $(this).width();
	});
	return (biggest + 30);
}
function setGrowing(){
 	var i = 0;
 	$('Xarticle label').each(function (){
		$(this).css('height' , (ArrayValues[i] * 100 / MaxAxis ) + '%');
		$(this).attr('growY' , ArrayValues[i]);
		i++;
	});
}
autoFixed($('.XpertContainer'));
function autoFixed( component ){
	component.scroll(function() {
		$('Xaside').css('left' , component.scrollLeft() + 'px');
	});
}