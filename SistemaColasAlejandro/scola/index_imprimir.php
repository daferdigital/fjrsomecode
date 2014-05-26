<?php
/* detectar impresora compartida localmente */
//var_dump(printer_list(PRINTER_ENUM_LOCAL | PRINTER_ENUM_SHARED));
var_dump(printer_list(PRINTER_ENUM_LOCAL));
echo "<hr>";
//exit;
//if($handle = printer_open("HP Deskjet D1600 series (Copiar 1)")){
if($handle = printer_open("EPSON TM-T88V ReceiptE4")){	
	echo "Imprimiendo...";
	/*printer_write($handle, "Texto a imprimir");
	printer_close($handle);*/
}else{
	echo "error al conectar con la impresora";
}
?>