<?php
/*
if(isset($_GET["id"])){
	$idTicket = $_GET["id"];
	header('Content-type: application/pdf');
	header("Content-Disposition: inline; filename=ticket_".$idTicket.".pdf");
	readfile("../tickets/ticket_".$idTicket.".pdf");
}
*/
if(isset($_GET["id"])){
	$idTicket = $_GET["id"];
?>
	<embed src="<?php echo "../tickets/ticket_".$idTicket.".pdf";?>" type='application/pdf'>
	</embed>
<?php
}
?>
