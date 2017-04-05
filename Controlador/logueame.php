<?php
session_start();
require_once '../Modelo/PDOConex.php';
$user = explode("@",trim($_POST['user']));
if((!$nameUser = $user[0]) || (!$password = md5(trim($_POST['pass']) ) ) ){
	header('location:../');
}

try{
	$stmt = $db_con->prepare('SELECT 
		idUsuarios, Contra FROM Usuarios WHERE Cuenta=:usuario');
	$stmt->execute(array(':usuario'=>$nameUser));
	$fila = $stmt->fetch(PDO::FETCH_ASSOC);

	if($fila['Contra']==$password){ //Credenciales correctas
		echo '1';
		$_SESSION['Usuario'] = true;
		$_SESSION['idUsuario'] = $fila['idUsuarios'];
		require_once 'Log/getTipo.php';
		getTipo($fila['idUsuarios'], $db_con);
	}else{
		echo '0'; // Credenciales incorrectas
	}
}catch(PDOException $e){
	echo $e->getMessage();
}
?>