<?php
require_once '../../Modelo/PDOConex.php';
session_start();

$input = strtolower($_GET['cargo']);
$largo = strlen($input);
$data = array();

if($largo){
    $sentCargos = $db_con->prepare('
        SELECT Cargo FROM Cargos WHERE 1
    ');
    $sentCargos->execute();
    $resultCargos = $sentCargos->fetchAll();
    
    for($i=0; $i < $sentCargos->rowCount(); $i++){
        $CargoMin = strtolower($resultCargos[$i][0]);
        if($input == substr($CargoMin,0,$largo)){
            $data[] = $resultCargos[$i][0];
        }
    }
}

echo json_encode($data, JSON_FORCE_OBJECT);