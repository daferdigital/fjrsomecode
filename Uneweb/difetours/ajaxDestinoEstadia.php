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
?>
		<select name="estadia" onchange="javascript:setTimeout('__doPostBack(\'estadia\')', 0)" id="estadia" class="calculator-input-dropdown">
			<option selected="selected" value="">Indique su tipo de estadia</option>
			<?php
				$query = "SELECT internal_key, descripcion FROM curso_estadia WHERE id_destino=".$destino." ORDER BY descripcion";
				$result = mysql_query($query);
				while ($row = mysql_fetch_array($result)){
			?>
				<option value="<?php echo $row["internal_key"];?>"><?php echo $row["descripcion"];?></option>
			<?php
				}
			?>
		</select>
<?php
	mysql_close();
?>
</body>
</html>