<?Php 
include_once("procesos/conexion.php");
include_once("seguridad.php");
?>
<script language="javascript">
	cadena_hiden='idapuesta';
</script>
<div class="titulo">Registro / Edici&oacute;n de Apuestas</div>
<form name="form1" method="post" action="">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre de la Apuesta:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Tipo de apuesta:</label>
            <select name="tipo_apuesta" id="tipo_apuesta">
                    <option value=""><b>Seleccione</b></option>
            <?Php 
				$selectcategorias="select * from tipo_apuestas";
				$querycategorias=mysql_query($selectcategorias);
					if(mysql_num_rows($querycategorias)>0){
						while($varcategorias=mysql_fetch_assoc($querycategorias)){
						?>
                            <option <?php echo $sel; ?> value="<?php echo $varcategorias['idtipo_apuesta']; ?>"><?php echo $varcategorias['nombre']; ?></option>               
                <?Php }//fin while
					}//fin if?>
                 </select>
                <label class="campo_obligatorio">*</label>
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Descripción:</label> 
        	<input type="text" name="descripcion" id="descripcion" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Apuesta para el equipo:</label>
            <select name="que_equipo" id="que_equipo">
                    <option value=""><b>Seleccione</b></option>            
                            <option value="A">A</option>               
               				<option value="B">B</option>               
                 </select>
                <label class="campo_obligatorio">*</label>
             </td></tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.form1,'apuestas.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <input type="hidden" name="idapuesta" id="idapuesta" value="" />
     <div id="listado">
    <?Php
		include("procesos/listar_apuestas.php");
	?>
    </div>
</form>