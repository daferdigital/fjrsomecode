package com.fjr.code.util;

import java.io.File;
import java.io.FileOutputStream;

import org.apache.log4j.Logger;

/**
 * 
 * Class: BLOBToDiskUtil
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class BLOBToDiskUtil {
	private static final Logger log = Logger.getLogger(BLOBToDiskUtil.class);
	
	private BLOBToDiskUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param destination
	 * @param contenido
	 */
	public static boolean writeBLOBToDisk(File destination, byte[] contenido){
		boolean result = false;
		log.info("Peticion de escribir " + contenido.length + " bytes en el archivo "
				+ destination.getAbsolutePath());
		
		try {
			FileOutputStream fos = new FileOutputStream(destination);
			fos.write(contenido);
			fos.flush();
			fos.close();
			
			result = true;
			log.info("Archivo " + destination.getAbsolutePath() + " fue llenado con el contenido respectivo");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("No se pudo escribir el contenido en la ruta " + destination.getAbsolutePath()
					+ ". Error fue: " + e.getMessage(), e);
		}
		
		log.info("Peticion de escribir " + contenido.length + " bytes en el archivo "
				+ destination.getAbsolutePath() + " dio como resultado: " + result);
		return result;
	}
}
