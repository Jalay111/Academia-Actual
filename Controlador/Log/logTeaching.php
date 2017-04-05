<?php
require_once '../../Modelo/PDOConex.php';
session_start();
$_SESSION['Usuario'] = logDocente($_GET['idIns'], $db_con);

if($_GET['direct']){
	header('location:../../Pages/indexTeaching.php');
}

exit('1');

function logDocente($idIn, $db_con){
	
	$sentTeaching = $db_con->prepare('
		SELECT
			Nombre, Apellido
		FROM
			Usuarios
			INNER JOIN
			Docentes
		WHERE
			Usuarios.idUsuarios=:idU
			AND
			Docentes.Instituciones_idInstituciones=:idI
	');
	$sentTeaching->execute(array(':idU'=>$_SESSION['idUsuario'], ':idI'=>$idIn));
	if(!$resultTeaching = $sentTeaching->fetch(PDO::FETCH_ASSOC)){
		exit('0');
	}else{
		require_once '../Usuarios/Docentes.php';
		$_SESSION['TypeUsing']='Teaching';
		return new Docentes(
			$_SESSION['idUsuario'], null, $resultTeaching['Nombre'], null,
			$resultTeaching['Apellido'] , null, null, null, $idIn, null
		);
	}
}