<?php
require_once "../../Modelo/PDOConex.php";
session_start();
$acu = array();

if($_SESSION['Tipo'][3] == 'Acudiente'){
    rellenarAcu($db_con, $acu);
    
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($acu, JSON_FORCE_OBJECT);
exit();

function rellenarAcu($db_con, &$acu){ 
    $acu['success'] = true;
    $acu['num'] = count($_SESSION['Acud']);
	$sentEstu = $db_con->prepare('SELECT idEstudiantes FROM Estudiantes WHERE Acudientes_idAcudientes =:id');
	$sentEstuNom = $db_con->prepare('SELECT Nombre, Apellido, Apellido2 FROM Usuarios WHERE idUsuarios =:id');
	
	for($i=0; $i < count($_SESSION['Acud']); $i++){
		$sentEstu->execute(array(':id' => $_SESSION['idUsuario']));
		$resEstu = $sentEstu->fetch(PDO::FETCH_ASSOC);
		$sentEstuNom->execute(array(':id' => $resEstu['idEstudiantes']));
		$resultNom = $sentEstuNom->fetch(PDO::FETCH_ASSOC);
	    
		$acu['data']['Nombre'][$i] = $resultNom['Nombre'].' '.$resultNom['Apellido'].' '.$resultNom['Apellido2'];
		$acu['data']['idEstudiantes'][$i] = $resEstu['idEstudiantes'];
	}
}
?>