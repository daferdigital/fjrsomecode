<?php 
	include_once './classes/DBConnection.php';
	include_once './classes/DBUtil.php';
	include_once './classes/UtilClass.php';
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
	<div style="width: 30%; display: inline-block;">
		<iframe width="275px" height="590px" src="showModeloFormLeftSide.php?id=<?php echo $_GET["id"];?>" scrolling="auto" frameborder="0">
		</iframe>
	</div>
	<div id="imageDiv" style="overflow: scroll; display: inline-block; width: 67%; vertical-align: top; margin-left: 10px;">
		<h3>Modelo: <?php echo $modelo["tipo"]." ".$modelo["nombre"]." n&uacute;mero ".$modelo["numero"];?></h3>
		<input type="button" value="Previsualizar">
		<input type="button" value="Ordenar">
		<br />
		<img border="0" alt="" src="<?php echo $imagePath;?>" />
	</div>
</body>
</html>