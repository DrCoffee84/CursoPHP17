<?php

global $materia, $carrera, $cantidadCarreras, $cantidadMaterias;

$servername = "localhost";
$username = "root";
$password = "";
$dataBase = "desafio";

$conn = new mysqli($servername, $username, $password, $dataBase);

if ($conn->connect_error) {
    die("Problema al conectar con la base de datos: " . $conn->connect_error);
}
/**
 * Hay cinco tipo de consultas: 
 * Filtro ( select por  nombre )[f]
 * Alta de materia ( insert )[i]
 * Baja ( delete ) [d] 
 * Selecionar materia a modificar ( select ) [s] 
 * Modificacion ( update ) [m].    
 */
$tipoDeConsulta = $_POST['tipo'];
//Filtro:
if ($tipoDeConsulta == 'f') {
    $filtro = ($_POST['filtro'] !== null) ? $_POST['filtro'] : "";
    $sql = "SELECT m.id,m.nombre,m.descripcion, m.carga_horaria,c.nombre as carrera "
            . "FROM materias m "
            . "JOIN carreras c on m.carrera_id = c.id "
            . "WHERE m.nombre like '%" . $filtro . "%';";  //<- validar para evitar inyeccion SQL. Como se hace en php (server), solo basta con validar que sean letras.
    actualizarTabla($sql, $conn);
}
//Alta
if ($tipoDeConsulta == 'i') {
    $nombre = $_POST['nombre'];
    $carreraId = $_POST['carrera'];
    $descripcion = $_POST['descripcion'];
    $cargaHoraria = $_POST['carga'];
    $val = $carreraId . ",'" . $nombre . "','" . $descripcion . "'," . $cargaHoraria; //<-validar contra inyeccion
    $consulta = "INSERT INTO `materias` (`carrera_id`, `nombre`, `descripcion`, `carga_horaria`)VALUES (" . $val . ");";
    $result = $conn->query($consulta); // <- validar si se inserto.
    actualizarTabla(null, $conn);
}
//BAJA
if ($tipoDeConsulta == 'd') {
    $materiaID = $_POST['materiaID'];
    $materiaNombre = $_POST['materiaNombre'];
    $consulta = "DELETE FROM `materias` WHERE `materias`.`id` =" . $materiaID . ";";
    $result = $conn->query($consulta);
    actualizarTabla(null, $conn);
}
//Modificar:
if ($tipoDeConsulta == 'm') {
    $materiaID = $_POST['materiaID'];
    $nombre = $_POST['nombre'];
    $carreraId = $_POST['carreraId'];
    $descripcion = $_POST['descripcion'];
    $cargaHoraria = $_POST['cargaHoraria'];
    $consulta = "UPDATE `materias` SET `carrera_id` = '" . $carreraId . "', `nombre` = '" . $nombre . "', `descripcion` = '" . $descripcion . "', `carga_horaria` = '" . $cargaHoraria . "' WHERE `materias`.`id` = " . $materiaID . ";";
    $result = $conn->query($consulta);
    actualizarTabla(null, $conn);
}
if ($tipoDeConsulta == 's') {
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
    $materiaID = $_POST['materiaIdMod'];
    $sql = "SELECT * FROM materias where id=" . $materiaID . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $materiaMod['id'] = $row['id'];
        $materiaMod['nombre'] = $row["nombre"];
        $materiaMod['carrera_id'] = $row["carrera_id"];
        $materiaMod['descripcion'] = $row["descripcion"];
        $materiaMod['carga_horaria'] = $row["carga_horaria"];
    }
    $filtro = $_POST['filtro'];
    actualizarTablaEditar($conn, $materiaMod, $carrera, $cantidadCarreras, $filtro);
}

$conn->close();

