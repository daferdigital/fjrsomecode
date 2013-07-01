<?php 
	header('Content-Type: text/html; charset=ISO-8859-1');
	
	include_once 'classes/DBConnection.php';
	include_once 'classes/DBUtil.php';
	
	//obtenemos el nombre del departamento al que vamos a agregar la solicitud
	$dptoId = $_POST["dpto"];
	$query = "SELECT nombre FROM departamento WHERE id=".$dptoId;
	$dpto = DBUtil::executeSelect($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title><?php echo htmlentities($dpto[0]["nombre"]);?></title>
        <script type="text/javascript" src="./js/scripts.js"></script>
        <script type="text/javascript" src="./js/jsDatePick.full.1.3.js"></script>
        
        <link rel="stylesheet" type="text/css" href="./css/jsDatePick_ltr.css"/>
        <link rel="stylesheet" type="text/css" href="./css/site.css">
    </head>

<body>
    <table width="80%"  border="0" align="center" cellpadding="0">
        <tr>
            <td>
                <div align="center">
                    <img src="Imagenes/logo.png" width="771" height="98">
                </div>
            </td>
        </tr>
    </table>
    
    <br>

    <table width="50%"  border="0" align="center" cellpadding="0">
        <tr>
            <td>
                <div align="center">
                    <span class="style1">
                        Formulario 
                        <br>
                        Llene el siguiente formulario para que su postulaci&oacute;n se realice
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <br>
    
    <table width="50%"  border="0" align="center" cellpadding="0">
        <tr bgcolor="#E8681F">
            <td>
                <div align="center">
                    <span class="style4">
                        Informaci&oacute;n Personal
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <form name="form2" method="post" action="guardarSolicitud.php" enctype="multipart/form-data">
        <table width="50%" border="0" align="center" class="formu">
            <tr>
                <td width="38%">Nombre:</td>
                <td width="62%">
                    <label for="nombre"></label>
                    <input name="nombre" type="text" id="nombre" size="30" onkeypress="return textInputOnlyLetters(event);" />
                    <span class="isMandatory" id="spanErrorNombre" style="display:none;">
                        <br />
                        Disculpe, el nombre es obligatorio.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="apellido">Apellido:</label></td>
                <td>
                    <input name="apellido" type="text" id="apellido" size="30" onkeypress="return textInputOnlyLetters(event);" />
                    <span class="isMandatory" id="spanErrorApellido" style="display:none;">
                        <br />
                        Disculpe, el apellido es obligatorio.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="ci">C&eacute;dula de Identidad:</label></td>
                <td>
                    <select name="tipoCi" id="tipoCi">
                        <option value="">- -</option>
                        <option value="V">V</option>
                        <option value="E">E</option>
                    </select>
                    <input name="ci" type="text" id="ci" size="30" maxlength="8" onkeypress="return textInputOnlyNumbers(event);" />
                    <span class="isMandatory" id="spanErrorTipoCi" style="display:none;">
                        <br />
                        Disculpe, debe indicar su tipo de c&eacute;dula.
                    </span>
                    <span class="isMandatory" id="spanErrorValueCi" style="display:none;">
                        <br />
                        Disculpe, su n&uacute;mero de c&eacute;dula es obligatorio.
                    </span>
                    <span class="isMandatory" id="spanErrorLengthCi" style="display:none;">
                        <br />
                        Disculpe, el n&uacute;mero de d&iacute;gitos de su c&eacute;dula es incorrecto.
                        <br />
                        Debe tener al menos 6 y m&aacute;ximo 8 d&iacute;gitos.
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lugar de nacimiento">Lugar de nacimiento:</label>
                </td>
                <td>
                    <input name="lugarNacimiento" type="text" id="lugarNacimiento" size="30" />
                    <span class="isMandatory" id="spanErrorLugarNacimiento" style="display:none;">
                        <br />
                        Disculpe, debe indicar su lugar de nacimiento.
                    </span>
                </td>
            </tr>
            <tr>
                <td>Fecha de Nacimiento:</td>
                <td>
                    <input type="text" id="fechaNacimiento" name="fechaNacimiento" size="25" readonly />
                    <input type="hidden" id="fechaNacimientoHidden" name="fechaNacimientoHidden" />
                    
                    <script>
                        new JsDatePick({
                        	useMode:2,
                        	target:"fechaNacimiento",
                        	targetHidden:"fechaNacimientoHidden",
                            isStripped:true,
                            weekStartDay:0,
                            limitToToday:true,
                            dateFormat:"%d/%m/%Y",
                            dateFormatHidden:"%Y-%m-%d",
                            imgPath:"images/"
                        });
                    </script>
                    <span class="isMandatory" id="spanErrorFechaNacimiento" style="display:none;">
                        <br />
                        Disculpe, debe indicar su fecha de nacimiento.
                    </span>
                </td>
            </tr>
            <tr>
                <td>Sexo:</td>
                <td>
                    <input type="radio" name="sexo" id="sexoFem" value="F" /> F
	                <input type="radio" name="sexo" id="sexoMas" value="M" /> M
	                <span class="isMandatory" id="spanErrorSexo" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos su g&eacute;nero.
                    </span>
	            </td>
            </tr>
            <tr>
                <td>Estado Civil:</td>
                <td> 
                    <select name="edoCivil" id="edoCivil">
                        <option value="">- -</option>
                        <option value="Soltero(a)">Soltero(a)</option>
						<option value="Casado(a)">Casado(a)</option>
						<option value="Divorciado(a)">Divorciado(a)</option>
						<option value="Viudo(a)">Viudo(a)</option>
			        </select>
			        <span class="isMandatory" id="spanErrorEdoCivil" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos su estado civil.
                    </span>
			    </td>
			</tr>
            <tr>
                <td>Tiene Hijos:</td>
                <td>
                    Si <input name="tieneHijos" id="siTieneHijos" type="radio" value="Si" />
                    No <input name="tieneHijos" id="noTieneHijos" type="radio" value="No" />
                    <span class="isMandatory" id="spanErrorTieneHijos" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos si tiene hijos.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="direccion">Direcci&oacute;n:</label></td>
                <td>
                    <textarea name="direccion" id="direccion" cols="24" rows="5"></textarea>
                    <span class="isMandatory" id="spanErrorDireccion" style="display:none;">
                        <br />
                        Disculpe, debe indicar su direcci&oacute;n de habitaci&oacute;n.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="telefono hab">Tel&eacute;fono de habitaci&oacute;n:</label></td>
                <td>
                    <input name="telefonoHab" type="text" id="telefonoHab" size="30" maxlength="11" onkeypress="return textInputOnlyNumbers(event);" />
                    <span class="isMandatory" id="spanErrorTelefonoHabitacion" style="display:none;">
                        <br />
                        Disculpe, debe indicar su n&uacute;mero de tel&eacute;fono de habitaci&oacute;n.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="telefono cel">Tel&eacute;fono celular:</label></td>
                <td>
                    <input name="telefonoCel" type="text" id="telefonoCel" size="30" maxlength="11" onkeypress="return textInputOnlyNumbers(event);" />
                    <span class="isMandatory" id="spanErrorTelefonoCelular" style="display:none;">
                        <br />
                        Disculpe, debe indicar su n&uacute;mero de tel&eacute;fono celular.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="correo">Correo electr&oacute;nico:</label></td>
                <td>
                    <input name="correo" type="text" id="correo" size="30" />
                    <span class="isMandatory" id="spanErrorCorreo" style="display:none;">
                        <br />
                        Disculpe, debe indicar una direcci&oacute;n de correo v&aacute;lida.
                    </span>
                </td>
            </tr>
            <tr>
                <td>Grado de Instrucci&oacute;n:</td>
                <td>
                    <select name="gradoInstruccion" id="gradoInstruccion">
                        <option value="">- -</option>
					    <option value="Primaria">Primaria</option>
                        <option value="Bachiller">Bachiller</option>
					    <option value="Profesional">Profesional</option>	 
				    </select>
				    <span class="isMandatory" id="spanErrorgradoInstruccion" style="display:none;">
                        <br />
                        Disculpe, debe indicar su grado de instrucci&oacute;n.
                    </span>
				</td>
		    </tr>
            <tr>
                <td><label for="profesional en">Profesional en:</label></td>
                <td>
                    <input name="profesionalEn" type="text" id="profesionalEn" size="30" />
                    <span class="isMandatory" id="spanErrorProfesion" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos cual es su profesi&oacute;n.
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="especialista en">Especialista en:</label></td>
                <td>
                    <input name="especialistaEn" type="text" id="especialistaEn" size="30" />
                    <span class="isMandatory" id="spanErrorEspecialidad" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos cual es su especialidad.
                    </span>
                </td>
            </tr>
            <tr>
                <td>Experiencia laboral:</td>
	            <td> 
	                S&iacute;<input name="expLaboral" type="radio" id="siExpLaboral" value="Si" onclick="displayElement('trCuantosTrabajos', true); displayElement('trTiempoTrabajo', true);" />
	                No <input name="expLaboral" type="radio" id="noExpLaboral" value="No" onclick="displayElement('trCuantosTrabajos', false); displayElement('trTiempoTrabajo', false);" />
	                <span class="isMandatory" id="spanErrorExperiencia" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos si posee experiencia laboral.
                    </span>
	            </td>
	        </tr>
            <tr id="trCuantosTrabajos" style="display:none;">
                <td>&iquest;Cu&aacute;ntos trabajos ha tenido en los &uacute;ltimos 5 a&ntilde;os?</td>
                <td>
                    <p>
                        1 <input name="cuantosTrabajos" id="1Trabajo" type="radio" value="1">
                        2 <input name="cuantosTrabajos" id="2Trabajos" type="radio" value="2">
                        3 <input name="cuantosTrabajos" id="3Trabajos" type="radio" value="3">
                        M&aacute;s de 3 <input name="cuantosTrabajos" id="=3Trabajos" type="radio" value="Mas de 3">
                        <span class="isMandatory" id="spanErrorCuantosTrabajos" style="display:none;">
                            <br />
                            Disculpe, debe indicarnos cuantos trabajos ha tenido en los &uacute;ltimos 5 a&ntilde;os.
                        </span>
                    </p>
                </td>
            </tr>
            <tr id="trTiempoTrabajo" style="display:none;">
                <td>Tiempo que permaneci&oacute; en el &uacute;ltimo trabajo:</td>
                <td> 
                    D&iacute;as <input name="tiempoTrabajo" id="tiempoDias" type="radio" value="Dias" />
                    Meses <input name="tiempoTrabajo" id="tiempoMeses" type="radio" value="Meses" />
                    1 A&ntilde;o <input name="tiempoTrabajo" id="tiempo1Year" type="radio" value="1 año" />
                    M&aacute;s de 1 a&ntilde;o <input name="tiempoTrabajo" id="tiempoMas1Year" type="radio" value="Más de un año" />
                    <span class="isMandatory" id="spanErrorTiempoTrabajo" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos cuanto tiempo permaneci&oacute; en el &uacute;ltimo trabajo.
                    </span>
                </td>
            </tr>
            <tr>
                <td>Cargo al que aspira:</td>
                <td>
                	<?php
                		$query = "SELECT id, nombre FROM cargo WHERE id_departamento=".$dptoId." ORDER BY LOWER(nombre)";
                		$cargos = DBUtil::executeSelect($query);
                		$i = 1;
                		
                		foreach ($cargos as $cargoItem){
					?>
						<?php echo htmlentities($cargoItem["nombre"]);?><input name="cargoAspirado" id="cargo<?php echo $i;?>" type="radio" value="<?php echo $cargoItem["id"];?>" />
					<?php
						}
                	?>
                    <span class="isMandatory" id="spanErrorCargoAspirado" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos el cargo aspirado.
                    </span>
                </td>
            </tr>
            <tr>
                <td>&iquest;Ha trabajado antes en La Muralla?</td>
                <td>
                    S&iacute; <input name="trabajoMuralla" id="siExEmpleado" type="radio" value="Si" onclick="displayElement('trExDpto', true); displayElement('trMotivoRetiro', true);" />
                    No <input name="trabajoMuralla" id="noExEmpleado" type="radio" value="No" onclick="displayElement('trExDpto', false); displayElement('trMotivoRetiro', false);" />
                    <span class="isMandatory" id="spanErrorExEmpleado" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos si ha laborado anteriormente en La Muralla.
                    </span>
                </td>
            </tr>
            <tr id="trExDpto" style="display:none;">
                <td>Departamento en el cual trabaj&oacute;:</td>
                <td>
                	<?php
                		$query = "SELECT id, nombre FROM departamento ORDER BY LOWER(nombre)";
                		$dptos = DBUtil::executeSelect($query);
                	?>
                    <select name="dptoTrabajo" id="dptoTrabajo">
                        <option value="">- -</option>
                        <?php
                        	foreach ($dptos as $itemDpto){
						?>
							<option value="<?php echo $itemDpto["id"];?>"><?php echo htmlentities($itemDpto["nombre"]);?></option>
						<?php
							} 
                        ?>
				    </select>
				    <span class="isMandatory" id="spanErrorExDpto" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos el Departamento en el cual trabaj&oacute;.
                    </span>
				</td>
		    </tr>
            <tr  id="trMotivoRetiro" style="display:none;">
                <td class="formu">Motivo de retiro:</td>
                <td class="formu">
                    <select name="motivoRetiro" id="motivoRetiro">
                        <option value="">- -</option>
                        <option> Renuncia</option>
	                    <option> Despido</option>
                        <option> Ninguno</option>
                    </select>
                    <span class="isMandatory" id="spanErrorMotivoRetiro" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos cual fue el motivo de su retiro.
                    </span>
                </td>
            </tr>
            <tr>
                <td>&iquest;Qu&eacute; horario desea trabajar?</td>
                <td>
                    <input type="checkbox" name="horario[]" id="horarioMixto" value="Mixto" /> Mixto
                    <br />
                    <input type="checkbox" name="horario[]" id="horarioDiurno" value="Diurno" /> Diurno
                    <br />
                    <input type="checkbox" name="horario[]" id="horarioNocturno" value="Nocturno" /> Nocturno
                    <span class="isMandatory" id="spanErrorHorario" style="display:none;">
                        <br />
                        Disculpe, debe indicarnos en que horario(s) desea trabajar.
                    </span>
                </td>
            </tr>
            <tr>
                <td>&iquest;Est&aacute; de acuerdo con la informaci&oacute;n introducida?</td>
                <td>
                    <input type="hidden" name="formSent" value="" />
                    <input type="button" name="enviar" id="enviar" value="Enviar" onclick="javascript:validateForm(this.form);" />
                    <input type="reset" name="Borrar" id="Borrar" value="Borrar" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
