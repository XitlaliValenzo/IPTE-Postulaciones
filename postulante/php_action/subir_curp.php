<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_curp = $id_usuario."-".$_FILES['curp']['name'];
	$ruta = $_FILES['curp']['tmp_name'];
	$destino = "archivos/".$nombre_curp;

	if ($nombre_curp != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET curp = '$nombre_curp' WHERE id_postulante = {$id_usuario} ";

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