function actualizarTabla($sql, $conn) {
    if ($sql == null) {
        $sql = "SELECT m.id,m.nombre,m.descripcion, m.carga_horaria,c.nombre as carrera FROM materias m JOIN carreras c on m.carrera_id = c.id";
    }
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

    if ($cantidadMaterias == 0)
        echo 'sin resultados';
    echo "<tr><th>id</th>
            <th>Materia</th>
            <th>Carrera</th>
            <th>descripcion</th>
            <th>Carga Horaria</th>
            <th>Accion</th>
        </tr> ";
    $i = 0;
    while ($i < $cantidadMaterias) {
        echo"<tr>
        <td>" . $materia[$i]["id"] . "</td>
        <td>" . $materia[$i]["nombre"] . "</td>
        <td>" . $materia[$i]["carrera"] . "</td>
        <td>" . $materia[$i]["descripcion"] . "</td>
        <td>" . $materia[$i]["carga_horaria"] . "</td>
        <td><button name='mod' onClick='SeleccionarMateria(" . $materia[$i]["id"] . ");'> Editar </button>
            <button name='delete' onClick='darDeBaja(" . $materia[$i]["id"] . ");'> Eliminar </button></td> 
        </tr>";
        $i++;
    }
}

function actualizarTablaEditar($conn, $materiaMod, $carrera, $cantidadCarreras, $filtro) {
    $horasPosibles = [2, 4, 6, 8, 10];
    $sql = "SELECT m.id,m.nombre,m.descripcion, m.carga_horaria,c.nombre as carrera "
            . "FROM materias m "
            . "JOIN carreras c on m.carrera_id = c.id "
            . "WHERE m.nombre like '%" . $filtro . "%';";
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

    if ($cantidadMaterias == 0)
        echo '.Sin resultados.';

    $i = 0;
    echo"
        <tr><th>id</th>
            <th>Materia</th>
            <th>Carrera</th>
            <th>descripcion</th>
            <th>Carga Horaria</th>
            <th>Accion</th>
        </tr> ";
    while ($i < $cantidadMaterias) {
        echo'<tr>';
        if ($materiaMod['id'] === $materia[$i]['id']) {
            echo'<td>' . $materia[$i]['id'] . '</td>
            <td> <input type="text" id="nombreMod" name="nombreMod" placeholder="Ingrese el nombre" onkeypress="return soloLetras(event)" onblur="limpia( nombreMod )" value ="' . $materia[$i]['nombre'] . '" /> </td>
            <td> <select name="carreraMod" id="carreraMod">';
            if ($cantidadCarreras > 0) {
                for ($j = 0; $j < $cantidadCarreras; $j++) {
                    echo '<option';
                    if ($carrera[$j]['id'] == $materiaMod['carrera_id'])
                        echo ' selected';
                    echo ' value="' . $carrera[$j]['id'] . '" >' . $carrera[$j]['nombre'] . ' </option>';
                }
            }else {
                echo '<option value="0">No hay opciones</option>';
            }
            echo '</select></td>
            <td><input type="text" placeholder="Ingrese descripcion" name="descripcionMod" onkeypress="return soloLetras(event)" onblur="limpia( descripcionMod )" id="descripcionMod" value="' . $materiaMod['descripcion'] . '"/></td>
            <td><select name="cargaHorariaMod" id="cargaHorariaMod">';

            for ($j = 0; $j < count($horasPosibles); $j++) {
                echo '<option';
                if ($horasPosibles[$j] == $materiaMod['carga_horaria'])
                    echo ' selected';
                echo '>' . $horasPosibles[$j] . '</option>';
            }

            echo '</select> </td><td>';
            echo "<button name='mod' onClick='modificar(" . $materia[$i]["id"] . ");'> listo </button>";
        } else {
            echo"
            <td>" . $materia[$i]["id"] . "</td>
            <td>" . $materia[$i]["nombre"] . "</td>
            <td>" . $materia[$i]["carrera"] . "</td>
            <td>" . $materia[$i]["descripcion"] . "</td>
            <td>" . $materia[$i]["carga_horaria"] . "</td><td>
            <button name='mod' onClick='SeleccionarMateria(" . $materia[$i]["id"] . ");'> Editar </button>";
        }
        echo"
            <button name='delete' onClick='darDeBaja(" . $materia[$i]["id"] . ");'> Eliminar </button></td> 
        </tr>";

        $i++;
    }
}
?>
