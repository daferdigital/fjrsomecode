<?Php session_start();?>
<div class="titulo">Activar/Desactivar el generar cookies para taquillas</div>
<?Php
	include("procesos/conexion.php");
		$sql="select * from taquillas order by nombre";
		$query=mysql_query($sql);
			if(mysql_num_rows($query)>0){
				?><form name="form1" method="post" action="">
					<table align="center" width="800px">
                    	<tr class="titulo_tablas"><td>Cedula</td><td>Nombre</td><td>Tel&eacute;fono</td><td>Email</td><td colspan="2" align="center">Operación</td></tr>
                        	<?Php
								while($var=mysql_fetch_assoc($query)){
									?>
                                    	<tr class="tr">
                                        	<td><?Php echo $var["cedula"];?></td>
                                            <td><?Php echo $var["nombre"];?></td>
                                            <td><?Php echo $var["telefono"];?></td>
                                            <td><?Php echo $var["email"];?></td>
                                            <td><input type="radio" name="taq[<?Php echo $var["idtaquilla"];?>]" value="1" <?Php echo ($var["generar_cookie"]==1?'checked':'');?>> Activar</td>
                                            <td><input type="radio" name="taq[<?Php echo $var["idtaquilla"];?>]" value="0" <?Php echo ($var["generar_cookie"]==0?'checked':'');?>> Desactivar</td>
                                         </tr>
                                    <?Php
								}
							?>
                    </table>
                    <center><input type="button" name="Guardar" value="Guardar cambios" class="boton" onClick="javascript: form_cookie='si';nolistado='no';noreset='no';validar(document.form1,'activar_cookie.php');"></center>
                   </form>
				<?Php
			}
?>