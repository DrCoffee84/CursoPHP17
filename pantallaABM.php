<?php
	// Traigo de la pagina principal, los datos de las materias. (podria llegar  haber lectura sucia, pero ANDAAAA).
	session_start();
	$cantidadMaterias = $_SESSION['cantidadMaterias'];
	$cantidadCarreras = $_SESSION['cantidadCarreras'];
	if( $cantidadMaterias > 0 )
		$materia = $_SESSION['materia'];
	if( $cantidadCarreras > 0 )
		$carreras = $_SESSION['carrera'];
	
	
	include("baseDeDatos.php"); //conexiones a la base de datos.
?>

<html>
 <head>
	<title>Desafio</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="funciones.js"></script>
 </head>
 <body>
 
 <h1>ALTAS BAJAS MODIFICACION DE MATERIAS</h1><br>
	<button onClick="mostrar_alta();"> Alta </button>
	<button onClick="mostrar_baja();"> Baja </button>
	<button onClick="mostrar_modificacion();"> Modificacion </button>
	
	<?php include("alta.php"); // contenedor con el formulario de alta. ?> 
	<?php include("baja.php"); // contenedor con el formulario de baja?>
	<?php include("mod.php");  // contenedor con el formulario de modificador?>
	
 </body>
</html>






