/***************************/
//@Author: Adrian Mato Gondelle
//@website: http://web.ontuts.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
    $(".menu > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".menu li.active").removeClass("active");
        $(".menu #"+a).addClass("active");
        //ocultamos divisiones, mostramos la seleccionada
        $(".content").css("display", "none");
        $("."+a).fadeIn();
    });
});