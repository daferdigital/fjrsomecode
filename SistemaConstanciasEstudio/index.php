<?php
include_once './classes/DBUtil.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>.:: Sistema de Expedición de Constancias de Estudio ::.</title>
	<script type="text/javascript" src="./js/scripts.js"></script>

    <link rel="stylesheet" type="text/css" href="./css/site.css">
</head>
<body>
    <table width="80%"  border="0" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tr>
            <td width="13%">
                <div align="center">
                    <img src="./images/header.png" />
                </div>
            </td>
        </tr>
    </table>
    <table align="center">
    	<tr>
    		<td colspan="2">
    			Ubique a quien este dirigida la constancia de estudio
    		</td>
    	</tr>
    	<tr>
    		<td>N&uacute;mero de C&eacute;dula</td>
    		<td>
    			<input type="text" name="cedula" id="cedula" maxlength="8" onkeypress="return textInputOnlyNumbers(event);" />
    			<div style="display: none" class="isMandatory" id="mandatoryCedula">
					Disculpe, debe indicar un valor para la c&eacute;dula.
				</div>
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2" align="center">
    			<input type="button" value="Buscar" onclick="buscarDataInfo(1);">
    		</td>
    	</tr>
    </table>
    
    <div style="width: 100%; align: center;" id="ajaxPageResult">
		&nbsp;
	</div>
</body>
</html>