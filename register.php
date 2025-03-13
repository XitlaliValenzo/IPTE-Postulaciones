<?php 

    include 'config.php';
    if (isset($_POST['submit'])) {
    // Consultamos para verificar si el correo electrónico ya existe
    $checkEmail = "SELECT * FROM usuarios WHERE email = '$_POST[email]' ";

    $errorMsg = "";
    $alert = "";
    $boton="";

    //La variable $result mantiene los datos de la conexión y la consulta
    $result = $con-> query($checkEmail);

    //La variable $count retiene el resultado de la consulta
    $count = mysqli_num_rows($result);

    //Si count == 1 significa que el correro electrónico ya está en la base de datos
    if ($count == 1) {
    	$errorMsg = "¡Este correo electrónico ya está en nuestra base de datos. Vuelve a registrarte!";
    	$alert = "alert alert-warning alert-dismissible fade show";

 } else {

 	//Si el correo electrónico no existe, los datos del formulario se envían a la base de datos y se crea la cuenta
     $nombre = $_POST['nombre'];
     $email = $_POST['email'];     
     $password = $con->real_escape_string(md5($_POST['password']));   
     $telefono = $_POST['telefono'];     
     $edad = $_POST['edad']; 
     $genero = $_POST['genero']; 
     $direccion = $_POST['direccion'];
     $image = $_FILES['image']['name'];
     

     // La función password_hash() convierte la contraseña en un hash antes de enviarla a la base de datos
     //$passHash = password_hash($pass, PASSWORD_DEFAULT);

     // Inserta la consulta para enviar por hash el nombre, email y password a la base de datos 

     //Guarda en una carpeta llamada "photos" las imagenes que contendrá todo lo subido al sistema
     $target_file = "photos/" . basename($_FILES["image"]["name"]);
     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      
     } else {
      $errorMsg = "¡Error!";
      $alert = "alert alert-danger alert-dismissible fade show";
    
     }

     $query = "INSERT INTO usuarios (nombre, email, password, telefono, edad, genero, direccion, image, activo, role) VALUES ('$nombre', '$email', '$password', '$telefono', '$edad', '$genero', '$direccion', '$image' , 1, 'postulante')";

     if (mysqli_query($con, $query)) {
        $errorMsg = "¡Tu cuenta ha sido creada!";
        $alert = "alert alert-success alert-dismissible fade show";
    	$boton="<br><center><a class='btn btn-success' href='login.php' role='button'>Iniciar sesión</a></center>";
     } else {
     	$errorMsg = "Error: " . $query . "<br>" . mysqli_error($con);
     }
  }
}
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="css/estilo.css">
	<title>Registro</title>
</head>
<body class="fondo_registro">
<section class="h-100 h-custom">
	<div class="container py-5 h-100">
		<div class="row d-flex h-100" style="justify-content: space-between;">
			<div class="col-lg-3 col-xl-5 py-2 d-flex">
				<div class="container px-3 py-3 d-flex align-items-center" id="fondo_logo">
					<center><img src="img/logo.png" class="img-fluid" alt="logo_ipte"></center>
				</div>
			</div>
			<div class="col-lg-7 col-xl-5">
				<div class="card rounded-3">
					<div class="card-body p-4 p-md-5">
						<h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Registro</h3>
						<?php  
					if (isset($errorMsg))
					{
				?>
				<div class="<?php echo $alert; ?>" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;
					</button><center>
					<?php echo $errorMsg;
					if (isset($boton)){
						echo "<br>" . $boton;
					}

					?>
					</center>
				</div>
			<?php } ?>
			<br>
						<form class="px-md-2" action="" method="POST" enctype="multipart/form-data">
					  		<div class="form-outline mb-4">
					  			<label for="name">Nombre completo:</label>
					  			<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe tu nombre completo" required/>
                    		</div>
                    		
                    		<div class="form-row">
                    			<div class="form-group col-md-6">
                    				<label for="email">Email:</label>
                    				<input type="email" id="email" name="email" class="form-control" placeholder="Escribe tu email" required/>
                    			</div>
                    			<div class="form-group col-md-6">
                    				<label for="password">Password:</label>
                    				<input type="password" id="password" name="password" class="form-control" placeholder="Escribe tu contraseña" required/>
                    			</div>
                    		</div>
                    		<div class="form-outline mb-2">
                    			<label for="telefono">Teléfono móvil:</label>
                    			<input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Escribe tu número de teléfono móvil" required/>
                    		</div>

                    		<div class="form-row">
                    			<div class="form-group col-md-6">
                    				<label for="edad">Edad:</label>
                    				<input type="number" min="18" max="70" name="edad" class="form-control" id="inputCity" placeholder="Escribe tu edad" required/>
                    			</div>
                    			<div class="form-group col-md-6">
                    				<label for="genero">Género:</label>
                    				<select name="genero" id="genero" class="form-control" required/>
                    					<option selected disabled value="">Seleccionar ...</option>
                    					<option>Femenino</option>
                    					<option>Masculino</option>
                    					<option>Otro</option>
                    				</select>
                    			</div>
                    		</div>
                    		<div class="form-outline mb-4">
                    			<label for="direccion">Dirección/Domicilio:</label>
                    			<textarea class="form-control" id="direccion" name="direccion" rows="3" placeholder="Escribe tu dirección completa (Colonia, calle, avenida, número, andador)" required/></textarea>
                    		</div>
                    		<div class="form-group">
                    			<label for="exampleForControlFile1">Foto de perfil</label>
                    			<input type="file" class="form-control-file" id="image" name="image" accept=".jpg, .jpeg, .png" onchange="validar()" required/>
                    		</div>
                    		<br>
                    		<br>
                    		<button type="submit" name="submit" class="btn btn-light btn-lg mb-1 btn-block" style="background-color: #032F92; color: #FFF;">Registrarte</button>
                    		<br>
                    		<p class="text-center">¿Ya estás registrado? <a href="login.php">¡Inicia sesión aquí!</a></p>
					  	</form>
					  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function validar(){
		var fileName = document.getElementById("image").value;
		var idxDot = fileName.lastIndexOf(".") + 1;
		var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
		if (extFile== "jpg" || extFile=="jpeg" || extFile=="png") {
		}else{
			alert("¡Solo se permiten archivos jpg/jpeg y png!");
		}
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>