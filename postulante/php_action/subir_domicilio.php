<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_domicilio = $id_usuario."-".$_FILES['com_domicilio']['name'];
	$ruta = $_FILES['com_domicilio']['tmp_name'];
	$destino = "archivos/".$nombre_domicilio;

	if ($nombre_domicilio != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET com_domicilio = '$nombre_domicilio' WHERE id_postulante = {$id_usuario} ";


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