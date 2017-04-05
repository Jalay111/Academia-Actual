<?php
require_once "../../Modelo/PDOConex.php";
session_start();
$est = array();
if($_SESSION['Tipo'][2] =='Estudiante'){
    rellenarEstudiante($db_con, $est);
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($est, JSON_FORCE_OBJECT);
exit();

function rellenarEstudiante($db_con, &$est){
    try{
        $est['success'] = true;
        $sentCurso = $db_con->prepare('SELECT Curso, Grados_idGrado FROM Cursos WHERE idCursos=:id');
        $sentCurso->execute(array(':id' => $_SESSION['Est']['Cursos_idCursos']));
        $resultCurso = $sentCurso->fetch(PDO::FETCH_ASSOC);
    
        $sentGrado = $db_con->prepare('SELECT Grado FROM Grados WHERE idGrado= :id');
        $sentGrado->execute(array(':id' => $resultCurso['Grados_idGrado']));
        $resultGrado = $sentGrado->fetch(PDO::FETCH_ASSOC);
    
        $est['data']['Grado'] = $resultGrado['Grado'];
        // $est['data']['IdGrado'] = $resultCurso['Grados_idGrado'];
        $est['data']['Curso'] = $resultCurso['Curso'];
        $est['data']['IdCurso'] = $_SESSION['Est']['Cursos_idCursos'];
    }catch(PDOException $e){
	    echo $e->getMessage();
    }
}