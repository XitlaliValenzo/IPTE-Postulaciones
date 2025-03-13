<?php 
 	require_once '../../config.php';

 	if($_POST){
		$id = $_POST['id'];

		$sql = "UPDATE usuarios SET estatus = 'No contratado' WHERE id = {$id}";

		if($con -> query($sql) === TRUE) {
			header("Location: solicitud_rechazada.php");
		} else {
			echo "Error al eliminar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>