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
	private $modulesAllowed;
	
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
			$tiempoSesion, $active, $registrosPorPagina){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->login = $login;
		$this->clave = $clave;
		$this->correo = $correo;
		$this->tiempoSesion = $tiempoSesion;
		$this->active = $active;
		$this->registrosPorPagina = $registrosPorPagina;
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
	
	/**
	 *
	 * @param string $keyModule
	 * @return true si el usuario tiene entre los modulos activados el indicado en el parametro $keyModule
	 */
	public function canAccessKeyModule($keyModule){
		$categories = $this->modulesAllowed;
		foreach ($categories as $categoryDetail){
			foreach ($categoryDetail as $moduleKey => $moduleValue){
				if($moduleKey == $keyModule){
					return true;
				}
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