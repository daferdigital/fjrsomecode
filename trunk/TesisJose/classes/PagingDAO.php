<?php 
class PagingDAO{
	private $pageRange = 10;
	
	private $pageNumber;
	private $scriptFunction;
	private $totalRecords;
		
	/**
	 * 
	 * @param unknown_type $pageNumber
	 * @param unknown_type $scriptFunction
	 * @param unknown_type $totalRecords
	 */
	public function PagingDAO($pageNumber, $scriptFunction, $totalRecords){
		$this->pageNumber = $pageNumber;
		$this->scriptFunction = $scriptFunction;
		$this->totalRecords = $totalRecords;
	}
	
	/**
	 *
	 * @return
	 */
	private function getPageNumberRequested(){
		$pageNumber = 1;
	
		if(intval($this->pageNumber) > 0){
			$pageNumber = intval($this->pageNumber);
		}
	
		$this->pageNumber = $pageNumber;
		return $pageNumber;
	}
	
	/**
	 *
	 * @return TR string content para el footer del pagineo
	 */
	public function getTRFooterPaging(){
		$footerTR = "";
	
		//vemos la cantidad de elementos a dibujar por pagina
		$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
		$maxRecordsPerPage = $userDTO->getRegistrosPorPagina();
		//$maxRecordsPerPage = 1;
		
		//calculamos el total de paginas involucradas
		$pagesInvolved = ((int) ($this->totalRecords / $maxRecordsPerPage)) + ($this->totalRecords % $maxRecordsPerPage == 0 ? 0 : 1);
	
		//vemos la pagina que estamos dibujando
		$pageNumber = $this->getPageNumberRequested();
		$linkClass = "footerPagingLink";
		
		//si estamos en la primera pagina no dibujamos las opciones de ir a primera pagina
		//ni pagina previa
		if($pageNumber > 1){
			$footerTR .= "<a href=\"#footerPage\" id=\"footerPage\" class=\"".$linkClass."\" onclick=\"".$this->scriptFunction."(1)\">";
			$footerTR .= "<img src=\"images/icons/firstPage.png\" border=\"0\" title=\"Primera Pagina\" />";
			$footerTR .= "</a>";
				
			$footerTR .= "<a href=\"#footerPage\" id=\"footerPage\" class=\"".$linkClass."\" onclick=\"".$this->scriptFunction."(".($pageNumber - 1).")\">";
			$footerTR .= "<img src=\"images/icons/prevPage.png\" border=\"0\" title=\"Pagina Anterior\" />";
			$footerTR .= "</a>";
		}
	
		//dibujamos los indices anteriores
		for ($i = ($this->pageRange / 2); $i > 0; $i--) {
			if($pageNumber - $i > 0){
				//dibujamos este indice
				$footerTR .= "<a href=\"#footerPage\" id=\"footerPage\" class=\"".$linkClass."\" onclick=\"".$this->scriptFunction."(".($pageNumber - $i).")\">";
				$footerTR .= $pageNumber - $i;
				$footerTR .= "</a>";
			} else {
				continue;
			}
		}
	
		//dibujamos la propia pagina
		$footerTR .=  "<span class=\"".$linkClass."\">".$pageNumber."</span>";
	
		//dibujamos los indices posteriores
		for ($i = 1; $i < ($this->pageRange / 2) + 1; $i++) {
			if($pageNumber + $i <= $pagesInvolved){
				//dibujamos este indice
				$footerTR .= "<a href=\"#footerPage\" id=\"footerPage\" class=\"".$linkClass."\" onclick=\"".$this->scriptFunction."(".($pageNumber + $i).")\">";
				$footerTR .= $pageNumber + $i;
				$footerTR .= "</a>";
			} else {
				continue;
			}
		}
	
		//si no estamos en la ultima pagina, dibujamos las opciones de ir a siguiente o ultima pagina
		if($pageNumber < $pagesInvolved){
			$footerTR .= "<a href=\"#footerPage\" id=\"footerPage\" class=\"".$linkClass."\" onclick=\"".$this->scriptFunction."(".($pageNumber + 1).")\">";
			$footerTR .= "<img src=\"images/icons/nextPage.png\" border=\"0\" title=\"Proxima Pagina\" />";
			$footerTR .= "</a>";
				
			$footerTR .= "<a href=\"#footerPage\" id=\"footerPage\" class=\"".$linkClass."\" onclick=\"".$this->scriptFunction."(".$pagesInvolved.")\">";
			$footerTR .= "<img src=\"images/icons/lastPage.png\" border=\"0\" title=\"Ultima Pagina\" />";
			$footerTR .= "</a>";
		}
	
		return $footerTR;
	}
}
?>