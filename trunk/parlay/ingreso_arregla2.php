<?Php include_once("procesos/conexion.php");
session_start();
?>

<style type="text/css">
table tr td{
	margin:0 auto;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#666666;
}
.titulo{
	font-weight:bold;
	color:#003901;
	text-decoration:underline;
	font-size:18px;
	margin-bottom:30px;
}

#general{
	margin:0px auto;
	
	width:1198px;
	background-color:#fff;
	padding:10px;
	/*border:#000 1px dashed;*/
	position:relative;
}
.tit_campos{
	font-weight:bold;
}
.campo_obligatorio{
	font-weight:bold;
}
.titulo_tablas{
	font-weight:bold;
	font-size:14px;
	color:#fafbfc;
	background-color:#003901;
}

.titulo_tablas_negro{
	font-weight:bold;
	font-size:14px;
	color:#fafbfc;
	background-color:#000;
}
.boton{
	font-size:10px;
	font-family:Verdana,Helvetica;
	font-weight:bold;
	color:white;
	background:#003901;
	border:0px;
	width: auto;
	padding:5px;
	cursor:pointer;
}
.boton:hover{
	background-color:#000;
}

.tr:nth-child(odd){ background: #fcfcfc !important;}
.tr:nth-child(even){ background: #dbdbdb !important;}

option:nth-child(odd){ background: #cccccc;}
option:nth-child(even){ background: #dbdbdb;}
.tr img{
	cursor:pointer;
}
.menu a{
	text-decoration:none;
	
	
	font-size:10px;
	font-family:Verdana,Helvetica;
	font-weight:bold;
	color:white;
	background:#003901;
	border:0px;
	width: auto;
	padding:5px;
	cursor:pointer;
	/*padding-left:15px;*/
}
.menu a:hover{
	color:#cccccc;
	background-color:#000;
}
.color_2colum{
	/*background-color: #93FF93;*/
}
.columna_sola{
	text-align:center;
	width:40px;
}
/*LOGROS*/
.logros_tabla select{
	width:200px;
}
.logros_tabla input[type=radio]{
	width:12px;
	cursor:pointer;
}
.logros_tabla .tit_campos{
	font-size:10px;
	text-align: center;
	font-weight:normal;
}
.logros_tabla td{
	//border-right:#000 1px solid;
}
.logros_tabla{
	border-bottom:#000 1px solid;
	border-left:#000 1px solid;
	border-right:#000 1px solid;
}
.logros_tabla .linesep{
	border-top:#000 1px solid;
}
.logros_tabla .linesep td{
	border-top:#000 1px solid;
}
.logros_tabla .bnone{
	border-top: 0px !important;
}
.logros_tabla .tr_top td{
	border-top:#000 1px solid;
}
.td_left{
	border-left:#000 1px solid;
}
.carga_load, .carga_load2, .carga_load3, .mensaje_resultado {
	position:fixed;
	/*background:#fff;*/
	color:#000;
	font-weight:bold;
	display:none;
	position: absolute;
	left: 50%;
	top: 50%;
	width: 200px;
	height: 100px;
	margin-top: -100px;
	margin-left: -150px;
	overflow: auto;
	background:#FFF url(../imagenes/loading1.gif) center no-repeat;
	vertical-align:middle;
	text-align:center;
	padding-top:60px;
	/*border: 1px solid red;*/
}
.carga{
	position:fixed;
	background:#000;
	color:#CCC;
	top:0px;
	left:0px;
	display:none;
	width:100%;
	height:100%;
}
#logrosd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_logros.jpg) right top no-repeat;
	padding-left:3px;
}
#combinacionesd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_combinaciones.jpg) right top no-repeat;
	padding-left:3px;
}
#resultadosd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_resultados.jpg) right top no-repeat;
	padding-left:3px;
}
#ventasd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_venta.jpg) right top no-repeat;
	padding-left:3px;
}
.navld{
	font-weight:bold;
	color:#FFF;
}

.borde_top_left{
	border-top:#000 1px solid; border-left:#000 1px solid;
}

.borde_rigth td{
	border-right:#9A9A9A 1px solid;
}

.borde_rigth_bottom td{
	border-right:#9A9A9A 1px solid;
	border-bottom:#9A9A9A 1px solid;
}

.borde_left{
	border-left:#9A9A9A 1px solid;
}

.borde_rigth_bottom_top td{
	border-right:#9A9A9A 1px solid;
	border-bottom:#9A9A9A 1px solid;
	border-top:#9A9A9A 1px solid;
}

.borde_bottom td{
	border-bottom:#000 1px solid;
}
.estatus_venta{
	font-weight:bold;
}
legend{
	font-weight:bold;
	font-style:italic;
}
input,select,textarea{
	color:#666666;
}
.texto_derecha{
	text-align:right;
}
.nencontrado{
	font-weight:bold;
	color:#900;
	font-size:14px;
}
.ventas_taquilla tr td{
	font-size:10px;
}
</style>
<script language="javascript">
	cadena_hiden='usuario_actual';
</script>
<div class="titulo">Arreglo de Tickets</div>
<form name="arreglaT" method="post" action="procesos/guardar_arregloT.php">
	<fieldset style="width:60%">
	<legend><strong>Datos del Ticket</strong></legend><table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">N&uacute;mero de Ticket:</label> <input type="text" name="num_ticket" id="num_ticket" value="" /> <label class="campo_obligatorio">*</label></td>
    		</tr>
             <tr>
        	<td width="50%">
                <label class="tit_campos">Estatus del Ticket:</label> 
                <select name="estatus" id="estatus">
                	<option value="">Seleccione</option>                
<!--                	<option value="1">Anulado</option>-->
                    <option value="2">Ganador</option>
                    <option value="3">Perdedor</option>
                    <option value="4">Recalculado</option>
                    <option value="5">Reembolzar</option>                                                            
                </select>
            </td>
    		</tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Monto a Pagar:</label> <input type="text" name="monto" id="monto" value="0" /> <label class="campo_obligatorio">*</label></td>
    		</tr>
      </table>
    </fieldset>
  <fieldset style="width:60%"><legend>Datos de logueo</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr valign="top">
        	<td width="50%">
            	<label class="tit_campos">Clave autorizaci&oacute;n:</label>
            	<span class="color_2colum">
            	<input type="password" name="clave" id="clave" value="" />
            	</span>
       	    <label class="campo_obligatorio">*</label>
            </td>
    		</tr>  
        <tr><td align="left"><input name="guardar" type="submit" class="boton" onclick="javascript:validar(document.arreglaT,'arreglaT.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    </fieldset>
    <input type="hidden" name="idbanquero" id="idbanquero" value="" />
    <div id="listado">
    <?Php
	///	include("procesos/listar_banqueros.php");
	?>
    </div>
    <input type="hidden" name="usuario_actual" id="usuario_actual" value="" />
</form><?
?>