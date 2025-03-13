<?php
    require_once '../../config.php';

    $id_entrevista = $_POST['id_entrevista'];
    if($_POST){
  
    $sql = "UPDATE entrevistas SET asistencia_entrevista = 'Sí' WHERE id_entrevista = '$id_entrevista' ";

    if($con -> query($sql) === TRUE) { 
      header("Location: asistencia_confirmada.php");
     } else {
      echo "Error al actualizar el registro" . $con ->error;
    }
  $con ->close();
  }
?>