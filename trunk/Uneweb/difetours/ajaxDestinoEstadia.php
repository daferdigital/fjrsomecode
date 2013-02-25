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