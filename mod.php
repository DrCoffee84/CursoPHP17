<?php
	if($mostramela)
		echo '<div id="contenedorModificar" style="display:inline;">';
	else
		echo '<div id="contenedorModificar" style="display:none;">';			
?>
	<form id="formularioMod" action="pantallaABM.php" role="form" method="post" enctype="multipart/form-data">
				
			<br>
			<select name="materiaIdMod" id="materiaIdMod" onChange="SeleccionarMateria()" placeholder="Seleccione Materia">			
			<option select value="-1">Seleccionar...</option>				
			<?php
				if( $cantidadMaterias > 0 ){
					for($i=0; $i < $cantidadMaterias; $i++)
						echo '<option value="'.$materia[$i]['id'].'" >'.$materia[$i]['nombre'].'</option>';
				}else
					echo '<option value="0">No hay materias</option>';
			?>
		</select><br><br>
	</form>
	<form id="formularioMod2" action="consultas.php" role="form" method="post" enctype="multipart/form-data">
		<input type="text" class="form-control" id="materiaIdMod" name="materiaIdMod" placeholder="Ingrese ID" value = "<?php echo $materiaMod['id']; ?>" style="display:none;"/>
		<?php
		if($mostramela)
			echo '<div id="contenedorMateriaModificar" style="display:inline;">';
		else
			echo '<div id="contenedorMateriaModificar" style="display:none;">';			
		?>
		<label class="labelAlta"> Carrera </label>
		<select name="carreraMod" id="carreraMod">
			<?php
				if( $cantidadCarreras > 0 ){
					for($i=0; $i < $cantidadCarreras; $i++){
						echo '<option';
						if($carreras[$i]['id'] == $materiaMod['carrera_id'])
							echo ' selected';
						echo ' value="'.$carreras[$i]['id'].'" >'.$carreras[$i]['nombre'].'</option>';
					}
				}else{
					echo '<option value="0">No hay opciones</option>';
				}
			?>
		</select>
		<br>
		<br>

		<label class="labelAlta" >	Nombre </label>
		<input type="text" class="form-control" id="nombreMod" name="nombreMod" placeholder="Ingrese el nombre" onKeyPress="return validarLetras(event);" value = "<?php echo $materiaMod['nombre']; ?>" />
		<br>
		<br>
		<label class="labelAlta">  Carga Horaria </label>
		<input type="radio" name="cargaMod" value="2" <?php if($materiaMod['carga_horaria']==2)echo 'checked';?> > 2 (dos) <br> 
		<br>
		<input type="radio" name="cargaMod" value="4" <?php if($materiaMod['carga_horaria']==4)echo 'checked'?> > 4 (cuatro) <br>
		<input type="radio" name="cargaMod" value="6" <?php if($materiaMod['carga_horaria']==6)echo 'checked'?> > 6 (seis) <br>
		<input type="radio" name="cargaMod" value="8" <?php if($materiaMod['carga_horaria']==8)echo 'checked'?> > 8 (ocho) <br>
		<input type="radio" name="cargaMod" value="10"<?php if($materiaMod['carga_horaria']==10)echo 'checked'?>  > 10	(diez)<br>
		<br>
		<label class="labelAlta">	Descripción: </label>
		<br>
		<textarea name="descripcionMod" id="descripcionMod" rows="10" cols="50" maxlength="255"><?php echo $materiaMod['descripcion'];?></textarea>
		<br>
		<br>
		<button type="submit" name="mod" onClick="modificar();"> Modificar </button>
	</form>
	</div>
</div>