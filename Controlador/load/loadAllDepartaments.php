<?php
require_once '../../Modelo/PDOConex.php';
require_once '../others/utf8converter.php';
session_start();
$data = array();

$sentDeps = $db_con->prepare('SELECT idDepartamentos, Departamento FROM Departamentos');
$sentDeps->execute();

$i=0;
while($result = $sentDeps->fetch(PDO::FETCH_ASSOC)){
    $data['idDep'][$i] = $result['idDepartamentos'];
    $data['Dep'][$i] = $result['Departamento'];
    $i++;
}

$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode(utf8_converter($data),JSON_FORCE_OBJECT);