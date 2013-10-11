package com.fjr.code.pdf;

import com.fjr.code.util.Constants;
import com.itextpdf.text.Font;
import com.itextpdf.text.FontFactory;

/**
 * 
 * Class: FuenteInformeUtil
 * Creation Date: 08/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
class FuenteInformeUtil {
	private static final Font informeFontNormal;
	private static final Font informeFontBold;
	
	static{
		FontFactory.register(Constants.FONTS_PATH + "ARIAL.TTF", "FuenteNormal");
		FontFactory.register(Constants.FONTS_PATH + "ARIALBD.TTF", "FuenteBold");
		
		informeFontNormal = FontFactory.getFont("FuenteNormal");
		informeFontBold = FontFactory.getFont("FuenteBold");
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
