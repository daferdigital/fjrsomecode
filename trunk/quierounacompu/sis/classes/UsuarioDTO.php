<?php
include_once ("RolDTO.php");
include_once ("DBUtil.php");

class UsuarioDTO {
	private $id;
	private $nombre;
	private $apellido;
	private $login;
	private $correo;
	private $tiempoSession;
	private $rolDTO = null;
	
	public function UsuarioDTO(){
		
	}
	
	public function doLogin($login, $pwd){
		$loginAceptado = false;
		
		try {
			$this->login = $login;
			$query = "SELECT u.id, u.nombre, u.apellido, u.correo, u.tiempo_sesion, r.id AS rolId, r.role_name, r.role_desc "
					."FROM usuarios u, roles r "
					."WHERE u.id_rol = r.id "
					."AND u.login='".$login."' "
					."AND u.clave=MD5('".$pwd."') ";
			
			$dbUtilObj = new DBUtil();
			$arrayResult = $dbUtilObj->executeSelect($query);
			
			if(count($arrayResult) > 0){
				//credenciales validas
				$row = $arrayResult[0];
				
				$this->id = $row["id"];
				$this->nombre = $row["nombre"];
				$this->apellido = $row["apellido"];
				$this->correo = $row["correo"];
				$this->tiempoSession = $row["tiempo_sesion"];
				
				$this->rolDTO = new RolDTO($row["rolId"], 
						$row["role_name"], 
						$row["role_desc"]);
				
				$loginAceptado = true;
			}
		} catch (Exception $e) {
			die("Error verificando login");
		}
		
		return $loginAceptado;
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
	
	public function getRolDTO(){
		return $this->rolDTO;
	}
	
	public function __toString(){
		return "UsuarioDTO["
				."nombre='".$this->nombre."'"
				.",apellido='".$this->apellido."'"
				."]";
	}
}
?>