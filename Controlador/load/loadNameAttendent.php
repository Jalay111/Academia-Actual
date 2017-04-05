<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
$data = array();

$sentDatas = $db_con->prepare('
    SELECT
        idUsuarios,
        Nombre,
        Apellido,
        Apellido2
    FROM
        Usuarios
    WHERE
        DNI=:doc
');
$sentDatas->execute(array(':doc'=>$_GET['dni']));
$data['success']=false;
if($resultDatas = $sentDatas->fetch(PDO::FETCH_ASSOC)){
    $sentAttendent = $db_con->prepare('
        SELECT idReg FROM `Acudientes` WHERE idAcudientes=:idA
    ');
    $sentAttendent->execute(array(':idA' => $resultDatas['idUsuarios']));
    if($result = $sentAttendent->fetch(PDO::FETCH_ASSOC)){
        $data['success']=true;
        $data['nombre']="{$resultDatas['Nombre']} {$resultDatas['Apellido']} {$resultDatas['Apellido2']}";
    }
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($data, JSON_FORCE_OBJECT);
