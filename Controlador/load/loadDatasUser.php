<?php
require_once '../../Modelo/PDOConex.php';
session_start();

$sentDatas = $db_con->prepare('
    SELECT
        Correo,
        Nombre,
        Nombre2,
        Apellido,
        Apellido2,
        Fecha_Nacimiento,
        Telefono,
        Sexo,
        Direccion
    FROM
        Usuarios
    WHERE
        DNI=:doc
');

$sentDatas->execute(array(':doc'=>$_GET['DNI']));
$result = $sentDatas->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/json; charset=utf-8');
echo json_encode($result, JSON_FORCE_OBJECT);