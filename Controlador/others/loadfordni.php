<?php
function loadUserxDNI($db_con, $dni){
    $sentencia = $db_con->prepare('SELECT * FROM Usuarios WHERE DNI=:doc');
    $sentencia->execute(array(':doc'=>$dni));
    return $sentencia->fetch(PDO::FETCH_ASSOC);
}