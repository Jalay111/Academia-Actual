<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
require_once '../others/exists.php';
require_once '../others/loadfordni.php';
session_start();

if((trim($_GET['N1'])==null) || (trim($_GET['A1'])==null) || (trim($_GET['A2'])==null) || (trim($_GET['dniAcu'])==null) ||
    (trim($_GET['dni'])==null) || (trim($_GET['mail'])==null) || (trim($_GET['nacimiento'])==null) ||
    (trim($_GET['dniAcu'])==null) || (trim($_GET['Curso']))){
        echo '0';
        exit();
    }

if(!exists($db_con, $_GET['dni'])){
    require_once 'regUser.php';
    reg($db_con, trim($_GET['N1']), trim($_GET['N2']), trim($_GET['A1']), trim($_GET['A2']), trim($_GET['dni']), trim($_GET['mail']), trim($_GET['nacimiento']), trim($_GET['tele']), trim($_GET['dire']), trim($_GET['idMun']), trim($_GET['sex']));
}
$newUser = loadUserxDNI($db_con, trim($_GET['dni']));
regStudent($db_con, $newUser['idUsuarios']);

function regStudent($db_con, $idUsu){
    $sentStudent= $db_con->prepare('
        SELECT 
            Cursos_idCursos,
            Acudientes_idAcudientes,
            Instituciones_idInstituciones,
            idReg
        FROM
            Estudiantes
        WHERE
            idEstudiantes=:idU
    ');
    $sentStudent->execute(array(':idU'=>$idUsu));
    if($resultStudent = $sentStudent->fetch(PDO::FETCH_ASSOC)){
        if($resultStudent['Instituciones_idInstituciones']==$_SESSION['Usuario']->getId_Colegio()){
            echo '3';
        }else{
            echo '2';
        }
        exit();
    }
    
    $grado = explode(" ",$_GET['Grado']);
    
    $sentGrado = $db_con->prepare('
        SELECT
            idGrado
        FROM
            Grados
        WHERE
            Grado=:gr
    ');
    $sentGrado->execute(array(':gr'=> $grado[0]));
    if(!$resultGrado = $sentGrado->fetch(PDO::FETCH_ASSOC)){
        echo '4';
        exit();
    }
    
    $sentCurso = $db_con->prepare('
        SELECT
            idCursos
        FROM
            Cursos
        WHERE 
            Curso=:cu
            AND
            Grados_idGrado=:idG
            AND
            Instituciones_idInstituciones=:idI
    ');
    $sentCurso->execute(array(':cu'=>$grado[1], ':idG'=>$resultGrado['idGrado'], ':idI'=>$_SESSION['Usuario']->getId_Colegio()));
    if(!$resultCurso = $sentCurso->fetch(PDO::FETCH_ASSOC)){
        echo '5';
        exit();
    }
    
    $sentAcu=$db_con->prepare('
        SELECT idUsuarios FROM Usuarios WHERE DNI=:doc
    ');
    $sentAcu->execute(array(':doc'=>$_GET['dniAcu']));
    $resultAcu=$sentAcu->fetch(PDO::FETCH_ASSOC);
    
    $sentInsertStudent = $db_con->prepare('
        INSERT INTO
            Estudiantes
                (
                    idEstudiantes,
                    Cursos_idCursos,
                    Acudientes_idAcudientes,
                    Instituciones_idInstituciones,
                    idReg
                )
        VALUES
            (:v1, :v2, :v3, :v4, :v5)    
    ');
    $sentInsertStudent->execute(array(
        ':v1'=>$idUsu,
        ':v2'=>$resultCurso['idCursos'],
        ':v3'=>$resultAcu['idUsuarios'],
        ':v4'=>$_SESSION['Usuario']->getId_Colegio(),
        ':v5'=>$_SESSION['Usuario']->getId()
    ));
    echo '1';
    exit();
}