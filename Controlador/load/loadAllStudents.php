<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
$sent = $db_con->prepare('
    SELECT 
        idEstudiantes, Cursos_idCursos
    FROM 
        Estudiantes
    WHERE 
        Instituciones_idInstituciones=:doc
    ');
    
$sent->execute(
    array(
        ':doc' => $_SESSION['Usuario']->getId_Colegio()
    )
);

$sentDatas = $db_con->prepare('
    SELECT 
        DNI, Nombre, Nombre2, Apellido, Apellido2
    FROM 
        Usuarios
    WHERE 
        idUsuarios=:id
    ');

$sentCurso = $db_con->prepare('SELECT Curso, Grados_idGrado FROM Cursos WHERE idCursos=:idc');

$sentGrado = $db_con->prepare('SELECT Grado FROM Grados WHERE idGrado=:idG');

$i=0;
while($result = $sent->fetch(PDO::FETCH_ASSOC)){
    $sentDatas->execute(array(':id' => $result['idEstudiantes']));
    
    $resultDatas = $sentDatas->fetch(PDO::FETCH_ASSOC);
    
    $sentCurso->execute(array(':idc' => $result['Cursos_idCursos']));
    $resultCurso = $sentCurso->fetch(PDO::FETCH_ASSOC);
    
    $sentGrado->execute(array(':idG' =>$resultCurso['Grados_idGrado'] ));
    $resultGrado = $sentGrado->fetch(PDO::FETCH_ASSOC);
    
    $data['DNI'][$i] = $resultDatas['DNI'];
    $data['N1'][$i] = $resultDatas['Nombre'];
    $data['N2'][$i] = $resultDatas['Nombre2'];
    $data['A1'][$i] = $resultDatas['Apellido'];
    $data['A2'][$i] = $resultDatas['Apellido2'];
    $data['Curso'][$i] = $resultGrado['Grado'].' '.$resultCurso['Curso'];
    $i++;
}
if($_SESSION['Usuario']->getAccesibilidad()==0){
    $data['permission'] = true;
}
$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);