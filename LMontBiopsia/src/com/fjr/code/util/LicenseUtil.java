package com.fjr.code.util;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.net.UnknownHostException;

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
	
	/**
	 * En caso de existir el archivo de licencia leemos su contenido para verificar la activacion.
	 * 
	 * @return
	 */
	private static String readLicenseFile(){
		File licenseFile = new File(AppProperties.getBaseAppDirectory() + File.separator + "license.dat");
		String fileContent = null;
		
		if(licenseFile.exists()){
			BufferedReader reader = null;
			
			try {
				reader = new BufferedReader(new FileReader(licenseFile));
				fileContent = reader.readLine();
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
			//el archivo de licensia no existe, debe activarse el software
		}
		
		return fileContent;
	}
	
	/**
	 * 
	 * @return
	 */
	public static boolean isValidLicense(){
		boolean isValid = false;
		String maskedMacAddress = maskMacAddress();
		String licenseFileContent = readLicenseFile();
		
		if(maskedMacAddress.equals(licenseFileContent)){
			//la licencia es valida
			isValid = true;
		}
		
		log.info("La validacion de la licencia dio como resultado: " + isValid);
		return isValid;
	}
	
	/**
	 * Obtenemos de forma enmascarada la mac address de la maquina donde se esta ejecutando el sistema.
	 * 
	 * @return
	 */
	private static String maskMacAddress(){
		StringBuilder sb = new StringBuilder();
		try {
	 		NetworkInterface network = NetworkInterface.getByInetAddress(
	 				InetAddress.getLocalHost());
	 		
			byte[] mac = network.getHardwareAddress();
			
			for (int i = 0; i < mac.length; i++) {
				//log.info(mac[i]);
				sb.append(mac[i] < 0 ? mac[i] * -1 : mac[i]);
				sb.append(String.format("%02X%s", mac[i], (i < mac.length - 1) ? "-" : ""));		
			}
			
			log.info(sb.toString());
		} catch (UnknownHostException e) {
			log.error("Host desconocido", e);
		} catch (SocketException e){
			log.error("Error de conexion via socket", e); 
		}
		
		return sb.toString();
	}
}
