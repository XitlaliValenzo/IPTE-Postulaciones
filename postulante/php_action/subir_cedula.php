<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_cedula = $id_usuario."-".$_FILES['cedula']['name'];
	
	$ruta = $_FILES['cedula']['tmp_name'];
	$destino = "archivos/".$nombre_cedula;

	if ($nombre_cedula != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET cedula = '$nombre_cedula' WHERE id_postulante = {$id_usuario} ";


			$query = $con->query($sql);
			if($query){
				header("Location: archivo_subido.php");

			}
		} else {
			header("Location: error.php");
		}
	}


}
ob_end_flush();
?>