<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="icon" type="image/ico" href="images/logo_II.ico" />
        <title>Brection</title>
        <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/libSweet/sweetalert.min.js"></script>
        <link rel="stylesheet" href="js/libSweet/sweetalert.css" type="text/css"/>
        <link rel="stylesheet" href="styles/fonts/Sites/style.css"/>
        <link rel="stylesheet" href="styles/css/header.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/indexTeaching.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/scrollbar.css?<?php echo time(); ?>" type="text/css" />
    </head>

    <body>
		<noscript>
			<meta http-equiv="Refresh" content="0; URL=../Controlador/logout.php">
		</noscript>        
		
		<header>
            <img src="images/logo.png"></img>
            <a href="javascript:mostrar('logoutOption', 'black')" id="logout"><i class="icon icon-exit_to_app"></i></a>
            <a href="javascript:mostrar('settingPanel', 'black')" id="setting"><i class="icon icon-settings"></i></a>
        </header>
        
        <div id="black" class="oculto"></div>
        
        <div id="logoutOption" class="oculto">
            <span>¿Que desea hacer?</span>
            <a href="javascript:cerrar('logoutOption', 'black')" id="cerrar"><i class="icon icon-highlight_off"></i></a>
            <a href="previous.php" id="change"><i class="icon icon-people_outline"></i>Cambiar de Usuario</a>
            <a href="../Controlador/logout.php" id="exit"><i class="icon icon-exit_to_app"></i>Cerrar Sesion</a>
        </div>
        
        <div id="settingPanel" class="oculto">
            <div id="encabezado">
                <a href="javascript:cerrar('settingPanel', 'black')" id="cerrar"><i class="icon icon-highlight_off"></i></a>
                <p id="Title">Datos Personales</p>
            </div>
            <img src="images/joel.jpg" id="perfil"></img>
            <p id="Nombre"><sup>Nombre:</sup> Joel David Alvarez Ayola</p><hr>
            <p id="DNI"><sup>DNI:</sup> 1083024028</p><hr>
            <p id="Correo_Personal"><sup>Correo Personal:</sup> Jalay1111@gmail.com  <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Usuario"><sup>Usuario:</sup> joelalvarezda@academiactual.com</p><hr>
            <p id="password">Contraseña  <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Telefono"><sup>Telefono:</sup> 3007501325  <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Direccion"><sup>Direccion:</sup> Calle 20 #17-16  <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Nacimiento"><sup>Fecha Nacimiento:</sup> 20 Abril 1997</p><hr>
            <p id="Sexo"><sup>Sexo:</sup> Masculino</p>
            <p></p>
        </div>
        
        <div id="saludo">
            <span id="hola">
                Hola, esta es tu seccion como Docente que eres.
                <br>
                <span id="dis">¡Disfrutala!</span>
            </span>
        </div>
    </body>
</html>

<script language="javascript">
    $(document).ready(function(){
        swal("Bienvenido", "", "success");
    })
    
    var zIndex = 0;
    
    function mostrar(container, black){
        $("#"+black).hide();
        $("#"+black).css("visibility", "visible");
        if(black=='black'){
            document.getElementById('black').style.height="100%";
        }
        zIndex++;
        document.getElementById(black).style.zIndex=zIndex;
        $("#"+black).fadeIn(200);
        $("#"+container).hide();
        $("#"+container).css("visibility", "visible")
        zIndex++;
        document.getElementById(container).style.zIndex=zIndex;
        $("#"+container).fadeIn(200);
    }
    
    function cerrar(container, black){
        zIndex--;
        $("#"+container).fadeOut(200, function(){
            document.getElementById(container).style.zIndex=zIndex;
        });
        if(black!=''){
            zIndex--;
            $("#"+black).fadeOut(200,function(){
                document.getElementById(black).style.zIndex=zIndex;
            });
        }
    }
</script>