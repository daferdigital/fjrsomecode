package com.fjr.code.main;

import java.io.File;

import javax.swing.JOptionPane;

import com.fjr.code.util.CustomClasspathLoader;

public class Start {
	private static final String basePath = new File("").getAbsolutePath();
	
	
	public static void main(String[] args) {
		try {
			CustomClasspathLoader.addJarsToClasspath(basePath + File.separator 
					+ "libs" + File.separator);
			Main.startProgram(args);
		} catch (Throwable e) {
			// TODO: handle exception
			JOptionPane.showMessageDialog(null, 
					"Error ajustando classpath automático. La aplicación no pudo ser iniciada",
					"Error iniciando aplicación", 
					JOptionPane.ERROR_MESSAGE);
		}
		
		
	}
}
