<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_ine = $id_usuario."-".$_FILES['ine']['name'];
	$ruta = $_FILES['ine']['tmp_name'];
	$destino = "archivos/".$nombre_ine;

	if ($nombre_ine != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET ine = '$nombre_ine' WHERE id_postulante = {$id_usuario} ";


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