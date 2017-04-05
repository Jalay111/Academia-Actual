<?php
require_once '../../Modelo/PDOConex.php';
session_start();

$input = strtolower($_GET['titulo']);
$largo = strlen($input);
$data = array();

if($largo){
    $sentTitulos = $db_con->prepare('
        SELECT Titulo FROM Titulos
    ');
    $sentTitulos->execute();
    $resultTitulos = $sentTitulos->fetchAll();
    
    for($i=0; $i < $sentTitulos->rowCount(); $i++){
        $tituloMin = strtolower($resultTitulos[$i][0]);
        if($input == substr($tituloMin,0,$largo)){
            $data[] = $resultTitulos[$i][0];
        }
    }
}

echo json_encode($data, JSON_FORCE_OBJECT);