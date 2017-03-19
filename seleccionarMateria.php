<!--Seleccionar la materia a modificiar.-->
<div id="contenedorModificar">
    <select name="materiaIdMod" id="materiaIdMod" onChange="SeleccionarMateria()" placeholder="Seleccione Materia">			
        <option select value="-1">Seleccionar...</option>				
        <?php
        if ($cantidadMaterias > 0) {
            for ($i = 0; $i < $cantidadMaterias; $i++)
                echo '<option value="' . $materia[$i]['id'] . '" >' . $materia[$i]['nombre'] . '</option>';
        } else
            echo '<option value="0">No hay materias</option>';
        ?>
    </select><br><br>
</div>
<div id="contenedorMateriaMod"></div>
<script type="text/javascript">


</script>