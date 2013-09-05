package com.fjr.code.util;

import java.util.regex.Pattern;

/**
 * 
 * Class: BiopsiaValidationUtil
 * Creation Date: 02/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class BiopsiaValidationUtil {
	private static final Pattern REG_EXP_NRO_BIOPSIA = Pattern.compile("([0-9]{2}\\-)[0-9]+");
	
	private BiopsiaValidationUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para validar que la estructura del numero de biopsia es la permitida en el sistema
	 * 
	 * @return
	 */
	public static boolean isAValidNroBiopsia(String nroBiopsia){
		boolean isValid = false;
		
		try {
			isValid = REG_EXP_NRO_BIOPSIA.matcher(nroBiopsia).matches();
		} catch (Exception e) {
			// TODO: handle exception
			e.printStackTrace();
		}
		
		return isValid;
	}
}
