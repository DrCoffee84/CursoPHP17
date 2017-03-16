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