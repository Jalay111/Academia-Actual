<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
require_once '../others/loadfordni.php';
require_once '../others/exists.php';
session_start();


if((trim($_GET['N1'])==null) || (trim($_GET['A1'])==null) || (trim($_GET['A2'])==null) || (trim($_GET['cargo'])==null) || (trim($_GET['dni'])==null) || (trim($_GET['mail'])==null) || (trim($_GET['nacimiento'])==null)){
        echo '0';
        exit();
    }

if(!exists($db_con, trim($_GET['dni']))){
    require_once 'regUser.php';
    reg($db_con, trim($_GET['N1']), trim($_GET['N2']), trim($_GET['A1']), trim($_GET['A2']), trim($_GET['dni']), trim($_GET['mail']), trim($_GET['nacimiento']), trim($_GET['tele']), trim($_GET['dire']),  trim($_GET['idMuni']), trim($_GET['sex']));
    $newUser = loadUserxDNI($db_con, trim($_GET['dni']));
    regAdministrativo($db_con, consultIdCargo($db_con, $_GET['cargo']), $newUser['idUsuarios']);
}else{
    //EL USUARIO YA EXISTE
    $newUser = loadUserxDNI($db_con, trim($_GET['dni']));
    $sentAdmin = $db_con->prepare('
        SELECT
            idReg
        FROM
            Administrativos
        WHERE
            Instituciones_idInstituciones=:idI
            AND
            idAdministrativos=:idA
    ');
    $sentAdmin->execute(array(':idI' => $_SESSION['Usuario']->getId_Colegio(), ':idA'=>$newUser['idUsuarios']));
    
    if($resultAdmin = $sentAdmin->fetch(PDO::FETCH_ASSOC)){
        echo '2';
        exit();
    }
    regAdministrativo($db_con, consultIdCargo($db_con, trim($_GET['cargo'])), $newUser['idUsuarios']);
}

function regAdministrativo($db_con, $idCargo, $idUsuario){
    $sent= $db_con->prepare('
        INSERT INTO Administrativos (idAdministrativos, Cargos_idCargos, Instituciones_idInstituciones,
        accesibilidad, idReg) VALUES (:v1, :v2, :v3, :v4, :v5)');
    $sent->execute(array(':v1'=>$idUsuario, ':v2'=>$idCargo, ':v3'=>$_SESSION['Usuario']->getId_Colegio(), ':v4'=>1, ':v5'=>$_SESSION['Usuario']->getId()));
    echo '1';
    exit();
}

function consultIdCargo($db_con, $cargo){
    $sent = $db_con->prepare('SELECT idCargos FROM Cargos WHERE Cargo=:car');
    $sent->execute(array(':car'=>$cargo));
    if($result = $sent->fetch(PDO::FETCH_ASSOC)){
        return $result['idCargos'];
    }
    
    $sentInsert = $db_con->prepare('
        INSERT INTO 
            Cargos 
                (Cargo, idReg)
        VALUES
            (:v1, :v2)
    ');
    $sentInsert->execute(array(':v1' => $cargo, ':v2'=>$_SESSION['Usuario']->getId()));
    
    return consultIdCargo($cargo);
}