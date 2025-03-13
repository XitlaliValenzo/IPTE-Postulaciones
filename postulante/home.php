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
  if (isset($_POST['submit'])){
    $id_usuario = $_SESSION['ID'];
    $aviso="";
    $checkVacante = "SELECT * FROM usuarios, vacante WHERE usuarios.id_vacante = vacante.id_vacante and id = '$id_usuario'";
    $result_v = $con-> query($checkVacante);
    $row_v = $result_v->fetch_assoc();
        if(isset($row_v['id_vacante'])){
            $aviso = "Ya te has postulado para la vacante de ".$row_v['puesto_vacante']."";
        } else {
          $id_vacante = $_POST['id_vacante'];
          header("Location: postulacion.php?id=".$id_vacante."");
        }
} ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<!-- CDN FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>IPTE Soluciones</title>
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
      <form class="form-inline my-2 my-lg-0" action="" method="GET">
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar vacante" name="busqueda">
      <button class="btn btn-success my-2 my-sm-0" type="submit" name="enviar"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
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
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/img1.jpg" class="d-block w-100" alt="img1" style=" filter:brightness(0.5);">
      <div class="carousel-caption d-none d-md-block">
        <h1>¡Bienvenido!</h1>
        <p class="lead"><b><?php echo ucwords($_SESSION['NAME']); ?></b></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/img2.jpg" class="d-block w-100" alt="img2" style=" filter:brightness(0.5);">
      <div class="carousel-caption d-none d-md-block">
        <h1>Vacantes de empleo</h1>
        <p class="lead"><b>Conoce nuestras vacantes de empleo</b></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/img3.jpg" class="d-block w-100" alt="img3" style=" filter:brightness(0.5);">
      <div class="carousel-caption d-none d-md-block">
        <h1>Postúlate</h1>
        <p class="lead"><b>Forma parte de la familia IPTE</b></p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>
	<div class="jumbotron">
	    <br>
		<center><h2>Nuestras vacantes</h2></center>
   <br>
 </div>
   <?php  
          if (isset($aviso)){
        ?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">IPTE SOLUCIONES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-danger">
        <i class="fa-solid fa-bullhorn fa-beat"></i> &nbsp;&nbsp;
        <?php echo $aviso ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa-solid fa-circle-check"></i> Aceptar</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
   <div class="d-flex justify-content-center row row-cols-1 row-cols-md-2">
   <?php
          if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];
            if (!empty($busqueda)) {
            $consulta = $con->query("SELECT * FROM vacante WHERE activo_vacante = 1 and puesto_vacante LIKE '%".$busqueda."%'");
            $num=0;
            if ($consulta->num_rows == 0) {
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
  No se encontraron resultados para la búsqueda: <strong>" . $busqueda. "</strong>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";

            }else{
            while ($row = $consulta -> fetch_array()) { 
              $num++;
              ?>
              <div class='col mb-4'>
                            <div class="accordion" id="accordionExample">
                        <div class='card h-100 shadow p-4 mb-5 bg-white rounded'>
                           
                        <div class='card-body'>
                           <h3 class='text-uppercase text-primary'><center><?php echo $row['puesto_vacante'] ?></h3></center>
                           <br>
                           <br>
                           <h5><i class="fa-solid fa-briefcase"></i> Descripción</h5>
                           <p><?php echo $row['descripcion_vacante'] ?></p>
                           <p>
                           <a class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $num ?>" aria-expanded="true" aria-controls="collapseOne">Ver más detalles</a>
                           </p>
                           <div id="collapse<?php echo $num ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                           <h5><i class="fa-solid fa-user-tie"></i> Perfil</h5>
                           <p><?php echo $row['perfil_vacante'] ?></p>
                           <h5><i class="fa-solid fa-money-check-dollar"></i> Sueldo </h5>
                           <p>$ <?php echo $row['sueldo_vacante'] ?></p>
                           <h5><i class="fa-solid fa-computer"></i> Modalidad</h5>
                           <p><?php echo $row['modalidad_vacante'] ?></p>
                           <h5><i class="fa-solid fa-building"></i> Ubicación</h5>
                           <p><?php echo $row['ubicacion_vacante'] ?></p>
                           <h5><i class="fa-solid fa-handshake"></i> Ofrecemos</h5>
                           <p><?php echo $row['comentarios_vacante'] ?></p>
                           </div>
                           <form action="" method="POST">
                           <div class="container-fluid text-center">
                              <input class="btn btn-success" role="button" type="submit" name="submit" value="¡Postularme!"> </input>
                              <input type="hidden" name="id_vacante" value="<?php echo $row['id_vacante']?>"/>
                           </div>
                           </form>

                           </div>
                           </div>
                           </div>
                         </div>


                        <?php } }
                     } }
                     ?>
                   </div>
                   </div>
   <div class="jumbotron" style="background-color: #FFF;">
   <div class="row row-cols-1 row-cols-md-2">
    <?php
      $sql = "SELECT * FROM vacante WHERE activo_vacante = 1 ";
               $result = $con -> query($sql);
               if($result ->num_rows > 0){
                $i=1;
                  while($row = $result ->fetch_assoc()) { 
                    $i++;
                    ?>
                    
                           <div class='col mb-4'>
                            <div class="accordion" id="accordionExample">
                        <div class='card h-100 shadow p-4 mb-5 bg-white rounded'>
                           
                        <div class='card-body'>
                           <h3 class='text-uppercase text-primary'><center><?php echo $row['puesto_vacante'] ?></h3></center>
                           <br>
                           <br>
                           <h5> Publicación</h5>
                           <p><?php setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                    echo strftime("%d de %B de %Y", strtotime($row['fecha_vacante'])); ?></p>
                           <h5><i class="fa-solid fa-briefcase"></i> Descripción</h5>
                           <p><?php echo $row['descripcion_vacante'] ?></p>
                           <p>
                           <a class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="true" aria-controls="collapseOne">Ver más detalles</a>
                           </p>
                           <div id="collapse<?php echo $i ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                           <h5><i class="fa-solid fa-user-tie"></i> Perfil</h5>
                           <p><?php echo $row['perfil_vacante'] ?></p>
                           <h5><i class="fa-solid fa-money-check-dollar"></i> Sueldo </h5>
                           <p>$ <?php echo $row['sueldo_vacante'] ?></p>
                           <h5><i class="fa-solid fa-computer"></i> Modalidad</h5>
                           <p><?php echo $row['modalidad_vacante'] ?></p>
                           <h5><i class="fa-solid fa-building"></i> Ubicación</h5>
                           <p><?php echo $row['ubicacion_vacante'] ?></p>
                           <h5><i class="fa-solid fa-handshake"></i> Ofrecemos</h5>
                           <p><?php echo $row['comentarios_vacante'] ?></p>
                           </div>
                           <form action="" method="POST">
                           <div class="container-fluid text-center">
                              <input class="btn btn-success" role="button" type="submit" name="submit" value="¡Postularme!"> </input>
                              <input type="hidden" name="id_vacante" value="<?php echo $row['id_vacante']?>"/>
                           </div>
                           </form>

                           </div>
                           </div>
                           </div>
                         </div>
                        <?php }
                     }else{ ?>
                        </div>
    <div class="card text-center shadow p-3 mb-5 bg-white rounded">
  <div class="card-body">
    <h5 class="card-title">No existe ninguna vacante publicada</h5>
  </div>
</div>   
<br>
<br>
<br>
<br>
                     <?php }
                     ?>
  </div>
</div>
   <br>
    <footer class="page-footer font-small" style="background-color: #0E3E6B; ">
      <div class="footer-copyright text-center py-3 text-dark" style="font-size: 20px">
       <p style="color: white;"><a href="https://www.iptesoluciones.com/" style="color: #fff;">IPTE Soluciones &copy; 2023</a></p>
       <p style="color: white;">Información de contacto: <a style="color: white;" href="mailto: ioregon@ipte.com.mx">Gerente de Gestión de Capital Humano</a></p>
      </div>
    </footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
  $(document).ready(function(){
    $("#staticBackdrop").modal('show');
  });
</script>
	<!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>