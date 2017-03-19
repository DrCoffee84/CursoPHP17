<div id="contenedorAlta" style="display:none"> <!-- Despues lo hago con .css y clases y toda la bola.-->
    <label class="labelAlta"> Carrera </label>
    <select name="carrera" id="carrera">
        <?php
        if ($cantidadCarreras > 0) {
            for ($i = 0; $i < $cantidadCarreras; $i++) {
                echo '<option value="' . $carrera[$i]['id'] . '" >' . $carrera[$i]['nombre'] . '</option>';
            }
        } else {
            echo '<option value="0">No hay opciones</option>';
        }
        ?>
    </select>
    <br>
    <br>
    <label class="labelAlta" >	Nombre </label>
    <input type="text" onkeypress="return soloLetras(event)" onblur="limpia('nombre')" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre"/>
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
    <textarea name="descripcion" onkeypress="return soloLetras(event)" onblur="limpia('descripcion')" id="descripcion" rows="10" cols="50" maxlength="255"></textarea>
    <br>
    <br>

    <button type="submit" name="insert" onClick="darDeAlta();"> Dar de alta </button>
    <button id="botonCerrar" onClick="ocultarPanelAlta();" style="display:none"> Cerrar </button>
</div>

<script type="text/javascript">
    function darDeAlta() {
        $.post(
                "consultas.php",
                {tipo: 'i',
                    nombre: $('#nombre').val(),
                    carrera: $('#carrera option:selected').val(),
                    descripcion: $('#descripcion').val(),
                    carga: $('input:radio[name=carga]:checked').val()
                },
                function (data) {
                    $('#botonAgregar').show();
                    $('#contenedorAlta').hide();
                    $("#tabla").html(data);
                });
    }
</script>