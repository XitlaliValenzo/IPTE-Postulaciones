<?php
	//Configuración de la BD
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bd_ipte";

	//Crear la conexión a la BD
	$con = new mysqli($hostname, $username, $password, $dbname);

	//Verificar la conexión
	if ($con->connect_error) {
		die("Conexion fallida: " . $con->connect_error);
	}
?>