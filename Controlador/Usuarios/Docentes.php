<?php
require_once 'Personas.php';

/**
 * @author Johnny Pacheco
 */
class Docentes extends Personas
{

	/**
	 * @var int
	 */
	private $Id_Colegio;

	/**
	 * @var string
	 */
	private $Titulo;

	/**
	 * @param int $id
	 * @return void
	 */

	public function __construct($id, $DNI, $Nom1, $Nom2, $Ape1, $Ape2, $Tel, $Nacimiento, $idCol, $titulo){
		$this->Id_Usuario = $id;
		$this->DNI = $DNI;
		$this->Nombre1 = $Nom1;
		$this->Nombre2 = $Nom2;
		$this->Apellido1 = $Ape1;
		$this->Apellido1 = $Ape2;
		$this->Telefono = $Tel;
		$this->Nacimiento = $Nacimiento;
		$this->Titulo[0] = $titulo;
		$this->Id_Colegio[0]=$idCol;
	}

	public function setId_Colegio($id){
		$this->Id_Colegio[count($this->Id_Colegio)+1] = $id;
	}

	/**
	 * @param string $titulo
	 * @return void
	 */
	public function setCargo($titulo){
		$this->Titulo[count($this->Titulo)+1] = $titulo;
	}

	/**
	 * @param int $pos
	 * @return void
	 */
	public function removeId_Colegio($pos){
		if(count($this->Id_Colegio) > $pos){
			$f = count($this->Id_Colegio);
			for($i=$pos; $i < $f-1; $i++){
				$this->Id_Colegio[$i] = $this->Id_Colegio[$i+1]; 
			}
			$this->Id_Colegio[$f-1]=null;
		}else{
			$this->Id_Colegio[pos] = null;
		}
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
	public function getTitulo(){
		return $this->Titulo;
	}
}
