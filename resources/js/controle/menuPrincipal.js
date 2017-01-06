$(document).ready(function(e){
		
		if ($('body').attr('class')==='visualizacao') {
	        $('.visualizacao').addClass('active'); 
		}

		if ($('body').attr('class')==='infracao') {
	        $('.infracao').addClass('active'); 
		}

		if ($('body').attr('class')==='agente') {			
	        $('.agente').addClass('active'); 
		}

		if ($('body').attr('class')==='dispositivo') {
	        $('.dispositivo').addClass('active'); 
		}

		if ($('body').attr('class')==='equipa') {
	        $('.equipa').addClass('active'); 
		}

		if ($('title').attr('class')==='relatorio') {			
	        $('.relatorio').addClass('active'); 
		}

		if ($('title').attr('class')==='administracao') {			
	        $('.administracao').addClass('active'); 
		}
			

		
		/*$('.menu label').click(function(e){
			$('.AreaUser').fadeToggle(100);
		});*/

});