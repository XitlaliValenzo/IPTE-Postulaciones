<?php 

include_once '../../config.php';

if ($_POST){
	$id_usuario = $_POST['id_usuario'];

	$nombre_curriculum = $id_usuario."-".$_FILES['curriculum']['name'];
	$ruta = $_FILES['curriculum']['tmp_name'];
	$destino = "archivos/".$nombre_curriculum;

	if ($nombre_curriculum != ""){
		if(copy($ruta,$destino)){
			$nombre = $_POST['nombre'];
			$edad = $_POST['edad'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];
			$entrevista = $_POST['entrevista'];
			date_default_timezone_set('America/Mexico_City');
			$fecha_postulacion = date("Y-m-d");

			$id_vacante = $_POST['id_vacante'];

			$sql = "UPDATE usuarios SET nombre = '$nombre',edad = '$edad', telefono = '$telefono', email = '$email', direccion = '$direccion', entrevista = '$entrevista', fecha_postulacion = '$fecha_postulacion', id_vacante='$id_vacante', curriculum = '$nombre_curriculum', estatus='Pendiente' WHERE id = {$id_usuario} ";


			$query = $con->query($sql);
			if($query){
				header("Location: postulacion_realizada.php");

			}
		} else {
			echo "Error";
		}
	}


}

?>