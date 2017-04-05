<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
$data = array();

$sentCursos = $db_con->prepare('
    SELECT 
        idCursos, Curso, Grados_idGrado, CupoMax
    FROM
        Cursos
    WHERE
        Instituciones_idInstituciones=:idI
');

$sentCursos->execute(array(':idI'=>$_SESSION['Usuario']->getId_Colegio()));

$sentGrados = $db_con->prepare('SELECT Grado FROM Grados WHERE idGrado=:idG');

$sentNum = $db_con->prepare('
    SELECT
        idEstudiantes
    FROM
        Estudiantes
    WHERE
        Cursos_idCursos=:idC
        AND
        Instituciones_idInstituciones=:idI
');

//* SEPTIMO A *//* 23/30  
$i=0;
while($resultCursos = $sentCursos->fetch(PDO::FETCH_ASSOC)){
    $sentGrados->execute(array(':idG'=>$resultCursos['Grados_idGrado']));
    $resultGrados = $sentGrados->fetch(PDO::FETCH_ASSOC);
    
    $sentNum->execute(array(':idC'=>$resultCursos['idCursos'], ':idI'=>$_SESSION['Usuario']->getId_Colegio()));
    
    $data['id'][$i] = $resultCursos['idCursos'];
    $data['Grado'][$i] = $resultGrados['Grado'];
    $data['Curso'][$i] = $resultCursos['Curso'];
    $data['CupoMax'][$i] = $resultCursos['CupoMax'];
    $data['numEst'][$i] = $sentNum->rowCount();
    $i++;
}

$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);