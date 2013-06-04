<?php
class SMSDTO {
	private $id;
	private $fechaRecibido;
	private $numberFrom;
	private $messageValue;

	public function SMSDTO(){
		
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setFechaRecibido($fechaRecibido){
		$this->fechaRecibido = $fechaRecibido;
	}
	
	public function getFechaRecibido(){
		return $this->fechaRecibido;
	}
	
	public function setNumberFrom($numberFrom){
		$this->numberFrom = $numberFrom;
	}
	
	public function getNumberFrom(){
		return $this->numberFrom;
	}
	
	public function setMessageValue($messageValue){
		$this->messageValue = $messageValue;
	}
	
	public function getMessageValue(){
		return $this->messageValue;
	}
	
	public function __toString(){
		return "SMSDTO[id=".$this->id
		.", fechaRecibido=".$this->fechaRecibido
		.", numberFrom=".$this->numberFrom
		.", messageValue=".$this->messageValue
		."]";
	}
}
?>