<!DOCTYPE html>
<html lang="es">
<head>
	<title>Crear usuario...</title>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">	
</head>
<body>

<div class="container">

	<?php 

    include 'config.php';

    // Consultamos para verificarsi el correo electrónico ya existe
    $checkEmail = "SELECT * FROM usuarios WHERE email = '$_POST[email]' ";

    //La variable $result mantiene los datos de la conexión y la consulta
    $result = $con-> query($checkEmail);

    //La variable $count retiene el resultado de la consulta
    $count = mysqli_num_rows($result);

    //Si count == 1 significa que el correro electrónico ya está en la base de datos
    if ($count == 1) {
    	echo "<div class='alert alert-warning mt-4 text-center' role='alert'>
    	<p>Ese correo electrónico ya está en nuestra base de datos.</p>
    	<p><a href='register.php'>¡Por favor inicia aquí!</a></p>
    	  </div>";
 } else {

 	//Si el correo electrónico no existe, los datos del formulario se envían a la base de datos y se crea la cuenta
     $nombre = $_POST['nombre'];
     $email = $_POST['email'];     
     $password = $_POST['password'];   
     $telefono = $_POST['telefono'];     
     $edad = $_POST['edad']; 
     $genero = $_POST['genero']; 
     $direccion = $_POST['direccion'];
     $image = $_FILES['image']['name'];
     $errorMsg = "";

     // La función password_hash() convierte la contraseña en un hash antes de enviarla a la base de datos
     //$passHash = password_hash($pass, PASSWORD_DEFAULT);

     // Inserta la consulta para enviar por hash el nombre, email y password a la base de datos 

     //Guarda en una carpeta llamada "photos" las imagenes que contendrá todo lo subido al sistema
     $target_file = "photos/" . basename($_FILES["image"]["name"]);
     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      
     } else {
      $errorMsg = "¡Error!";
     }
}
     $query = "INSERT INTO usuarios (nombre, email, password, telefono, edad, genero, direccion, image, activo, role) VALUES ('$nombre', '$email', '$password', '$telefono', '$edad', '$genero', '$direccion', '$image' , 1, "postulante")";

     if (mysqli_query($con, $query)) {
        $errorMsg = "¡Tu cuenta ha sido creada!";
     	echo "<div class='alert alert-success mt-4 text-center' role='alert'><h3>¡Tu cuenta ha sido creada!</h3>
        <br>
     	<a class='btn btn-success' href='login.php' role='button'>Iniciar sesión</a></div>";
     } else {
     	echo "Error: " . $query . "<br>" . mysqli_error($con);
     }
  
  mysqli_close($con);    
?>

</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
	
</body>
</html>