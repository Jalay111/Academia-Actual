<?php
require_once '../../Modelo/PDOConex.php';
session_start();
logAcud($db_con, $_SESSION['idUsuario'], $_GET['idEst']);

if($_GET['direct']){
	header('location:../../pages/indexAttendant.php');
}else{
	exit('1');
}

function logAcud($db_con, $idA, $idE){
	$sentencia = $db_con->prepare("
		SELECT 
			DNI,
			Nombre,
			Apellido
		FROM
			Usuarios
				INNER JOIN
			Acudientes
		WHERE
			Usuarios.idUsuarios =:idU
				AND Acudientes.idAcudientes =:idA"
		);
	$sentencia->execute(array(':idU'=>$idA, ':idA'=>$idA));

	if($result = $sentencia->fetch(PDO::FETCH_OBJ)){
		
		$sentEst = $db_con->prepare('
			SELECT
				Cursos_idCursos
			FROM
				Estudiantes
			WHERE
				idEstudiantes=:IdEs
				AND
				Acudientes_idAcudientes=:IdA
		');
		$sentEst->execute(array(':IdEs'=>$idE, ':IdA'=>$idA));
		if($resultEst = $sentEst->fetch(PDO::FETCH_OBJ)){
			require_once '../Usuarios/Acudientes.php';
			$acud = new Acudientes(
				$result->idUsuarios,
				$result->DNI,
				$result->Nombre,
				null,
				$result->Apellido,
				null,
				null,
				null,
				$idE
			);
			$_SESSION['TypeUsing'] = 'Attendement';
			return $acud;
		}
	}else{
		exit('0');
	}
}