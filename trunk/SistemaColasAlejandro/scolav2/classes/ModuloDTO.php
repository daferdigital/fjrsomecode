<?php
class ModuloDTO{
	private $id;
	private $categoria;
	private $keyModule;
	private $descripcion;
	
	/**
	 * 
	 * @param unknown_type $id
	 * @param unknown_type $categoria
	 * @param unknown_type $keyModule
	 * @param unknown_type $descripcion
	 */
	public function ModuloDTO($id, $categoria, $keyModule, $descripcion){
		$this->id = $id;
		$this->categoria = $categoria;
		$this->keyModule = $keyModule;
		$this->descripcion = $descripcion;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getCategoria(){
		return $this->categoria;
	}
	
	public function getKeyModule(){
		return $this->keyModule;
	}
	
	public function getDescripcion(){
		return $this->descripcion;
	}
}
?>