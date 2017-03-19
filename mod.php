
<?php echo "ID: <label id=materiaIdMod>" .$materiaID."</label>" ?>
<label class="labelAlta"> Carrera </label>
<select name="carreraMod" id="carreraMod">
    <?php
    if ($cantidadCarreras > 0) {
        for ($i = 0; $i < $cantidadCarreras; $i++) {
            echo '<option';
            if ($carrera[$i]['id'] == $materiaMod['carreras_id'])
                echo ' selected';
            echo ' value="' . $carrera[$i]['id'] . '" >' . $carrera[$i]['nombre'] . '</option>';
        }
    }else {
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
<label class="labelAlta">  Carga Horaria </label><br>
<input type="radio" name="cargaMod" value="2" <?php if ($materiaMod['carga_horaria'] == 2) echo 'checked'; ?> > 2 (dos) <br> 
<input type="radio" name="cargaMod" value="4" <?php if ($materiaMod['carga_horaria'] == 4) echo 'checked' ?> > 4 (cuatro) <br>
<input type="radio" name="cargaMod" value="6" <?php if ($materiaMod['carga_horaria'] == 6) echo 'checked' ?> > 6 (seis) <br>
<input type="radio" name="cargaMod" value="8" <?php if ($materiaMod['carga_horaria'] == 8) echo 'checked' ?> > 8 (ocho) <br>
<input type="radio" name="cargaMod" value="10"<?php if ($materiaMod['carga_horaria'] == 10) echo 'checked' ?>  > 10	(diez)<br>
<br>
<label class="labelAlta"> Descripción: </label>
<br>
<textarea name="descripcionMod" id="descripcionMod" rows="10" cols="50" maxlength="255"><?php echo $materiaMod['descripcion']; ?></textarea>
<br>
<br>
<button name="mod" onClick="modificar();"> Modificar </button>

<script type="text/javascript">
    
function modificar() {
    $.post(
            "consultas.php",
            {
                tipo: 'm',
                materiaID: $('#materiaIdMod').val(),
                nombre: $('#nombreMod').val(),
                carreraId: $('#carreraMod option:selected').val(),
                descripcion: $('#descripcionMod').val(),
                cargaHoraria: $('input:radio[name=cargaMod]:checked').val()},
            function (data) {
                $('#contenedorMateriaMod').html(data);
                $('#materiaIdMod').select("-1");
            }
    );
        
}
</script>
