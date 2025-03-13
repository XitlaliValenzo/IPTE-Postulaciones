<?php 
 	require_once '../../config.php';

 	if($_POST){
		$id_vacante = $_POST['id'];

		$sql = "UPDATE vacante SET activo_vacante = 2 WHERE id_vacante = {$id_vacante}";

		if($con -> query($sql) === TRUE) {
			header("Location: vacante_eliminada.php");
		} else {
			echo "Error al eliminar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>