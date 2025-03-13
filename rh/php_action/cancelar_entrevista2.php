<?php 
 	require_once '../../config.php';

 	if($_POST){
 		$cancelacion_entrevista = $_POST['cancelacion_entrevista'];

		$id_entrevista = $_POST['id'];
		$id_postulante = $_POST['id_postulante'];

		$sql = "UPDATE entrevistas SET cancelacion_entrevista = '$cancelacion_entrevista', estatus_entrevista = 'Cancelada', activo_entrevista = 2 WHERE id_entrevista = {$id_entrevista}";

		$sql2 = "UPDATE usuarios SET estatus = 'Entrevista cancelada' WHERE id = {$id_postulante}";

		if($con -> query($sql) === TRUE) {
			$con -> query($sql2);
			header("Location: entrevista_cancelada2.php");
		} else {
			echo "Error al eliminar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>