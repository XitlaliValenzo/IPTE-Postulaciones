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
     <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<title>Documentación</title>
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
         <li class="nav-item active ml-5 mr-5">
         <a class="nav-link" href="contrataciones.php"><i class="fa-solid fa-user-tie"></i> <span class="sr-only">(current)</span> Contrataciones&nbsp;&nbsp;<span class="badge badge-pill badge-info"><?php
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
		<center><h2>Subir documentos</h2></center>
   <br>
   <div class="text-center">
  <img src="img/archivo.png" class="rounded mx-auto d-block" alt="tarjeta" style="width: 100px; height: 100px;"></div>
   </div>
   <div class="container">
   <div class="jumbotron" style="background-color: #FFF;">
   <div class="row row-cols-1 row-cols-md-1 justify-content-center">
                        <div class="card mb-4" style="border: none;">
                            <h3 class="card-title text-center">Sube en formato .pdf los siguientes archivos</h3>
                            <br>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Subir</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Subir</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                          <?php
          $id = $_SESSION['ID'];
          $sql = "SELECT * FROM contratacion WHERE id_postulante = $id";
          $result = $con -> query($sql);
          if($result ->num_rows > 0){
            while($row = $result ->fetch_assoc()) { ?>
              <tr>
                  <td>
                    <?php
                    if (empty($row['acta_nacimiento'])) { ?>
                      <form action="php_action/subir_acta.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="acta_nacimiento">Acta de nacimiento</label>
                          <input type="file" class="form-control-file" id="archivo" name="acta_nacimiento" accept=".pdf" onchange="validar()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        Acta de nacimiento
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['acta_nacimiento'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <tr>
                  <td>
                    <?php
                    if (empty($row['curp'])) { ?>
                      <form action="php_action/subir_curp.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="curp">CURP</label>
                          <input type="file" class="form-control-file" id="archivo1" name="curp" accept=".pdf" onchange="validar1()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        CURP
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['curp'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <tr>
                  <td>
                    <?php
                    if (empty($row['com_domicilio'])) { ?>
                      <form action="php_action/subir_domicilio.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="com_domicilio">Comprobante de domicilio</label>
                          <input type="file" class="form-control-file" id="archivo2" name="com_domicilio" accept=".pdf" onchange="validar2()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        Comprobante de domicilio
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['com_domicilio'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <td>
                    <?php
                    if (empty($row['ine'])) { ?>
                      <form action="php_action/subir_ine.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="ine">INE</label>
                          <input type="file" class="form-control-file" id="archivo7" name="ine" accept=".pdf" onchange="validar7()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        INE
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['ine'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <tr>
                  <td>
                    <?php
                    if (empty($row['nss'])) { ?>
                      <form action="php_action/subir_nss.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="nss">Número de Seguridad Social</label>
                          <input type="file" class="form-control-file" id="archivo3" name="nss" accept=".pdf" onchange="validar3()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        Número de Seguridad social
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['nss'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <tr>
                  <td>
                    <?php
                    if (empty($row['fiscal_sat'])) { ?>
                      <form action="php_action/subir_sat.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="fiscal_sat">Constancia de Situación Fiscal</label>
                          <input type="file" class="form-control-file" id="archivo4" name="fiscal_sat" accept=".pdf" onchange="validar4()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        Constancia de Situación Fiscal
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['fiscal_sat'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <tr>
                  <td>
                    <?php
                    if (empty($row['titulo'])) { ?>
                      <form action="php_action/subir_titulo.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="titulo">Título</label>
                          <input type="file" class="form-control-file" id="archivo5" name="titulo" accept=".pdf" onchange="validar5()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        Título
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['titulo'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>

              <tr>
                  <td>
                    <?php
                    if (empty($row['cedula'])) { ?>
                      <form action="php_action/subir_cedula.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="cedula">Cédula</label>
                          <input type="file" class="form-control-file" id="archivo6" name="cedula" accept=".pdf" onchange="validar6()" />
                      </div>
                      <input type="hidden" name="id_usuario" value="<?php echo $row['id_postulante']?>"/>
                    <?php } else { ?>
                        Cédula
                    <?php }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (empty($row['cedula'])){ ?>
                      <br>
                      <div class="container-fluid text-center">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir archivo</button>
                      </div>
                    </form>
                    <?php } else { ?>
                      <h6 class="text-success"><i class="fa-solid fa-circle-check"></i> ¡Archivo registrado correctamente!</h6>
                    <?php }
                    ?>
                  </td>
              </tr>
            <?php }
          } else{
            echo "<tr> <td colspan='9'> <center>No existen vacantes registradas</center></td></tr>";
          }
        ?>
                                                           
                    </tbody>
                  </table>
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
    var fileName = document.getElementById("archivo").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar1(){
    var fileName = document.getElementById("archivo1").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar2(){
    var fileName = document.getElementById("archivo2").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar3(){
    var fileName = document.getElementById("archivo3").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar4(){
    var fileName = document.getElementById("archivo4").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar5(){
    var fileName = document.getElementById("archivo5").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar6(){
    var fileName = document.getElementById("archivo6").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }

  function validar7(){
    var fileName = document.getElementById("archivo7").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile== "pdf") {
    }else{
      alert("¡Solo se permiten archivos pdf!");
    }
  }
</script>
	<!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
</body>
</html>