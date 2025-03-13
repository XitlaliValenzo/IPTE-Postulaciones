<?php 
 	require_once '../../config.php';

 	if($_POST){
		$id = $_POST['id'];

		$sql = "UPDATE usuarios SET activo = 2 WHERE id = {$id}";

		if($con -> query($sql) === TRUE) {
			header("Location: ../../logout.php");
		} else {
			echo "Error al eliminar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>