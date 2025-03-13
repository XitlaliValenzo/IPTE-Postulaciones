<?php
  session_start();
  //incluimos la conexion a la BD
  include_once('../config.php');

  if (!isset($_SESSION['ID'])){
   header("Location: ../login.php");
   exit();
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
	<title>Mi estatus</title>
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
      <li class="nav-item ml-5 mr-5">
          <a class="nav-link" href="home.php"><i class="fa-solid fa-house"></i> Inicio
          &nbsp;&nbsp;<span class="badge badge-pill badge-info"><?php
                      $query = "SELECT COUNT(id_vacante) as total FROM vacante WHERE activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a></a>
        </li>
         <li class="nav-item active ml-5 mr-5">
         <a class="nav-link" href="estatus.php"><i class="fa-solid fa-briefcase"></i> <span class="sr-only">(current)</span>Estatus</a>
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
		<center><h2>Mi estatus</h2></center>
   <br>
   <div class="text-center">
  
  <img src="img/estatus.png" class="rounded mx-auto d-block" alt="tarjeta" style="width: 100px; height: 100px;"></div>
   </div>
   
   <div class="jumbotron" style="background-color: #FFF;">
   <div class="row row-cols-1 row-cols-md-2 justify-content-center">
    <?php
    $id = $_SESSION['ID'];

      $sql = "SELECT * FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante WHERE usuarios.estatus IS NOT NULL and usuarios.id = '$id' ";
               $result = $con -> query($sql);
               if($result ->num_rows > 0){
                  while($row = $result ->fetch_assoc()) { 
                    ?>
                           <div class='col mb-4'>
                        <div class='card h-100 shadow p-4 mb-5 bg-white rounded'>
                           
                        <div class='card-body'>
                           <h4 class='text-uppercase text-primary'><center>Postulación para <?php echo $row['puesto_vacante'] ?></h3></center>
                           <br>
                           <br>
                           <h6 style="color: #0e3e6b;"><i class="fa-solid fa-briefcase"></i> Descripción</h5>
                           <p><?php echo $row['descripcion_vacante'] ?></p>
                           <h6 style="color: #0e3e6b;"><i class="fa-solid fa-calendar"></i> Fecha de postulación</h6>
                           <p><?php 
                           setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                           echo strftime("%d de %B de %Y", strtotime($row['fecha_postulacion']));
                           ?></p>
                           <?php if ($row['estatus'] == 'Contratado'){ 
                            $sql2 = "SELECT * FROM contratacion WHERE id_postulante = '$id'";
                                  $result2 = $con->query($sql2);
                                  $row2 = $result2->fetch_assoc();?>
                                  <h6 style="color: #0e3e6b;"><i class="fa-solid fa-calendar"></i> Fecha de contratación</h6>
                           <p><?php 
                           setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                           echo strftime("%d de %B de %Y", strtotime($row2['fecha_contratacion']));
                           ?></p>
                           <?php }
                           ?>
                           <h6 style="color: #0e3e6b;"><i class="fa-solid fa-bullhorn"></i> Estatus</h5>
                           <?php
                                if ($row['estatus'] == 'Pendiente'){ ?>
                                  <p>Tu solicitud para la vacante ha sido enviada.
                                  <br>Pronto recibirás una respuesta.</p>
                                  <br>
                                  <div class="container-fluid text-center">
                              <a href="cancelar_postulacion.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button"><i class="fa-solid fa-circle-xmark"></i> Cancelar postulación</a>
                           </div>

                                <?php } else if ($row['estatus'] == 'Por entrevistar'){ 
                                  $sql2 = "SELECT * FROM entrevistas WHERE estatus_entrevista = 'Pendiente' and id_postulante = '$id'";
                                  $result2 = $con->query($sql2);
                                  $row2 = $result2->fetch_assoc(); ?>
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="background-color: #C7EAF2">Tienes una entrevista</li>
                                    <li class="list-group-item">Fecha: <?php echo strftime("%d de %B de %Y", strtotime($row2['fecha_entrevista'])); ?></li>
                                    <li class="list-group-item">Hora: <?php echo date('h:i a', strtotime($row2['hora_entrevista'])); ?></li>
                                    <li class="list-group-item">Modalidad: <?php echo $row2['modalidad_entrevista'] ?></li>

                                  <?php if ($row2['modalidad_entrevista'] == 'Presencial'){ ?>
                                    <li class="list-group-item">Dirección: <?php echo $row2['ubicacion_entrevista'] ?></li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } else { ?>
                                    
                                    <li class="list-group-item">Link de Teams: <a target="_blank" href="<?php echo $row2['link_teams'] ?>"><?php echo $row2['link_teams'] ?></a> </li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } ?>

                                <?php } else if ($row['estatus'] == 'Segunda etapa'){ ?>
                                  <h5 class="text-danger">Segunda etapa</h5>
                                  <p>Has pasado a la segunda etapa de postulación para la vacante.
                                  <br>Pronto recibirás la asignación para tu segunda entrevista.</p>

                                <?php } else if ($row['estatus'] == 'Por entrevistar segunda etapa'){ 
                                  $sql2 = "SELECT * FROM entrevistas WHERE estatus_entrevista = 'Pendiente segunda etapa' and id_postulante = '$id'";
                                  $result2 = $con->query($sql2);
                                  $row2 = $result2->fetch_assoc(); ?>
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="background-color: #C7EAF2">Tienes una entrevista (Segunda etapa)</li>
                                    <li class="list-group-item">Fecha: <?php echo strftime("%d de %B de %Y", strtotime($row2['fecha_entrevista'])); ?></li>
                                    <li class="list-group-item">Hora: <?php echo date('h:i a', strtotime($row2['hora_entrevista'])); ?></li>
                                    <li class="list-group-item">Modalidad: <?php echo $row2['modalidad_entrevista'] ?></li>

                                  <?php if ($row2['modalidad_entrevista'] == 'Presencial'){ ?>
                                    <li class="list-group-item">Dirección: <?php echo $row2['ubicacion_entrevista'] ?></li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } else { ?>
                                    <li class="list-group-item">Link de Teams: <a target="_blank" href="<?php echo $row2['link_teams'] ?>"><?php echo $row2['link_teams'] ?></a> </li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } ?>

                                <?php } else if ($row['estatus'] == 'Entrevista cancelada'){
                                  $sql2 = "SELECT * FROM entrevistas WHERE estatus_entrevista = 'Cancelada' and id_postulante = '$id'";
                                  $result2 = $con->query($sql2);
                                  $row2 = $result2->fetch_assoc(); ?>
                                  <h5 class="text-danger">Tu entrevista ha sido cancelada</h5>
                                  <ul>
                                    <li>Motivo: <?php echo $row2['cancelacion_entrevista'] ?> </li>
                                  </ul>
                                  
                                <?php } else if ($row['estatus'] == 'No contratado'){ ?>
                                  <h5 class="text-danger text-center">No has sido contratado</h5>
                                  <div class="text-center">
                                    <img src="img/no_contratado.png" class="rounded mx-auto d-block" alt="tarjeta" style="width: 100px; height: 100px;"></div>
                                  <p class="text-center lead">¡Te agradecemos!</p>

                                <?php } else if ($row['estatus'] == 'Contratado'){ ?>
                                  
                                  <h5 class="text-success text-center">¡Felicidades! Has sido contratado</h5>
                                  <div class="text-center">
                                    <img src="img/no_contratado.png" class="rounded mx-auto d-block" alt="tarjeta" style="width: 100px; height: 100px;"></div>
                                    <p class="text-center lead">Ahora eres parte de la familia IPTE</p>

                                <?php } else if ($row['estatus'] == 'Solicitud rechazada') { ?>
                                  <h5 class="text-danger text-center">Tu solicitud ha sido rechazada</h5>
                                  <div class="text-center">
                                    <img src="img/no_contratado.png" class="rounded mx-auto d-block" alt="tarjeta" style="width: 100px; height: 100px;"></div>
                                  <p class="text-center lead">¡Agradecemos tu postulación!</p>


                                <?php } else if ($row['estatus'] == 'Entrevista reagendada') {
                                  $sql2 = "SELECT * FROM entrevistas WHERE estatus_entrevista = 'Pendiente' or estatus_entrevista = 'Pendiente segunda etapa' and id_postulante = '$id'";
                                  $result2 = $con->query($sql2);
                                  $row2 = $result2->fetch_assoc(); ?>
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="background-color: #C7EAF2">Tu entrevista ha sido reagendada</li>
                                    <li class="list-group-item">Fecha: <?php echo strftime("%d de %B de %Y", strtotime($row2['fecha_entrevista'])); ?></li>
                                    <li class="list-group-item">Hora: <?php echo date('h:i a', strtotime($row2['hora_entrevista'])); ?></li>
                                    <li class="list-group-item">Modalidad: <?php echo $row2['modalidad_entrevista'] ?></li>

                                  <?php if ($row2['modalidad_entrevista'] == 'Presencial'){ ?>
                                    <li class="list-group-item">Dirección: <?php echo $row2['ubicacion_entrevista'] ?></li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } else { ?>
                                    <li class="list-group-item">Link de Teams: <a target="_blank" href="<?php echo $row2['link_teams'] ?>"><?php echo $row2['link_teams'] ?></a> </li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } ?>

                                <?php } else if ($row['estatus'] == 'Entrevista reagendada segunda etapa') {
                                  $sql2 = "SELECT * FROM entrevistas WHERE estatus_entrevista = 'Pendiente' or estatus_entrevista = 'Pendiente segunda etapa' and id_postulante = '$id'";
                                  $result2 = $con->query($sql2);
                                  $row2 = $result2->fetch_assoc(); ?>
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="background-color: #C7EAF2">Tu entrevista ha sido reagendada</li>
                                    <li class="list-group-item">Fecha: <?php echo strftime("%d de %B de %Y", strtotime($row2['fecha_entrevista'])); ?></li>
                                    <li class="list-group-item">Hora: <?php echo date('h:i a', strtotime($row2['hora_entrevista'])); ?></li>
                                    <li class="list-group-item">Modalidad: <?php echo $row2['modalidad_entrevista'] ?></li>

                                  <?php if ($row2['modalidad_entrevista'] == 'Presencial'){ ?>
                                    <li class="list-group-item">Dirección: <?php echo $row2['ubicacion_entrevista'] ?></li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php } else { ?>
                                    <li class="list-group-item">Link de Teams: <a target="_blank" href="<?php echo $row2['link_teams'] ?>"><?php echo $row2['link_teams'] ?></a> </li>
                                  </ul>
                                  <br>
                                  <div class="container-fluid text-center">
                                    <form action="php_action/confirmar_asistencia.php" method="POST">
                                      <input type="hidden" name="id_entrevista" value="<?php echo $row2['id_entrevista']?>"/>
                                      <button type="submit" class="btn btn-success" role="button"><i class="fa-solid fa-circle-check"></i> Confirmar asistencia</button>
                                    </form>
                                  </div>

                                  <?php }

                                }?>
                           </div>
                           </div>
                           </div>
                         </div>
                        <?php }
                     }else{ ?>
                        </div>
    <div class="card text-center shadow p-3 mb-5 bg-white rounded">
  <div class="card-body">
    <h5 class="card-title">Aún no has realizado ninguna postulación</h5>
  </div>
</div>   
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
	<!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>