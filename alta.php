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