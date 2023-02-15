function crear_variable(variable,valor){
    $.ajax({
        url: "../compartida/funciones/funciones.php",
        data:"oper=crear_variable&"+variable+"="+valor,
        type: "POST",
        async:false,
        cache:false,
        success: function(ret){	}
    });
};

function obtener_variable(variable,valor){
    var $valor = "";
	$.ajax({
        url: "../compartida/funciones/funciones.php",
        data:"oper=obtener_variable&"+variable+"="+valor,
        type: "POST",
        async:false,
        cache:false,
        success: function(ret){
			$valor = ret;
		}
    });
	return $valor;
};

function destruir_variable(variable,valor){
    $.ajax({
        url: "../compartida/funciones/funciones.php",
        data:"oper=destruir_variable&"+variable+"="+valor,
        type: "POST",
        async:false,
        cache:false,
        success: function(ret){	}
    });
};

function mensaje(msj){
    $.blockUI({
        theme:     true, 
        title:    'Advertencia:',
        message: "<div>"+msj+"</div>",
        css: {
            cursor:'default'
        }
    });
    $('.blockOverlay').click($.unblockUI); 
};

function alerta(msj){
    $.blockUI({ 
        message: "<p style='font-size:15px; font-weight:bold; '>"+msj+"</p>", 
        baseZ: 1005,
        centerX: true, 
        centerY: true,
        timeout:1000, 
        css: { 
			border: 'none', 
            padding: '15px', 
            backgroundColor: '#ffffff', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            
        }
    }); 
};

function alertax(msj){
    $.blockUI({ 
        message: "<p style='font-size:22px; font-weight:bold; color:#F7FE2E'>"+msj+"</p>", 
        baseZ: 1005,
        centerX: true, 
        centerY: true,
        timeout:9000, 
        css: { 
			border: 'none', 
            padding: '10', 
			width:'600px',
            backgroundColor: '#FF0000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            
        }
    }); 
};

function alerta2(msj){
    $.blockUI({ 
        message: "<p style='font-size:15px; font-weight:bold;'>"+msj+"</p>", 
        baseZ: 1005,
        centerX: true, 
        centerY: true,
		timeout:5500,
       css: { 
			border: 'none', 
            padding: '15px', 
            backgroundColor: '#ffffff', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            
        }
    }); 
};

function alerta3(msj){
    $.blockUI({ 
        message: "<p style='font-size:15px; font-weight:bold;'>"+msj+"</p>", 
        baseZ: 1005,
        centerX: true, 
        centerY: true,
		timeout:9000,
       css: { 
			border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            
        }
    }); 
};

function ventana(ruta){
    $.blockUI({ 
        message: "<div id='cargaVentana'></div>", 
        baseZ: 9999,
        fadeIn: 1000, 
        fadeOut: 1000,
        centerX: true,
        centerY: true,
        css: { 
            border: '0px solid black',
            cursor:'default', 
            width:'auto',
            padding: '15px', 
            backgroundColor: 'inherit', 
            top: '130px',
            color: 'black' 
        }
		
    });
	
    $("#cargaVentana").load(ruta);
};

function mensaje_error(complete,message){
    if(complete == true){
        $("#frmError").empty();
        $("#frmError").hide();
    }else{
        $("#frmError").empty();
        $("#frmError").show();
        $("#frmError").append("<span id='xmsj' style='color:#000080;font-size:1.2em;'>"+message+"</span>");

    }
}

function soloNum(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode <= 13)	{
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /[0-9]/
        return re.test(keyChar);
    }	
}
function soloLetra(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /^[\sa-zA-ZÑñÁÉÍÓÚáéíóú]+$/
        return re.test(keyChar);
    }	
}

function LetraNum(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /[a-zA-Z0-9_-]/
        return re.test(keyChar);
    }	
}

function LetraEspacio(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /[\sa-zA-ZÑñÁÉÍÓÚáéíóú]/
        return re.test(keyChar);			
    }	
}

function LetraNumEspacio(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /[\sa-zA-Z0-9_-]/
        return re.test(keyChar);			
    }	
}

function sinEspacio(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /\s/ 
        return !re.test(keyChar);
    }	
}

function NumDeci(evt){	
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /[0-9,]/
        return re.test(keyChar);
    }	
}
function NumDeciPunto(evt){  
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode <= 13){
        return true;
    }else{
        var keyChar = String.fromCharCode(charCode);
        var re = /[0-9.]/
        return re.test(keyChar);
    }   
}