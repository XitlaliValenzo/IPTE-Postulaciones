<?php 
ob_start();
include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_titulo = $id_usuario."-".$_FILES['titulo']['name'];
	$ruta = $_FILES['titulo']['tmp_name'];
	$destino = "archivos/".$nombre_titulo;

	if ($nombre_titulo != ""){
		if(copy($ruta,$destino)){

			$sql = "UPDATE contratacion SET titulo = '$nombre_titulo' WHERE id_postulante = {$id_usuario} ";


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