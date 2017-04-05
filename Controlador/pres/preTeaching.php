<?php
session_start();
require_once '../../Modelo/PDOConex.php';
$doc = array();
if($_SESSION['Tipo'][1] =='Docente'){
	rellenarDoc($db_con, $doc);
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($doc, JSON_FORCE_OBJECT);
exit();

function rellenarDoc($db_con, &$doc){
	
	$doc['success'] = true;
	$doc['num'] = count($_SESSION['Doc']);
	$sentInstu = $db_con->prepare('SELECT Nombre FROM Instituciones WHERE idInstituciones =:id');
	for ($i=0; $i<count($_SESSION['Doc']) ; $i++){
		$sentInstu->execute(array(':id' => $_SESSION['Doc'][$i]['Instituciones_idInstituciones']));
		$resInstu = $sentInstu->fetch(PDO::FETCH_ASSOC);
		
		$doc['data']['Instituciones'][$i] = $resInstu['Nombre'];
		$doc['data']['IdInstituciones'][$i] = $_SESSION['Doc'][$i]['Instituciones_idInstituciones'];
	}
}
?>