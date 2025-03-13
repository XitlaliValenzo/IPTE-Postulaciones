<?php 
 	require_once '../../config.php';

 	if($_POST){
		$password = $con->real_escape_string(md5($_POST['password']));
		$id = $_POST['id'];

		$sql = "UPDATE usuarios SET password = '$password' WHERE id = {$id}";

		if($con -> query($sql) === TRUE) {
			header("Location: password_actualizada.php");
		} else {
			echo "Error al actualizar el registro" . $con ->error;
		}
	$con ->close();
 	}
?>