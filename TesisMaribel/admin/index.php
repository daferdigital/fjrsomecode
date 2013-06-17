<?php session_start();?>
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
    
    <form name="loginForm" action="doLogin.php" method="post" enctype="application/x-www-form-urlencoded" onsubmit="return validarLogin(this);">
    <table width="20%" border="0" align="center" style="margin-top: 50px;">
        <tr style="display: <?php echo (isset($_SESSION["invalidLogin"]) ? "''" : "none"); unset($_SESSION["invalidLogin"]);?>">
        	<td colspan="2" align="center">
        		<div>
        			Disculpe, el login y clave son inv&aacute;lidos. Intente de nuevo.
        		</div>
        	</td>
        </tr>
        <tr>
            <td>
                Usuario:
            </td>
            <td>
                <input type="text" name="login" id="login"/>
                <span id="spanNotEmptyLogin" class="isMandatory" style="display: none;">
                    <br />
                    Disculpe, el usuario es obligatorio.
                </span>
            </td>
        </tr>
        <tr>
            <td>
                Clave:
            </td>
            <td>
                <input type="password" name="clave" id="clave"/>
                <span id="spanNotEmptyPassword" class="isMandatory" style="display: none;">
                    <br />
                    Disculpe, la clave es obligatoria.
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Ingresar"/>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
