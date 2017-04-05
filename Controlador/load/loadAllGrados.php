<?php
require_once '../../Modelo/PDOConex.php';
session_start();
$data = array();
$sentGrados = $db_con->prepare('SELECT idGrado, Grado FROM Grados');
$sentGrados->execute();
$i=0;
while($resultGrados = $sentGrados->fetch(PDO::FETCH_ASSOC)){
    $data['idGrados'][$i] = $resultGrados['idGrado'];
    $data['Grados'][$i] = $resultGrados['Grado'];
    $i++;
}
$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);