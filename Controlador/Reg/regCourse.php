<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();

$idgrado = $_GET['idGrado'];
$cupo = $_GET['CpMax'];

if(($cupo=="") or ($cupo==null) or ($idgrado=="0") or ($idgrado=="") or ($idgrado==null)){
   echo "0" ;
   exit();
}
$sentCurso = $db_con->prepare('
    SELECT 
        Curso
    FROM
        Cursos
    WHERE
        Instituciones_idInstituciones=:idI
        AND
        Grados_idGrado=:idG
');

$sentCurso->execute(array(':idI'=>$_SESSION['Usuario']->getId_Colegio(), ':idG'=>$idgrado));

while($result = $sentCurso->fetch(PDO::FETCH_ASSOC)){
    $copiaResult = $result;
}
if($copiaResult['Curso'] == null){
    $curso = "A";
}else{
    $curso = ++$copiaResult['Curso'];
}

$sentRegCurso = $db_con->prepare('
    INSERT INTO
        Cursos (Curso, Grados_idGrado, CupoMax, idReg, Instituciones_idInstituciones)
    VALUES
        (:v1, :v2, :v3, :v4, :v5)
');

$sentRegCurso->execute(array(':v1'=>$curso, ':v2'=>$idgrado, ':v3'=>$cupo, ':v4'=> $_SESSION['Usuario']->getId(), ':v5'=>$_SESSION['Usuario']->getId_Colegio()));
echo "1";