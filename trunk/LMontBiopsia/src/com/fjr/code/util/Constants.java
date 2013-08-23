package com.fjr.code.util;

import java.io.File;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.UIManager;

import org.jvnet.substance.SubstanceLookAndFeel;

/**
 * 
 * Class: Constants
 * Creation Date: 18/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class Constants {
	private Constants() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Variable para almacenar el directorio desde donde se inicio la aplicacion
	 */
	public static final String BASE_PATH = new File("").getAbsolutePath();
	
	/**
	 * Variable para almacenar el directorio desde donde se inicio la aplicacion
	 */
	public static final String LABELS_PATH = BASE_PATH + File.separator + "labels";
	
	public static final String APP_SOFTWARE_NAME = "L'Mont Biopsias";
	public static final String APP_SOFTWARE_VERSION = "Versión 1.0 Beta";
	
	public static final int APP_WINDOW_MAX_X = 1000;
	public static final int APP_WINDOW_MAX_Y = 700;
	public static final int APP_MENU_HEIGTH = 22;
	
	//iconos
	public static final Icon icoMain = new ImageIcon(Constants.class.getResource("/resources/images/LmontTech.jpg"));
	
	/**
	 * 
	 */
	public static void setLookAndFeel() {
		try {
			boolean typeWindow = true;
			if (typeWindow) {
				JFrame.setDefaultLookAndFeelDecorated(true);
				JDialog.setDefaultLookAndFeelDecorated(true);

				UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());

			} else {
				JFrame.setDefaultLookAndFeelDecorated(true); 
				JDialog.setDefaultLookAndFeelDecorated(true);

				UIManager.setLookAndFeel("com.nilo.plaf.nimrod.NimRODLookAndFeel"); // tipo
																					// personalizado
				// UIManager.setLookAndFeel("javax.swing.plaf.nimbus.NimbusLookAndFeel");
				// UIManager.setLookAndFeel("com.sun.java.swing.plaf.windows.WindowsLookAndFeel");

				SubstanceLookAndFeel.setSkin("org.jvnet.substance.skin.BusinessBlueSteelSkin");
				// SubstanceLookAndFeel.setSkin("org.jvnet.substance.skin.NebulaSkin");

			}
		} catch (Exception e) {
			e.printStackTrace();
		}		
	}
}
