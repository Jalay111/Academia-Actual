<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();

$sentDocent = $db_con->prepare('SELECT idDocentes FROM Docentes WHERE Instituciones_idInstituciones =:idI');
$sentDocent->execute(array(':idI' => $_SESSION['Usuario']->getId_Colegio()));

$sentDatas = $db_con->prepare('
    SELECT 
        DNI, Nombre, Nombre2, Apellido, Apellido2
    FROM 
        Usuarios
    WHERE 
        idUsuarios=:id
    ');

$sentDoc_has_Tit = $db_con->prepare('
    SELECT
        Titulos_idTitulos
    FROM
        Docentes_has_Titulos
    WHERE
        Docentes_idDocentes=:idT
');

$sentTitulo = $db_con->prepare('SELECT Titulo FROM Titulos WHERE idTitulos =:idT');

$i=0;
while($resultDocent = $sentDocent->fetch(PDO::FETCH_ASSOC)){
    $sentDatas->execute(array(':id' => $resultDocent['idDocentes']));
    $sentDoc_has_Tit->execute(array(':idT'=>$resultDocent['idDocentes']));
    $resultDoc_has_Tit = $sentDoc_has_Tit->fetch(PDO::FETCH_ASSOC);
    
    $sentTitulo->execute(array(':idT' => $resultDoc_has_Tit['Titulos_idTitulos']));
    
    $resultDatas = $sentDatas->fetch(PDO::FETCH_ASSOC);
    $resultTitulo = $sentTitulo->fetch(PDO::FETCH_ASSOC);
    
    $data['DNI'][$i] = $resultDatas['DNI'];
    $data['N1'][$i] = $resultDatas['Nombre'];
    $data['N2'][$i] = $resultDatas['Nombre2'];
    $data['A1'][$i] = $resultDatas['Apellido'];
    $data['A2'][$i] = $resultDatas['Apellido2'];
    $data['Titulo'][$i] = $resultTitulo['Titulo'];
    $i++;
}

if($_SESSION['Usuario']->getAccesibilidad()==0){
    $data['permission'] = true;
}

$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);