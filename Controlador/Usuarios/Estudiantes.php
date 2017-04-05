<?php
require_once 'Personas.php';

/**
 * @author Johnny Pacheco
 */
class Estudiantes extends Personas{

	/**
	 * @var int
	 */
	private $Id_Acudiente;

	/**
	 * @var int
	 */
	private $Id_Curso;

	public function __construct($id, $DNI, $Nom1, $Nom2, $Ape1, $Ape2, $Tel, $Nacimiento, $idAcu, $idCurso){
		$this->Id_Usuario = $id;
		$this->DNI = $DNI;
		$this->Nombre1 = $Nom1;
		$this->Nombre2 = $Nom2;
		$this->Apellido1 = $Ape1;
		$this->Apellido1 = $Ape2;
		$this->Telefono = $Tel;
		$this->Nacimiento = $Nacimiento;
		$this->Id_Curso = $idCurso;
		$this->Id_Acudiente=$idAcu;
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function setId_Acudiente($id){
		$this->Id_Acudiente=$id;
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function setId_Curso($id){
		$this->Id_Curso=$id;
	}

	/**
	 * @return int
	 */
	public function getId_Acudiente(){
		return $Id_Acudiente;
	}

	/**
	 * @return int
	 */
	public function getId_Curso(){
		return $Id_Curso;
	}
}
