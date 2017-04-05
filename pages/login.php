<?php
	require_once '../Controlador/Usuarios/Acudientes.php';
	require_once '../Controlador/Usuarios/Administrativos.php';
	require_once '../Controlador/Usuarios/Docentes.php';
	require_once '../Controlador/Usuarios/Estudiantes.php';
	session_start();
	if($_SESSION['Usuario']){
		header("location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Brection</title>
		<link rel="icon" type="image/ico" href="images/logo_II.ico" />
		<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
		<link rel="stylesheet" href="styles/css/login.css?<?php echo time(); ?>" type="text/css"/>
	</head>
	<body>
		<noscript>
			<meta http-equiv="Refresh" content="0; URL=activeJS.html">
		</noscript>
		<script type="text/javascript">
			function foco(){
				document.getElementById("user").focus();
			}
		</script>
		<div id="form">
			<img src="images/logo.png"></img>
			<form id="form" method="POST" onsubmit="return false;">
				<input type="text" class="input" id="user" max-length="300" required/><i id="usertext">Usuario:</i>
			    <input type="password" class="input" id="password" max-length="300" required/><i id="passwordtext">Contraseña:</i>
				<span id="result"></span>
				<input type="submit" name="login" id="login" value="Iniciar Sesion"/>
			</form>
		</div>
	</body>
</html>

<script>
	$(document).ready(function(){
		$('#login').click(function(){

			if($.trim(user).length > 0 && $.trim(password).length > 0){
				$.ajax({
					url:"../Controlador/logueame.php",
					method:"POST",
					data:{user:$('#user').val(), pass:$('#password').val()},
					cache:"false",
					beforeSend:function(){
						$('#login').val("Conectando...");
					},
					success:function(data){ 
						$('#login').val("Iniciar sesion");
						if (data=="1") {
							$(location).attr('href','../index.php');
						}else{
							$("#result").html("<div class='Cambiar clase'><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
							document.getElementById("user").focus();
							document.getElementById("password").value = '';
						}
					}
				});
			};
		});
	});
</script>