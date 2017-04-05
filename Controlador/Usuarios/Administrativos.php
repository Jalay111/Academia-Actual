<?php
require_once 'Personas.php';

/**
 * @author Johnny Pacheco
 */
class Administrativos extends Personas{

	/**
	 * @var int
	 */
	private $Id_Colegio;

	/**
	 * @var string
	 */
	private $Cargo;
	
	/**
	 * @var int
	 */
	private $Accesibilidad;

	public function __construct($id, $Nom1, $Ape1, $idCol, $Cargo, $Accesibilidad){
		$this->Id_Usuario = $id;
		$this->Nombre1 = $Nom1;
		$this->Apellido1 = $Ape1;
		$this->Id_Colegio = $idCol;
		$this->Cargo = $Cargo;
		$this->Accesibilidad = $Accesibilidad;
	}

	/**
	 * @param int $id
	 * @return void
	 */

	public function setId_Colegio($id){
		$this->Id_Colegio = $id;
	}

	/**
	 * @param string $cargo
	 * @return void
	 */
	public function setCargo($cargo){
		$this->Cargo = $cargo;
	}
	
	/**
	 * @param string $Accesibilidad
	 * @return void
	 */
	public function setAccesibilidad($Accesibilidad){
		$this->Accesibilidad = $Accesibilidad;
	}


	/**
	 * @return int
	 */
	public function getId_Colegio(){
		return $this->Id_Colegio;
	}

	/**
	 * @return string
	 */
	public function getCargo(){
		return $this->Cargo;
	}
	
	/**
	 * @return int
	 */
	 public function getAccesibilidad(){
	 	return $this->Accesibilidad;
	 }
}