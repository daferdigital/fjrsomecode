<?php include_once("procesos/conexion.php");?>
<div class="titulo">
	Registro / Edici&oacute;n de Equipos
</div>
<script type="text/javascript">
	cadena_hiden='idequipo';
</script>
<form name="equipos" method="post" action="procesos/guardar_equipos.php" enctype="multipart/form-data">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%">
        		<label class="tit_campos">
        			Nombre del Equipo:
        		</label>
        		<input type="text" name="nombre" id="nombre" value="" />
        		<label class="campo_obligatorio">*</label>
        	</td>
    		<td  class="color_2colum">
    			<label class="tit_campos">Liga Padre:</label>
            	<select name="liga" id="liga">
                    <option value=""><b>Liga</b></option>
            	<?php 
					$selectligas="select * from ligas";
					$queryligas=mysql_query($selectligas);
					if(mysql_num_rows($queryligas)>0){
						while($varligas=mysql_fetch_assoc($queryligas)){
				?>
                			<option <?php echo $sel; ?> value="<?php echo $varligas['idliga']; ?>">
                				<?php echo $varligas['nombre']; ?>
                			</option>               
                <?php 
						}//fin while
					}//fin if
				?>
                </select>
              	<label class="campo_obligatorio">*</label>
            </td>
        </tr>
        <tr>
        	<td width="50%">
        		<label class="tit_campos">Estatus:</label>
        		<select name="estatus" id="estatus">
        			<option value="0">Deshabilitado</option>
        			<option value="1">Habilitado</option>
        		</select>
        		<label class="campo_obligatorio">*</label>
        	</td>
    		<td  class="color_2colum">
    			<span class="btn btn-success fileinput-button">
				    <i class="glyphicon glyphicon-plus"></i>
				    <span>Logo del Equipo <br /> (recomendado 36x24)</span>
				    <!-- The file input field used as target for the file upload widget -->
				    <input id="fileupload" type="file" name="files[]" noobli="noobli" />
				</span>
				<br>
				<br>
				<!-- The global progress bar -->
				<div id="progress" class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<!-- The container for the uploaded files -->
				<div id="files" class="files"></div>
    			<span id="imagenActual" style="display: none;">
    				Imagen Actual: 
    				<img name="imagenEquipo" id="imagenEquipo" src="" width="36px" height="24px" />
    			</span>
            </td>
        </tr>
        <tr>
        	<td align="left" colspan="2">
        		<input name="guardar" type="button" class="boton" onclick="javascript:validar(document.equipos,'equipos.php');" value="Guardar" />
        		<input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer"  onclick="deshacer(cadena_hiden);resetEquipoForm();" />
        	</td>
       	</tr>
    </table>
  	
  	<input type="hidden" name="idequipo" id="idequipo" value="" />
  	<input type="hidden" name="imageHidden" id="imageHidden" value="" />
  	
    <div id="listado">
    <?php
		include("procesos/listar_equipos.php");
	?>
    </div>
</form>

<script>
	/*jslint unparam: true */
	/*global window, $ */
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = window.location.hostname === 'blueimp.github.io' ?
	                '//jquery-file-upload.appspot.com/' : 
	                    'fileUpload/uploadLogoEquipo.php';
	   	$('#fileupload').fileupload({
		    url: url,
		    dataType: 'json',
		    done: function (e, data) {
		        $.each(data.result.files, function (index, file) {
		        	$('#files').text("Pendiente por guardar logo: " + file.name);
		            $("#imageHidden").val(file.name);
		            $("#imagenEquipo").attr("src", "imagenes/img_equipos/" + file.name);
		            $("#imagenActual").show();
		        });
		    },
		    progressall: function (e, data) {
		        var progress = parseInt(data.loaded / data.total * 100, 10);
		        $('#progress .progress-bar').css(
		            'width',
		            progress + '%'
		        );
		    }
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});

	$(function () {
		resetEquipoForm();
	});
</script>
