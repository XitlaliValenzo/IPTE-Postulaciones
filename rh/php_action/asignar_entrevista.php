<?php 
 	require_once '../../config.php';

 	if($_POST){
		$fecha_entrevista = $_POST['fecha_entrevista'];
		$hora_entrevista = $_POST['hora_entrevista'];
		$modalidad_entrevista = $_POST['modalidad_entrevista'];
				
		$id = $_POST['id'];

		if ($modalidad_entrevista == 'Presencial') {

			$ubicacion_entrevista = $_POST['ubicacion_entrevista'];

			$sql = "INSERT INTO entrevistas (fecha_entrevista, hora_entrevista, modalidad_entrevista,ubicacion_entrevista, estatus_entrevista, id_postulante, activo_entrevista) VALUES('$fecha_entrevista', '$hora_entrevista', 'Presencial', '$ubicacion_entrevista', 'Pendiente', {$id}, 1)";
			
			$sql2 = "UPDATE usuarios SET estatus = 'Por entrevistar' WHERE id = {$id}";


		} else {

			$link_teams = $_POST['link_teams'];

			$sql = "INSERT INTO entrevistas (fecha_entrevista, hora_entrevista, modalidad_entrevista, link_teams, estatus_entrevista, id_postulante, activo_entrevista) VALUES('$fecha_entrevista', '$hora_entrevista', 'Online', '$link_teams', 'Pendiente', {$id}, 1)";

			$sql2 = "UPDATE usuarios SET estatus = 'Por entrevistar' WHERE id = {$id}";

		}


		if($con -> query($sql) === TRUE) {
			$con -> query($sql2);
			header("Location: entrevista_asignada.php");
		} else {
			echo "Error al actualizar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>