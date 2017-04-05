<?php
require_once '../../Modelo/PDOConex.php';
session_start();
$_SESSION['Usuario'] = logEst($_GET['idCurso'], $db_con);

if($_GET['direct']){
	header('location:../../pages/indexStudent.php');
}
exit('1');

function logEst($idCu, $db_con){
	$sentencia=$db_con->prepare('
		SELECT 
		    Usuarios.idUsuarios,
		    Usuarios.Nombre,
		    Usuarios.Apellido,
		    Estudiantes.Acudientes_idAcudientes
		FROM
		    Betaing.Usuarios
		        INNER JOIN
		    Betaing.Estudiantes
		WHERE
		    Usuarios.idUsuarios =:idU
			AND
			Estudiantes.idEstudiantes =:idE
			AND
			Estudiantes.Cursos_idCursos =:idC
        ');
	$sentencia->execute(array(':idU'=>$_SESSION['idUsuario'], ':idE'=>$_SESSION['idUsuario'], ':idC'=>$idCu));

	if($result = $sentencia->fetch(PDO::FETCH_OBJ)){
		require_once '../Usuarios/Estudiantes.php';
		$_SESSION['TypeUsing'] = 'Student';
		return new Estudiantes(
			$result->idUsuarios,
			null,
			$result->Nombre,
			null,
			$result->Apellido,
			null,
			null,
			null,
			null,
			$idCu
		);
	}else{
		exit('0');
	}
}