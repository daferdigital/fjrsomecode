<?php
	include("DBConexion.php");
	
	class PageText {
		private $textsArray = Array();
		private $noKey = "<b>NO KEY</b>";
		
		function PageText(){
			$dbCon = new DBConexion();
			$dbCon->prepareConexion();
			
		}
		
		/**
		 * 
		 * @param unknown $key
		 * @return string
		 */
		private function getTextOfKey($key){
			if($key == null || strlen($key) == 0){
				//no tenemos key, devolvemos algo que identifique ese escenario
				return $this->noKey;
			} else {
				if(isset($this->textsArray[$language."_".$key])){
					return $this->textsArray[$language."_".$key];
				} else {
					return "<b>No text for key: ".$key."</b>";
				}
			}
		}
	}
?>