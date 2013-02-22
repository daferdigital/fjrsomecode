<?php
class RolDTO{
	private $id;
	private $roleName;
	private $roleDesc;
	
	public function RolDTO($id, $roleName, $roleDesc){
		$this->id = $id;
		$this->roleName = $roleName;
		$this->roleDesc = $roleDesc;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getRoleName(){
		return $this->roleName;
	}
	
	public function getRoleDesc(){
		return $this->roleDesc;
	}
}
?>