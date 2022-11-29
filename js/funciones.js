function determinanteUsuario() {


    document.getElementById("rut").disabled = false
    document.getElementById("nombre").disabled = false
    document.getElementById("ApellidoPaterno").disabled = false
    document.getElementById("ApellidoMaterno").disabled = false
    document.getElementById("Fechanacimiento").disabled = true
    document.getElementById("Dirección").disabled = true
    document.getElementById("Comuna").disabled = true
    document.getElementById("Telefono").disabled = false
    document.getElementById("Instagram").disabled = true
    document.getElementById("Facebook").disabled = true
    document.getElementById("email").disabled = false
    document.getElementById("emailInstitucional").disabled = true
    document.getElementById("Contraseña").disabled = false

}
function determinanteEmprendedor() {
    document.getElementById("rut").disabled = false
    document.getElementById("nombre").disabled = false
    document.getElementById("ApellidoPaterno").disabled = false
    document.getElementById("ApellidoMaterno").disabled = false
    document.getElementById("Fechanacimiento").disabled = false
    document.getElementById("Dirección").disabled = false
    document.getElementById("Comuna").disabled = false
    document.getElementById("Telefono").disabled = false
    document.getElementById("Instagram").disabled = false
    document.getElementById("Facebook").disabled = false
    document.getElementById("email").disabled = true
    document.getElementById("emailInstitucional").disabled = false
    document.getElementById("Contraseña").disabled = false

}
function ActualizarPerfilVis(){
    document.getElementById("rut").disabled = true
    document.getElementById("nombre").disabled = false
    document.getElementById("ApellidoPaterno").disabled = false
    document.getElementById("ApellidoMaterno").disabled = false
    document.getElementById("Telefono").disabled = false
    document.getElementById("email").disabled = true
    document.getElementById("Nuevacontra").disabled = true
    document.getElementById("Contraseña").disabled = true
    document.getElementById("Actualizar").disabled = false
}
function ActualizarPerfilEm(){
    document.getElementById("rut").disabled = true
    document.getElementById("nombre").disabled = false
    document.getElementById("ApellidoPaterno").disabled = false
    document.getElementById("ApellidoMaterno").disabled = false
    document.getElementById("direc").disabled = false
    document.getElementById("comuna").disabled = false
    document.getElementById("Telefono").disabled = false
    document.getElementById("Insta").disabled = false
    document.getElementById("Face").disabled = false
    document.getElementById("email").disabled = true
    document.getElementById("Nuevacontra").disabled = true
    document.getElementById("Contraseña").disabled = true
    document.getElementById("Actualizar").disabled = false
}
function cambiarPass() {

    document.getElementById("Nuevacontra").disabled = false
    document.getElementById("Contraseña").disabled = false
    document.getElementById("Actualizar").disabled = false
   
}
function cambiarPassNo() {

    document.getElementById("Nuevacontra").disabled = true
    document.getElementById("Contraseña").disabled = true
    document.getElementById("Actualizar").disabled = true
 
}
function cambiarPassn() {

    document.getElementById("Nuevacontra").disabled = true
    document.getElementById("Contraseña").disabled = false

}

function SeleccionarPubli(){
    
    document.getElementById("foto").disabled = true
    document.getElementById("Titulo").disabled = true
    document.getElementById("Categoria").disabled = true
    document.getElementById("BreveDescrip").disabled = true
    document.getElementById("Descripcion").disabled = true
    document.getElementById("Fecha").disabled = true
    document.getElementById("Precio").disabled = true
    document.getElementById("Institucion").disabled = true
    document.getElementById("Sede").disabled = true
}


$(document).ready(function(){

	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});

});

