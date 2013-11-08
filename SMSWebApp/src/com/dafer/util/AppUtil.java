package com.dafer.util;

import java.util.regex.Pattern;

/**
 * 
 * Class: AppUtil <br />
 * DateCreated: 01/04/2013 <br />
 * @author T&T <br />
 *
 */
public final class AppUtil {
	private static final String EMAIL_PATTERN = 
			"^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@"
			+ "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
	
	private AppUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Rutina para validar si determinado valor de email es realmente del formato valido
	 * 
	 * @param email
	 * @return
	 */
	public static boolean isAValidEmail(String email) {
		boolean isValid = false;
		
		try {
			Pattern pattern = Pattern.compile(EMAIL_PATTERN);
			isValid = pattern.matcher(email).matches();
		} catch (Exception e) {
			// TODO: handle exception
		}

		return isValid;
	}
	
	/**
	 * 
	 * @param value
	 * @return
	 */
	public static boolean isEmptyOrNull(String value){
		if(value == null){
			return true;
		}else{
			if("".equals(value.trim()) || "null".equals(value.trim())){
				return true;
			}
		}
		
		return false;
	}
}
