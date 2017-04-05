<?php
session_start();
require_once '../../Modelo/PDOConex.php';
$ad = array();
if($_SESSION['Tipo'][0] == 'Administrativo'){
	rellenarAdmin($db_con, $ad);
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($ad,JSON_FORCE_OBJECT);
exit();

function rellenarAdmin($db_con, &$ad){
	$ad['success'] = true;
	$sentInstu = $db_con->prepare('SELECT Nombre FROM Instituciones WHERE idInstituciones =:id');
	$sentCargo = $db_con->prepare('SELECT Cargo FROM Cargos WHERE idCargos=:id');
	$ad['num'] = count($_SESSION['Admins']);

	for($i=0; $i < count($_SESSION['Admins']); $i++){
		$sentInstu->execute(array(':id' => $_SESSION['Admins'][$i]['Instituciones_idInstituciones']));
		$resInstu = $sentInstu->fetch(PDO::FETCH_ASSOC);

		$sentCargo->execute(array(':id' => $_SESSION['Admins'][$i]['Cargos_idCargos']));
		$resCargo = $sentCargo->fetch(PDO::FETCH_ASSOC);

		//Cargamos el Array
		$ad['data']['Instituciones'][$i] = $resInstu['Nombre'];
		$ad['data']['IdInstituciones'][$i] = $_SESSION['Admins'][$i]['Instituciones_idInstituciones'];
		$ad['data']['Cargos'][$i] = $resCargo['Cargo'];
		$ad['data']['IdCargos'][$i] = $_SESSION['Admins'][$i]['Cargos_idCargos'];
	}

}