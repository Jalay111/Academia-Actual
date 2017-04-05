<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
$sent = $db_con->prepare('
    SELECT 
        idAdministrativos, Cargos_idCargos
    FROM 
        Administrativos
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
$sentCargo = $db_con->prepare('SELECT Cargo FROM Cargos WHERE idCargos=:idc');
$i=0;
while($result = $sent->fetch(PDO::FETCH_ASSOC)){
    $sentDatas->execute(array(':id' => $result['idAdministrativos']));
    
    $resultDatas = $sentDatas->fetch(PDO::FETCH_ASSOC);
    
    $sentCargo->execute(array(':idc' => $result['Cargos_idCargos']));
    $resultCargo = $sentCargo->fetch(PDO::FETCH_ASSOC);
    
    $data['DNI'][$i] = $resultDatas['DNI'];
    $data['N1'][$i] = $resultDatas['Nombre'];
    $data['N2'][$i] = $resultDatas['Nombre2'];
    $data['A1'][$i] = $resultDatas['Apellido'];
    $data['A2'][$i] = $resultDatas['Apellido2'];
    $data['Cargo'][$i] = $resultCargo['Cargo'];
    $i++;
}
if($_SESSION['Usuario']->getAccesibilidad()==0){
    $data['permission'][0] = "<a href='#' id='add'><i class='icon icon-add'></i></a>";
    $data['permission'][1] = "javascript:mostrar('add_admin', 'black_add', null); callDep()";
}
$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);