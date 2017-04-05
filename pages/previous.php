<?php
require_once '../Modelo/PDOConex.php';
session_start();
if(!$_SESSION['Usuario']){ 
	header('location:../Controlador/logout.php');
	exit();
}

if ((count($_SESSION['Admins'])==1) and (count($_SESSION['Doc'])==0) and (count($_SESSION['Est'])==0) and (count($_SESSION['Acud'])==0)){
	$_SESSION['Doc']=null;
	$_SESSION['Est']=null;
	$_SESSION['Acud']=null;
	header('location:../Controlador/Log/logAdmin.php?direct=true&Ins='.$_SESSION['Admins'][0]['Instituciones_idInstituciones'].'&Carg='.$_SESSION['Admins'][0]['Cargos_idCargos']);
	exit();
}else{
	if((count($_SESSION['Admins'])==0) and (count($_SESSION['Doc'])==1) and (count($_SESSION['Est'])==0) and (count($_SESSION['Acud'])==0)){
		$_SESSION['Admins']=null;
		$_SESSION['Est']=null;
		$_SESSION['Acud']=null;
		header('location:../Controlador/Log/logTeaching.php?direct=true&idIns='.$_SESSION['Doc'][0]['Instituciones_idInstituciones']);
		exit();
	}else{
		if((count($_SESSION['Admins'])==0) and (count($_SESSION['Doc'])==0) and (count($_SESSION['Est'])==1) and (count($_SESSION['Acud'])==0)){
			$_SESSION['Admins']=null;
			$_SESSION['Doc']=null;
			$_SESSION['Acud']=null;
			header('location:../Controlador/Log/logStudent.php?direct=true&idCurso='.$_SESSION['Est'][0]['Cursos_idCursos']);
			exit();
		}else{
			if((count($_SESSION['Admins'])==0) and (count($_SESSION['Doc'])==0) and (count($_SESSION['Est'])==0) and (count($_SESSION['Acud'])==1)){
				$_SESSION['Admins']=null;
				$_SESSION['Doc']=null;
				$_SESSION['Est']=null;
				header('location:../Controlador/Log/logAttendant.php?direct=true&idEst='.$_SESSION['Acud'][0]['idEstudiantes']);
				exit();
			}
		}
	}
}?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/ico" href="images/logo_II.ico"/>
		<title>Brection</title>
		<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
		<script type="text/javascript" src="js/libSweet/sweetalert.min.js"></script>
		<link rel="stylesheet" href="js/libSweet/sweetalert.css" type="text/css"/>
		<link rel="stylesheet" href="styles/css/previous.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/fonts/Sites/style.css"/>
	</head>
	<body>
		<noscript>
			<meta http-equiv="Refresh" content="0; URL=../Controlador/logout.php">
		</noscript>
        
		<a href="../Controlador/logout.php" id="logout"><i class="icon icon-exit_to_app"></i></a>
		
		<div id="admin" class="type">
			<!--<div id="preloader"></div>-->
		</div>
		<div id="teaching" class="type">
			<!--<div id="preloader"></div>-->
		</div>
		<div id="attendent" class="type">
			<!--<div id="preloader"></div>-->
		</div>
		<div id="student" class="type">
			<!--<div id="preloader"></div>-->
		</div>
		<div id="preloader"></div>
	</body>
</html>


