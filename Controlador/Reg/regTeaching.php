<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
require_once '../others/exists.php';
require_once '../others/loadfordni.php';
session_start();

if((trim($_GET['N1'])==null) || (trim($_GET['A1'])==null) || (trim($_GET['A2'])==null) || (trim($_GET['titulo'])==null) ||
    (trim($_GET['dni'])==null) || (trim($_GET['mail'])==null) || (trim($_GET['nacimiento'])==null)){
        exit('0');
    }

if(exists($db_con, trim($_GET['dni']))==null){
    require_once 'regUser.php';
    reg($db_con, trim($_GET['N1']), trim($_GET['N2']), trim($_GET['A1']), trim($_GET['A2']), trim($_GET['dni']), trim($_GET['mail']), trim($_GET['nacimiento']), trim($_GET['tele']), trim($_GET['dire']), trim($_GET['idMun']), trim($_GET['sex']));
}
$newUser = loadUserxDNI($db_con, trim($_GET['dni']));
regTeaching($db_con, $newUser['idUsuarios'], trim($_GET['titulo']));
exit();


function regTeaching($db_con, $idUsu, $titulo){
    $sentDoc = $db_con->prepare('
        SELECT
            Instituciones_idInstituciones
        FROM 
            Docentes
        WHERE
            idDocentes=:id
    ');
    
    $sentDoc->execute(array(':id' => $idUsu));
    while($resultDoc = $sentDoc->fetch(PDO::FETCH_ASSOC)){
    //El docente ya esta registrado en la tabla
        $isDocent = true;
        if($resultDoc['Instituciones_idInstituciones'] == $_SESSION['Usuario']->getId_Colegio()){
            //El usuario ya esta registrado como docente en la misma institucion
            echo '2';
            exit();
        }
    }
    
    $sentReg = $db_con->prepare('
            INSERT INTO 
                Docentes
                    (idDocentes, Instituciones_idInstituciones, idReg)
            VALUES (
                :v1,
                :v2,
                :v3
            )'
        );
    $sentReg->execute(array(':v1' => $idUsu, ':v2'=>$_SESSION['Usuario']->getId_Colegio(), ':v3'=>$_SESSION['Usuario']->getId()));
    
    //Si la persona no estaba registrada antes como docente.
    if($isDocent==null){
        //Verificar si el titulo enviado ya existe.
        $sentTitulo = $db_con->prepare('SELECT idTitulos FROM Titulos WHERE Titulo=:tit');
        $sentTitulo->execute(array(':tit'=>trim($titulo)));
        
        if($Result = $sentTitulo->fetch(PDO::FETCH_ASSOC)){
            $sentRegDoc_has_Titu = $db_con->prepare('
                INSERT INTO 
                Docentes_has_Titulos
                    (Docentes_idDocentes, Titulos_idTitulos)
                VALUES (:v1, :v2)');
            $sentRegDoc_has_Titu->execute(array(':v1'=>$idUsu, ':v2'=> $Result['idTitulos']));
        }else{
            $sentRegTitul = $db_con->prepare('
                INSERT INTO Titulos
                    (Titulo, idReg)
                VALUES
                (:v1, :v2)'
            );
            $sentRegTitul->execute(array(':v1' => $titulo, ':v2'=>$_SESSION['Usuario']->getId()));
            $sentTitulo = $db_con->prepare('SELECT idTitulos FROM Titulos WHERE Titulo=:tit');
            $sentTitulo->execute(array(':tit'=>trim($titulo)));       
            $Result = $sentTitulo->fetch(PDO::FETCH_ASSOC);
            $sentRegDoc_has_Titu = $db_con->prepare('
                INSERT INTO 
                Docentes_has_Titulos
                    (Docentes_idDocentes, Titulos_idTitulos)
                VALUES (:v1, :v2)');
            $sentRegDoc_has_Titu->execute(array(':v1'=>$idUsu, ':v2'=> $Result['idTitulos']));
        }
    }
    
    echo '1'; //Registro exitoso
    exit();
}