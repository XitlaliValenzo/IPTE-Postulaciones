<?php 
 	require_once '../../config.php';

 	if($_POST){
		$id = $_POST['id'];

		$sql = "UPDATE usuarios SET estatus = null, id_vacante = null WHERE id = {$id}";

		if($con -> query($sql) === TRUE) {
			header("Location: postulacion_cancelada.php");
		} else {
			echo "Error al cancelar la postulacion" . $con ->error;
		}
	$con ->close();
 	}
?>