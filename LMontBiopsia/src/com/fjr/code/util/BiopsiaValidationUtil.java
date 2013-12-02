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
	private static final Pattern REG_EXP_NEW_NRO_BIOPSIA = Pattern.compile("([0-9]{2}\\-)[0-9]{1,5}");
	private static final Pattern REG_EXP_OLD_NRO_BIOPSIA = Pattern.compile("([0-9]{4}\\-)[A-Z]{1}");
	
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
			isValid = REG_EXP_NEW_NRO_BIOPSIA.matcher(nroBiopsia).matches();
			if(!isValid){
				//verificamos los tipos de codigos viejos, para permitir la carga de esas biopsias
				isValid = REG_EXP_OLD_NRO_BIOPSIA.matcher(nroBiopsia).matches();
			}
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
		return String.format("%02d-%05d", year, number);
	}
	
	/**
	 * 
	 * @param year
	 * @param number
	 * @return
	 */
	public static String formatCodigoBiopsia(String codigo){
		try {
			if(isAValidNroBiopsia(codigo)){
				String[] pieces = codigo.split("\\-");
				int year = Integer.parseInt(pieces[0]);
				int numero  = Integer.parseInt(pieces[1]);
				
				codigo = String.format("%02d-%05d", year, numero);
			}
		} catch (Exception e) {
			// TODO: handle exception
			//es el formato antiguo de codigo, lo dejamos igual
		}
		
		return codigo;
	}
}
