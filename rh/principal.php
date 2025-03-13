<?php	
	session_start();
    include_once('../config.php');
    if(!isset($_SESSION['ID'])){
		header("Location: login.php");
	}
	
	$nombre = $_SESSION['NAME'];
	$tipo_usuario = $_SESSION['ROLE'];	
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>IPTE Soluciones | Administrador</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
		<!-- CDN FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
   #nav {
   background: #457fca;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #5691c8, #457fca);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #5691c8, #457fca); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
   }
</style>
	</head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark" id="nav">
            <a class="navbar-brand" href="principal.php">
    <img src="../img/logo.png" width="130" height="50" class="d-inline-block align-top" alt="IPTE">
  </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button
            >
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?php echo $nombre; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-fw"></i> Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="background-color: #e5e5e5;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="principal.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>Inicio</a>                         
                                <div class="sb-sidenav-menu-heading">Vacantes</div>
                                <a class="nav-link" href="vacantes.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase"></i></div>
                                    Vacantes&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id_vacante) as total FROM vacante WHERE activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                    <div class="sb-sidenav-menu-heading">Postulantes</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                    Primera etapa
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                                    ></a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="postulantes_pendientes.php">Pendientes&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante WHERE estatus='Pendiente' and activo = 1 and vacante.activo_vacante = 1";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                            <a class="nav-link" href="por_entrevistar.php">Por entrevistar&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante INNER JOIN entrevistas ON entrevistas.id_postulante = usuarios.id WHERE activo_entrevista=1 and (estatus='Entrevista reagendada' or estatus='Por entrevistar') and estatus_entrevista = 'Pendiente' and usuarios.activo = 1 and vacante.activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                    Segunda etapa
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                                    ></a>
                                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="segunda_etapa.php">Pendientes&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante WHERE vacante.activo_vacante=1 and estatus='Segunda etapa' and activo = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                            <a class="nav-link" href="por_entrevistar_etapa2.php">Por entrevistar&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante INNER JOIN entrevistas ON entrevistas.id_postulante = usuarios.id WHERE activo_entrevista = 1 and (estatus='Por entrevistar segunda etapa' or estatus = 'Entrevista reagendada segunda etapa') and estatus_entrevista = 'Pendiente segunda etapa' and usuarios.activo =1 and vacante.activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                        </nav>
                                    </div>
                                    <a class="nav-link" href="postulantes_contratados.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-check"></i></div>
                                    Contratados&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios WHERE estatus='Contratado'";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                    <a class="nav-link" href="no_contratados.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-xmark"></i></div>
                                    No contratados&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios WHERE estatus='No contratado' ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                    <div class="sb-sidenav-menu-heading">Entrevistas</div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                                    ><div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                                        Entrevistas
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                                        ></a>
                                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                                <a class="nav-link" href="calendario.php">Calendario</a>
                                                <a class="nav-link" href="entrevistas_pendientes.php">Pendientes &nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id_entrevista) as total FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante INNER JOIN entrevistas ON entrevistas.id_postulante = usuarios.id WHERE activo_entrevista=1 and (estatus_entrevista = 'Pendiente' or estatus_entrevista = 'Pendiente segunda etapa') and usuarios.activo = 1 and vacante.activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                                <a class="nav-link" href="entrevistas_canceladas.php">Canceladas
                                                    &nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id_entrevista) as total FROM entrevistas WHERE estatus_entrevista='Cancelada' ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>
                                                <a class="nav-link" href="entrevistas_realizadas.php">Realizadas
                                                &nbsp;&nbsp;
                                            <span class="badge badge-pill badge-info"><?php
                            $query = "SELECT COUNT(id_entrevista) as total FROM entrevistas WHERE estatus_entrevista='Realizada' ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></a>    
                                            </nav>
                                        </div>
                            <div class="sb-sidenav-menu-heading">GRÁFICAS</div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Contrataciones</a>
                                <a class="nav-link" href="charts1.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Postulaciones</a>
                                <a class="nav-link" href="charts2.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Entrevistas</a>
                            </div>
                    </div>
                    <div class="sb-sidenav-footer" style="background-color: #0E3E6B;color:#fff;">
                        <div class="small" style="color:#fff;">Conectado como:</div>
                        <?php echo $nombre; ?>
                    </div>
                </nav>
      </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Contratación de empleados</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Recursos humanos</li>
						</ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-briefcase"></i> Vacantes&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-light"><?php
                            $query = "SELECT COUNT(id_vacante) as total FROM vacante WHERE activo_vacante = 1 ";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="vacantes.php">Ver detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-user-tie"></i> Postulantes&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-light"><?php
                            $query = "SELECT COUNT(id) as total FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante WHERE estatus='Pendiente' and activo = 1 and vacante.activo_vacante = 1";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="postulantes_pendientes.php">Ver detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-calendar-days"></i> Entrevistas&nbsp;&nbsp;
                                            <span class="badge badge-pill badge-light"><?php
                            $query = "SELECT COUNT(id_entrevista) as total FROM entrevistas WHERE activo_entrevista = 1 and estatus_entrevista='Pendiente' or estatus_entrevista='Pendiente segunda etapa'";
                            $result = $con -> query($query);
                            $row = $result->fetch_assoc();
                            echo "" . $row['total'] . "";
                        ?></span></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="calendario.php">Ver detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-chart-simple"></i> Gráficas</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="charts.php">Ver detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
						</div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fa-solid fa-briefcase"></i> Postulaciones</div>
                            <div class="card-body">
                                <div class="row row-cols-1 row-cols-md-3">
      <?php
      $sql = "SELECT vacante.*, IFNULL(total_postulaciones, 0) as total_postulaciones 
      FROM vacante
      LEFT JOIN (SELECT id_vacante, COUNT(id_vacante) as total_postulaciones FROM usuarios WHERE usuarios.activo = 1 and estatus='Pendiente' GROUP BY id_vacante) usuarios ON vacante.id_vacante = usuarios.id_vacante WHERE vacante.activo_vacante = 1 ";

               $result = $con -> query($sql);

               if($result ->num_rows > 0){
                  while($row = $result ->fetch_assoc()) { ?>
                           <div class="col mb-4">
                        <div class="card h-100 shadow p-3 mb-0 bg-white rounded" style="border: none;">
                           
                        <div class="card-body">
                           <h5 class="text-uppercase"><center><?php echo $row['puesto_vacante'] ?></h5></center>
                           <br>
                           <h4 class="text-danger"><center><span class="badge badge-danger"><?php echo $row['total_postulaciones'] ?></span></h4></center>
                           <br>
                           <?php 
                            if ($row['total_postulaciones'] > 0){
                           ?>
                           <div class="container-fluid text-center">
                              <a href="ver_postulantes.php?id=<?php echo $row['id_vacante'] ?>" class="btn btn-outline-info" role="button"><i class="fa-solid fa-users"></i> Ver postulantes</a> 
                           </div> <?php } else { ?>
                            <div class="container-fluid text-center">
                              <button class="btn btn-outline-info" role="button"><i class="fa-solid fa-users"></i> Sin postulantes</button> 
                           </div> <?php } ?>
                           </div>
                           </div>
                           </div>
                        <?php }
                     }else{ ?>
                        </div>
    <div class="card text-center shadow p-3 mb-5 bg-white rounded">
  <div class="card-body">
    <h5 class="card-title">No existe ninguna postulación</h5>
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
					</div>
				</main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; IPTE Soluciones 2023</div>
                            <div>
                                <a href="politica.php">Política de privacidad</a>
                                &middot;
                                <a href="politica.php">Términos y condiciones</a>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
	</body>
</html>