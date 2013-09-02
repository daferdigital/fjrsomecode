package com.fjr.code.util;

import java.awt.event.KeyEvent;
import java.util.regex.Pattern;

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
	 * 
	 */
	private static final Pattern PATTERN_VALID_EMAIL = Pattern.compile(
			"^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$");
	
	/**
	 * Valor en codigo del ENTER como tecla presionada.
	 */
	private static final int KEY_CODE_ENTER = 10;
	
	/**
	 * Valor en codigo del ENTER como tecla presionada.
	 */
	private static final int KEY_CODE_BACKSPACE = 8;
	
	/**
	 * 
	 */
	private KeyEventsUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para validar si un determinado texto tiene la estructura de una direccion valida de correo
	 * 
	 * @param e
	 * @return
	 */
	public static boolean isAValidEmailAddress(String emailValue){
		boolean isValid = false;
		
		try {
			isValid = PATTERN_VALID_EMAIL.matcher(emailValue).matches();
		} catch (Exception ex) {
			// TODO: handle exception
			ex.printStackTrace();
		}
		
		return isValid;
	}
	
	/**
	 * Metodo para saber si se tipeo un digito en un control de ventana.
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
	 * Metodo para saber si se presiono una tecla de digitos en un control de ventana.
	 * 
	 * @param e Evento asociado al tipeo del caracter
	 * @return
	 */
	public static boolean wasPressedANumber(KeyEvent e){
		boolean wasTyped = false;
		
		if(DIGIT_NUMBERS.contains(Character.toString(e.getKeyChar()))){
			wasTyped = true;
		}
		
		return wasTyped;
	}
	
	/**
	 * Metodo para saber si se presiono la tecla ENTER en un control de ventana.
	 * 
	 * @param e Evento asociado al tipeo del caracter
	 * @return
	 */
	public static boolean wasPressedAEnter(KeyEvent e){
		boolean wasTyped = false;
		
		if(e.getKeyCode() == KEY_CODE_ENTER){
			wasTyped = true;
		}
		
		return wasTyped;
	}
	
	/**
	 * Metodo para saber si se presiono la tecla BACKSPACE en un control de ventana.
	 * 
	 * @param e Evento asociado al tipeo del caracter
	 * @return
	 */
	public static boolean wasPressedABackSpace(KeyEvent e){
		boolean wasTyped = false;
		
		if(e.getKeyCode() == KEY_CODE_BACKSPACE){
			wasTyped = true;
		}
		
		return wasTyped;
	}
}
