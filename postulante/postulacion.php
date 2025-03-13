<?php
  session_start();
  //incluimos la conexion a la BD
  include_once('../config.php');

  if (!isset($_SESSION['ID'])){
   header("Location: ../login.php");
   exit();
  }
?>
<?php

  if($_GET['id']){
    $id_vacante = $_GET['id'];

    $sql = "SELECT * FROM vacante WHERE id_vacante = {$id_vacante}";
    $result = $con ->query($sql);

    $data = $result->fetch_assoc();

   

    $id_usuario = $_SESSION['ID'];
    $query = "SELECT * FROM usuarios WHERE id='$id_usuario' ";
    $resultado = $con ->query($query);

  if($resultado = $con->query($query)){
    $row2 = $resultado->fetch_assoc();
  } else {
   printf("Error: %s\n", $con->error);
 }

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<!-- CDN FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Postulación</title>
  <style>
   #nav {
   background: #457fca;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #5691c8, #457fca);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #5691c8, #457fca); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
   }
</style>
</head>
<body>
  <div class="sticky-top">
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark" id="nav">
    <a class="navbar-brand" href="home.php">
    <img src="../img/logo.png" width="130" height="55" class="d-inline-block align-top" alt="IPTE">
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown mr-3">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i> <?php echo ucwords($_SESSION['NAME']); ?> 
          </a>
         <div class="dropdown-menu">
            <a class="dropdown-item" href="profile.php"><i class="fa-solid fa-user"></i> Perfil</a>
            <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f1faee;color:#7CE2FC">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-auto">
      <li class="nav-item active ml-5 mr-5">
          <a class="nav-link" href="home.php"><i class="fa-solid fa-house"></i> <span class="sr-only">(current)</span>Inicio
          &nbsp;&nbsp;<span class="badge badge-pill badge-info"><?php
                      $query = "SELECT COUNT(id_vacante) as total FROM vacante WHERE activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a></a>
        </li>
         <li class="nav-item ml-5 mr-5">
         <a class="nav-link" href="estatus.php"><i class="fa-solid fa-briefcase"></i> Estatus</a>
         </li>
         <li class="nav-item ml-5 mr-5">
         <a class="nav-link" href="entrevistas.php"><i class="fa-solid fa-calendar"></i> Entrevistas
         &nbsp;&nbsp;<span class="badge badge-pill badge-info"><?php
         $id = $_SESSION['ID'];
                      $query = "SELECT COUNT(id_entrevista) as total FROM entrevistas WHERE activo_entrevista = 1 and (estatus_entrevista = 'Pendiente' or estatus_entrevista = 'Pendiente segunda etapa') and id_postulante='$id' ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
         </li>
         <li class="nav-item ml-5 mr-5">
         <a class="nav-link" href="contrataciones.php"><i class="fa-solid fa-user-tie"></i> Contrataciones&nbsp;&nbsp;<span class="badge badge-pill badge-info"><?php
         $id = $_SESSION['ID'];
                      $query = "SELECT COUNT(id) as total FROM contratacion WHERE id_postulante='$id' ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a></a>
         </li>
         <li class="nav-item ml-5 mr-5">
         <a class="nav-link" href="contacto.php"><i class="fa-solid fa-address-card"></i> Contacto</a>
         </li>
    </ul>
  </div>
</nav>
</div>
	<div class="jumbotron">
	    <br>
		<center><h2>Postulación para <?php echo $data['puesto_vacante']?></h2>
      <br>
    <img src="img/vacantes.png" class="rounded mx-auto d-block" alt="comida" style="width: 100px; height: 100px;"></center>
   </div>
   
   <div class="container">
    <div class="jumbotron" style="background-color: white;">
      <div class="row row-cols-1 row-cols-md-2 d-flex justify-content-center">
            <div class="col mb-4">
                <div class="card shadow p-3 mb-5 bg-white rounded" style="border: none">
                <div class="card-body">
                    <h3 class="card-title text-center">Ingresa los siguientes datos</h3>
                    <br>
                    <form action="php_action/realizar_postulacion.php" method="POST" enctype="multipart/form-data">
                      
            <div class="form-group">
              <label for="nombre" class="disabledTextInput">Nombre completo</label>
              <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $row2['nombre']?>" required/>
            </div>
            <div class="form-group">
              <label for="edad">Edad</label>
              <input type="number" min="18" max="70" name="edad" class="form-control" id="edad" value="<?php echo $row2['edad']?>" required/>
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input class="form-control" type="tel" name="telefono" id="telefono" value="<?php echo $row2['telefono']; ?>"/>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="email" name="email" id="email" value="<?php echo $row2['email']; ?>"/>
            </div>
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <textarea class="form-control" name="direccion" id="direccion" value="<?php echo $row2['edad']?>" rows="3"><?php echo $row2['direccion']?></textarea>
            </div>
                            <?php 
                              if ($data['modalidad_entrevista'] == 'Presencial y online'){ ?>
                                <div class="form-group">
                                <label for="entrevista">En caso de una entrevista en <?php echo $data['ubicacion_vacante'] ?> selecciona una modalidad</label>
                            <select name="entrevista" id="entrevista" class="form-control">
                                <option value="#">Seleccionar...</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>

                              <?php } else { ?>
                                <div class="form-group">
              <label for="entrevista" class="disabledTextInput">Modalidad de entrevista</label>
              <input class="form-control" type="text" name="entrevista" id="entrevista" value="<?php echo $data['modalidad_entrevista'] ?>" disabled/>
              <input type="hidden" name="entrevista" value="<?php echo $data['modalidad_entrevista'] ?>"/>
            </div>

                              <?php }

                            ?>
                          
            <div class="form-group">
                          <label for="exampleForControlFile1">Currículum</label>
                          <input type="file" class="form-control-file" id="curriculum" name="curriculum" accept=".pdf" onchange="validar()" required/>
                        </div>
                        
                            <br>
                            <br>
                            <input type="hidden" name="id_vacante" value="<?php echo $data['id_vacante']?>"/>
                            <input type="hidden" name="id_usuario" value="<?php echo $row2['id']?>"/>
                            <div class="container-fluid text-center">
              <a href="home.php" class="btn btn-danger" role="button">Atrás</a>
              <button type="reset" class="btn btn-primary">Borrar</button>
              <button type="submit" class="btn btn-success">Enviar postulación</button>
                        <br>
                        <br>
                         
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
    <footer class="page-footer font-small" style="background-color: #0E3E6B; ">
      <div class="footer-copyright text-center py-3 text-dark" style="font-size: 20px">
       <p style="color: white;"><a href="https://www.iptesoluciones.com/" style="color: #fff;">IPTE Soluciones &copy; 2023</a></p>
       <p style="color: white;">Información de contacto: <a style="color: white;" href="mailto: ioregon@ipte.com.mx">Gerente de Gestión de Capital Humano</a></p>
      </div>
    </footer>
    <script type="text/javascript">
  function validar(){
    var fileName = document.getElementById("curriculum").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf" ) {
    }else{
      alert("¡Solo se permiten archivos pdf, vuelve a intentarlo!");
    }
  }
</script>
	<!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
<?php
  }
?>