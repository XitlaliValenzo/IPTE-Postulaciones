<?php 
 	require_once '../../config.php';

 	if($_POST){
		$fecha_entrevista = $_POST['fecha_entrevista'];
		$hora_entrevista = $_POST['hora_entrevista'];
		$modalidad_entrevista = $_POST['modalidad_entrevista'];
				
		$id_entrevista = $_POST['id'];
		$id_postulante = $_POST['id_postulante'];

		if ($modalidad_entrevista == 'Presencial') {

			$ubicacion_entrevista = $_POST['ubicacion_entrevista'];

			$sql = "UPDATE entrevistas SET fecha_entrevista = '$fecha_entrevista', hora_entrevista = '$hora_entrevista', ubicacion_entrevista = '$ubicacion_entrevista' WHERE id_entrevista = {$id_entrevista}";
			$sql2 = "UPDATE usuarios SET estatus = 'Entrevista reagendada segunda etapa' WHERE id = {$id_postulante}";
			
		} else {

			$link_teams = $_POST['link_teams'];

			$sql = "UPDATE entrevistas SET fecha_entrevista = '$fecha_entrevista', hora_entrevista = '$hora_entrevista', link_teams = '$link_teams' WHERE id_entrevista = {$id_entrevista}";
			$sql2 = "UPDATE usuarios SET estatus = 'Entrevista reagendada' WHERE id = {$id_postulante}";

		}


		if($con -> query($sql) === TRUE) {
			$con -> query($sql2);
			header("Location: entrevista_reagendada2.php");
		} else {
			echo "Error al actualizar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>