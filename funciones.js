function darDeAlta(){
	$('#contenedorAlta').hide();	
}
function darDeBaja(){
	$('#contenedorBaja').hide();	
}
function modificar(){
	$('#contenedorModificar').hide();	
}
function SeleccionarMateria(){
	if( $('#materiaIdMod').val() == "-1"){
		$('#contenedorMateriaModificar').hide();
	}else{
		$('#formularioMod').submit();
	}
}
function mostrar_alta(){
	$('#contenedorAlta').show();
	$('#contenedorBaja').hide();
	$('#contenedorModificar').hide();
}
function mostrar_baja(){
	$('#contenedorAlta').hide();
	$('#contenedorBaja').show();
	$('#contenedorModificar').hide();
}
function mostrar_modificacion(){
	$('#contenedorMateriaModificar').hide();	
	$('#contenedorAlta').hide();
	$('#contenedorBaja').hide();
	$('#contenedorModificar').show();
}