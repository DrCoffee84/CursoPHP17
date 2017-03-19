<html>
<head>
	<title>Desafio</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
 </head>
 <body>
 
 <h1>ALTAS BAJAS MODIFICACION DE MATERIAS</h1><br>
	<button onClick="mostrar_alta();"> Alta </button>
	<button onClick="mostrar_baja();"> Baja </button>
	<button onClick="mostrar_modificacion();"> Modificacion </button>
        <div id="contenedor"></div>
        
</body>
</html>

<script type="text/javascript">
function mostrar_alta(){
        actualizar_e_importar_contenedor("a");
        $('#contenedorAlta').show();
	$('#contenedorBaja').hide();
	$('#contenedorModificar').hide();
}
function mostrar_baja(){
        actualizar_e_importar_contenedor("b");
	$('#contenedorAlta').hide();
	$('#contenedorBaja').show();
	$('#contenedorModificar').hide();
}
function mostrar_modificacion(){
        actualizar_e_importar_contenedor("m");
	$('#contenedorMateriaModificar').hide();	
	$('#contenedorAlta').hide();
	$('#contenedorBaja').hide();
	$('#contenedorModificar').show();
}
/**
 * 
 * @param {type} tipoContenedor
 * @returns {nada}
 * Actualiza la informacion desde la base de datos 
 * y trae el div que se pidio por parametro.
 */
function actualizar_e_importar_contenedor(tipoContenedor){
    $.post(
         "consultas.php",{tipo: 'c',contenedor: tipoContenedor},
          function(data){    
                $('#contenedor').html(data);	
          });
}

</script>