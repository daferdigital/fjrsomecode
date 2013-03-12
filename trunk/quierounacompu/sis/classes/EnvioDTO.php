<?php
class EnvioDTO {
	private $id;
	private $seudonimoML;
	private $nombreCompleto;
	private $ciRIF;
	private $correo;
	private $detalleCompra;
	private $numVoucher;
	private $fechaPago;
	private $montoPago;
	private $nombreDestinatario;
	private $direccionDestino;
	private $ciudadDestino;
	private $estadoDestino;
	private $tlfCelularDestinatario;
	private $tlfLocalDestinatario;
	private $observacionesEnvio;
	private $idMedioPago;
	private $descMedioPago;
	private $idBanco;
	private $descBanco;
	private $idEmpresaEnvio;
	private $descEmpresaEnvio;
	private $idStatusActual;
	private $descStatusActual;
	
	
	public function EnvioDTO(){
		
	}
	
	/**
	 * 
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * 
	 * @param unknown_type $id
	 */
	public function setId($id){
		$this->id = $id;
	}
	
	/**
	 * 
	 */
	public function getSeudonimoML(){
		return $this->seudonimoML;
	}
	
	/**
	 * 
	 * @param unknown_type $seudonimoML
	 */
	public function setSeudonimoML($seudonimoML){
		$this->seudonimoML = $seudonimoML;
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	public function getNombreCompleto(){
		return $this->nombreCompleto;
	}
	
	/**
	 * 
	 * @param unknown_type $nombreCompleto
	 */
	public function setNombreCompleto($nombreCompleto){
		$this->nombreCompleto = $nombreCompleto;
	}
	
	/**
	 * 
	 */
	public function getCiRIF(){
		return $this->ciRIF;
	}
	
	/**
	 * 
	 * @param unknown_type $ciRIF
	 */
	public function setCiRIF($ciRIF){
		$this->ciRIF = $ciRIF;
	}
	
	private $correo;
	private $detalleCompra;
	private $numVoucher;
	private $fechaPago;
	private $montoPago;
	private $nombreDestinatario;
	private $direccionDestino;
	private $ciudadDestino;
	private $estadoDestino;
	private $tlfCelularDestinatario;
	private $tlfLocalDestinatario;
	private $observacionesEnvio;
	private $idMedioPago;
	private $descMedioPago;
	private $idBanco;
	private $descBanco;
	private $idEmpresaEnvio;
	private $descEmpresaEnvio;
	private $idStatusActual;
	private $descStatusActual;
}
?>