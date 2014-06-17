<?php 
include_once 'PDFJavaScript.php';

/**
 * 
 * @author frojas
 *
 */
class PDFAutoPrint extends PDFJavaScript{
	
	/**
	 * 
	 * @param string $dialog
	 */
	function AutoPrint($dialog=false){
	    //Open the print dialog or start printing immediately on the standard printer
	    $param=($dialog ? 'true' : 'false');
	    $script="print($param);";
	    $this->includeJS($script);
	}
	
	/**
	 * 
	 * @param unknown $server
	 * @param unknown $printer
	 * @param string $dialog
	 */
	function AutoPrintToPrinter($server, $printer, $dialog=false){
	    //Print on a shared printer (requires at least Acrobat 6)
	    $script = "var pp = getPrintParams();";
	    if($dialog)
	        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
	    else
	        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
	    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
	    $script .= "print(pp);";
	    $this->includeJS($script);
	}
}