<?php
session_start();
require_once '../../Modelo/PDOConex.php';

$_SESSION['Usuario'] = logAdmin($_GET['Ins'], $_GET['Carg'], $db_con);

if($_GET['direct']){
	header('location:../../pages/indexAdmin.php');
}
exit('1');

function logAdmin($idI, $idC, $db_con){
	$sentencia = $db_con->prepare('
		SELECT
			Usuarios.Nombre,
			Usuarios.Apellido,
			Administrativos.accesibilidad
		FROM 
			Usuarios
		INNER JOIN
			Administrativos
		WHERE
			Usuarios.idUsuarios=:idUs
			AND
			Administrativos.idAdministrativos=:idU
			AND
			Administrativos.Instituciones_idInstituciones=:idI
			AND
			Administrativos.Cargos_idCargos=:idC'
		);
	$sentencia->execute(array(':idUs'=> $_SESSION['idUsuario'], ':idU'=>$_SESSION['idUsuario'], ':idI'=>$idI, ':idC'=>$idC));

	if($sentencia->rowCount() != 0){
		require_once '../Usuarios/Administrativos.php';
		$result = $sentencia->fetch(PDO::FETCH_OBJ);
		$admin = new Administrativos(
			$_SESSION['idUsuario'],
			$result->Nombre,
			$result->Apellido,
			$idI,
			getCargo($result->Cargos_idCargos, $db_con),
			$result->accesibilidad
		);
		$_SESSION['TypeUsing'] = 'Administrativo';
		return $admin;
	}else{
		exit('0');
	}
}

function getCargo($id, $db_con){
	$sent = $db_con->prepare("SELECT Cargo FROM Cargos WHERE idCargos=:id ");
	$sent->execute(array(":id"=>$id));
	$res = $sent->fetch(PDO::FETCH_OBJ);
	return $res->Cargo;
}