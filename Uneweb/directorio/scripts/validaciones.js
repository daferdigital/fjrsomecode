function prepareOficios(selectOficios){
	var tmpValues = "";
	var i = 0;
	
	for(i = 0; i < selectOficios.length; i++){
	    if (selectOficios.options[i].selected) {
	        if(tmpValues != ""){
	       		tmpValues += "|";
	        }
	        tmpValues += selectOficios.options[i].value;
	    }
	}
	
	//alert(tmpValues);
	document.getElementById('tipoTmp').value = tmpValues;
}

function MM_validateForm2() { //v4.0
  if (document.getElementById){
    var i,p,nm,test,num,min,max,errors='',args=MM_validateForm2.arguments;
    
    for (i=0; i<(args.length-2); i+=3) {
        test=args[i+2]; 
        val=document.getElementById(args[i]);

        if (val) {
            //nm=val.name;
            nm=args[i+1];  
            if ((val=val.value)!="") {
	            if (test.indexOf('isEmail')!=-1) {
	                p=val.indexOf('@');
	
	                if (p<1 || p==(val.length-1)) {
	                     errors+='- '+nm+' debe ser una direccion de correo.\n';
	                }
	        	} else if (test!='R') {
	            	num = parseFloat(val);
	
	            	if (isNaN(val)) {
	                	 errors+='- '+nm+' debe ser un numero.\n';
	            	}
	            	if (test.indexOf('inRange') != -1) { 
	                	p=test.indexOf(':');
	                	min=test.substring(8,p); 
	                	max=test.substring(p+1);
	
	            		if (num<min || max<num) {
	                		errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
	            		}
	            	} 
	            } 
	        } else if (test.charAt(0) == 'R') {
	            errors += '- '+nm+' es obligatorio.\n'; 
	        }
    	}
    }

    if (errors) {
    	alert('Los siguientes errores han ocurrido:\n'+errors);
	}
	
    document.MM_returnValue = (errors == '');
    return document.MM_returnValue;
  }
}

var tDate=new Date();
var iCurrentMonth=tDate.getMonth(); 
var iCurrentYear=1900 + tDate.getYear(); 
var monthName = "";

function PreviousMonth(){
	ClearCalendar();
	--iCurrentMonth;
	if (iCurrentMonth<0) {
		iCurrentMonth=11;
		--iCurrentYear;
	}
	SetCalendar();
}

function NextMonth(){
	ClearCalendar();
	++iCurrentMonth;
	if (iCurrentMonth==12) {
		iCurrentMonth=0;
		++iCurrentYear;
	}
	SetCalendar();
}

function ClearCalendar(){
	var i=0;
	var j=0;	
	var oCurRow;
	var oCell;
	var oTable=document.all("tblCalendar");

	for (i=2;i<8;i++){
		oCurRow = oTable.rows[i];
		for (j=0;j<7;j++){
			oCell=oCurRow.cells[j];
			oCell.innerHTML = "<font face='Verdana, Arial, Helvetica, sans-serif' size='1'>&nbsp;</font>";
		}
	}
}

function GetDaysPerMonth(iMonth, iYear){
	switch (iMonth){
		case 0: monthName = "Ene"; return 31; break;
		case 1:
			monthName = "Feb";
			if (iYear % 4 == 0){
				if (iYear % 400 == 0){
					return 29;
				}
				else {
					if (iYear % 100 == 0){
						return 28;
					}
					else {
						return 29;
					}
				}
			}
			else {
				return 28;			
			}; 
			break;
		case 2: monthName = "Mar"; return 31; break;
		case 3: monthName = "Abr"; return 30; break;
		case 4: monthName = "May"; return 31; break;
		case 5: monthName = "Jun"; return 30; break;
		case 6: monthName = "Jul"; return 31; break;
		case 7: monthName = "Ago"; return 31; break;
		case 8: monthName = "Sep"; return 30; break;
		case 9: monthName = "Oct"; return 31; break;
		case 10: monthName = "Nov"; return 30; break;
		case 11: monthName = "Dic"; return 31; break;
	}
}

function SetCalendar(){
	var iDay=0;
	
	var tFirstDayDate = new Date(iCurrentYear,iCurrentMonth,1);
	var iLastDayMonth=GetDaysPerMonth(iCurrentMonth, iCurrentYear);
	var iCol=tFirstDayDate.getDay(); //0-Diumenge ... 6-Dissabte	
	--iCol;
	if (iCol <0) {
		iCol = 6;
	}
	//alert(iCol + "-" + tFirstDayDate);
	var iRow=2;
	//var oTable=document.all("tblCalendar");
	var oTable = document.getElementById('tblCalendar');
	//alert(oTable.rows.length + '-'+ iCol);
	var oCurRow;
	var oCell;

	for (iDay=1;iDay<=iLastDayMonth;iDay++){
		oCurRow = oTable.rows[iRow];
		//alert(oCurRow.cells.length);
		oCell=oCurRow.cells[iCol];
		oCell.innerHTML = "<div align='center'>"
			+ "<font face='Verdana, Arial, Helvetica, sans-serif' size='2'>"
			+"<a href=\"javascript:setDateValue('" + iDay +"', '" + iCurrentMonth + "', '" + iCurrentYear + "')\">"+iDay+"</a>"
			+"</font></div>";
		iCol++;
		if (iCol>6) {
			iCol=0;
			iRow++;
		}
	}
	oCurRow= oTable.rows[0];
	oCell=oCurRow.cells[1];
	oCell.innerHTML = "<div align='center'><font face='Verdana, Arial, Helvetica, sans-serif' size='2'>"+monthName+"/"+iCurrentYear+"</font></div>";
}

function setDateValue(day,month,year){
	//alert(day + " - " + (month + 1) + " - " + year);
	month++;
	document.getElementById('dateValue').value = year + "/" + month + "/" + day;
}
