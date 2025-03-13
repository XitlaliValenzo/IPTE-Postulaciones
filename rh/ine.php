<?php ob_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INE</title>
</head>
<body>
 <?php

 include_once('../config.php');
          $sql = "SELECT * FROM contratacion INNER JOIN usuarios ON contratacion.id_postulante = usuarios.id WHERE id_postulante=".$_GET['id'];
          $result = $con -> query($sql);

          if($result ->num_rows > 0){
         
            while($row = $result ->fetch_assoc()) { 
              if($row['ine']==""){ ?>
                <p>No tiene archivos</p>

              <?php } else { 
                header('content-type: application/pdf');
               
                header('Content-Disposition: inline; filename="INE_' . $row['nombre'] . '.pdf"');

                readfile('../postulante/php_action/archivos/'.$row['ine']);
               }   
            }
          } 
?> 
</body>
</html>
<?php ob_end_flush();?>