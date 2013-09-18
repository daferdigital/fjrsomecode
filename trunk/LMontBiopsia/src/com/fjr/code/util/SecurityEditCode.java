package com.fjr.code.util;

/**
 * 
 * Class: SecurityEditCode
 * Creation Date: 11/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SecurityEditCode {
	private static final String SECURITY_CODE = "123456";
	
	/**
	 * 
	 * @param value
	 * @return
	 */
	public static boolean checkIfValueIsTheSecurityCode(String value){
		return SECURITY_CODE.equals(value);
	}
}
