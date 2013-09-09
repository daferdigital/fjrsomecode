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
	private static final Pattern REG_EXP_NRO_BIOPSIA = Pattern.compile("([0-9]{2}\\-)[0-9]{1,6}");
	
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
	
	/**
	 * 
	 * @param year
	 * @param number
	 * @return
	 */
	public static String formatCodigoBiopsia(int year, int number){
		return String.format("%02d-%06d", year, number);
	}
	
	public static String formatCodigoBiopsia(String number){
		return String.format("%02s-%06s", number, number);
	}
	
	public static void main(String[] args) {
		System.out.println(formatCodigoBiopsia("3-5"));
	}
}
