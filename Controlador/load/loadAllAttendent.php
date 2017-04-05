<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();

$sentAcu = $db_con->prepare('SELECT idAcudientes FROM Acudientes');
$sentAcu->execute();


$sentEstu = $db_con->prepare('
SELECT 
	idEstudiantes
FROM 
	Estudiantes
WHERE 
	Acudientes_idAcudientes =:idA 
AND
	Instituciones_idInstituciones=:idI');
	
$sentDatas = $db_con->prepare('
    SELECT 
        DNI, Nombre, Nombre2, Apellido, Apellido2
    FROM 
        Usuarios
    WHERE 
        idUsuarios=:id
    ');
    
$i=0;


while($resultAcu = $sentAcu->fetch(PDO::FETCH_ASSOC)){
	$sentEstu->execute(array(':idA' => $resultAcu['idAcudientes'], ':idI'=>$_SESSION['Usuario']->getId_Colegio()));
	if($resultEstu = $sentEstu->fetch(PDO::FETCH_ASSOC)){
		$sentDatas->execute(array(':id' => $resultAcu['idAcudientes']));
		$resultDatas = $sentDatas->fetch(PDO::FETCH_ASSOC);
		$data['DNI'][$i] = $resultDatas['DNI'];
		$data['N1'][$i] = $resultDatas['Nombre'];
	    $data['N2'][$i] = $resultDatas['Nombre2'];
	    $data['A1'][$i] = $resultDatas['Apellido'];
	    $data['A2'][$i] = $resultDatas['Apellido2'];
	    $i++;
	}
}
if($_SESSION['Usuario']->getAccesibilidad()==0){
    $data['permission'] = true;
}

$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);