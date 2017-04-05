<?php
require_once '../../Modelo/PDOConex.php';
require_once '../others/utf8converter.php';
session_start();
$data = array();
$sent = $db_con->prepare('
    SELECT
        Correo, DNI, Cuenta,
        Nombre, Nombre2, Apellido,
        Apellido2, Fecha_Nacimiento,
        Telefono, Sexo, Direccion, idMun
    FROM
        Usuarios
    WHERE
        idUsuarios=:idU
');
$sent->execute(array(':idU'=>$_SESSION['idUsuario']));
if($result = $sent->fetch(PDO::FETCH_ASSOC)){
    
    $sentMuni = $db_con->prepare('SELECT Municipio FROM Municipios WHERE idMunicipios=:idV');
    $sentMuni->execute(array(':idV'=>$result['idMun']));
    $resultMuni = $sentMuni->fetch(PDO::FETCH_ASSOC);
    
    $data['success']=true;
    $data['N1'] = $result['Nombre'];
    $data['N2'] = $result['Nombre2'];
    $data['A1'] = $result['Apellido'];
    $data['A2'] = $result['Apellido2'];
    $data['DNI'] = $result['DNI'];
    $data['Cuenta'] = $result['Cuenta'];
    $data['fecha'] = $result['Fecha_Nacimiento'];
    $data['tele'] = $result['Telefono'];
    $data['Municipio'] = $resultMuni['Municipio'];
    $data['Correo'] = $result['Correo'];
    $data['Direccion'] = $result['Direccion'];
    
    if($result['Sexo']=='1'){
        $data['Sexo'] = 'Masculino';
    }elseif($result['Sexo']=='2'){
        $data['Sexo'] = 'Femenino';
    }
}

header('Content-type: application/json; charset=utf-8');
echo json_encode(utf8_converter($data),JSON_FORCE_OBJECT);