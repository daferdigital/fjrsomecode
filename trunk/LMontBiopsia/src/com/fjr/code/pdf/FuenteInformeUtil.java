package com.fjr.code.pdf;

import com.fjr.code.util.Constants;
import com.itextpdf.text.Font;
import com.itextpdf.text.FontFactory;

class FuenteInformeUtil {
	private static final Font informeFontNormal;
	private static final Font informeFontBold;
	
	static{
		FontFactory.register(Constants.FONTS_PATH + "CALIBRI.TTF", "CalibriNormal");
		FontFactory.register(Constants.FONTS_PATH + "CALIBRIB.TTF", "CalibriBold");
		
		informeFontNormal = FontFactory.getFont("CalibriNormal");
		informeFontBold = FontFactory.getFont("CalibriBold");
	}
	
	private FuenteInformeUtil() {
		// TODO Auto-generated constructor stub
	}
	
	public static Font getInformeFontBold() {
		return informeFontBold;
	}
	
	public static Font getInformeFontNormal() {
		return informeFontNormal;
	}
}
