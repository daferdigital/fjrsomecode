<?php
/**
 * 
 * @param String $iMonth
 * @param String $iYear
 */
function getDaysPerMonth($iMonth, $iYear){
	$monthName;
	$daysInMonth;
	
	switch ((int) $iMonth){
		case 1: $monthName = "Ene"; $daysInMonth = 31; break;
		case 2:
			$monthName = "Feb";
			if ($iYear % 4 == 0){
				if ($iYear % 400 == 0){
					$daysInMonth = 29;
				} else {
					if ($iYear % 100 == 0){
						$daysInMonth = 28;
					} else {
						$daysInMonth = 29;
					}
				}
			} else {
				$daysInMonth = 28;
			};
			break;
		case 3: $monthName = "Mar"; $daysInMonth = 31; break;
		case 4: $monthName = "Abr"; $daysInMonth = 30; break;
		case 5: $monthName = "May"; $daysInMonth = 31; break;
		case 6: $monthName = "Jun"; $daysInMonth = 30; break;
		case 7: $monthName = "Jul"; $daysInMonth = 31; break;
		case 8: $monthName = "Ago"; $daysInMonth = 31; break;
		case 9: $monthName = "Sep"; $daysInMonth = 30; break;
		case 10: $monthName = "Oct"; $daysInMonth = 31; break;
		case 11: $monthName = "Nov"; $daysInMonth = 30; break;
		case 12: $monthName = "Dic"; $daysInMonth = 31; break;
	}
	
	return array(0 => $monthName, 1 => $daysInMonth);
}


function getDivDiasInfo(){
	$mesesToPrint = 24;
	$nodoDiv = 0;
	$fechaActual = date("Y-m");
	$iYearBase = substr($fechaActual, 0, 4);
	$iMonthBase = substr($fechaActual, 5, 2);
	
	$iDaysPerMonth;
	$visualStyle;
	
	$divDiasInfo = "<div id=\"dateOptions\" class=\"clearfix\">
		<input type=\"hidden\" name=\"salidas\" id=\"salidas\" value=\"\" />";
	
	for($i = 0; $i < $mesesToPrint; $i++){
		//revisamos los meses a imprimir
		$mkTimeValue = mktime(0,0,0, $iMonthBase + $i, 1, $iYearBase);
		$fechaActual = date("Y-m", $mkTimeValue);
		$iYear = substr($fechaActual, 0, 4);
		$iMonth = substr($fechaActual, 5, 2);
		
		$result = getDaysPerMonth($iMonth, $iYear);
		
		$monthName = $result[0];
		$iDaysPerMonth = $result[1];
		
		$wValue = date("w", $mkTimeValue);
		
		if($nodoDiv < 2){
			$visualStyle = "style=\"display: block\"";
		} else {
			$visualStyle = "style=\"display: none\"";
		}
		
		$divDiasInfo .= "<div class=\"yearBox\" id=\"$nodoDiv\" $visualStyle>
		<h4>
		<cufon style=\"width: 33px; height: 13px;\" alt=\"$iYear-$monthName\" class=\"cufon cufon-canvas\">
		<canvas style=\"width: 40px; height: 15px; top: -2px; left: -1px;\" height=\"15\" width=\"40\"></canvas>
		<cufontext>$monthName - $iYear</cufontext>
		</cufon>
		</h4>
		<ul>
		<li>Do</li>
		<li>Lu</li>
		<li>Ma</li>
		<li>Mi</li>
		<li>Ju</li>
		<li>Vi</li>
		<li>Sa</li>";
		
		//ajustamos el primer dia del mes
		for($d = 0; $d < $wValue; $d++){
			$divDiasInfo .=  "<li></li>";
		}
		
		//mostramos el mes correspondiente
		for($d = 1; $d <= $iDaysPerMonth; $d++){
			if($d < 10){
				$d = "0".$d;
			}
			
			$key1 = $iYear."-".$iMonth."-".$d;
		
			$divDiasInfo .=  "<li>
				<label class=\"\" id=\"$key1\">
				<a name=\"date\" title=\"$key1\" href=\"#dateHID$key1\" onclick=\"javascript:putAsChecked(this, '".$key1."'); return false;\">$d</a>".
				"</label>
				</li>";
		}
		
		$divDiasInfo .="</ul></div>";
		
		$nodoDiv ++;
	}
	
	$divDiasInfo .= "</div>";
	
	return $divDiasInfo;
}

?>