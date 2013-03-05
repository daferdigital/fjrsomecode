<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
body{ 
font-family:Arial, Helvetica, sans-serif;}
</style>
<script type="text/javascript">

function xLogro(valor)
{
	nv = parseFloat(valor);

	if (nv<0)
	  { return -(100-nv)/nv; }
	else  
	  { return (100+nv)/100; }	  
}

function CalcularParlay(form)
{
    TP1 = xLogro(form.Ap01.value);
    TP2 = xLogro(form.Ap02.value);
    TP3 = xLogro(form.Ap03.value);
    TP4 = xLogro(form.Ap04.value);
    TP5 = xLogro(form.Ap05.value);
    TP6 = xLogro(form.Ap06.value);
    TP7 = xLogro(form.Ap07.value);
    TP8 = xLogro(form.Ap08.value);
    TP9 = xLogro(form.Ap09.value);
    TP10 = xLogro(form.Ap10.value);
    Mnt = parseFloat(form.Mnt.value);

    APagar = ((TP1 * TP2 * TP3 * TP4 * TP5 * TP6 * TP7 * TP8 * TP9 * TP10)) * Mnt;
    form.APagar.value = APagar;
}

function ResetAllValues(form)
{
  form.Ap01.value = "0";
  form.Ap02.value = "0";
  form.Ap03.value = "0";
  form.Ap04.value = "0";
  form.Ap05.value = "0";
  form.Ap06.value = "0";
  form.Ap07.value = "0";
  form.Ap08.value = "0";
  form.Ap09.value = "0";
  form.Ap10.value = "0";

  form.APagar.value = "0";
  
}
</script>
</head>

<body>
<form style="margin: 0; ">
   <div>
     <div align="center"><strong>Gran Apuesta -- Calculadora de Parlay </strong></div>
   </div>
  <div align="center"><br />
  <table border="0" width="443" align="center">
    <tr>
      <td style="background-color:#090; color: #FFF;"><strong>Monto de la Apuesta</strong></td>
      <td bgcolor="#009900"><input style="font-size:16px;" type="text" size="10" name="Mnt" value="10" ></td>
      </tr>
    <tr>
      <td style="background-color:#000000; color: #FFF;"><strong>Equipo</strong></td>
      <td style="background-color:#000000; color: #FFF;"><strong>Logro</strong></td>
      </tr>
    <tr>
      <td>Logro del Equipo 01</td>
      <td><input type="text" size="10" name="Ap01" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 02</td>
      <td><input type="text" size="10" name="Ap02" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 03</td>
      <td><input type="text" size="10" name="Ap03" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 04</td>
      <td><input type="text" size="10" name="Ap04" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 05</td>
      <td><input type="text" size="10" name="Ap05" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 06</td>
      <td><input type="text" size="10" name="Ap06" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 07</td>
      <td><input type="text" size="10" name="Ap07" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 08</td>
      <td><input type="text" size="10" name="Ap08" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 09</td>
      <td><input type="text" size="10" name="Ap09" value="0" ></td></tr>
    <tr>
      <td>Logro del Equipo 10</td>
      <td><input type="text" size="10" name="Ap10" value="0" ></td></tr>
    <tr>
      <td colspan="2" bgcolor="#003300"><div align="center">
        <input type="button"  style="font-family: Arial; font-size: 10pt" value="Calcular!" onClick="CalcularParlay(this.form)">
        <input type="reset"  style="font-family: Arial; font-size: 10pt" value="Limpiar" onclick="ResetAllValues(this.form)" />
        </div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td><div align="center" style="font-size:16px;"><strong>Monto a Ganar &gt;&gt;&gt;</strong></div></td>
      <td><input style="font-size:16px;" type="text" size="10" name="APagar" value="0" ></td></tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td></tr>
  </table>
   </div>
</form>
</body>
</html>