<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
require_once '../others/loadfordni.php';
session_start();
require_once '../others/exists.php';

if((trim($_GET['N1'])==null) || (trim($_GET['A1'])==null) || (trim($_GET['A2'])==null) ||
    (trim($_GET['dni'])==null) || (trim($_GET['mail'])==null) || (trim($_GET['nacimiento'])==null)){
        echo '0';
        exit();
    }
    
if(!exists($db_con, $_GET['dni'])){
    require_once 'regUser.php';
    reg($db_con, trim($_GET['N1']), trim($_GET['N2']), trim($_GET['A1']), trim($_GET['A2']), trim($_GET['dni']), trim($_GET['mail']), trim($_GET['nacimiento']), trim($_GET['tele']), trim($_GET['dire']), trim($_GET['idMuni'], trim($_GET['sex'])));
}

$newUser = loadUserxDNI($db_con, trim($_GET['dni']));
regAttendent($db_con, $newUser['idUsuarios']);

function regAttendent($db_con, $idUsuario){
    $sentAcu = $db_con->prepare('SELECT idReg FROM Acudientes WHERE idAcudientes=:idA');
    $sentAcu->execute(array(':idA'=>$idUsuario));
    if($resultAcu = $sentAcu->fetch(PDO::FETCH_ASSOC)){
        echo '2';
        exit();
    }

    $sentInsert = $db_con->prepare('
        INSERT INTO
            Acudientes (idAcudientes, idReg)
        VALUES
            (:v1, :v2)
    ');
    $sentInsert->execute(array(':v1'=>$idUsuario, ':v2'=>$_SESSION['Usuario']->getId()));
    echo '1';
    exit();
}