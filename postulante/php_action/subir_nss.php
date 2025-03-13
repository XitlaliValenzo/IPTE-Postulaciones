<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_nss = $id_usuario."-".$_FILES['nss']['name'];
	$ruta = $_FILES['nss']['tmp_name'];
	$destino = "archivos/".$nombre_nss;

	if ($nombre_nss != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET nss = '$nombre_nss' WHERE id_postulante = {$id_usuario} ";


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