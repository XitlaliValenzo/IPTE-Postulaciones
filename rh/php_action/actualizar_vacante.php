<?php 
ob_start();
 	require_once '../../config.php';

 	if($_POST){
		$puesto_vacante = $_POST['puesto_vacante'];
		$descripcion_vacante = nl2br($_POST['descripcion_vacante']);
		$perfil_vacante = nl2br($_POST['perfil_vacante']);
		$sueldo_vacante = $_POST['sueldo_vacante'];
		$ubicacion_vacante = $_POST['ubicacion_vacante'];
		$modalidad_vacante = $_POST['modalidad_vacante'];
		$modalidad_entrevista = $_POST['modalidad_entrevista'];
		$comentarios_vacante = nl2br($_POST['comentarios_vacante']);

		$id_vacante = $_POST['id'];

		$sql = "UPDATE vacante SET puesto_vacante = '$puesto_vacante', descripcion_vacante = '$descripcion_vacante', perfil_vacante = '$perfil_vacante', sueldo_vacante = '$sueldo_vacante', ubicacion_vacante = '$ubicacion_vacante', modalidad_vacante = '$modalidad_vacante', modalidad_entrevista = '$modalidad_entrevista', comentarios_vacante = '$comentarios_vacante' WHERE id_vacante = {$id_vacante}";

		if($con -> query($sql) === TRUE) {
			header("Location: vacante_actualizada.php");
		} else {
			echo "Error al actualizar el registro" . $con ->error;
		}
	$con ->close();
 	}
 	ob_end_flush();
?>