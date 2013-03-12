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
	
	/**
	 * 
	 */
	public function getCorreo(){
		return $this->correo;
	}
	
	/**
	 * 
	 * @param unknown_type $correo
	 */
	public function setCorreo($correo){
		$this->correo = $correo;
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	public function getDetalleCompra(){
		return $this->detalleCompra;
	}
	
	/**
	 *
	 * @param unknown_type $detalleCompra
	 */
	public function setDetalleCompra($detalleCompra){
		$this->detalleCompra = $detalleCompra;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getNumVoucher(){
		return $this->numVoucher;
	}
	
	/**
	 *
	 * @param unknown_type $numVoucher
	 */
	public function setNumVoucher($numVoucher){
		$this->numVoucher = $numVoucher;
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	public function getFechaPago(){
		return $this->fechaPago;
	}
	
	/**
	 *
	 * @param unknown_type $fechaPago
	 */
	public function setFechaPago($fechaPago){
		$this->fechaPago = $fechaPago;
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	public function getMontoPago(){
		return $this->montoPago;
	}
	
	/**
	 *
	 * @param unknown_type $montoPago
	 */
	public function setMontoPago($montoPago){
		$this->montoPago = $montoPago;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getNombreDestinatario(){
		return $this->nombreDestinatario;
	}
	
	/**
	 *
	 * @param unknown_type $nombreDestinatario
	 */
	public function setNombreDestinatario($nombreDestinatario){
		$this->nombreDestinatario = $nombreDestinatario;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getDireccionDestino(){
		return $this->direccionDestino;
	}
	
	/**
	 *
	 * @param unknown_type $direccionDestino
	 */
	public function setDireccionDestino($direccionDestino){
		$this->direccionDestino = $direccionDestino;
	}

	/**
	 *
	 * @return unknown_type
	 */
	public function getCiudadDestino(){
		return $this->ciudadDestino;
	}
	
	/**
	 *
	 * @param unknown_type $ciudadDestino
	 */
	public function setCiudadDestino($ciudadDestino){
		$this->ciudadDestino = $ciudadDestino;
	}

	/**
	 *
	 * @return unknown_type
	 */
	public function getEstadoDestino(){
		return $this->estadoDestino;
	}
	
	/**
	 *
	 * @param unknown_type $estadoDestino
	 */
	public function setEstadoDestino($estadoDestino){
		$this->estadoDestino = $estadoDestino;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getTlfCelularDestinatario(){
		return $this->tlfCelularDestinatario;
	}
	
	/**
	 *
	 * @param unknown_type $tlfCelularDestinatario
	 */
	public function setTlfCelularDestinatario($tlfCelularDestinatario){
		$this->tlfCelularDestinatario = $tlfCelularDestinatario;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getTlfLocalDestinatario(){
		return $this->tlfLocalDestinatario;
	}
	
	/**
	 *
	 * @param unknown_type $tlfLocalDestinatario
	 */
	public function setTlfLocalDestinatario($tlfLocalDestinatario){
		$this->tlfLocalDestinatario = $tlfLocalDestinatario;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getObservacionesEnvio(){
		return $this->observacionesEnvio;
	}
	
	/**
	 *
	 * @param unknown_type $observacionesEnvio
	 */
	public function setObservacionesEnvio($observacionesEnvio){
		$this->observacionesEnvio = $observacionesEnvio;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getIdMedioPago(){
		return $this->idMedioPago;
	}
	
	/**
	 *
	 * @param unknown_type $idMedioPago
	 */
	public function setIdMedioPago($idMedioPago){
		$this->idMedioPago = $idMedioPago;
	}

	/**
	 *
	 * @return unknown_type
	 */
	public function getDescMedioPago(){
		return $this->descMedioPago;
	}
	
	/**
	 *
	 * @param unknown_type $descMedioPago
	 */
	public function setDescMedioPago($descMedioPago){
		$this->descMedioPago = $descMedioPago;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getIdBanco(){
		return $this->idBanco;
	}
	
	/**
	 *
	 * @param unknown_type $idBanco
	 */
	public function setIdBanco($idBanco){
		$this->idBanco = $idBanco;
	}

	/**
	 *
	 * @return unknown_type
	 */
	public function getDescBanco(){
		return $this->descBanco;
	}
	
	/**
	 *
	 * @param unknown_type $descBanco
	 */
	public function setDescBanco($descBanco){
		$this->descBanco = $descBanco;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getIdEmpresaEnvio(){
		return $this->idEmpresaEnvio;
	}
	
	/**
	 *
	 * @param unknown_type $idEmpresaEnvio
	 */
	public function setIdEmpresaEnvio($idEmpresaEnvio){
		$this->idEmpresaEnvio = $idEmpresaEnvio;
	}

	/**
	 *
	 * @return unknown_type
	 */
	public function getDescEmpresaEnvio(){
		return $this->descEmpresaEnvio;
	}
	
	/**
	 *
	 * @param unknown_type $descEmpresaEnvio
	 */
	public function setDescEmpresaEnvio($descEmpresaEnvio){
		$this->descEmpresaEnvio = $descEmpresaEnvio;
	}
	
	/**
	 *
	 * @return unknown_type
	 */
	public function getIdStatusActual(){
		return $this->idStatusActual;
	}
	
	/**
	 *
	 * @param unknown_type $idStatusActual
	 */
	public function setIdStatusActual($idStatusActual){
		$this->idStatusActual = $idStatusActual;
	}

	/**
	 *
	 * @return unknown_type
	 */
	public function getDescStatusActual(){
		return $this->descStatusActual;
	}
	
	/**
	 *
	 * @param unknown_type $descStatusActual
	 */
	public function setDescStatusActual($descStatusActual){
		$this->StatusActual = $descStatusActual;
	}
}
?>