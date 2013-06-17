<?php
session_start();

include_once '../classes/DBUtil.php';

if(! isset($_SESSION["nombre"])){
	header("Location: index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>.:: Sistema Automatizado de Solicitudes Empleo ::.</title>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/site.css">
</head>
<body>
    <table width="80%"  border="0" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tr>
            <td width="13%">
                <div align="center">
                    <img src="../Imagenes/logo.png" width="771" height="98" />
                </div>
            </td>
        </tr>
    </table>
    <table align="center">
    	<tr>
    		<td colspan="2">
    			Indique los criterios de b&uacute;squeda para los CVs que desea ver
    		</td>
    	</tr>
    	<tr>
    		<td>Departamento</td>
    		<td>
    		<?php 
    			$query = "SELECT * FROM departamento ORDER BY LOWER(nombre)";
    			$departamentos = DBUtil::executeSelect($query);
    		?>
    			<select name="dpto" id="dpto" onchange="startDelayToShowCargos(this.value);">
    				<option value="">Todos</option>
    				<?php 
    					foreach ($departamentos as $departamento){
    				?>
    					<option value="<?php echo $departamento["id"];?>"><?php echo $departamento["nombre"];?></option>
    				<?php
    					}
    				?>
    			</select>
    		</td>
    	</tr>
    	<tr>
    		<td>Cargo Solicitado</td>
    		<td>
    			<script type="text/javascript">
	    		<?php 
	    			$query = "SELECT * FROM cargo ORDER BY id_departamento, LOWER(nombre)";
	    			$cargos = DBUtil::executeSelect($query);
	    		
	    			foreach ($cargos as $cargo){
	    		?>
	    			indice = window.cargos.length;
	    			window.cargos[indice]= new Object();
	    			window.cargos[indice].id = <?php echo $cargo["id"]; ?>;
	    			window.cargos[indice].nombre = '<?php echo $cargo["nombre"]; ?>';
	    			window.cargos[indice].idDpto = '<?php echo $cargo["id_departamento"]; ?>';
	    		<?php
	    			}
	    		?>
    			</script>
    			
    			<select name="cargo" id="cargo">
    				<option value="">Todos</option>
    			</select>
    			<span id="cargoAjax"  style="display: none;">
    				<img alt="" src="../img/loading.gif" />
    			</span>
    		</td>
    	</tr>
    	<tr>
    		<td>N&uacute;mero de C&eacute;dula</td>
    		<td>
    			<input type="text" name="cedula" />
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2" align="center">
    			<input type="button" value="Buscar" onclick="searchCVS(1);">
    		</td>
    	</tr>
    </table>
    
    <div style="width: 100%" id="ajaxPageResult">
		&nbsp;
	</div>
</body>
</html>