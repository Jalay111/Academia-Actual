<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
if($_SESSION['Usuario']->getAccesibilidad()==0){
    $data['permission']=true;
}else{
    $data['permission'] = null;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($data,JSON_FORCE_OBJECT);