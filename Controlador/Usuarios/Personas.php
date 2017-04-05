<?php

/**
 * @author Johnny Pacheco
 */
abstract class Personas{

    /**
     * @var int
     */
    protected $Id_Usuario;

    /**
     * @var string
     */
    protected $DNI;

    /**
     * @var string
     */
    protected $Nombre1;

    /**
     * @var string
     */
    protected $Nombre2;

    /**
     * @var string
     */
    protected $Apellido1;

    /**
     * @var string
     */
    protected $Apellido2;

    /**
     * @var date
     */
    protected $Nacimiento;

    /**
     * @var string
     */
    protected $Telefono;

    /**
     * @param int $id
     * @return void
     */
    public function setId($id){
        $this->Id_Usuario=$id;
    }

    /**
     * @param int $tipo
     * @return void
     */
    public function setTipo($tipo){
        $this->Tipo_Usuario=$tipo;
    }

    /**
     * @param string $doc
     * @return void
     */
    public function setDNI($doc){
        $this->DNI=$doc;
    }

    /**
     * @param string $nom
     * @return void
     */
    public function setNom1($nom){
        $this->Nombre1=$nom;
    }

    /**
     * @param string $nom
     * @return void
     */
    public function setNom2($nom){
        $this->Nombre2=$nom;
    }

    /**
     * @param string $ape
     * @return void
     */
    public function setApe1($ape){
        $this->Apellido1=$ape;
    }

    /**
     * @param string $ape
     * @return void
     */
    public function setApe2($ape){
        $this->Apellido2=$ape;
    }

    /**
     * @param date $fecha
     * @return void
     */
    public function setNacimiento(date $fecha){
        $this->Nacimiento=$fecha;
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->Id_Usuario;
    }

    /**
     * @return int
     */
    public function getTipo(){
        $this->Tipo_Usuario;
    }

    /**
     * @return string
     */
    public function getDNI(){
        return $this->DNI;
    }

    /**
     * @return string
     */
    public function getNom1(){
        return $this->Nombre1;
    }

    /**
     * @return string
     */
    public function getNom2(){
        return $this->Nombre2;
    }

    /**
     * @return string
     */
    public function getApe1(){
        return $this->Apellido1;
    }

    /**
     * @return string
     */
    public function getApe2(){
        return $this->Apellido2;
    }

    /**
     * @return date
     */
    public function getNacimiento(){
        return $this->Nacimiento;
    }

    /**
     * @return int
     */
    public function getEdad(){
        return 0;
    }
}
