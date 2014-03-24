package com.fjr.code.util;

import java.io.File;
import java.text.SimpleDateFormat;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.UIManager;

import org.jvnet.substance.SubstanceLookAndFeel;

import com.fjr.code.dto.UsuarioDTO;

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
	 * Variable para almacenar las distintas etiquetas creadas dentro de la aplicacion
	 */
	public static final String LABELS_PATH = BASE_PATH + File.separator + "labels";
	
	/**
	 * Variable para indicar el directorio temporal de la aplicacion
	 */
	public static final String TMP_PATH = BASE_PATH + File.separator + "tmp";
	
	/**
	 * Variable para indicar el directorio de respaldos de codigo (copia de jars viejos)
	 */
	public static final String RESPALDO_PATH = BASE_PATH + File.separator + "respaldo";
	
	/**
	 * Variable para indicar el directorio de logs de la aplicacion
	 * 
	 */
	public static final String LOGS_PATH = Constants.BASE_PATH + File.separator + "logs" + File.separator;
	
	/**
	 * Variable para indicar el directorio de images para la aplicacion
	 * 
	 */
	public static final String IMAGES_PATH = Constants.BASE_PATH + File.separator + "images" + File.separator;
	
	/**
	 * Variable para indicar el directorio de images para la aplicacion
	 * 
	 */
	public static final String FONTS_PATH = Constants.BASE_PATH + File.separator + "fonts" + File.separator;
	
	public static final String APP_SOFTWARE_NAME = "L'Mont Biopsias";
	public static final String APP_SOFTWARE_VERSION = "Versión 1.0 Beta";
	
	public static final int APP_WINDOW_MAX_X = 1000;
	public static final int APP_WINDOW_MAX_Y = 700;
	public static final int APP_MENU_HEIGTH = 22;
	
	//iconos
	public static final Icon icoMain = new ImageIcon(Constants.class.getResource("/resources/images/LmontTech.jpg"));

	
	public static final int MAX_RECORDS_PER_PAGE = 50;
	
	/**
	 * Codigo de reactivo a usar como vacio para poder cumplir con la FK de micro laminas recien creadas
	 * 
	 */
	public static final int REACTIVO_VACIO = -1;

	public static final String APP_WINDOW_TITLE = "Sistema de Gesti\u00F3n de Biopsias";
	
	/**
	 * Id de cliente por defecto para las nuevas biopsias
	 */
	public static final int ID_DEFAULT_CLIENTE = -2;
	
	/**
	 * Prefijo para el nombre del archivo pdf donde debe almacenarse fisicamente el contenido del diagnostico(informe)
	 */
	public static final String PREFIJO_PDF_INFORME = "diagnostico_";
	
	/**
	 * Prefijo para el nombre del archivo pdf donde debe almacenarse fisicamente el contenido del diagnostico complementario(informe complementario)
	 */
	public static final String PREFIJO_PDF_INFORME_COMPLEMENTARIO = "diagnosticoComplementario_";
	
	/**
	 * Atributo para formatear fechas en el estilo dia-mes-año
	 */
	public static final SimpleDateFormat sdfDDMMYYYY = new SimpleDateFormat("dd-MM-yyyy"); 
	
	/**
	 * Constante global para guardar los datos basicos del usuario recien logueado
	 */
	public static UsuarioDTO USUARIO_LOGUEADO = null;
	
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
