<?php
require_once '../../Modelo/PDOConex.php';
require_once '../Usuarios/Administrativos.php';
session_start();
$idgrado = $_GET['idGrado'];

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
    echo "A";
}else{
    $curso = ++$copiaResult['Curso'];
    echo $curso;
}