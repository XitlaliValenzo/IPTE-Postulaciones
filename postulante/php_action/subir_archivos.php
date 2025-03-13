<?php 

include_once '../../config.php';

if ($_POST){
	

	$nombre_acta = $_FILES['acta_nacimiento']['name'];
	$ruta_acta = $_FILES['acta_nacimiento']['tmp_name'];
	$destino_acta = "archivos/".$nombre_acta;

	$nombre_curp = $_FILES['curp']['name'];
	$ruta_curp = $_FILES['curp']['tmp_name'];
	$destino_curp = "archivos/".$nombre_curp;

	$nombre_domicilio = $_FILES['com_domicilio']['name'];
	$ruta_domicilio = $_FILES['com_domicilio']['tmp_name'];
	$destino_domicilio = "archivos/".$nombre_domicilio;

	$nombre_nss = $_FILES['nss']['name'];
	$ruta_nss = $_FILES['nss']['tmp_name'];
	$destino_nss = "archivos/".$nombre_nss;

	$nombre_fiscal = $_FILES['fiscal_sat']['name'];
	$ruta_fiscal = $_FILES['fiscal_sat']['tmp_name'];
	$destino_fiscal = "archivos/".$nombre_fiscal;

	$nombre_titulo = $_FILES['titulo']['name'];
	$ruta_titulo = $_FILES['titulo']['tmp_name'];
	$destino_titulo = "archivos/".$nombre_titulo;

	$nombre_cedula = $_FILES['cedula']['name'];
	$ruta_cedula = $_FILES['cedula']['tmp_name'];
	$destino_cedula = "archivos/".$nombre_cedula;

	$id_vacante = $_POST['id_vacante'];
	$id_usuario = $_POST['id_usuario'];

	$sql = "INSERT INTO contratacion (id_postulante, id_vacante) VALUES('$id_usuario', '$id_vacante')";
	if($con -> query($sql) === TRUE) {
			echo 'Primer registro';
		} else {
			echo "Error" .$sql. ' ' .$con ->connect_error;
		}

	if ($nombre_acta != ""){
		if(copy($ruta_acta,$destino_acta)){
			$sql2 = "UPDATE contratacion SET acta_nacimiento = '$nombre_acta' WHERE id_postulante = {$id_usuario} ";
			$query2 = $con->query($sql2);
			if($query2){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}

	if ($nombre_curp != ""){
		if(copy($ruta_curp,$destino_curp)){
			$sql3 = "UPDATE contratacion SET curp = '$nombre_curp' WHERE id_postulante = {$id_usuario} ";
			$query3 = $con->query($sql3);
			if($query3){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}

	if ($nombre_domicilio != ""){
		if(copy($ruta_domicilio,$destino_domicilio)){
			$sql4 = "UPDATE contratacion SET com_domicilio = '$nombre_domicilio' WHERE id_postulante = {$id_usuario} ";
			$query4 = $con->query($sql4);
			if($query4){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}

	if ($nombre_nss != ""){
		if(copy($ruta_nss,$destino_nss)){
			$sql5 = "UPDATE contratacion SET nss = '$nombre_nss' WHERE id_postulante = {$id_usuario} ";
			$query5 = $con->query($sql5);
			if($query5){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}

	if ($nombre_fiscal != ""){
		if(copy($ruta_fiscal,$destino_fiscal)){
			$sql6 = "UPDATE contratacion SET fiscal_sat = '$nombre_fiscal' WHERE id_postulante = {$id_usuario} ";
			$query6 = $con->query($sql6);
			if($query6){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}

	if ($nombre_titulo != ""){
		if(copy($ruta_titulo,$destino_titulo)){
			$sql7 = "UPDATE contratacion SET titulo = '$nombre_titulo' WHERE id_postulante = {$id_usuario} ";
			$query7 = $con->query($sql7);
			if($query7){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}

	if ($nombre_cedula != ""){
		if(copy($ruta_cedula,$destino_cedula)){
			$sql8 = "UPDATE contratacion SET cedula = '$nombre_cedula' WHERE id_postulante = {$id_usuario} ";
			$query8 = $con->query($sql8);
			if($query8){
				echo "Se guardó correctamente";
			
			}
		} else {
			echo "Error";
		}
	}


}

?>