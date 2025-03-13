<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_sat = $id_usuario."-".$_FILES['fiscal_sat']['name'];
	$ruta = $_FILES['fiscal_sat']['tmp_name'];
	$destino = "archivos/".$nombre_sat;

	if ($nombre_sat != ""){
		if(copy($ruta,$destino)){
			
			$sql = "UPDATE contratacion SET fiscal_sat = '$nombre_sat' WHERE id_postulante = {$id_usuario} ";


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