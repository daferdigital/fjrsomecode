package com.yss.util;

/**
 * 
 * Class: UtilText
 * Creation Date: 08/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class UtilText {
	
	private UtilText() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param value
	 * @return
	 */
	public static String emptyIfNull(String value){
		if((value == null) || ("null".equals(value))){
			return "";
		} else {
			return value;
		}
	}
}
