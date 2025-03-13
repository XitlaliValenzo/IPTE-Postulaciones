<?php
require_once '../../config.php';
$data = array();
$query = "SELECT id_entrevista, usuarios.nombre, hora_entrevista, modalidad_entrevista, link_teams, ubicacion_entrevista, fecha_entrevista, entrevistas.estatus_entrevista, cancelacion_entrevista FROM entrevistas, usuarios WHERE entrevistas.id_postulante = usuarios.id ORDER BY hora_entrevista";
$statement = $con->prepare($query);
$statement->execute();
$statement->bind_result($id_entrevista, $nombre, $hora_entrevista, $modalidad_entrevista, $link_teams, $ubicacion_entrevista,$fecha_entrevista, $estatus_entrevista, $cancelacion_entrevista);

while ($statement->fetch()) {
	setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
	$hora_entrevista2 = date('h:i a', strtotime($hora_entrevista));
	if ($modalidad_entrevista == 'Presencial'){
		if ($estatus_entrevista == 'Pendiente'){
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . $ubicacion_entrevista,
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#34D0F2',
			);

		} else if ($estatus_entrevista == 'Pendiente segunda etapa'){
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . $ubicacion_entrevista,
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#ffb703',
			);

		} else if ($estatus_entrevista == "Realizada"){
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . $ubicacion_entrevista,
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#3FE151',
			);

		} else {
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . $ubicacion_entrevista . "<br>" . 'Motivo de cancelación: ' . $cancelacion_entrevista,
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#fa4040',
			);
		}
	} else {
		if ($estatus_entrevista == 'Pendiente'){
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . '<a href="' . $link_teams . '" target="_blank" class="text-warning">'."Ir a la reunión en Teams"."</a>",
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#34D0F2',
			);

		} else if ($estatus_entrevista == 'Pendiente segunda etapa'){
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . '<a href="' . $link_teams . '" target="_blank" class="text-warning">'."Ir a la reunión en Teams"."</a>",
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#ffb703',
			);
		} else if ($estatus_entrevista == "Realizada"){
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . '<a href="' . $link_teams . '" target="_blank" class="text-warning">'."Ir a la reunión en Teams"."</a>",
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#3FE151',
			);

		} else {
			$data[] = array(
				'id' => $id_entrevista,
				'name' => $estatus_entrevista,
				'description' => $nombre . "<br>" . 'Horario: ' . $hora_entrevista2 . "<br>" . 'Modalidad: ' . $modalidad_entrevista . "<br>" . '<a href="' . $link_teams . '" target="_blank" class="text-warning">'."Ir a la reunión en Teams"."</a>" . "<br>" . 'Motivo de cancelación: ' . $cancelacion_entrevista,
				'date' => date("Y-m-d",strtotime($fecha_entrevista."+ 1 days")),
				'type' => $id_entrevista . $estatus_entrevista,
				'color'=>'#fa4040',
			);
		}
		
	}
    
}

$statement->close();

echo json_encode($data);
?>




