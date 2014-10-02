package com.dafer.sms.send.japplet.util;

/**
 * 
 * Class: DebugLog
 * Creation Date: 01/10/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public final class DebugLog {
	public static boolean isDebug = false;
	
	/**
	 * 
	 */
	private DebugLog() {
		// TODO Auto-generated constructor stub
	}
	
	public static void info(String message){
		if(isDebug){
			System.out.println("INFO : " + message);
		}
	}
	
	public static void warning(String message){
		if(isDebug){
			System.out.println("WARN : " + message);
		}
	}
	
	public static void warning(String message, Throwable e){
		if(isDebug){
			System.out.println("WARN : " + message + ". Exception: " + e.getLocalizedMessage());
		}
	}
	
	public static void error(String message){
		if(isDebug){
			System.out.println("ERROR: " + message);
		}
	}
	
	public static void error(String message, Throwable e){
		if(isDebug){
			System.out.println("ERROR: " + message + ". Exception: " + e.getLocalizedMessage());
			e.printStackTrace();
		}
	}
}
