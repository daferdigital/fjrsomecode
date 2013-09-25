<?php
class UsuarioDTO {
	private $id;
	private $nombre;
	private $apellido;
	private $login;
	private $clave;
	private $correo;
	private $tiempoSesion;
	private $active;
	private $registrosPorPagina;
	private $horaMinimaLecturaSMS;
	private $horaMaximaLecturaSMS;
	
	/**
	 * 
	 * @param int $id
	 * @param String $nombre
	 * @param String $apellido
	 * @param String $login
	 * @param String $clave
	 * @param String $correo
	 * @param int $tiempoSesion
	 * @param String $active, '1' para usuario activo, inactivo con cualquier otro valor
	 * @param $registrosPorPagina cantidad de registros a observar en paginados
	 */
	public function UsuarioDTO($id, $nombre, $apellido, $login, $clave, $correo, 
			$tiempoSesion, $active, $registrosPorPagina, $horaMinimaLecturaSMS,
			$horaMaximaLecturaSMS){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->login = $login;
		$this->clave = $clave;
		$this->correo = $correo;
		$this->tiempoSesion = $tiempoSesion;
		$this->active = $active;
		$this->registrosPorPagina = $registrosPorPagina;
		$this->horaMinimaLecturaSMS = $horaMinimaLecturaSMS;
		$this->horaMaximaLecturaSMS = $horaMaximaLecturaSMS;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function getApellido(){
		return $this->apellido;
	}
	
	public function getNombreCompleto(){
		return $this->nombre." ".$this->apellido;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getClave(){
		return $this->clave;
	}
	
	public function getCorreo(){
		return $this->correo;
	}
	
	public function getTiempoSesion(){
		return $this->tiempoSesion;
	}
	
	public function getActive(){
		return $this->active;
	}
	
	public function setRegistrosPorPagina($registrosPorPagina){
		$this->registrosPorPagina = $registrosPorPagina;
	}
	
	public function getRegistrosPorPagina(){
		return $this->registrosPorPagina;
	}
	
	public function setHoraMinimaLecturaSMS($horaMinimaLecturaSMS){
		$this->horaMinimaLecturaSMS = $horaMinimaLecturaSMS;
	}
	
	public function getHoraMinimaLecturaSMS(){
		return $this->horaMinimaLecturaSMS;
	}
	
	public function setHoraMaximaLecturaSMS($horaMaximaLecturaSMS){
		$this->horaMaximaLecturaSMS = $horaMaximaLecturaSMS;
	}
	
	public function getHoraMaximaLecturaSMS(){
		return $this->horaMaximaLecturaSMS;
	}
	public function __toString(){
		return "UsuarioDTO["
				."nombre='".$this->nombre."'"
				.",apellido='".$this->apellido."']";
	}
}
?>