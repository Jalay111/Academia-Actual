<?php
function getTipo($id, $db_con){
	#Administrativos
	$cons = $db_con->prepare('SELECT Cargos_idCargos, Instituciones_idInstituciones FROM Administrativos WHERE idAdministrativos=:id');
	$cons->execute(array(":id"=>$id));
	if($cons->rowCount()>0){
		$_SESSION['Tipo'][0] = 'Administrativo';
		$_SESSION['Admins'] = $cons->fetchAll();
	}else{
		$_SESSION['Tipo'][0] = null;
	}

	#Docentes
	$cons = $db_con->prepare('SELECT Instituciones_idInstituciones FROM Docentes WHERE idDocentes=:id');
	$cons->execute(array(":id"=>$id));
	if($cons->rowCount()>0){
		$_SESSION['Tipo'][1] = 'Docente';
		$_SESSION['Doc'] = $cons->fetchAll();
	}else{
		$_SESSION['Tipo'][1] = null;
	}

	#Estudiantes
	$cons = $db_con->prepare('SELECT Cursos_idCursos FROM Estudiantes WHERE idEstudiantes=:id');
	$cons->execute(array(":id"=>$id));
	if($cons->rowCount()>0){
		$_SESSION['Tipo'][2] = 'Estudiante';
		$_SESSION['Est'] = $cons->fetch(PDO::FETCH_ASSOC);
	}else{
		$_SESSION['Tipo'][2] = null;
	}

	#Acudientes
	$cons = $db_con->prepare('
		SELECT
			idEstudiantes
		FROM
			Estudiantes
		WHERE
			Acudientes_idAcudientes=:idA
	');
	$cons->execute(array(':idA'=>$id));
	if($cons->rowCount()>0){
		$_SESSION['Tipo'][3] = 'Acudiente';
		$_SESSION['Acud'] = $cons->fetchAll();
	}else{
		$_SESSION['Tipo'][3] = null;
	}
}