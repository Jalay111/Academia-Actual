<?php
function exists($db_con, $DNIsearch){
    $sentencia = $db_con->prepare('Select Nombre FROM Usuarios WHERE DNI=:doc');
    $sentencia->execute(array(':doc' => $DNIsearch));
    $result = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $result['Nombre'];
}