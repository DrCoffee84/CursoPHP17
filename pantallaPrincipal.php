<?php
$servername = "localhost";
$username = "root";
$password = "";
$dataBase = "desafio";
$conn = new mysqli($servername, $username, $password, $dataBase);
if ($conn->connect_error) {
    die("Problema al conectar con la base de datos" . $conn->connect_error);
}
$sql = "SELECT m.id,m.nombre,m.descripcion, m.carga_horaria,c.nombre as carrera FROM materias m JOIN carreras c on m.carrera_id = c.id";

$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $materia[$i]['id'] = $row["id"];
        $materia[$i]['nombre'] = $row["nombre"];
        $materia[$i]['carrera'] = $row["carrera"];
        $materia[$i]['descripcion'] = $row["descripcion"];
        $materia[$i]['carga_horaria'] = $row["carga_horaria"];
        $i++;
    }
}
$cantidadMaterias = $i;
$sql = "SELECT * FROM carreras";
$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carrera[$i]['id'] = $row["id"];
        $carrera[$i]['nombre'] = $row["nombre"];
        $carrera[$i]['descripcion'] = $row["descripcion"];
        $i++;
    }
}
$cantidadCarreras = $i;
$conn->close();
?>

<html>
    <head>
        <title>Desafio</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/estilos.css.css"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap.min.js"></script>

    <div class="container">
        <h1>Intraconsulta Rancio v1.0 (bueno mas rancio)</h1>
    </div>

</head>
<body>

    <input name="filtro" class="form-control"id="filtro" type="text" placeholder="Escriba algo para filtrar"/>
    <table id='tabla' class='table table-striped'>
       
        <tr>
            <th>id</th>
            <th>Materia</th>
            <th>Carrera</th>
            <th>descripcion</th>
            <th>Carga Horaria</th>
            <th>Accion</th>
        </tr>
        <?php
        $i = 0;
        while ($i < $cantidadMaterias) {
            echo "
        <tr id=fila" . $materia[$i]["id"] . " ><td>" . $materia[$i]["id"] . "</td>
        <td>" . $materia[$i]["nombre"] . "</td>
        <td>" . $materia[$i]["carrera"] . "</td>
        <td>" . $materia[$i]["descripcion"] . "</td>
        <td>" . $materia[$i]["carga_horaria"] . "</td>
        <td><button name='mod' onClick='SeleccionarMateria(" . $materia[$i]["id"] . ");'> Editar </button>
            <button name='delete' onClick='darDeBaja(" . $materia[$i]["id"] . ");' > Eliminar </button></td>
        </tr>
        ";
            $i++;
        }
        echo '</table>';
        echo include("alta.php");
        echo '<button id="botonAgregar" onClick="mostrarPanelAlta();"> Agregar </button>';
        ?>
</body>
</html>

<script type="text/javascript">
    $('#filtro').keyup(function () {
        $.post(
                "consultas.php",
                {tipo: 'f', filtro: $('#filtro').val()},
                function (data) {
                    $("#tabla").html(data);
                });
    });
    function darDeBaja(id) {
        $.post(
                "consultas.php",
                {tipo: 'd',
                    materiaID: id,
                    materiaNombre: $('#materiaID option:selected').text()

                },
                function (data) {
                    $("#tabla").html(data);
                });
    }
    function mostrarPanelAlta() {
        $('#contenedorAlta').show();
        $('#nombre').val("");
        $('#descripcion').val("");
        $('#botonAgregar').hide();
        $('#botonCerrar').show();
    }
    function ocultarPanelAlta() {
        $('#contenedorAlta').hide();
        $('#botonAgregar').show();
        $('#botonCerrar').hide();
    }
    function SeleccionarMateria(id) {
        $.post(
                "consultas.php",
                {
                    tipo: 's',
                    materiaIdMod: id,
                    filtro: $('#filtro').val()
                },
                function (data) {
                    $("#tabla").html(data);
                }
        );
    }
    function modificar(id) {
        $.post(
                "consultas.php",
                {
                    tipo: 'm',
                    materiaID: id,
                    nombre: $('#nombreMod').val(),
                    carreraId: $('#carreraMod option:selected').val(),
                    descripcion: $('#descripcionMod').val(),
                    cargaHoraria: $('#cargaHorariaMod option:selected').val()},
                function (data) {
                    $("#tabla").html(data);
                }
        );

    }
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46]; // BackSpace , flecha izquierda, flecha derecha, Suprimir.

        tecla_especial = false;
        for (var i in especiales) {
            if (key === especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) === -1 && !tecla_especial)
            return false;
    }

    function limpia(idLimpiar) {
        var texto = $('#' + idLimpiar).val();
        if (hay_algo_que_no_es_letra(texto))
            $('#' + idLimpiar).val("");
    }
    function hay_algo_que_no_es_letra(texto) {
        texto = texto.toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        for (i = 0; i < texto.length; i++) {
            if (letras.indexOf(texto.charAt(i)) === -1) {
                return true;
            }
        }
        return false;
    }
</script>
