<?php
require_once 'Personas.php';

/**
 * @author Johnny Pacheco
 */
class Acudientes extends Personas{
	
	private $idEst;
	
	public function __construct($id, $DNI, $Nom1, $Nom2, $Ape1, $Ape2, $Tel, $Nacimiento, $idEst){
		$this->Id_Usuario = $id;
		$this->DNI = $DNI;
		$this->Nombre1 = $Nom1;
		$this->Nombre2 = $Nom2;
		$this->Apellido1 = $Ape1;
		$this->Apellido1 = $Ape2;
		$this->Telefono = $Tel;
		$this->Nacimiento = $Nacimiento;
		$this->$idEst=$idEst;
	}
	
	public function getIdEst(){
		return $this->idEst;
	}
	
	public function setIdEst($id){
		$this->idEst = $id;
	}
}
