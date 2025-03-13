<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_acta = $id_usuario."-".$_FILES['acta_nacimiento']['name'];
	$ruta = $_FILES['acta_nacimiento']['tmp_name'];
	$destino = "archivos/".$nombre_acta;

	if ($nombre_acta != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET acta_nacimiento = '$nombre_acta' WHERE id_postulante = {$id_usuario} ";


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