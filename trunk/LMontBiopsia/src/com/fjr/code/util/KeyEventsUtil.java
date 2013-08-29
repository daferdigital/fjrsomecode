package com.fjr.code.util;

import java.awt.event.KeyEvent;

/**
 * 
 * Class: KeyEventsUtil
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class KeyEventsUtil {
	/**
	 * Single digits for all numbers
	 */
	private static final String DIGIT_NUMBERS = "0123456789";
	
	/**
	 * Valor en codigo del ENTER como tecla presionada.
	 */
	private static final int KEY_CODE_ENTER = 10;
	
	/**
	 * 
	 */
	private KeyEventsUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para saber si se tipeo un numero en un control de ventana.
	 * 
	 * @param e Evento asociado al tipeo del caracter
	 * @return
	 */
	public static boolean wasTypedANumber(KeyEvent e){
		boolean wasTyped = false;
		
		if(DIGIT_NUMBERS.contains(Character.toString(e.getKeyChar()))){
			wasTyped = true;
		}
		
		return wasTyped;
	}
	
	/**
	 * Metodo para saber si se tipeo un ENTER en un control de ventana.
	 * 
	 * @param e Evento asociado al tipeo del caracter
	 * @return
	 */
	public static boolean wasTypedAEnter(KeyEvent e){
		boolean wasTyped = false;
		
		if(e.getKeyCode() == KEY_CODE_ENTER){
			wasTyped = true;
		}
		
		return wasTyped;
	}
}
