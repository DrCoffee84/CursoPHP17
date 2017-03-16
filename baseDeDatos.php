<?php
//Esto es para el formulario modificar, traigo la materia a cambiar.
$mostramela = false;
if(isset($_POST['materiaIdMod'])){
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
	$materiaID = $_POST['materiaIdMod'];
	$sql = "SELECT * FROM materia where id=".$materiaID.";";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$materiaMod['id'] = $row['id'];
		$materiaMod['nombre'] =  $row["nombre"];
		$materiaMod['carrera_id'] =  $row["carrera_id"];
		$materiaMod['descripcion'] =  $row["descripcion"];
		$materiaMod['carga_horaria'] =  $row["carga_horaria"];	
	}
	$mostramela = true;
}
?>