<script type="text/javascript">

	function accAdmin(id, idC){
		mostrar(id, 1);
		logAd(id, idC)
	}
	
	function accTeaching(id){
		mostrar(id, 2);
		logTeaching(id);
	}
	
	function accStudent(id){
		mostrar(id, 3);
		logStudent(id);
	}
	
	function accAttendement(id){
		mostrar(id,4);
		logAttendement(id)
	}
	
    function mostrar(id, clase){
    	if(clase==1){
    		clase="admin";
    	}else if(clase==2){
    		clase="Teaching";
    	}else if(clase==3){
    		clase = "Student";
    	}else if(clase==4){
    		clase="Attendement"
    	}
    	$("div#spinner."+clase+id).show();
		$("div#spinner."+clase+id).css("visibility", "visible");
		$("div#spinner."+clase+id).fadeIn(300);
	}

	$(document).ready(function(){
		$(".type").hide();
		
		var getAdmin = function(){
			return $.getJSON("../Controlador/pres/preAdmin.php");
		}
		
		var getDocente = function(){
			return $.getJSON("../Controlador/pres/preTeaching.php");
		}
		
		var getEstudiante = function(){
			return $.getJSON("../Controlador/pres/preStudent.php");
		}
		
		var getAcudiente = function(){
			return $.getJSON("../Controlador/pres/preAttendant.php");
		}

		getAdmin().done(function(respuesta){
			if(respuesta.success){
				var output = "<table><caption>Administrativo</caption><tr><th>Institucion</th><th>Cargo</th><th>Acceder</th><th id='carga'></th>";
				for(var i = respuesta.num - 1; i >= 0; i--){
					output += "<tr><td>";
					output += respuesta.data.Instituciones[i] + "</td>";
					output += "<td>" + respuesta.data.Cargos[i] + "</td>";
					output += "<td><button id='btnAdmin' onclick='accAdmin("+respuesta.data.IdInstituciones[i].toString()+", " + respuesta.data.IdCargos[i].toString()+")'>Acceder</button></td>"; 
					output += "<td id='carga_td'><div id='spinner'class='admin"+respuesta.data.IdInstituciones[i].toString()+"'></div></td>";
				}
				output += "</table>";
				$("#admin").html(output);
				$("#admin").fadeIn(400);
			}else{
				$("#admin").html("");
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
				$("#admin").html("Algo ha fallado: " + textStatus);
		}).always(function(){
			document.getElementById('admin').style.height='auto';
		});
		
		getDocente().done(function(respuesta){
			if(respuesta.success){
				var output = "<table id='tDoc'><caption>Docente</caption><tr><th>Institucion</th><th>Acceder</th>";
				for(var i = respuesta.num - 1; i >= 0; i--){
					output += "<tr><td>";
					output += respuesta.data.Instituciones[i] + "</td>";
					output += "<td><button id='prueba' onclick=accTeaching("+ respuesta.data.IdInstituciones[i].toString()+")>Acceder</td>";
					output += "<td id='carga_td'><div id='spinner'class='Teaching"+respuesta.data.IdInstituciones[i] + "'></div></td>";
				}
				output += "</table>";
				$("#teaching").html(output);
				$("#teaching").fadeIn(400);
			}else{
				$("#teaching").html("");
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			$("#teaching").html("Algo ha fallado: " + textStatus);
		}).always(function(){
			document.getElementById('teaching').style.height='auto';
		});

		getAcudiente().done(function(respuesta){
			if(respuesta.success){
				var output = "<table><caption>Acudiente</caption><tr><th>Estudiante</th><th>Iniciar</th></tr>";
				for(var i = respuesta.num - 1; i >= 0; i--){
					output += "<tr><td>";
					output += respuesta.data.Nombre[i] + "</td><td>";
					output += "<button onclick=accAttendement("+ respuesta.data.idEstudiantes[i] + ")> Iniciar </button>";
					output += "<td id='carga_td'><div id='spinner'class='Attendement"+respuesta.data.idEstudiantes[i]+"'></div></td>";
				}
				output += "</table>";
				$("#attendent").html(output);
				$("#attendent").fadeIn(400);
			}else{
				$("#attendent").html("");
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			$("#attendent").html("Algo ha fallado: " + textStatus);
		}).always(function(){
			document.getElementById('attendent').style.height='auto';
		});
		
		getEstudiante().done(function(respuesta){
		    if(respuesta.success){
		    	var output = "<table><caption>Estudiante</caption><tr><th>Curso</th><th>Iniciar</th></tr>";
		    	output += "<tr><td>"+respuesta.data.Grado + " "+respuesta.data.Curso + "</td>";
		    	output += "<td><button onclick=accStudent("+respuesta.data.IdCurso+")> Iniciar </button></td>";
		    	output += "<td id='carga_td'><div id='spinner'class='Student"+respuesta.data.IdCurso+"'></div></td>";
		    	output += "</table>";
		    	$("#student").html(output);
		    	$("#student").fadeIn(400);
		    }else{
		    	$("#student").html("");
		    }
		}).fail(function(jqXHR, textStatus, errorThrown) {
			$("#student").html("Algo ha fallado: " + textStatus);
		}).always(function(){
			$("#preloader").fadeOut(300);
			document.getElementById('student').style.height='auto';
		});

	});
	
	function logAd(idI, idC){
		$.ajax({
			url: "../Controlador/Log/logAdmin.php",
			data: {Ins: idI, Carg: idC},
			success: function(respuesta){
				if(respuesta=='1'){
					$(location).attr('href','indexAdmin.php');
				}else{
					swal({
						title: "Ops....",
						text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
						type: "error"
					},
					function(isConfirm){
						if(isConfirm){
							$(location).attr('href','../Controlador/logout.php');
						}
					});
				}
			},
			error:function(xhr, status){
    			swal({
						title: "Ops....",
						text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
						type: "error"
					},
					function(isConfirm){
						if(isConfirm){
							$(location).attr('href','../Controlador/logout.php');
						}
					});
			},
			beforeSend:function(){
				mostrar('loader', 'container_loaderAdd_black');
			}
		})
	}
	
	function logStudent(id){
		$.ajax({
			url:"../Controlador/Log/logStudent.php",
			data:{idCurso:id},
			success:function(data){
				if(data=='1'){
					$(location).attr('href','indexStudent.php');
				}else{
					swal({
						title: "Ops....",
						text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
						type: "error"
					},
					function(isConfirm){
						if(isConfirm){
							$(location).attr('href','../Controlador/logout.php');
						}
					});
				}
			},
			beforeSend:function(){
				mostrar('loader', 'container_loaderAdd_black');
			},
			error:function(){
				swal({
					title: "Ops....",
					text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
					type: "error"
				},
				function(isConfirm){
					if(isConfirm){
						$(location).attr('href','../Controlador/logout.php');
					}
				});
			}
		})
	}
	
	function logTeaching(idI){
		$.ajax({
			url: "../Controlador/Log/logTeaching.php",
			data:{idIns:idI},
			success:function(data){
				if(data=='1'){
					$(location).attr('href','indexTeaching.php');
				}else{
					swal({
						title: "Ops....",
						text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
						type: "error"
					},
					function(isConfirm){
						if(isConfirm){
							$(location).attr('href','../Controlador/logout.php');
						}
					});
				}
			},
			beforeSend:function(){
				mostrar('loader', 'container_loaderAdd_black');
			},
			error:function(){
				swal({
						title: "Ops....",
						text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
						type: "error"
					},
					function(isConfirm){
						if(isConfirm){
							$(location).attr('href','../Controlador/logout.php');
						}
					});
			}
		})
	}
	
	function logAttendement(idE){
		$.ajax({
			url: "../Controlador/Log/logAttendant.php",
			data:{idEst:idE},
			success:function(data){
				if(data=='1'){
					$(location).attr('href','indexAttendant.php');
				}else{
					swal({
						title: "Ops....",
						text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
						type: "error"
					},
					function(isConfirm){
						if(isConfirm){
							$(location).attr('href','../Controlador/logout.php');
						}
					});
				}
			},
			beforeSend:function(){
				mostrar('loader', 'container_loaderAdd_black');
			},
			error:function(){
				swal({
					title: "Ops....",
					text: "Lo sentimos, ha ocurrido un error, comuniquese con el administrador",
					type: "error"
				},
				function(isConfirm){
					if(isConfirm){
						$(location).attr('href','../Controlador/logout.php');
					}
				});
			}
		})
	}
</script>