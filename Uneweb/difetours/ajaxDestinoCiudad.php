<?php header('Content-Type: text/html; charset=ISO-8859-1');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<?php
	include 'conexion.php';
	$destino = $_POST["destino"];
	
	$query = "SELECT id, ciudad FROM curso_ciudad WHERE id_destino=".$destino." ORDER BY ciudad";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) > 0){
?>
		<select name="ciudadDestino" onchange="javascript:setTimeout('__doPostBack(\'ciudadDestino\')', 0)" id="ciudadDestino" class="calculator-input-dropdown">
			<?php 
				while ($row = mysql_fetch_array($result)){
			?>
				<option value="<?php echo $row["id"];?>"><?php echo $row["ciudad"];?></option>
			<?php
				}
			?>
		</select>
<?php	
	}

	mysql_close();
?>
</body>
</html>