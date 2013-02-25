<?php
	include 'conexion.php';
	$destino = $_POST["destino"];
?>
		<select name="formaEstudio" onchange="javascript:setTimeout('__doPostBack(\'formaEstudio\')', 0)" id="formaEstudio" class="calculator-input-dropdown">
        	<option selected="selected" value="">Modalidad de Estudio</option>
			<?php
				$query = "SELECT id, descripcion FROM curso_modalidad WHERE id_destino=".$destino." ORDER BY id";
				$result = mysql_query($query);
				while ($row = mysql_fetch_array($result)){
			?>
				<option value="<?php echo $row["id"];?>"><?php echo $row["descripcion"];?></option>
			<?php
				}
			?>
		</select>
<?php
	mysql_close();
?>