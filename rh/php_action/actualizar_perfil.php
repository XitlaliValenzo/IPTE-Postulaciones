<?php 

    require_once '../../config.php';

   

 	//Si el correo electrónico no existe, los datos del formulario se envían a la base de datos y se crea la cuenta
     $nombre = $_POST['nombre'];
     $email = $_POST['email'];     
     $telefono = $_POST['telefono'];     
     $puesto = $_POST['puesto']; 
     $image = $_FILES['image']['name'];
     
     $id = $_POST['id'];

     if(empty($image)){
     	$query = "UPDATE usuarios SET nombre = '$nombre', email = '$email', telefono = '$telefono', puesto = '$puesto' WHERE id = {$id}";


     if (mysqli_query($con, $query)) {
     	header("Location: perfil_actualizado.php");
     } else {
     	echo "Error: " . $query . "<br>" . mysqli_error($con);
     }

     } else{
     //Guarda en una carpeta llamada "photos" las imagenes que contendrá todo lo subido al sistema

     $target_file = "../../photos/" . basename($_FILES["image"]["name"]);
     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      
     } else {
      echo "¡Error!";
     }

     $query = "UPDATE usuarios SET nombre = '$nombre', email = '$email', telefono = '$telefono', puesto = '$puesto', image = '$image' WHERE id = {$id}";


     if (mysqli_query($con, $query)) {
     	header("Location: ../profile.php");
     } else {
     	echo "Error: " . $query . "<br>" . mysqli_error($con);
     }

    }
  
  mysqli_close($con);    
?>