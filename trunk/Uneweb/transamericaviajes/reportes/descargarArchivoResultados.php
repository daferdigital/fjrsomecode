<?php
	$fileToDownload = "resultados/ErroresCarga.txt";
	
	//lo enviamos
	header("Content-type: ".filetype($fileToDownload)."\"");
	header("Content-Disposition: attachment;filename=ErroresCarga.txt");
	header("Content-Transfer-Encoding: binary");
	header('Pragma: no-cache');
	header('Expires: 0');
	//Send the file contents.
	set_time_limit(0);
	readfile($fileToDownload);
?>
