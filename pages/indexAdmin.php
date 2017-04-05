<?php
    require_once '../Controlador/Usuarios/Administrativos.php';
    session_start();
    if($_SESSION['Usuario']==null){
        header('location:../Controlador/logout.php');
        exit();
    }
    if(($_SESSION['TypeUsing']!='Administrativo')){
        header('location:previus.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="icon" type="image/ico" href="images/logo_II.ico" />
        <title>Brection</title>
        <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/libSweet/sweetalert2.min.js"></script>
        <script type="text/javascript" src="js/jquery.quicksearch.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <link href="js/calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET"/>
        <link rel="stylesheet" href="styles/css/indexAdmin.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/header.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/indexAdmin_two.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/scrollbar.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/selectAdmin.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/selectAttendent.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/selectTeaching.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/selectStudent.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/scrollbar.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/selectAchievement.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/selectCourse.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="styles/css/containerSelected.css?<?php echo time(); ?>" type="text/css" />
        <link rel="stylesheet" href="js/libSweet/sweetalert2.min.css" type="text/css"/>
        <link rel="stylesheet" href="styles/fonts/Entypo/style.css"/>
        <link rel="stylesheet" href="styles/fonts/Sites/style.css"/>
        <link rel="stylesheet" href="styles/css/jquery-ui.css">
        
    </head>

    <body>
		<noscript>
			<meta http-equiv="Refresh" content="0; URL=../Controlador/logout.php">
		</noscript>        
		
		<header>
            <img src="images/logo.png"></img>
            <a href="javascript:mostrar('logoutOption', 'black', null)" id="logout"><i class="icon icon-exit_to_app"></i></a>
            <a href="javascript:callPanel()" id="setting"><i class="icon icon-settings"></i></a>
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
            <p id="Nombre"><sup>Nombre:</sup> /p><hr>
            <p id="DNI"><sup>DNI:</sup> </p><hr>
            <p id="Correo_Personal"><sup>Correo Personal:</sup> <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Usuario"><sup>Usuario:</sup> </p><hr>
            <p id="password">Contraseña  <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Telefono"><sup>Telefono:</sup>  <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Direccion"><sup>Direccion:</sup> <a href="#" id="setting_icon"><i class="icon icon-mode_edit"></i></a></p><hr>
            <p id="Nacimiento"><sup>Fecha Nacimiento:</sup></p><hr>
            <p id="Sexo"><sup>Sexo:</sup> </p>
            <p></p>
        </div>
        
        <div id="see_one">
            <div id="body-one">
                
                <h1 id="users"><span class="icon icon-people"></span>Usuarios</h1>
                
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-one" name="student" class="select">
                    <i>Estudiantes</i>
                </a>
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-one" name="teaching" class="select">
                    <i>Docentes</i>
                </a>
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-one" name="attendent" class="select">
                    <i>Acudientes</i>
                </a>
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-one" name="admin" class="select">
                    <i>Administradores</i>
                </a>
            </div>
            
            <div id="body-two">
                <h1 id="others"><span class="icon icon-library_books"></span>Componentes</h1>
                <a href="javascript: mostrar('container_selected', 'black', null)" id="container-body-two" name="course" class="select">
                    <i>Cursos</i>
                </a>
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-two" name="achievement" class="select">
                    <i>Asignaturas</i>
                </a>
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-two" name="money" class="select">
                    <i>Economia</i>
                </a>
                <a href="javascript:mostrar('container_selected', 'black', null)" id="container-body-two" name="institution" class="select">
                    <i>Institucion</i>
                </a>
            </div>
            <a href="javascript:next()" id="next"><i class="icon icon-navigate_next"></i></a>
        
            <div id="container_selected" class="oculto">
                <a href="javascript:cerrar('container_selected', 'black')" id="cerrar"><i class="icon icon-highlight_off"></i></a>
                
                <form id="search" action="">
                  <input type="text" max-length="20" placeholder="Buscar" id="search_input"/>
                  <a><i class="icon icon-search"></i></a>
                </form>
                
                <div id="crear-btn">
                </div>
                
                <div id="container_table">
                    <div id="preloader"></div>
                </div>
                
                <div id="black_add" class="oculto">
                    <div id="add_student">
                        <div id="encabezado_add_student">
                            <span id="Title_student">Datos del Estudiante</span>
                            <a href="javascript:cerrar('add_student', 'black_add')" id="cerrar_add_student"><i class="icon icon-highlight_off"></i></a>
                        </div>
                        <input id="DNI" class="add_student_field" type="text" max-length="20"/><p id="DNI">Documento de Identidad</p><a id="cargarDatos" href="javascript:loadDatas('add_student_field')"><i class="icon icon-search"></i></a>
                        <input id="Nombre_I" class="add_student_field" type="text" max-length="20"/><p id="Nombre_I">Primer Nombre</p>
                        <input id="Nombre_II" class="add_student_field" type="text" max-length="20"/><p id="Nombre_II">Segundo Nombre</p>
                        <input id="Apellido_I" class="add_student_field" type="text" max-length="20"/><p id="Apellido_I">Primer Apellido</p>
                        <input id="Apellido_II" class="add_student_field" type="text" max-length="20"/><p id="Apellido_II">Segundo Apellido</p>
                        <input id="Correo" class="add_student_field" type="text" max-length="20"/><p id="Correo">Correo Electronico</p>
                        <input id="Direccion" class="add_student_field" type="text" max-length="20"/><p id="Direccion">Direccion Residencial</p>
                        <select id="Departamentos" class="add_student_field"></select><p id="Departamentos">Departamentos</p>
                        <select id="Ciudades" class="add_student_field"></select><p id="Ciudades">Ciudades</p>
                        <input id="Nacimiento" class="add_student_field" type="date" name="fecha" class="campofecha" max-length="20"/><p id="Nacimiento">Fecha de Nacimiento</p>
                        <input id="Telefono" class="add_student_field" type="text" max-length="20"/><p id="Telefono">Telefono</p>
                        <input id="DNI_acudiente" class="add_student_field" type="text" max-length="20"/><p id="DNI_acudiente">Documento de Indentidad del Acudiente</p><a id="cargarAcudiente" href="javascript:loadNameAttendentOfStudent()"><i class="icon icon-search"></i></a>
                        <select id="Sexo" class="add_student_field">
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                        </select><p id="Sexo">Sexo</p>
                        <input id="Curso" class="add_student_field" type="text" max-length="20" readonly="readonly"/><p id="Curso">Curso</p><a href="javascript:mostrar('courseStudent', 'black_add_one', true)" id="see_course"><i class="icon icon-list"></i></a>
                        <a href="javascript:regStudent()" id="save"><i class="icon icon-check"></i></a>
                    </div>
                    <div id="black_add_one" class="oculto">
                        <div id="courseStudent">
                            <a href="javascript:cerrar('courseStudent', 'black_add_one')" id="cerrar_courseStudent"><i class="icon icon-highlight_off"></i></a>
                            <select id="GradoStudent" class="add_course_field">
                            </select><p id="Grado">Grado</p>
                            <div id="Grades_student">
                                <!--<div class="item">-->
                                <!--    <span id="Curso">A</span>-->
                                <!--    <span id="Capacidad">34/42</span>-->
                                <!--    <hr>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="black_add" class="oculto">
                    <div id="add_teaching">
                        <div id="encabezado_add_teaching">
                            <span id="Title_teaching">Datos del Docente</span>
                            <a href="javascript:cerrar('add_teaching', 'black_add')" id="cerrar_add_teaching"><i class="icon icon-highlight_off"></i></a>
                        </div>
                        <input id="DNI" class="add_teaching_field" type="text" max-length="20"/><p id="DNI">Documento de Identidad</p><a id="cargarDatos" href="javascript:loadDatas('add_teaching_field')"><i class="icon icon-search"></i></a>
                        <input id="Nombre_I" class="add_teaching_field" type="text" max-length="20"/><p id="Nombre_I">Primer Nombre</p>
                        <input id="Nombre_II" class="add_teaching_field" type="text" max-length="20"/><p id="Nombre_II">Segundo Nombre</p>
                        <input id="Apellido_I" class="add_teaching_field" type="text" max-length="20"/><p id="Apellido_I">Primer Apellido</p>
                        <input id="Apellido_II" class="add_teaching_field" type="text" max-length="20"/><p id="Apellido_II">Segundo Apellido</p>
                        <input id="Correo" class="add_teaching_field" type="email" max-length="20"/><p id="Correo">Correo Electronico</p>
                        <input id="Direccion" class="add_teaching_field" type="text" max-length="20"/><p id="Direccion">Direccion Residencial</p>
                        <select id="Departamentos" class="add_teaching_field"></select><p id="Departamentos">Departamentos</p>
                        <select id="Ciudades" class="add_teaching_field"></select><p id="Ciudades">Ciudades</p>
                        <input id="Nacimiento" class="add_teaching_field" type="date" name="fecha" class="campofecha" max-length="20"/><p id="Nacimiento">Fecha de Nacimiento</p>
                        <input id="Telefono" class="add_teaching_field" type="number" max-length="20"/><p id="Telefono">Telefono</p>
                        <input id="Titulo_academico" data-source="../Controlador/load/autoTitulos.php?search=" class="add_teaching_field" type="text" max-length="20"/><p id="Titulo_academico">Titulo Academico</p>
                        <select id="Sexo" class="add_teaching_field">
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                        </select><p id="Sexo">Sexo</p>
                        <a href="javascript:regTeaching('add_teaching', 'black_add')" id="save"><i class="icon icon-check"></i></a>
                    </div>
                </div>
                
                <div id="black_add" class="oculto">
                    <div id="add_attendent">
                        <div id="encabezado_add_attendent">
                            <span id="Title_attendent">Datos del Acudiente</span>
                            <a href="javascript:cerrar('add_attendent', 'black_add')" id="cerrar_add_attendent"><i class="icon icon-highlight_off"></i></a>
                        </div>
                        <input id="DNI" class="add_attendent_field" type="text" max-length="20"/><p id="DNI">Documento de Identidad</p><a id="cargarDatos" href="javascript:loadDatas('add_attendent_field')"><i class="icon icon-search"></i></a>
                        <input id="Nombre_I" class="add_attendent_field" type="text" max-length="20"/><p id="Nombre_I">Primer Nombre</p>
                        <input id="Nombre_II" class="add_attendent_field" type="text" max-length="20"/><p id="Nombre_II">Segundo Nombre</p>
                        <input id="Apellido_I" class="add_attendent_field" type="text" max-length="20"/><p id="Apellido_I">Primer Apellido</p>
                        <input id="Apellido_II" class="add_attendent_field" type="text" max-length="20"/><p id="Apellido_II">Segundo Apellido</p>
                        <input id="Correo" class="add_attendent_field" type="text" max-length="20"/><p id="Correo">Correo Electronico</p>
                        <input id="Direccion" class="add_attendent_field" type="text" max-length="20"/><p id="Direccion">Direccion Residencial</p>
                        <select id="Departamentos" class="add_attendent_field"></select><p id="Departamentos">Departamentos</p>
                        <select id="Ciudades" class="add_attendent_field"></select><p id="Ciudades">Ciudades</p>
                        <input id="Nacimiento" class="add_attendent_field" type="date" name="fecha" class="campofecha" max-length="20"/><p id="Nacimiento">Fecha de Nacimiento</p>
                        <input id="Telefono" class="add_attendent_field" type="text" max-length="20"/><p id="Telefono">Telefono</p>
                        <select id="Sexo" class="add_attendent_field">
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                        </select><p id="Sexo">Sexo</p>
                        <a href="javascript:regAttendent()" id="save"><i class="icon icon-check"></i></a>
                    </div>
                </div>
                
                <div id="black_add" class="oculto">
                    <div id="add_admin">
                        <div id="encabezado_add_admin">
                            <span id="Title_admin">Datos del Administrador</span>
                            <a href="javascript:cerrar('add_admin', 'black_add')" id="cerrar_add_admin"><i class="icon icon-highlight_off"></i></a>
                        </div>
                        <input id="DNI" class="add_admin_field" type="text" max-length="20"/><p id="DNI">Documento de Identidad</p><a id="cargarDatos" href="javascript:loadDatas('add_admin_field')"><i class="icon icon-search"></i></a>
                        <input id="Nombre_I" class="add_admin_field" type="text" max-length="20"/><p id="Nombre_I">Primer Nombre</p>
                        <input id="Nombre_II" class="add_admin_field" type="text" max-length="20"/><p id="Nombre_II">Segundo Nombre</p>
                        <input id="Apellido_I" class="add_admin_field" type="text" max-length="20"/><p id="Apellido_I">Primer Apellido</p>
                        <input id="Apellido_II" class="add_admin_field" type="text" max-length="20"/><p id="Apellido_II">Segundo Apellido</p>
                        <input id="Correo" class="add_admin_field" type="text" max-length="20"/><p id="Correo">Correo Electronico</p>
                        <input id="Direccion" class="add_admin_field" type="text" max-length="20"/><p id="Direccion">Direccion Residencial</p>
                        <select id="Departamentos" class="add_admin_field"></select><p id="Departamentos">Departamentos</p>
                        <select id="Ciudades" class="add_admin_field"></select><p id="Ciudades">Ciudades</p>
                        <input id="Nacimiento" class="add_admin_field" type="date" name="fecha" class="campofecha" max-length="20"/><p id="Nacimiento">Fecha de Nacimiento</p>
                        <input id="Telefono" class="add_admin_field" type="text" max-length="20"/><p id="Telefono">Telefono</p>
                        <select id="Sexo" class="add_admin_field">
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                        </select><p id="Sexo">Sexo</p>
                        <input id="Cargo" class="add_admin_field" type="text" max-length="20" placeholder="ejemplo: Coordinador Academico"/><p id="Cargo">Cargo</p>
                        <select id="Visibilidad" class="add_admin_field">
                            <option value="1">Basico</option>
                        </select><p id="Visibilidad">Visibilidad</p>
                        <a href="javascript:regAdmin()" id="save"><i class="icon icon-check"></i></a>
                    </div>
                </div>
                
                <div id="black_add" class="oculto">
                    <div id="add_course">
                        <div id="encabezado_add_course">
                            <span id="Title_course">Caracteristicas del Curso</span>
                            <a href="javascript:cerrar('add_course', 'black_add')" id="cerrar_add_course"><i class="icon icon-highlight_off"></i></a>
                        </div>
                        <select id="Grado" class="add_course_field">
                        </select><p id="Grado">Grado</p>
                        <input id="Curso" class="add_course_field" type="text" max-length="20" readonly="readonly"/><p id="Curso">Curso</p>
                        <input id="Cupo" class="add_course_field" type="number" max-length="20"/><p id="Cupo">Cupo Maximo</p>
                        <a href="javascript:regCourse()" id="save"><i class="icon icon-check"></i></a>
                    </div>
                </div>
                
                <div id="black_add" class="oculto">
                    <div id="add_achievement">
                        <div id="encabezado_add_achievement">
                            <span id="Title_achievement">Caracteristicas de Asignatura</span>
                            <a href="javascript:cerrar('add_achievement', 'black_add')" id="cerrar_add_achievement"><i class="icon icon-highlight_off"></i></a>
                        </div>
                        <input id="Area" class="add_achievement_field" type="text" max-length="20"/><p id="Area">Area</p>
                        <input id="Porcent" class="add_achievement_field" type="text" placeholder="100%" max-length="20" readonly="readonly"/><p id="Porcent">Porcent.</p>
                        <input id="Principal" name="tipo_materia" value="Pincipal" class="add_achievement_field" type="radio" checked/><span id="Principal">Principal</span>
                        <input id="Secundaria" name="tipo_materia" value="Secundaria" class="add_achievement_field" type="radio"/><span id="Secundaria">Secundaria</span>
                        <input id="Docente" class="add_achievement_field" type="text" max-length="20" readonly="readonly"/><p id="Docente">Docente</p><a href="javascript:mostrar('teachers_achievement', 'black_add_one_curse', true)" id="see_teaching"><i class="icon icon-list"></i></a>
                        <input id="Curso" class="add_achievement_field" type="text" max-length="20" readonly="readonly"/><p id="Curso">Curso</p><a href="javascript:mostrar('courses', 'black_add_one_curse', true)" id="see_course"><i class="icon icon-list"></i></a>
                        <a href="javascript:check('add_achievement', 'black_add')" id="save"><i class="icon icon-check"></i></a>
                    </div>
                    <div id="black_add_one" class="oculto">
                        <div id="teachers_achievement">
                            <a href="javascript:cerrar('teachers_achievement', 'black_add_one')" id="cerrar_teachers_achievement"><i class="icon icon-highlight_off"></i></a>
                            <select id="jum" class="add_teaching_field">
                            </select><p id="jum">Grado</p>
                            <div id="Teacher_option">
                                <!--<div class="item">-->
                                <!--    <span id="Teacher">A</span>-->
                                <!--    <span id="Capacidad">34/42</span>-->
                                <!--    <hr>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div id="courses">
                            <a href="javascript:cerrar('courses', 'black_add_one')" id="cerrar_courses"><i class="icon icon-highlight_off"></i></a>
                            <select id="Grados" class="add_course_field">
                            </select><p id="Grado">Grado</p>
                            <div id="Grades_option">
                                <!--<div class="item">-->
                                <!--    <span id="Curso">A</span>-->
                                <!--    <span id="Capacidad">34/42</span>-->
                                <!--    <hr>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div id="porcentajes">
                            <a href="javascript:cerrar('porcentajes', 'black_add_one')" id="cerrar_porcentajes"><i class="icon icon-highlight_off"></i></a>
                            <div id="lista_materias">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <div id="container_loaderAdd_black" class="oculto">
            <div id="loader">
                <div id="box"></div>
                <div id="hill"></div>
            </div>
        </div>
        <div id="container_loaderLoad_Data" class="oculto">
            <div id="tout">
              <div>
                <div>
                  <div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <div id="see_two">
            <div id="black" class="oculto"></div>
            <div id="container_poblacion_estudiantil">
                <div id="canvas_pobEst" class="oculto">
                    <canvas id="chartPobEst"></canvas>
                </div>
            </div>
            
            <div id="container_prueba_estado">
            </div>
            
            <div id="container_calificacion">
            </div>
            
            <div id="container_comments">
            </div>
            <a href="javascript:before()" id="before"><i class="icon icon-navigate_before"></i></a>
        </div>
    </body>
</html>

<script language="javascript">
    var canvas = document.getElementById("chartPobEst");
    
    var data = {
        labels: ["2013", "2014", "2015", "2016", "2017"],
        datasets: [
            {
                label: "Poblacion Estudiantil",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [400, 700, 1200, 980, 1100],
            }
        ]
    };
    
    var myLineChart = Chart.Line(canvas,{
        data:data
    });
     $("input#Secundaria").click(function(){
        swal({
          title: "Materia Secundaria",
          text: "Ingrese el nombre de la materia que desea registrar",
          type: 'question',
          input: 'select',
          inputOptions: {
            'MAT': 'Matematicas',
            'LENG': 'Leguaje'
          },
          showCancelButton: true,
          animation: true,
          inputPlaceholder: "Materia Secundaria",
        }).then(function (result) {
          swal({
            type: 'success',
            html: 'You entered: ' + result
          })
          $("input#Principal").prop('disabled', 'disabled');
        }, 
            function (dismiss) {
                if (dismiss === 'cancel') {
                document.getElementById('Principal').checked=true;
            }
        })
    });
    
// Select --------------------------------------------------------------- Select
    $('.select').click(function(e){
        $("#crear-btn").html("<a href='#' id='add'><i class='icon icon-add'></i></a>");
        $("#container_table").html("<div id='preloader'></div>");
        if(this.name=="student"){
            $("#add").attr("href", "javascript:mostrar('add_student', 'black_add', null);callDep()");
            callStudent();
        }else if(this.name=="teaching"){
            $("#add").attr("href", "javascript:mostrar('add_teaching', 'black_add', null);callDep()");
            callTeaching();
        }else if(this.name=="attendent"){
            $("#add").attr("href", "javascript:mostrar('add_attendent', 'black_add', null);callDep()");
            callAttendent();
        }else if(this.name=="admin"){
            callAdmin();
        }else if(this.name=="achievement"){
            $("#add").attr("href", "javascript:mostrar('add_achievement', 'black_add', null)");
            callAchievement();
        }else if(this.name=="course"){
            $("#add").attr("href", "javascript:mostrar('add_course', 'black_add', null)");
            callCourse();
            callGrades("Grado");
            
            $("select#Grado").change(function(){
                $.ajax({
                    url:"../Controlador/load/loadCourseSpecifiqueGrade.php",
                    data:{idGrado:$("select#Grado").val()},
                    method: 'GET',
                    dataType: "text"
                }).done(function(respuesta){
                    $("input#Curso").val($("select#Grado option:selected").text()+" "+respuesta);
                }).fail(function(){
                    sweetAlert("Opsss", "Lo sentimos, ha ocurrido un error", "error");
                });
	        });
        }
    });
    
    var zIndex = 0;
    
    function mostrar(container, black, borrar){
        if(!borrar){
            readonlyAdd();
            $("select").val("0");
            $("input").val("");
        }
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
    
    function check(container, black){
        swal("Perfecto", "Todo marcha bien.", "success");
        cerrar(container, black);
    }
    
    function next(){
        $("#see_one").animate({marginLeft: "-100%", opacity: "0"}, 1000, "swing");
        $("#see_two").animate({marginLeft: "0%", opacity: "1"}, 1000, "swing");
    }
    
    function before(){
        $("#see_one").animate({marginLeft: "0%", opacity: "1"}, 1000, "swing");
        $("#see_two").animate({marginLeft: "100%", opacity: "0"}, 1000, "swing");
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
    
    function formatCourse(respuesta){
        if(respuesta.num>0){
            var output = "<table id='tableSelected'><thead><tr><th>Curso</th><th>Cupo</th><th>Opciones</th></thead></tr>";
            for(var i = respuesta.num - 1; i >= 0; i--){
                output += "<tr><td>";
                output += respuesta.Grado[i] + " "+ respuesta.Curso[i]+"</td>";
                output += "<td>"+respuesta.numEst[i]+"/"+ respuesta.CupoMax[i]+"</td>";
                output += "<td>"+"<a href='#'>Ver <i class='icon icon-search'></i></a>";
                output += "</td>";
                output += "</tr>";
            }
            output += "</table>";
            $("#loader").fadeOut(300);
            $("#container_table").hide();
            $("#container_table").html(output);
            $("#container_table").fadeIn(300);
        }else{
            $("#container_table").html("<span id='alert_table'><i class='icon icon-error'></i><BR>No hay datos para mostrar.</span>");
        }
    }
    
    function formatAttendent(respuesta){
        if(respuesta.num>0){
            var output = "<table id='tableSelected'><thead><tr><th>DNI</th><th>Nombre</th><th>Opciones</th></thead></tr>";    
            for(var i = respuesta.num - 1; i >= 0; i--){
                output += "<tr><td>";
                output += respuesta.DNI[i] + "</td>";
                output += "<td>"+respuesta.N1[i]+" "+respuesta.N2[i]+" "+respuesta.A1[i]+" "+respuesta.A2[i]+"</td>";
                output += "<td>"+"<a href='#'>Ver <i class='icon icon-search'></i></a>";
                output += "</td>";
                output += "</tr>";
            }
            output += "</table>";
            $("#loader").fadeOut(300);
            $("#container_table").hide();
            $("#container_table").html(output);
            $("#container_table").fadeIn(300);
        }else{
            $("#container_table").html("<span id='alert_table'><i class='icon icon-error'></i><BR>No hay datos para mostrar.</span>");
        }
    }
    
    function formatStudent(respuesta){
        if(respuesta.num>0){
            var output = "<table id='tableSelected'><thead><tr><th>DNI</th><th>Nombre</th><th>Curso</th><th>Opcion</th></thead></tr>";
            for(var i = respuesta.num - 1; i >= 0; i--){
                output += "<tr><td>";
                output += respuesta.DNI[i] + "</td>";
                output += "<td>"+respuesta.N1[i]+" "+respuesta.N2[i]+" "+respuesta.A1[i]+" "+respuesta.A2[i]+"</td>";
                output += "<td>" + respuesta.Curso[i] +"</td>";
                output += "<td>"+"<a href='#'>Ver <i class='icon icon-search'></i></a>";
                output += "</td>";
                output += "</tr>";
            }
            output += "</table>";
            $("#loader").fadeOut(300);
            $("#container_table").hide();
            $("#container_table").html(output);
            $("#container_table").fadeIn(300);
        }else{
            $("#container_table").html("<span id='alert_table'><i class='icon icon-error'></i><BR>No hay datos para mostrar.</span>");
        }
    }
    
    function formatTeaching(respuesta){
        if(respuesta.num>0){
            var output = "<table id='tableSelected'><thead><tr><th>DNI</th><th>Nombre</th><th>Titulo</th><th>Opcion</th></thead></tr>";
            for(var i = respuesta.num - 1; i >= 0; i--){
                output += "<tr><td>";
                output += respuesta.DNI[i] + "</td>";
                output += "<td>"+respuesta.N1[i]+" "+respuesta.N2[i]+" "+respuesta.A1[i]+" "+respuesta.A2[i]+"</td>";
                output += "<td>" + respuesta.Titulo[i] +"</td>";
                output += "<td>"+"<a href='#'>Ver <i class='icon icon-search'></i></a>";
                output += "</td>";
                output += "</tr>";
            }
            output += "</table>";
            $("#loader").fadeOut(300);
            $("#container_table").hide();
            $("#container_table").html(output);
            $("#container_table").fadeIn(300);
        }else{
        $("#container_table").html("<span id='alert_table'><i class='icon icon-error'></i><BR>No hay datos para mostrar.</span>");
        }
    }
    
    function formatAdmin(respuesta){
        if((respuesta.permission)){
            $("#crear-btn").html(respuesta.permission[0]);
            $("#add").attr("href", respuesta.permission[1]);
        }
        if(respuesta.num>0){
            var output = "<table id='tableSelected'><thead><tr><th>DNI</th><th>Nombre</th><th>Cargo</th><th>Opcion</th></thead></tr>";
            for(var i = respuesta.num - 1; i >= 0; i--){
                output += "<tr><td>";
                output += respuesta.DNI[i] + "</td>";
                output += "<td>"+respuesta.N1[i]+" "+respuesta.N2[i]+" "+respuesta.A1[i]+" "+respuesta.A2[i]+"</td>";
                output += "<td>" + respuesta.Cargo[i] +"</td>";
                output += "<td>"+"<a href='#'>Ver <i class='icon icon-search'></i></a>";
                output += "</td>";
                output += "</tr>";
            }
            output += "</table>"
            $("#loader").fadeOut(300);
            $("#container_table").hide();
            $("#container_table").html(output);
            $("#container_table").fadeIn(300);
        }else{
        $("#container_table").html("<span id='alert_table'><i class='icon icon-error'></i><BR>No hay datos para mostrar.</span>");
        }
    }
    
    $("#see_course").click(function(){
        callGrades("GradoStudent");
        $("#Grades_student").html("");
    });
    var gradoSelectCourse;
    $("#GradoStudent").change(function(){
        gradoSelectCourse = $("#GradoStudent option:selected").text();
        $.ajax({
            url: "../Controlador/load/loadAllCourseSpecifiqueGrade.php",
            data:{
                idGrado:$("#GradoStudent").val()
            },
            dataType: "json",
            beforeSend:function(){
                mostrar('loader', 'container_loaderAdd_black',true);
            },
            success:function(respuesta){
                if(respuesta.success){
                    var output ="";
                    for(var i=0; i<respuesta.num; i++){
                        curso = respuesta.Curso[i];
                        output += "<a href='#' id='item_grades_student'>"
                        output += "<div class='item'>";
                        output += "<span id='Curso'>"+respuesta.Curso[i]+"</span>";
                        output += "<span id='Capacidad'>"+ respuesta.numEst[i]+"/"+respuesta.CupoMax[i]+"</span>";
                        output += "<hr>";
                        output += "<div onclick=colocarCurso('"+respuesta.Curso[i]+"')  style='height: 100%; width:100%; position: absolute; background:transparent;'></div>";
                        output += "</div>";
                        output += "</a>";
                    }
                    $("#Grades_student").hide();
                    $("#Grades_student").html(output);
                    $("#Grades_student").fadeIn(300);
                }
                cerrar('loader', 'container_loaderAdd_black');
            }
        })
    });
    
    
    function colocarCurso(curso){
        $("input#Curso.add_student_field").val(gradoSelectCourse+" "+curso);
        cerrar('courseStudent', 'black_add_one');
    }

//Carga Total del documento -------------------------- Carga Total del documento
    $(document).ready(function(){
// ReadOnly --------------------------------------------------- ReadOnly
        readonlyAdd();
        
// Autocomplete --------------------------------------------------- Autocomplete
        $("#Titulo_academico").keyup(function(){
            $("#Titulo_academico").autocomplete({
                source: "../Controlador/load/autoTitulos.php?titulo="+$("#Titulo_academico").val()
            });
        });
        
        $("input#Cargo.add_admin_field").keyup(function(){
            $("input#Cargo.add_admin_field").autocomplete({
                source: "../Controlador/load/autoCargos.php?cargo="+$("input#Cargo.add_admin_field").val()
            });
        });
        
        $("input#Area.add_achievement_field").keyup(function(){
            $("input#Area.add_achievement_field").autocomplete({
                source: "../Controlador/load/autoAreass.php?area="+$("input#Area.add_achievement_field").val()
            });
        });
        
    });
    
// Registros --------------------------------------------------------- Registros

    function regStudent(){
        var nom1 = $("input#Nombre_I.add_student_field").val().trim();
        var nom2 = $("input#Nombre_II.add_student_field").val().trim();
        var ape1 = $("input#Apellido_I.add_student_field").val().trim();
        var ape2 = $("input#Apellido_II.add_student_field").val().trim();
        var correo = $("input#Correo.add_student_field").val().trim();
        var Direccion = $("input#Direccion.add_student_field").val().trim();
        var DNI = $("input#DNI.add_student_field").val().trim();
        var Nacimiento = $("#Nacimiento.add_student_field").val().trim();
        var Telefono = $("input#Telefono.add_student_field").val().trim();
        var DNIAcu = $("input#DNI_acudiente.add_student_field").val().trim();
        var gradoCurso = $("input#Curso.add_student_field").val().trim();
        var Sexo = $("#Sexo.add_student_field").val();
        var Munic = $("#Ciudades.add_student_field").val();
        if((gradoCurso!="") && (DNIAcu!="") && (nom1!="") && (ape1!="") && (correo!="") && (Direccion!="") && (DNI!="") && (Nacimiento!="") && (Sexo!="")){
            $.ajax({
                url: "../Controlador/Reg/regStudent.php",
                data:{
                    N1:nom1,
				    N2:nom2,
				    A1:ape1,
				    A2:ape2,
				    mail:correo,
				    dire:Direccion,
				    dni:DNI,
				    nacimiento:Nacimiento,
				    tele:Telefono,
				    sex:Sexo,
				    dniAcu:DNIAcu,
				    Grado: gradoCurso,
				    idMuni: Munic
                },
                cache:"false",
                beforeSend:function(){
                    mostrar('loader', 'container_loaderAdd_black', null);
                },success:function(data){
                    alert(data);
                    if(data=="1"){
                        swal("Perfecto", "Usuario Registrado con exito", "success");
					    callStudent();
                        $("#search_input").val(DNI);
                    }else if(data=="2"){
                        //El estudiante esta vinculado a otra institucion
                        sweetAlert("El estudiante esta vinculado a otra institucion", "", "error");
                    }else if(data=="3"){
                        //El estudiante esta vinculado a esta institucion
                        sweetAlert("El estudiante esta vinculado a esta institucion", "", "error");
                    }else if(data=="4"){
                        //Datos erroneos
                        sweetAlert("Ha enviado datos erroneos", "", "error");
                    }else{
                        sweetAlert("Ha ocurrido un error", "", "error");
                    }
                },error:function(){
                    swal("Error", "Lo sentimos. La conexion ha fallado");
                    readonlyAdd();
                    $("select").val("0");
                    $("input").val("");
                },complete:function(){
                    cerrar('loader', 'container_loaderAdd_black');
                }
            })
        }
    }

    function regAttendent(){
        var nom1 = $("input#Nombre_I.add_attendent_field").val().trim();
        var nom2 = $("input#Nombre_II.add_attendent_field").val().trim();
        var ape1 = $("input#Apellido_I.add_attendent_field").val().trim();
        var ape2 = $("input#Apellido_II.add_attendent_field").val().trim();
        var correo = $("input#Correo.add_attendent_field").val().trim();
        var Direccion = $("input#Direccion.add_attendent_field").val().trim();
        var DNI = $("input#DNI.add_attendent_field").val().trim();
        var Nacimiento = $("#Nacimiento.add_attendent_field").val().trim();
        var Telefono = $("input#Telefono.add_attendent_field").val().trim();
        var Sexo = $("#Sexo.add_attendent_field").val();
        var Munic = $("#Ciudades.add_attendent_field").val();

        if((nom1!="") && (ape1!="") && (correo!="") && (Direccion!="") && (DNI!="") && (Nacimiento!="") && (Sexo!="")){
            $.ajax({
                url:"../Controlador/Reg/regAttendent.php",
                method:"GET",
                data:{
				    N1:nom1,
				    N2:nom2,
				    A1:ape1,
				    A2:ape2,
				    mail:correo,
				    dire:Direccion,
				    dni:DNI,
				    nacimiento:Nacimiento,
				    tele:Telefono,
				    sex:Sexo,
				    idMuni: Munic
				},
				cache:"false",
				beforeSend:function(){
					mostrar('loader', 'container_loaderAdd_black', null);
				},success:function(data){
				    if(data=="1"){
					    swal("Perfecto", "Usuario Registrado con exito", "success");
					    cerrar('add_attendent', 'black_add');
					    callAttendent();
                        $("#search_input").val(DNI);
				    }else if(data=="2"){
				        sweetAlert("El usuario ya estaba registrado", "", "error");
				    }else{
				        sweetAlert("Ha ocurrido un error", "", "error");
				    }
				},complete:function(){
				    cerrar('loader', 'container_loaderAdd_black');
				},error:function(){
                    swal("Error", "Lo sentimos. La conexion ha fallado");
                    readonlyAdd();
                    $("select").val("0");
                    $("input").val("");
				}
            })
        }else{
            swal("Campo Vacio", "Algunos campos requiridos estan vacios.");
            $("input.add_attendent_field").focus();
        }
    }

    function regAdmin(){
        var nom1 = $("input#Nombre_I.add_admin_field").val().trim();
        var nom2 = $("input#Nombre_II.add_admin_field").val().trim();
        var ape1 = $("input#Apellido_I.add_admin_field").val().trim();
        var ape2 = $("input#Apellido_II.add_admin_field").val().trim();
        var correo = $("input#Correo.add_admin_field").val().trim();
        var Direccion = $("input#Direccion.add_admin_field").val().trim();
        var DNI = $("input#DNI.add_admin_field").val().trim();
        var Nacimiento = $("#Nacimiento.add_admin_field").val().trim();
        var Telefono = $("input#Telefono.add_admin_field").val().trim();
        var Cargo = $("#Cargo.add_admin_field").val().trim();
        var Sexo = $("#Sexo.add_admin_field").val();
        var Munic = $("#Ciudades.add_admin_field").val();
        if((nom1!="") && (ape1!="") && (correo!="") && (Direccion!="") && (DNI!="") && (Nacimiento!="") && (Cargo!="") && (Sexo!="")){
            $.ajax({
				url:"../Controlador/Reg/regAdmin.php",
				method:"GET",
				data:{
				    N1:nom1,
				    N2:nom2,
				    A1:ape1,
				    A2:ape2,
				    mail:correo,
				    dire:Direccion,
				    dni:DNI,
				    nacimiento:Nacimiento,
				    tele:Telefono,
				    cargo:Cargo,
				    sex:Sexo,
				    idMuni: Munic
				},
				cache:"false",
				beforeSend:function(){
					mostrar('loader', 'container_loaderAdd_black', null);
				},success:function(data){
				    alert(data);
				    if(data=="1"){
				        
					    swal("Perfecto", "Usuario Registrado con exito", "success");
					    cerrar('add_admin', 'black_add');
					    callAdmin();
                        $("#search_input").val(DNI);
				    }else if(data=="2"){
				        sweetAlert("No se pudo registrar", "El usuario ya estaba registrado", "error");
				    }else{
				        sweetAlert("Ha ocurrido un error", "", "error");
				    }
				},complete:function(){
				    cerrar('loader', 'container_loaderAdd_black');
				},error:function(){
                    swal("Error", "Lo sentimos. La conexion ha fallado");
                    readonlyAdd();
                    $("select").val("0");
                    $("input").val("");
				}
            });
        }else{
            swal("Campo Vacio", "Algunos campos requiridos estan vacios.");
            $("input.add_admin_field").focus();
        }
    }
    
    function regTeaching(){
        var nom1 = $("#Nombre_I.add_teaching_field").val().trim();
        var nom2 = $("#Nombre_II.add_teaching_field").val().trim();
        var ape1 = $("#Apellido_I.add_teaching_field").val().trim();
        var ape2 = $("#Apellido_II.add_teaching_field").val().trim();
        var correo = $("#Correo.add_teaching_field").val().trim();
        var Direccion = $("#Direccion.add_teaching_field").val().trim();
        var DNI = $("#DNI.add_teaching_field").val().trim();
        var Nacimiento = $("#Nacimiento.add_teaching_field").val().trim();
        var Telefono = $("#Telefono.add_teaching_field").val().trim();
        var Titulo_academico = $("#Titulo_academico.add_teaching_field").val().trim();
        var Sexo = $("#Sexo.add_teaching_field").val();
        var Munic = $("#Ciudades.add_teaching_field").val();
        if((nom1!="") && (ape1!="") && (correo!="") && (Direccion!="") && (DNI!="") && (Nacimiento!="") && (Titulo_academico!="") && (Sexo!="")){
            $.ajax({
				url:"../Controlador/Reg/regTeaching.php",
				method:"GET",
				data:{
				    N1:nom1,
				    N2:nom2,
				    A1:ape1,
				    A2:ape2,
				    mail:correo,
				    dire:Direccion,
				    dni:DNI,
				    nacimiento:Nacimiento,
				    tele:Telefono,
				    titulo:Titulo_academico,
				    sex:Sexo,
				    idMuni: Munic
				},
				cache:"false",
				beforeSend:function(){
					mostrar('loader', 'container_loaderAdd_black', null);
				},
				success:function(data){
					if(data=="1"){
					    swal("Perfecto", "Usuario Registrado con exito", "success");
					    cerrar('loader', 'container_loaderAdd_black');
					    cerrar('add_teaching', 'black_add');
					    callTeaching();
                        $("#search_input").val(DNI);
					}else if(data=="2"){
				        sweetAlert("No se pudo registrar", "El usuario ya estaba registrado", "error");
					}else{
					    sweetAlert("Ha ocurrido un error", "", "error");
					}
				},complete:function(){
				    cerrar('loader', 'container_loaderAdd_black');
				},error:function(){
                    swal("Error", "Lo sentimos. La conexion ha fallado");
                    readonlyAdd();
                    $("select").val("0");
                    $("input").val("");
				}
			});
        }else{
            swal("Campo Vacio", "Algunos campos requiridos estan vacios.");
            $("input.add_teaching_field").focus();
        }
    }
    
    function regCourse(){
        var idG = $("select#Grado").val();
        var cupo = $("input#Cupo").val();
        $.ajax({
            url:"../Controlador/Reg/regCourse.php",
            data:{
                idGrado:idG,
                CpMax:cupo
            },
            dataType:"text",
            cache:"false",
            beforeSend:function(){
				mostrar('loader', 'container_loaderAdd_black', null);
			}
        }).done(function(respuesta){
            if(respuesta=="1"){
                swal("Perfecto", "Curso Registrado con exito", "success");
                cerrar('add_course', 'black_add');
                callCourse();
            }else{
                sweetAlert("Ha ocurrido un error", "", "error");
            }
        }).fail(function(){
            swal("Error", "Lo sentimos. Ha ocurrido un error en el proceso de registro");
        }).always(function(){
            cerrar('loader', 'container_loaderAdd_black');
        })
    }

// OTRAS ............................................    
    function readonlyAdd(){
            $("input#Nombre_I").attr("readonly","readonly");
            $("input#Nombre_II").attr("readonly","readonly");
            $("input#Apellido_I").attr("readonly","readonly");
            $("input#Apellido_II").attr("readonly","readonly");
            $("input#Correo").attr("readonly","readonly");
            $("input#Direccion").attr("readonly","readonly");
            $("input#Nacimiento").attr("readonly","readonly");
            $("input#Telefono").attr("readonly","readonly");
            $("select#Sexo").prop('disabled', 'disabled');
        }
    
    function loadDatas(clase){
        var dni = $("input#DNI."+clase).val();
        $("input#Nombre_I."+clase).val("");
        $("input#Nombre_II."+clase).val("");
        $("input#Apellido_I."+clase).val("");
        $("input#Apellido_II."+clase).val("");
        $("input#Correo."+clase).val("");
        $("input#Direccion."+clase).val("");
        $("input#Nacimiento."+clase).val("");
        $("input#Telefono."+clase).val("");
        $("select#Sexo."+clase).val();
        
        var loadDatas = function(){
            mostrar('tout', 'container_loaderLoad_Data', null);
            return $.getJSON("../Controlador/load/loadDatasUser.php?DNI="+dni);
        }
        
        loadDatas().done(function(respuesta){
            if(respuesta){
                swal("Listo", "Usuario Encontrado y Cargado", "success")
                $("input#DNI."+clase).val(dni);
                $("input#Nombre_I."+clase).val(respuesta.Nombre);
                $("input#Nombre_II."+clase).val(respuesta.Nombre2);
                $("input#Apellido_I."+clase).val(respuesta.Apellido);
                $("input#Apellido_II."+clase).val(respuesta.Apellido2);
                $("input#Correo."+clase).val(respuesta.Correo);
                $("input#Direccion."+clase).val(respuesta.Direccion);
                $("input#Nacimiento."+clase).val(respuesta.Fecha_Nacimiento);
                $("input#Telefono."+clase).val(respuesta.Telefono);
                $("select#Sexo."+clase).val(respuesta.Sexo);
                readonlyAdd();
            }else{
                swal("Registrar", "El usuario no esta registrado, ingrese sus datos", "warning")
                $("input#Nombre_I."+clase).removeAttr("readonly");
                $("input#Nombre_II."+clase).removeAttr("readonly");
                $("input#Apellido_I."+clase).removeAttr("readonly");
                $("input#Apellido_II."+clase).removeAttr("readonly");
                $("input#Correo."+clase).removeAttr("readonly");
                $("input#Direccion."+clase).removeAttr("readonly");
                $("input#Nacimiento."+clase).removeAttr("readonly");
                $("input#Telefono."+clase).removeAttr("readonly");
                $("select#Sexo."+clase).removeProp('disabled');
                $("input#DNI."+clase).val(dni);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            swal("Error", "Lo sentimos. Ha ocurrido un error en el proceso de registro");
        }).always(function(){
            cerrar('tout', 'container_loaderLoad_Data');
        });
    }
    
    function callAttendent(){
        var loadAttendent = function(){
            return $.getJSON("../Controlador/load/loadAllAttendent.php");
        }
        
        loadAttendent().done(function(respuesta){
            formatAttendent(respuesta);
            $(function(){
                $('input#search_input').quicksearch('table#tableSelected  tbody  tr');								
            });
        }).fail(function(jqXHR, textStatus, errorThrown){
            $("#container_table").html("<span id='error_table'><i class='icon icon-error'></i><BR>Disculpe las molestias, ha ocurrido un error.</span>");
        });
    }
    
    function callAdmin(){
        var loadAdmin = function(){
            $("#crear-btn").html("");
            return $.getJSON("../Controlador/load/loadAllAdmins.php");
        }
        
        loadAdmin().done(function(respuesta){
            formatAdmin(respuesta);
            $(function(){
                $('input#search_input').quicksearch('table#tableSelected  tbody  tr');								
            });
        }).fail(function(jqXHR, textStatus, errorThrown){
            $("#container_table").html("<span id='error_table'><i class='icon icon-error'></i><BR>Disculpe las molestias, ha ocurrido un error.</span>");
        });
    }
    
    function callCourse(){
        var loadCourse = function(){
                return $.getJSON("../Controlador/load/loadAllCourse.php");
            }
            
            loadCourse().done(function(respuesta){
                formatCourse(respuesta);
                $(function(){
                    $('input#search_input').quicksearch('table#tableSelected  tbody  tr');								
                });
            }).fail(function(){
                $("#container_table").html("<span id='error_table'><i class='icon icon-error'></i><BR>Disculpe las molestias, ha ocurrido un error.</span>");
            });
    }
    
    function callTeaching(){
        var loadTeaching = function(){
            return $.getJSON("../Controlador/load/loadAllTeachings.php");
        }
        
        loadTeaching().done(function(respuesta){
            formatTeaching(respuesta);
            $(function(){
                $('input#search_input').quicksearch('table#tableSelected  tbody  tr');								
            });
        }).fail(function(jqXHR, textStatus, errorThrown){
            $("#container_table").html("<span id='error_table'><i class='icon icon-error'></i><BR>Disculpe las molestias, ha ocurrido un error.</span>");
        });
    }
    
    function callStudent(){
        var loadStudent = function(){
            return $.getJSON("../Controlador/load/loadAllStudents.php");
        }
        
        loadStudent().done(function(respuesta){
            formatStudent(respuesta);
            $(function(){
                $('input#search_input').quicksearch('table#tableSelected  tbody  tr');								
            });
        }).fail(function(jqXHR, textStatus, errorThrown){
            $("#container_table").html("<span id='error_table'><i class='icon icon-error'></i><BR>Disculpe las molestias, ha ocurrido un error.</span>");
        });
    }
    
    function callGrades(id){
        var loadGrados = function(){
                return $.getJSON("../Controlador/load/loadAllGrados.php");
            }
            
            loadGrados().done(function(respuesta){
                var output="<option value='0'>Seleccione</option>";
                for(var i = 0; i < respuesta.num; i++){
                    output += "<option value='"+ respuesta.idGrados[i]+"'>"+respuesta.Grados[i]+"</option>";
                }
                $("select#"+id).html(output);
            }).fail(function(){
                $("select#"+id).html("<option>Lo sentimos, hubo un problema.</option>");
            });
    }
    
    function callAchievement(){
        $.ajax({
            url:"../Controlador/load/loadAllAchievement.php",
            beforeSend:function(){
                
            },
            success:function(respuesta){
                formatAchievement(respuesta);
            },error:function(){
                $("#container_table").html("<span id='error_table'><i class='icon icon-error'></i><BR>Disculpe las molestias, ha ocurrido un error.</span>");
            },complete:function(){
                
            }
        });
    }
    
    function formatAchievement(respuesta){
        
    }
    
    function loadNameAttendentOfStudent(){
        if($("input#DNI_acudiente.add_student_field").val()!=''){
            $.ajax({
                url:"../Controlador/load/loadNameAttendent.php",
                data:{dni:$("input#DNI_acudiente.add_student_field").val()},
                dataType:"json",
                beforeSend:function(){
                    mostrar('loader', 'container_loaderAdd_black', true);
                },success:function(data){
                    if(data.success){
                        swal("Acudiente", data.nombre, "success");
                    }else{
                        swal("Error", "Lo sentimos. Este Acudiente no se encuentra registrado");
                        $("input#DNI_acudiente.add_student_field").val("");
                    }
                },error:function(){
                    swal("Error", "Lo sentimos. La conexion ha fallado");
                    readonlyAdd();
                    $("select").val("0");
                    $("input").val("");
                },complete:function(){
    			    cerrar('loader', 'container_loaderAdd_black');
    			}
            });   
        }else{
            swal("Campo Vacio", "Debe llenar este campo");
        }
    }
    
    function callDep(){
        $.ajax({
           url:"../Controlador/load/loadAllDepartaments.php",
           success:function(respuesta){
               var output;
               for(var i = 0; i<respuesta.num; i++){
                   output += "<option value='"+respuesta.idDep[i]+"'>";
                   output += respuesta.Dep[i];
                   output += "</option>";
               }
            $("select#Departamentos").html(output);
           },error:function(){
               $("select#Departamentos").html("<option>Ha ocurrido un problema</option>");
           }
        });
    }
    
    $("select#Departamentos").change(function(){
        $.ajax({
           url:"../Controlador/load/loadAllMunicipality.php",
           data:{idDepa: $(this).val()},
           success:function(respuesta){
               var output;
               for(var i=0; i<respuesta.num; i++){
                   output+= "<option value='"+respuesta.idMun[i]+"'>";
                   output+= respuesta.Mun[i];
                   output+= "</option>";
               }
               $("select#Ciudades").html(output);
           },error:function(){
               $("select#Ciudades").html("<option>Ha ocurrido un problema</option>");
           }, beforeSend:function(){
               $("select#Ciudades").html("");
           }
        });
    });
    
    function callPanel(){
        mostrar('settingPanel', 'black', null);
        $.ajax({
            url: "../Controlador/load/loadDatasXId.php",
            beforeSend:function(){
                $("p#Nombre").html("<sup>Nombre: </sup>");
                $("p#DNI").html("<sup>DNI: </sup>");
                $("p#Correo_Personal").html("<sup>Correo Personal: </sup>");
                $("p#Usuario").html("<sup>Usuario: </sup>");
                $("p#Telefono").html("<sup>Telefono:</sup>");
                $("p#Direccion").html("<sup>Direccion:</sup>");
                $("p#Nacimiento").html("<sup>Fecha Nacimiento: </sup>");
                $("p#Sexo").html("<sup>Sexo: </sup>");
                $("img#perfil").attr("src","");
            },
            success:function(data){
                alert(JSON.stringify(data));
                if(data.success){
                    $("p#Nombre").html("<sup>Nombre: </sup>"+data.N1+" "+data.N2+" "+data.A1+" "+data.A2);
                    $("p#DNI").html("<sup>DNI: </sup>"+data.DNI);
                    $("p#Correo_Personal").html("<sup>Correo Personal: </sup>"+data.Correo+"<a href='#' id='setting_icon'><i class='icon icon-mode_edit'></i></a>");
                    $("p#Usuario").html("<sup>Usuario: </sup>"+data.Cuenta);
                    $("p#Telefono").html("<sup>Telefono:</sup>"+data.tele+"<a href='#' id='setting_icon'><i class='icon icon-mode_edit'></i></a>");
                    $("p#Direccion").html("<sup>Direccion:</sup>"+data.Municipio+" "+data.Direccion+"<a href='#' id='setting_icon'><i class='icon icon-mode_edit'></i></a>");
                    $("p#Nacimiento").html("<sup>Fecha Nacimiento: </sup>"+data.fecha);
                    $("p#Sexo").html("<sup>Sexo: </sup>"+data.Sexo);
                    $("img#perfil").attr("src","images/"+data.DNI+".jpg");
                }
            },
            error:function(){
                
            }
        });
    }
</script>