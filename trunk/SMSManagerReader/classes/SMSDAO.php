<?php
include_once 'DBUtil.php';
include_once 'SMSDTO.php';

class SMSDAO {
	
	public static function getNewMessages($lastIdObtained){
		$query = "SELECT * FROM mensajes WHERE id > ".$lastIdObtained;
		$result = DBUtil::executeSelect($query);
		$arrayMessages = array();
		
		foreach ($result as $row) {
			$smsDTO = new SMSDTO();
			$smsDTO->setId($id);
			$smsDTO->setFechaRecibido($fechaRecibido);
			$smsDTO->setMessageValue($messageValue);
			$smsDTO->setNumberFrom($numberFrom);
			
			$arrayMessages[] = $smsDTO;
		}
	}
}
?>