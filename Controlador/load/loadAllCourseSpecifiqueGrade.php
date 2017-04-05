<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
$idgrado = $_GET['idGrado'];

$sentCurso = $db_con->prepare('
    SELECT
        idCursos, Curso, CupoMax
    FROM
        Cursos
    WHERE
        Instituciones_idInstituciones=:idI
        AND
        Grados_idGrado=:idG
');

$sentCurso->execute(array(':idI'=>$_SESSION['Usuario']->getId_Colegio(), ':idG'=>$idgrado));

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
$i=0;
while($resultCurso = $sentCurso->fetch(PDO::FETCH_ASSOC)){
    $sentNum->execute(array(':idC'=>$resultCurso['idCursos'], ':idI'=>$_SESSION['Usuario']->getId_Colegio()));
    $data['success']=true;
    $data['Curso'][$i]=$resultCurso['Curso'];
    $data['CupoMax'][$i]=$resultCurso['CupoMax'];
    $data['numEst'][$i] = $sentNum->rowCount();
    $i++;
}
$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);