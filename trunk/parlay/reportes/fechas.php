<?php
	function FechaOrdenar($pFecha, $pSeparador, $accion) 
	{
		if (trim($pFecha)!="") 
		{
			if ($accion=='M')
			{
				$f = explode('-', $pFecha);
				return "$f[2]/$f[1]/$f[0]";
			}
			else 
			{
				$Hora = "";
				if (strlen($pFecha)>10)
				{
					$vFecha = explode(" ", $pFecha);
					
					$Fecha = $vFecha[0];
					$Hora = " ".$vFecha[1]." ".$vFecha[2];
				}
				else
				{ $Fecha = $pFecha;	}
					$FechaOrd = explode($pSeparador, $Fecha);
					$FechaOrd = "$FechaOrd[2]/$FechaOrd[1]/$FechaOrd[0]";
					return($FechaOrd.$Hora);
			}
		}
	}

			    
		function ToFecha() 
	{
		$aDias = array("Domingo","Lunes", "Martes", "Miercoles","Jueves", "Viernes", "Sabado");
		$aMeses= array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$dia_letra = array("Uno","Dos","Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez","Once","Doce","Trece","Catorce","Quince","Dieciseis","Diecisiete","Dieciocho","Diecinueve","Veinte","Veintiuno","Veintidos","Veintitres","Veinticuatro","Veinticinco","Veintiseis","Veintisiete","Veintiocho","Veintinueve","Treinta","Treinta y uno");
		$nDiaSemana= date("w");
		$nDia1 = date("j");
		$nDia = (date("j")-1);
		$nMes = (date("n")-1);
		$nAnio = date("Y");
		return  "<strong>$dia_letra[$nDia] </strong>"."<strong>($nDia1)</strong>". "  d&iacute;as del mes de " ."<strong>$aMeses[$nMes]</strong>". " de " . "<strong>$nAnio.</strong>";
	}
	
		function FechaNor() 
	{
		$aDias = array("Domingo","Lunes", "Martes", "Miercoles","Jueves", "Viernes", "Sabado");
		$aMeses= array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$dia_letra = array("Uno","Dos","Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez","Once","Doce","Trece","Catorce","Quince","Dieciseis","Diecisiete","Dieciocho","Diecinueve","Veinte","Veintiuno","Veintidos","Veintitres","Veinticuatro","Veinticinco","Veintiseis","Veintisiete","Veintiocho","Veintinueve","Treinta","Treinta y uno");
		$nDiaSemana= date("w");
		$nDia1 = date("j");
		$nDia = (date("j")-1);
		$nMes = (date("n")-1);
		$nAnio = date("Y");
		return  "$nDia1". " de " ."$aMeses[$nMes]". " de " . "$nAnio.";
	}	




	function FechaOrdenar1($pFecha, $pSeparador, $accion) 
	{
		if (trim($pFecha)!="") 
		{
			if ($accion=='M')
			{
				$f = explode('-', $pFecha);
				return "$f[2]/$f[1]/$f[0]";
			}
			else 
			{
				$Hora = "";
				if (strlen($pFecha)>10)
				{
					$vFecha = explode(" ", $pFecha);
					
					$Fecha = $vFecha[0];
					$Hora = " ".$vFecha[1]." ".$vFecha[2];
				}
				else
				{ $Fecha = $pFecha;	}
					$FechaOrd = explode($pSeparador, $Fecha);
					$FechaOrd = "$FechaOrd[0]$FechaOrd[1]$FechaOrd[2]";
					return($FechaOrd.$Hora);
			}
		}
	}

	function FechaOrdenar2($pFecha, $pSeparador, $accion) 
	{
		if (trim($pFecha)!="") 
		{
			if ($accion=='M')
			{
				$f = explode('-', $pFecha);
				return "$f[2]-$f[1]-$f[0]";
			}
			else 
			{
				$Hora = "";
				if (strlen($pFecha)>10)
				{
					$vFecha = explode(" ", $pFecha);
					
					$Fecha = $vFecha[0];
					$Hora = " ".$vFecha[1]." ".$vFecha[2];
				}
				else
				{ $Fecha = $pFecha;	}
					$FechaOrd = explode($pSeparador, $Fecha);
					$FechaOrd = "$FechaOrd[2]-$FechaOrd[1]-$FechaOrd[0]";
					return($FechaOrd.$Hora);
			}
		}
	}
		
?>