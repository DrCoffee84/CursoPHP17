 <?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dataBase = "desafio";
	$conn = new mysqli($servername, $username, $password, $dataBase);
	if ($conn->connect_error) 
		die("Problema al conectar con la base de datos" . $conn->connect_error);
		

	if (isset($_POST['insert'] )) {
		$nombre = $_POST['nombre'];
		$carreraId = $_POST['carrera'];
		$descripcion = $_POST['descripcion'];
		$cargaHoraria = $_POST['carga'];	
		$val = $carreraId .",'" . $nombre  ."','" .  $descripcion  ."'," .  $cargaHoraria;
		$consulta = "INSERT INTO `materia` (`carrera_id`, `nombre`, `descripcion`, `carga_horaria`)VALUES (". $val .");";
		$result = $conn->query($consulta);
	}
	if(isset($_POST['delete'])){
		$materiaID = $_POST['materiaID'];
		$consulta = "DELETE FROM `materia` WHERE `materia`.`id` =". $materiaID .";";
		$result = $conn->query($consulta);
	}
	if(isset($_POST['mod'])){
		$materiaID = $_POST['materiaIdMod'];
		$nombre = $_POST['nombreMod'];
		$carreraId = $_POST['carreraMod'];
		$descripcion = $_POST['descripcionMod'];
		$cargaHoraria = $_POST['cargaMod'];	
		
		$consulta = "UPDATE `materia` SET `carrera_id` = '" . $carreraId ."', `nombre` = '". $nombre."', `descripcion` = '".$descripcion."', `carga_horaria` = '".$cargaHoraria."' WHERE `materia`.`id` = ".$materiaID.";";
		$result = $conn->query($consulta);
	}
	echo '<p>Kami-sama puede ser mi cruel >:( </p>';
?>