<?php ob_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Currículum</title>
</head>
<body>
 <?php

 include_once('../config.php');
          $sql = "SELECT * FROM usuarios INNER JOIN vacante ON usuarios.id_vacante = vacante.id_vacante WHERE activo = 1 and estatus = 'Pendiente' or estatus ='Por entrevistar' or estatus='Segunda etapa' or estatus='Por entrevistar segunda etapa' or estatus='Entrevista reagendada segunda etapa' or estatus='Entrevista reagendada' or estatus='Contratado' or estatus='No contratado' and id=".$_GET['id'];
          $result = $con -> query($sql);

          if($result ->num_rows > 0){
         
            while($row = $result ->fetch_assoc()) { 
              if($row['curriculum']==""){ ?>
                <p>No tiene archivos</p>

              <?php } else { 
                header('content-type: application/pdf');
                header('Content-Disposition: inline; filename="Curriculum ' . $row['nombre'] . '.pdf"');

                readfile('../postulante/php_action/archivos/'.$row['curriculum']);
               }   
            }
          } 
?> 
</body>
</html>
<?php ob_end_flush();?>
