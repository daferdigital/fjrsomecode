<?php
class UsuarioDTO {
	private $id;
	private $nombre;
	private $apellido;
	private $login;
	private $correo;
	private $tiempoSession;
	private $modulesAllowed;
	
	/**
	 * 
	 * @param unknown_type $id
	 * @param unknown_type $nombre
	 * @param unknown_type $apellido
	 * @param unknown_type $login
	 * @param unknown_type $correo
	 * @param unknown_type $tiempoSession
	 */
	public function UsuarioDTO($id, $nombre, $apellido, $login, $correo, $tiempoSession){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->login = $login;
		$this->correo = $correo;
		$this->tiempoSession = $tiempoSession;
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
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getCorreo(){
		return $this->correo;
	}
	
	public function getTiempoSession(){
		return $this->tiempoSession;
	}
	
	public function setModulesAllowed($modulesAllowed){
		$this->modulesAllowed = $modulesAllowed;
	}
	
	public function getModulesAllowed(){
		return $this->modulesAllowed;
	}
	
	/**
	 * 
	 * @param string $categoryModule
	 * @return true si existen al menos un modulo permitido para la categoria que se desea verificar
	 */
	public function canAccessCategoryModule($categoryModule){
		if(isset($this->modulesAllowed[$categoryModule])){
			if(count($this->modulesAllowed[$categoryModule]) > 0){
				return true;
			}
		}
		
		return false;
	}
	
	public function __toString(){
		return "UsuarioDTO["
				."nombre='".$this->nombre."'"
				.",apellido='".$this->apellido."'"
				.",modules=".print_r($this->modulesAllowed, true)
				."]";
	}
}
?>