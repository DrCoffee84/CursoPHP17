<?php
		session_start();
		$cantidadMaterias = $_SESSION['cantidadMaterias'];
		$cantidadCarreras = $_SESSION['cantidadCarreras'];
		if( $cantidadMaterias > 0 )
			$materia = $_SESSION['materia'];
		if( $cantidadCarreras > 0 )
			$carreras = $_SESSION['carrera'];
		
	function conectarBaseDeDatos(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dataBase = "desafio";
		$conn = new mysqli($servername, $username, $password, $dataBase);
		if ($conn->connect_error) {
			die("Problema al conectar con la base de datos" . $conn->connect_error);
		} 
	}
	
	function insertar($sql){
	$result = $conn->query($sql);
	}	
?>

<html>
 <head>
	<title>Desafio</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
 </head>
 
 <body>
 
 <h1>ALTAS BAJAS MODIFICACION DE MATERIAS</h1><br>
	<button type="submit" id="enviar" onClick="mostrar_alta();"> Alta </button>
	<button type="submit" id="enviar" onClick="mostrar_baja();"> Baja </button>
	<button type="submit" id="enviar" onClick="mostrar_modificacion();"> Modificacion </button>
	
	<div id="contenedorAlta" style="display:none;">
		<form id="formularioAlta" action="javascript:void(0);" role="form" id="alta" method="post" enctype="multipart/form-data">
			<label class="labelAlta"> Carrera </label>
			<select name="carrera" id="carrera">
				<?php
					$cantcarreras=count($carreras);
					if( $cantcarreras > 0 ){
						for($i=0; $i < $cantcarreras; $i++){
							echo '<option value="'.$carreras[$i]['id'].'" >'.$carreras[$i]['nombre'].'</option>';
						}
						
					}else{
						echo '<option value="0">No hay opciones</option>';
					}
				?>
			</select>
			<br>
			<br>

			<label class="labelAlta" >	Nombre </label>
			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre"/>
			<br>
			<br>
			<label class="labelAlta">  Carga Horaria </label>
			<br>
			<input type="radio" name="carga" value="2"> 2 (dos) <br>
			<input type="radio" name="carga" value="4"> 4 (cuatro) <br>
			<input type="radio" name="carga" value="6"> 6 (seis) <br>
			<input type="radio" name="carga" value="8"> 8 (ocho) <br>
			<input type="radio" name="carga" value="10"> 10	(diez)<br>
			<br>
			<label class="labelAlta">	Descripción: </label>
			<br>
			<textarea name="descripcion" id="descripcion" rows="10" cols="50" maxlength="255"></textarea>
			<br>
			<br>
			<button type="submit" id="enviar" onClick="darDeAlta();"> Dar de alta </button>
		</form>
	</div>
	
	<div id="contenedorBaja" style="display:none;">
			<select name="materias" id="materias">
				<?php
					$cantmaterias=count($materias);
					if( $cantmaterias > 0 ){
						for($i=0; $i < $cantmaterias; $i++){
							echo '<option value="'.$materias[$i]['id'].'" >'.$materias[$i]['nombre'].'</option>';
						}
						
					}else{
						echo '<option value="0">No hay materias</option>';
					}
				?>
			</select>
			<button type="submit" id="enviar" onClick="darDeBaja();"> Dar de baja </button>
	</div>
	<div id="contenedorModificar" style="display:none;">
			<select name="materias" id="materias">
				<?php
					$cantmaterias=count($materias);
					if( $cantmaterias > 0 ){
						for($i=0; $i < $cantmaterias; $i++){
							echo '<option value="'.$materias[$i]['id'].'" >'.$materias[$i]['nombre'].'</option>';
						}
						
					}else{
						echo '<option value="0">No hay materias</option>';
					}
				?>
			</select>
			<button type="submit" id="enviar" onClick="SeleccionarMateria();"> Seleccionar </button>
			<div id="contenedorMateriaModificar" style="display:none;">
			<form id="formularioAlta" action="javascript:void(0);" role="form" id="alta" method="post" enctype="multipart/form-data">
			<label class="labelAlta"> Carrera </label>
			<select name="carrera" id="carreraMod">
				<?php
					$cantcarreras=count($carreras);
					if( $cantcarreras > 0 ){
						for($i=0; $i < $cantcarreras; $i++){
							echo '<option value="'.$carreras[$i]['id'].'" >'.$carreras[$i]['nombre'].'</option>';
						}
						
					}else{
						echo '<option value="0">No hay opciones</option>';
					}
				?>
			</select>
			<br>
			<br>

			<label class="labelAlta" >	Nombre </label>
			<input type="text" class="form-control" id="nombreMod" name="nombre" placeholder="Ingrese el nombre" onKeyPress="return validarLetras(event);"/>
			<br>
			<br>
			<label class="labelAlta">  Carga Horaria </label>
			<br>
			<input type="radio" name="cargaMod" value="2"> 2 (dos) <br>
			<input type="radio" name="cargaMod" value="4"> 4 (cuatro) <br>
			<input type="radio" name="cargaMod" value="6"> 6 (seis) <br>
			<input type="radio" name="cargaMod" value="8"> 8 (ocho) <br>
			<input type="radio" name="cargaMod" value="10"> 10	(diez)<br>
			<br>
			<label class="labelAlta">	Descripción: </label>
			<br>
			<textarea name="descripcion" id="descripcionMod" rows="10" cols="50" maxlength="255"></textarea>
			<br>
			<br>
			<button type="submit" id="enviar" onClick="modificar();"> Modificar </button>
		</form>
		</div>
	</div>
 </body>
</html>


<script type="text/javascript">

	function darDeAlta(){
		var carreraId = $('#carrera option:selected').val()
		var nombre = $('#nombre').val();
		var descripcion = $('#descripcion').val();
		var cargaHoraria = $('input[name=carga]:checked').val();
		var val = carreraId +"," + nombre  +"," +  descripcion  +"," +  cargaHoraria;
		var consulta = "INSERT INTO `materia` (`carrera_id`, `nombre`, `descripcion`, `carga_horaria`)VALUES ("+ val +");";

		console.log( consulta );
		
		$('#contenedorAlta').hide();	
	}
	function darDeBaja(){
		$('#contenedorBaja').hide();	
	}
	function modificar(){
		$('#contenedorModificar').hide();	
	}
	function SeleccionarMateria(){
		$('#contenedorMateriaModificar').show();	
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
</script>



