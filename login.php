<?php 
    session_start();
    if(isset($_SESSION['ID'])){
    	if ($_SESSION['ROLE'] == 'administrador') {
    		//header("Location: administrador/pedidos.php");
    		header("Location: rh/principal.php");
    		exit();
    	}
    	if ($_SESSION['ROLE'] == 'postulante') {
    		header("Location: postulante/home.php");
    		exit();
    	}

    	
    } 

	//Incluimos el archivo de conexion a la bd.
	include_once('config.php');

	if (isset($_POST['submit'])) {
		$errorMsg = "";
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		if (!empty($email) || !empty($password)){
        $query = "SELECT * FROM usuarios where email='$email' and password='$password' and activo = 1";
		$result = $con->query($query);

		    if ($result->num_rows > 0) {
			    $row = $result->fetch_assoc();
			    $_SESSION['ID'] = $row['id'];
			    $_SESSION['ROLE'] = $row['role'];
			    $_SESSION['NAME'] = $row['nombre'];
			    
			    if ($_SESSION['ROLE'] == 'administrador') {
			    	header("Location: rh/principal.php");
			    	die();
			    }
			    if ($_SESSION['ROLE'] == 'postulante') {
			    	header("Location: postulante/home.php");
			    	die();
			    }
		    } else {
		    	$errorMsg = "Su email no se encuentra en nuestro sistema.";
		    }
	    } else{
	    	$errorMsg= "El email y password son obligatorias.";
	    }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>IPTE Soluciones</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="css/estilo.css">
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
					  	<h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Iniciar sesión</h3>
					  	<?php  
					if (isset($errorMsg))
					{
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;
					</button>
					<?php echo $errorMsg; ?>
				</div>
			<?php } ?>
			<br>
					  	<form class="px-md-2" action="" method="POST">
					  		<div class="form-outline mb-4">
					<label for="email"><i class="fa-solid fa-user"></i>  Email</label>
					<input type="email" class="form-control" name="email" id="email" placeholder="Escribe tu email">
				</div>
				<div class="form-outline mb-4">
					<label for="password"><i class="fa-solid fa-lock"></i> Password</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Escribe tu contraseña">
				</div>
				<br>
					<input type="submit" name="submit" class="btn btn-light btn-lg mb-1 btn-block" style="background-color: #032F92; color: #FFF;" value="Iniciar sesión">
					<br>
					
					<p class="text-center">¿No estás registrado? <a href="register.php">¡Registrate ahora!</a></p>
					  	</form>
					  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>