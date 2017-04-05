<?php
require_once '../../Modelo/PDOConex.php';
require_once '../others/utf8converter.php';
session_start();
$data = array();

$sentMun = $db_con->prepare('
    SELECT
        idMunicipios,
        Municipio
    FROM
        Municipios
    WHERE
        idDepartamentos_Departamentos=:idD    
');
$sentMun->execute(array(':idD' => $_GET['idDepa']));

$i=0;
while($resultMun = $sentMun->fetch(PDO::FETCH_ASSOC)){
    $data['idMun'][$i] = $resultMun['idMunicipios'];
    $data['Mun'][$i] = $resultMun['Municipio'];
    $i++;
}

$data['num']=$i;
header('Content-type: application/json; charset=utf-8');
echo json_encode(utf8_converter($data),JSON_FORCE_OBJECT);