<?php
		session_start();
		$cantidadMaterias = $_SESSION['cantidadMaterias'];
		$cantidadCarreras = $_SESSION['cantidadCarreras'];
		if( $cantidadMaterias > 0 )
			$materia = $_SESSION['materia'];
		if( $cantidadCarreras > 0 )
			$carreras = $_SESSION['carrera'];
		
?>

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
	<div id="contenedorAlta" style="display:none;">
		<form role="form" id="alta" method="post" action="consultas.php" enctype="multipart/form-data">
			<label class="labelAlta"> Carrera </label>
			<select name="carrera" id="carrera">
				<?php
					if( $cantidadCarreras > 0 ){
						for($i=0; $i < $cantidadCarreras; $i++){
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
			<button type="submit" name="insert" value="insertt" onClick="darDeAlta();"> Dar de alta </button>
		</form>
	</div>
	
	<div id="contenedorBaja" style="display:none;">
		<form role="form" id="baja" method="post" action="consultas.php" enctype="multipart/form-data">
			<select name="materiaID" id="materiaID">
				<?php
					if( $cantidadMaterias > 0 ){
						for($i=0; $i < $cantidadMaterias; $i++){
							echo '<option value="'.$materia[$i]['id'].'" >'.$materia[$i]['nombre'].'</option>';
						}
					}else{
						echo '<option value="0">No hay materias</option>';
					}
				?>
			</select>
			<button type="submit" name="delete" onClick="darDeBaja();"> Dar de baja </button>
		</form>
	</div>
	
	<div id="contenedorModificar" style="display:none;">
		<form id="formularioMod" action="consultas.php" role="form" id="mod" method="post" enctype="multipart/form-data">
			<select name="materiaIdMod" id="materiaIdMod" onChange="SeleccionarMateria()" placeholder="Seleccione Materia">
				 <option select value="-1"></option>
				<?php
					if( $cantidadMaterias > 0 ){
						for($i=0; $i < $cantidadMaterias; $i++){
							echo '<option value="'.$materia[$i]['id'].'" >'.$materia[$i]['nombre'].'</option>';
						}
					}else{
						echo '<option value="0">No hay materias</option>';
					}
				?>
			</select>
			<div id="contenedorMateriaModificar" style="display:none;">
			<label class="labelAlta"> Carrera </label>
			<select name="carreraMod" id="carreraMod">
				<?php
					if( $cantidadCarreras > 0 ){
						for($i=0; $i < $cantidadCarreras; $i++){
							echo '<option value="'.$carreras[$i]['id'].'" >'.$carreras[$i]['nombre'].'</option>';
						}
					}else{
						echo '<option value="0">No hay opciones</option>';
					}
					/* Codigo magico para que aparezca la carrera de la base de datos.
						echo '<option value="'.$row["rango"].'"';
						if($row['rango']==$rango ) {
						echo "selected";
						}
						echo ">".$row['rango']."</option>";
					*/
				?>
			</select>
			<br>
			<br>

			<label class="labelAlta" >	Nombre </label>
			<input type="text" class="form-control" id="nombreMod" name="nombreMod" placeholder="Ingrese el nombre" onKeyPress="return validarLetras(event);"/>
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
			<textarea name="descripcionMod" id="descripcionMod" rows="10" cols="50" maxlength="255"></textarea>
			<br>
			<br>
			<button type="submit" name="mod" onClick="modificar();"> Modificar </button>
		</form>
		</div>
	</div>
 </body>
</html>


<script type="text/javascript">

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
			$('#contenedorMateriaModificar').show();
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
</script>



