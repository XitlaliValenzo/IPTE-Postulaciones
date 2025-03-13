<?php

 	require_once '../../config.php';

 	if($_POST){
 		$puesto_vacante = $_POST['puesto_vacante'];
		$descripcion_vacante = nl2br($_POST['descripcion_vacante']);
		$perfil_vacante = nl2br($_POST['perfil_vacante']);
		$sueldo_vacante = $_POST['sueldo_vacante'];
		$ubicacion_vacante = $_POST['ubicacion_vacante'];
		$modalidad_vacante = $_POST['modalidad_vacante'];
		$modalidad_entrevista = $_POST['modalidad_entrevista'];
		date_default_timezone_set('America/Mexico_City');
		$fecha_vacante = date("Y-m-d");
		$comentarios_vacante = nl2br($_POST['comentarios_vacante']);

		$sql = "INSERT INTO vacante (puesto_vacante, descripcion_vacante, perfil_vacante, sueldo_vacante, ubicacion_vacante, modalidad_vacante, modalidad_entrevista, comentarios_vacante, fecha_vacante, activo_vacante) VALUES('$puesto_vacante', '$descripcion_vacante', '$perfil_vacante', '$sueldo_vacante', '$ubicacion_vacante', '$modalidad_vacante', '$modalidad_entrevista', '$comentarios_vacante', '$fecha_vacante', 1)";

		if($con -> query($sql) === TRUE) {
			header("Location: vacante_creada.php");
		} else {
			echo "Error" .$sql. ' ' .$con ->connect_error;
		}
	$con ->close();
 	}
 	
?>