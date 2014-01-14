package com.fjr.code.util;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.HashMap;
import java.util.Map;

import org.apache.log4j.Logger;

/**
 * Clase utilitaria para validar la licencia del sistema
 * y permitir asi su uso.
 * 
 * Class: LicenseUtil
 * Creation Date: 21/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class LicenseUtil {
	private static final Logger log = Logger.getLogger(LicenseUtil.class);
	private static final File licenseFile = new File(Constants.BASE_PATH + File.separator + "license.dat");
	
	/**
	 * 
	 */
	private static final Map<String, String> licenseCharacters = new HashMap<String, String>();
	
	private static final byte[] normalMacAddress = getNormalServerSerial();
	static {
		licenseCharacters.put("0", "J");
		licenseCharacters.put("1", "K");
		licenseCharacters.put("2", "L");
		licenseCharacters.put("3", "M");
		licenseCharacters.put("4", "N");
		licenseCharacters.put("5", "P");
		licenseCharacters.put("6", "Q");
		licenseCharacters.put("7", "R");
		licenseCharacters.put("8", "S");
		licenseCharacters.put("9", "T");
		licenseCharacters.put("A", "U");
		licenseCharacters.put("B", "V");
		licenseCharacters.put("C", "W");
		licenseCharacters.put("D", "X");
		licenseCharacters.put("E", "Y");
		licenseCharacters.put("F", "Z");
		
		//caracteres libres GHIJ
	}
	
	/**
	 * En caso de existir el archivo de licencia leemos su contenido para verificar la activacion.
	 * Dicho contenido es procesado en su equivalente de validacion de manera directa
	 * 
	 * 
	 * @return
	 */
	private static String readFixedLicenseValue(){
		String fileContent = null;
		String result = "";
		
		if(licenseFile.exists()){
			BufferedReader reader = null;
			
			try {
				reader = new BufferedReader(new FileReader(licenseFile));
				fileContent = reader.readLine();
				
				char[] chars = fileContent.toCharArray();
				int digito = 1;
				for (int i = 1; i < chars.length; i+=2) {
					result += licenseCharacters.get("G".equals(Character.toString(chars[i])) ? "0" : Character.toString(chars[i]));
					
					if((digito % 2) == 0 && i + 1 < chars.length){
						result += "-";
					}
					
					digito++;
					
				}
			} catch (Exception e) {
				// TODO: handle exception
			} finally {
				try {
					reader.close();
				} catch (Exception e2) {
					// TODO: handle exception
				}
			}
		} else {
			//el archivo de licencia no existe, debe activarse el software
			log.info("El archivo de licencia no existe, debe activarse el software");
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param licenseValue
	 */
	public static void writeLicenseFile(String licenseValue){
		if(licenseFile.exists()){
			licenseFile.delete();
		}
		
		BufferedWriter writer;
		try {
			writer = new BufferedWriter(new FileWriter(licenseFile));
			writer.write(licenseValue);
			writer.flush();
			writer.close();
			
			log.info("Almacenado valor de la licencia desde el formulario.");	
		} catch (IOException e) {
			// TODO Auto-generated catch block
			log.error(e.getMessage(), e);
		}
	}
	
	/**
	 * Retornamos el codigo especifico de validacion del servidor
	 * @return
	 */
	public static String getSerialServer(){
		return maskServerSerial(normalMacAddress);
	}
	
	/**
	 * 
	 * @return
	 */
	public static boolean isValidLicense(){
		boolean isValid = false;
		
		String maskedValue = maskServerSerial(normalMacAddress);
		String licenseFileFixed = readFixedLicenseValue();
		//log.info(getSerialAsString());
		
		if(maskedValue.equals(licenseFileFixed)){
			//la licencia es valida
			isValid = true;
		}
		
		//log.info("La validacion de la licencia para '" + maskedMacAddress + "' dio como resultado: " + isValid);
		//return isValid;
		return true;
	}
	
	/**
	 * Obtenemos de forma enmascarada el serial de la maquina donde se esta ejecutando el sistema.
	 * 
	 * @return
	 */
	private static String maskServerSerial(byte[] normalMacAddress){
		StringBuilder sb = new StringBuilder();
		try {
	 		
			for (int i = 0; i < normalMacAddress.length; i++) {
				//log.info(mac[i]);
				//sb.append(normalMacAddress[i] < 0 ? normalMacAddress[i] * -1 : normalMacAddress[i]);
				sb.append(String.format("%02X%s", normalMacAddress[i], (i < normalMacAddress.length - 1) ? "-" : ""));
			}
			
			char[] chars = new char[sb.length()];
			sb.getChars(0, sb.length(), chars, 0);
			sb.delete(0, sb.length());
			
			for (char c : chars) {
				if(licenseCharacters.containsKey(Character.toString(c))){
					sb.append(licenseCharacters.get(Character.toString(c)));
				} else {
					sb.append(c);
				}
			}
			
			//log.info(sb.toString());
		} catch (Exception e){
			log.error("Error procesando mascara de la MAC", e); 
		}
		
		return sb.toString();
	}
	
	/**
	 * 
	 * @return
	 */
	private static byte[] getNormalServerSerial(){
		byte[] macAddress = new byte[0];
		
		NetworkInterface network;
		try {
			network = NetworkInterface.getByInetAddress(
					InetAddress.getLocalHost());
			
			macAddress = network.getHardwareAddress();
		} catch (SocketException e) {
			// TODO Auto-generated catch block
			log.error(e.getMessage(), e);
		} catch (UnknownHostException e) {
			// TODO Auto-generated catch block
			log.error(e.getMessage(), e);
		}
 		
		return macAddress;
	}
}
