<?php
require_once 'Controlador/Usuarios/Acudientes.php';
require_once 'Controlador/Usuarios/Administrativos.php';
require_once 'Controlador/Usuarios/Docentes.php';
require_once 'Controlador/Usuarios/Estudiantes.php';
session_start();

if(!$_SESSION['Usuario']){
	header('location:Controlador/logout.php');
}else{
	header('location:pages/previous.php');
}

