<?php 
 	require_once '../../config.php';

 	if($_POST){
		$estatus_entrevista = $_POST['estatus_entrevista'];
		$estatus = $_POST['estatus'];
		
				
		$id_entrevista = $_POST['id'];
		$id_postulante = $_POST['id_postulante'];

		$sql = "UPDATE entrevistas SET estatus_entrevista = '$estatus_entrevista' WHERE id_entrevista = {$id_entrevista}";
		$sql2 = "UPDATE usuarios SET estatus = '$estatus' WHERE id = {$id_postulante}";

		if ($estatus == 'Contratado'){
			date_default_timezone_set('America/Mexico_City');
			$fecha_contratacion = date("Y-m-d");
			$puesto = $_POST['puesto_vacante'];
			$id_vacante = $_POST['id_vacante'];
			$info_empleo = nl2br($_POST['info_empleo']);


			$sql3 = "INSERT INTO contratacion (puesto, fecha_contratacion, info_empleo, id_postulante, id_vacante) VALUES ('$puesto', '$fecha_contratacion', '$info_empleo', '$id_postulante', '$id_vacante')";
			$con -> query($sql3);

		}

		if($con -> query($sql) === TRUE) {
			$con -> query($sql2);
			header("Location: estatus_actualizado.php");
		} else {
			echo "Error al actualizar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>