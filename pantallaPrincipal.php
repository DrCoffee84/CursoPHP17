<?php
	// Parametros que necesito 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dataBase = "desafio";

	// Creo la conexion 
	$conn = new mysqli($servername, $username, $password, $dataBase);
	
	// Verifico la conexion
	if ($conn->connect_error) {
		die("Problema al conectar con la base de datos" . $conn->connect_error);
	} 
	
	if(isset($_POST['filtro'])){
		$filtro = $_POST['filtro'];
		$sql = "SELECT * FROM materia WHERE nombre like '%". $filtro. "%';"; 	//<- validar para evitar inyeccion SQL. Como se hace en php (server), solo basta con validar que sean letras.
		}
	else{
		$sql = "SELECT * FROM materia;";
	}
		$result = $conn->query($sql);
		$i = 0;	
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$materia[$i]['id'] =  $row["id"];
				$materia[$i]['nombre'] =  $row["nombre"];
				$materia[$i]['carrera_id'] =  $row["carrera_id"];
				$materia[$i]['descripcion'] =  $row["descripcion"];
				$materia[$i]['carga_horaria'] =  $row["carga_horaria"];
				$i++;
			}
		}
		$cantidadMaterias = $i;
	
	$sql = "SELECT * FROM carreras";
	$result = $conn->query($sql);
	$i = 0;	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$carrera[$i]['id'] =  $row["id"];
			$carrera[$i]['nombre'] =  $row["nombre"];
			$carrera[$i]['descripcion'] =  $row["descripcion"];
			$i++;
		}
	}
	$cantidadCarreras = $i;
	
	unset($i); //destruyo i :D (porque quiero). <<
	
	//	Cierro la conexion
	$conn->close();
	
	if( ! isset($_POST['filtro']) ){
		session_start();
		$_SESSION['cantidadMaterias'] = $cantidadMaterias;
		$_SESSION['cantidadCarreras'] = $cantidadCarreras;
		if( $cantidadMaterias > 0){
			$_SESSION['materia'] = $materia;
		}
		if( $cantidadCarreras > 0){
			$_SESSION['carrera'] = $carrera;
		}
	}
	
?>

<html>
	<head>
		<title>Desafio</title>
		<script type="text/javascript" src="js/jquery.min.js"></script>
	</head>
 <body>
 <?php echo '<h1>Intraconsulta Rancio v1.0 (bueno mas rancio)</h1>' ; 
	echo '<a href="http://localhost/git/CursoPHP17/pantallaABM.php" >ABM de materia</a><br>'; 
	echo "Materias: " . $cantidadMaterias. "<br><br>";
	echo '<form id="formularioMod" action="pantallaPrincipal.php" role="form" method="post" enctype="multipart/form-data">';
	echo '<input name="filtro" id="filtro" type="text" placeholder="Escriba algo para filtrar"/>';
	echo '<button type="submit" id="filtro"> Filtrar </button>';
	echo "<table id='tabla'>";
	$i=0;	
	while($i<$cantidadMaterias){
		echo 	"
					<tr><td>".$materia[$i]["id"]."</td>
					<td>".$materia[$i]["nombre"]."</td>
					<td>".$materia[$i]["carrera_id"]."</td>
					<td>".$materia[$i]["descripcion"]."</td>
					<td>".$materia[$i]["carga_horaria"]."</td>
					</tr>
				";
		$i++;
	}
	echo '</table>';
?>
 </body>
</html>

<script type="text/javascript">
/*
	$('#filtro').keyup(function SeleccionarMateria(){ //<- por lo menos sin ajax no funciona bien.
			$('#formularioMod').submit();
	});
*/
</script>
