<?php
class LogSistemaDTO {
	private $id;
	private $fecha;
	private $query;
	private $result;
	private $wasError;
	private $queryTime;
	private $idUsuario;
	private $userName;
	
	public function LogSistemaDTO(){
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getFecha(){
		return $this->fecha;
	}
	
	public function setFecha($fecha){
		$this->fecha = $fecha;
	}
	
	public function getQuery(){
		return $this->query;
	}
	
	public function setQuery($query){
		$this->query = $query;
	}
	
	public function getResult(){
		return $this->result;
	}
	
	public function setResult($result){
		$this->result = $result;
	}
	
	public function getWasError(){
		return $this->wasError;
	}
	
	public function setWasError($wasError){
		$this->wasError = $wasError;
	}
	
	public function getQueryTime(){
		return $this->queryTime;
	}
	
	public function setQueryTime($queryTime){
		$this->queryTime = $queryTime;
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	public function getUserName(){
		return $this->userName;
	}
	
	public function setUserName($userName){
		$this->userName = $userName;
	}
}
?>