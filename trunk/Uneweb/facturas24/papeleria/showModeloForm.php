<?php 
	include_once './classes/DBConnection.php';
	include_once './classes/DBUtil.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  	<title>Complete su pedido</title>
  	<link rel="stylesheet" href="css/smoothness/jquery-ui.css" />
  	<link rel="stylesheet" href="css/papeleria.css" />
  	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  	<script type="text/javascript" src="js/jquery-ui.js"></script>
  	<script type="text/javascript" src="js/papeleria.js"></script>
</head>
<body>
	<?php 
		$query = "SELECT tm.id, tm.nombre AS tipo, m.id AS modeloId, m.nombre, m.numero, m.clasico";
		$query .= " FROM tipos_modelos tm, modelos m";
		$query .= " WHERE tm.id = m.id_tipo_modelo";
		$query .= " AND m.id = ".$_GET["id"];
		$query .= " ORDER BY tm.nombre, m.nombre, m.numero";
		
		$modelo = DBUtil::executeSelect($query);
		$imagePath = "";
		if(count($modelo) < 1){
			echo "<h2>No se encontro informacion sobre el modelo solicitado.</h2>";
		} else {
			$modelo = $modelo[0];
			$imagePath = "../imagenes/";
			$imagePath .= str_replace(" ", "", $modelo["tipo"])."/";
			$imagePath .= str_replace(" ", "", $modelo["nombre"]);
			$imagePath .= $modelo["numero"].".jpg";
		}
	?>
	<div id="accordion" style="width: 30%; display: inline-block;">
  		<h3>Datos del pedido</h3>
  		<table class="formModelo">
  			<tr>
	  			<td>
	  				RIF
	  				<input type="text" name="rif" id="rif"/>
	  				<br />
	  				Ejemplo: J-12345678-0
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Nombre o Raz&oacute;n Social
	  				<input type="text" name="razonSocial" id="razonSocial"/>
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<table>
  						<tr>
  							<td>
  								<select name="font1" id="font1" class="formModelo">
				  					<option value="AdrianRegular">AdrianRegular</option>
				  					<option value="Aeolus">Aeolus</option>
				  					<option value="Aero">Aero</option>
				  					<option value="Alba">Alba</option>
				  					<option value="AmeliaBT">AmeliaBT</option>
				  					<option value="Annifont">Annifont</option>
				  					<option value="Anson">Anson</option>
				  					<option value="ArcaneWide">ArcaneWide</option>
				  					<option value="ArchiesHand">ArchiesHand</option>
				  					<option value="Arial">Arial</option>
				  					<option value="ArialNarrowBold">ArialNarrowBold</option>
				  					<option value="AvantGardeBook">AvantGardeBook</option>
				  					<option value="AvantGardeBookOblique">AvantGardeBookOblique</option>
				  					<option value="AvantGuard">AvantGuard</option>
				  					<option value="AvantGuardBold">AvantGuardBold</option>
				  					<option value="Azrael">Azrael</option>
				  				</select>
  							</td>
  							<td align="right">
  								<select name="sizeFont1" id="sizeFont1" class="formModelo">
				  					<option value="13">13</option>
				  					<option value="13">14</option>
				  					<option value="13">15</option>
				  					<option value="13">16</option>
				  					<option value="13">17</option>
				  					<option value="13">18</option>
				  					<option value="13">19</option>
				  					<option value="13">20</option>
				  					<option value="13">21</option>
				  					<option value="13">22</option>
				  					<option value="13">23</option>
				  					<option value="13">24</option>
				  					<option value="13">25</option>
				  					<option value="13">26</option>
				  				</select>
  							</td>
  						</tr>
  						<tr>
  							<td>
  								<input type="checkbox" name="boldFont1" id="boldFont1"> Negrita
  							</td>
  							<td align="right">
  								<input type="checkbox" name="cursivaFont1" id="cursivaFont1"> Cursiva
  							</td>
  						</tr>
  					</table>
  					
	  			</td>
  			</tr>
  		</table>
	</div>
	<div id="imageDiv" style="display: inline-block; width: 67%; vertical-align: top; margin-left: 10px;">
		<img border="0" alt="" src="<?php echo $imagePath;?>" />
	</div>
</body>
</html>