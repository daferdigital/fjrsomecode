<?php
/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */
session_start();
 
extract($_REQUEST);
include("conexion.php");

if($_SESSION["usuario"]==1315){
	//$i=0; //Nada
}else{
	header("location: formulario2.php?$linkp");
}

//datos de la cuenta
$banco = "Banesco";
$tipo_cta = "Corriente";
$num_cta = "XXXXX-XXXXX-XXXXX-XXXXX";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
<link href="scripts/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/jsDatePick_ltr.css" rel="stylesheet" type="text/css" />
<script src="scripts/jsDatePick.full.1.3.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function fillFields(formulario, selectId){
	//colocamos los campos
	formulario.nombre.value = document.getElementById("nombre_" + selectId).value;
	formulario.cedula_rif.value = document.getElementById("cedula_" + selectId).value;
	formulario.email.value = document.getElementById("email_" + selectId).value;
	formulario.direccion.value = document.getElementById("direccion_" + selectId).value;
	formulario.telefono.value = document.getElementById("telefono_" + selectId).value;
}
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener un correo.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe contener números.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
    } if (errors) alert('Favor llenar los campos:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
</head>

<body>
   	<table align="center"  width="1025"cellpadding="0" border="0" cellspacing="0" >	
  <tr>
    <td width="68%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">
		<!-- Espacio para el contenido -->
		                       
  		<div style="height:20px;"><?php
		 
		if($_SESSION["usuario"]==1315){	
	?>
  			<div class="bien">
                  Bienvenido <b><?php echo $_SESSION["nombre"]; ?></b><br />
                  <div class="bien2">
				  	<a class="logb" href="destroy2.php?op=1&tot=<?php echo $_GET["tot"].$linkp; ?>">
				  		Cerrar Sesi&oacute;n
			  		</a>
 				  </div>
            </div>
            <div style="height:20px;"></div>  
	<?php 
	
		}
	?>
  		
		<div style="height:20px;"></div>
  		  <p><br />
  		    <br />
<br />
  		    <br />
          </p>
  		</div>
  		
  		<form action="registrarPago.php" method="post" name="miForm" id="miForm" onsubmit="MM_validateForm('cedrif','','NisNum','email','','NisEmail','telefono','','NisNum','cel','','NisNum','transaccion','','NisNum','direccion','','R','fechaPago','','R');return document.MM_returnValue">
  		  <table width="390" border="0" align="center">

		<tr>
        	<td height="23" colspan="2"><div align="center" >
			  	<p><span style="font-family: Verdana; font-size: 22px;"><br />
			  	  <br />
			  	  Reporte de Pago<br />
			  	  </span>Favor realizar sus dep&oacute;sitos en:		  	    </p>
</div>
			<div align="left" style="padding-left: 25px;">
			  <ul >
					<li><b>Banco:</b> <?php echo $banco;?></i></li>
					<li><b>Tipo de Cuenta:</b> <?php echo $tipo_cta;?></i></li>
					<li><b>No de Cuenta:</b> <?php echo $num_cta;?></i></li>
				</ul>
		    </div>
			
			<br />
			
			<div align="center" name="nota" id="nota">
			  	Una vez realizado el dep&oacute;sito, favor notificarlo <br /> suministrando los siguientes datos:
			</div>
			</td>
        </tr>
    </table>
	
	<div style="height: 30px"></div> 
	
	<table width="365" border="0" style="border: 1px solid black;" align="center" cellpadding="2" cellspacing="0">   
        <tr>
            <td width="148" style="padding-left: 6px;">
				Cliente:
			</td>
			<td width="207">
				<select name="cliente" id="cliente" onchange="fillFields(this.form, this.options[this.selectedIndex].value)">
				<?php
					$query = "SELECT id, nombre, apellido, cedula, login, direccionh, telefono FROM clientes ORDER BY LOWER(nombre), LOWER(apellido)";
					$result = mysql_query($query);
					$hiddenFields = "";
					
					while($row = mysql_fetch_array($result)){
						$hiddenFields .= "<input type=\"hidden\" id=\"nombre_".$row["id"]."\" value=\"".$row["nombre"]." ".$row["apellido"]."\"/> \n";
						$hiddenFields .= "<input type=\"hidden\" id=\"cedula_".$row["id"]."\" value=\"".$row["cedula"]."\"/> \n";
						$hiddenFields .= "<input type=\"hidden\" id=\"email_".$row["id"]."\" value=\"".$row["login"]."\"/> \n";
						$hiddenFields .= "<input type=\"hidden\" id=\"direccion_".$row["id"]."\" value=\"".$row["direccionh"]."\"/> \n";
						$hiddenFields .= "<input type=\"hidden\" id=\"telefono_".$row["id"]."\" value=\"".$row["telefono"]."\"/> \n";
				?>
					<option value="<?php echo $row["id"]?>"><?php echo $row["nombre"]." ".$row["apellido"]?></option>
				<?php
					}
				?>
				</select>
				<?php echo $hiddenFields;?>
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td width="148" style="padding-left: 6px;">
				Nombre y Apellido:
			</td>
			<td width="207" align="center">
				<input name="nombre" type="text" id="nombre" size="25" maxlength="30" />
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Compa&ntilde;ia (opcional):
			</td>
			<td align="center">
				<input type="text" name="compania" size="25" maxlength="30" />
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				C&eacute;dula / RIF
			</td>
			<td align="center">
				<input name="cedula_rif" type="text" id="cedula_rif" size="25" maxlength="30" readonly="readonly"/>
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Email
			</td>
			<td align="center">
				<input name="email" type="text" id="email" size="25" maxlength="30" readonly="readonly"/>
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Direcci&oacute;n
			</td>
			<td align="center">
				<textarea name="direccion" cols="19" rows="4" id="direccion"></textarea>
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Tel&eacute;fono
			</td>
			<td align="center">
				<input name="telefono" type="text" id="telefono" size="25" maxlength="30" />
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Celular
			</td>
			<td align="center">
				<input name="celular" type="text" id="celular" size="25" maxlength="30" />
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Nro de Transacci&oacute;n
			</td>
			<td align="center">
				<input name="transaccion" type="text" id="transaccion" size="25" maxlength="30" />
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">Banco</td>
			<td align="center"><input name="factura" type="text" id="factura" size="25" maxlength="30" /></td>
		</tr>
		<tr>
			<td width="148" style="padding-left: 6px;">
				Fecha del pago
			</td>
			<td width="207" align="center">
				<input type="text" id="fechaPago" name="fechaPago" size="25" readonly="true"/>
			
				<script>
					new JsDatePick({
				        useMode:2,
				        target:"fechaPago",        
				        isStripped:true,
				       	weekStartDay:0,
				        limitToToday:true,
				        dateFormat:"%Y-%m-%d",
				        imgPath:"css/img/"
				    });
				</script>
			</td>
		</tr>		
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Monto del Pago</td>
			<td align="center"><input name="comentarios" type="text" value="" size="25" />
			</td>
		</tr>
	</table>

	<div style="height: 20px"></div>
	 
	<div align="center">
    	<input type="submit" name="enviar" value="Enviar" />
    </div>          

  </form>	
		
	<div style="height:60px;"></div>
		
		<!-- Espacio para el contenido -->
	</td>
  </tr>
</table>
<script type="text/javascript">
					fillFields(document.getElementById("cliente").form, 
							document.getElementById("cliente").value);
				</script>
</body>
</html>
