package com.fjr.code.main;

import java.io.File;

import javax.swing.JOptionPane;

import com.fjr.code.util.Constants;
import com.fjr.code.util.CustomClasspathLoader;

/**
 * Clase de inicio para carga de classpath dinamico (directorio libs)
 * 
 * Class: Start
 * Creation Date: 22/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class Start {
	
	public static void main(String[] args) {
		try {
			new File(Constants.LABELS_PATH).mkdirs();
			new File(Constants.LOGS_PATH).mkdirs();
			new File(Constants.TMP_PATH).mkdirs();
			new File(Constants.RESPALDO_PATH).mkdirs();
			
			CustomClasspathLoader.addJarsToClasspath(Constants.BASE_PATH + File.separator 
					+ "libs" + File.separator);
			CustomClasspathLoader.addJarsToClasspath(Constants.BASE_PATH + File.separator);
			
			AfterStart.startProgram(args);
		} catch (Throwable e) {
			// TODO: handle exception
			JOptionPane.showMessageDialog(null, 
					"Error ajustando classpath automático. La aplicación no pudo ser iniciada. El error fue: " + e.getMessage(),
					"Error iniciando aplicación", 
					JOptionPane.ERROR_MESSAGE);
		}	
	}
}
