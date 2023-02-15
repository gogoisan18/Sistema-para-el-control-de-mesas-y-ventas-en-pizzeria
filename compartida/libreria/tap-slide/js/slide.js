$(document).ready(function() {
	//Objetos toppanel
		ejecutar_panel('#toppanel');
	//Objetos bottompanel
		ejecutar_panel('#bottompanel');
		
		$('#toppanel #open').click(); //Mostrar menu al carga pagina
});

function ejecutar_panel (panel){
	$(panel+" #open").click(function(){
		$(panel+" div#panel").slideDown("slow"); // Expand Panel
	});	
		
	$(panel+" #close").click(function(){
		$(panel+" div#panel").slideUp("slow");	// Collapse Panel
	});		
		
	$(panel+" #toggle a").click(function () {
		$(panel+" #toggle a").toggle(); // Switch buttons from "Open Panel" to "Close Panel" on click
	});		


};