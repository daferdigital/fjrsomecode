package com.fjr.code.main;

 import java.io.File;
import java.io.IOException;
import java.net.ServerSocket;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.LoginWindow;
import com.fjr.code.util.Constants;
import com.fjr.code.util.LicenseUtil;
import com.fjr.code.util.SystemLogger;

/**
 * 
 * Class: Main <br />
 * DateCreated: 14/08/2013 <br />
 * @author T&T <br />
 *
 */
public class AfterStart {
	private static final Logger log = Logger.getLogger(AfterStart.class);
	private static final String basePath = new File("").getAbsolutePath();
	
	public static AppWindow mainWindow = null;
	
	static {
		//iniciamos el log para la aplicacion
		SystemLogger.init(basePath + File.separator + "logs" + File.separator);
	}
	
	/**
	 * 
	 * @param args
	 */
	public static void startProgram(String[] args) {
		try {
			final ServerSocket ss = new ServerSocket(7777);
			
			log.info("Directorio base: " + basePath);
			
			//hook para evitar que al finalizar la instancia de la JVM el server socket quede iniciado
			Runtime.getRuntime().addShutdownHook(new Thread(){
				@Override
				public void run() {
					// TODO Auto-generated method stub
					try {
						log.info("Closing ServerSocket...");
						ss.close();
					} catch (Exception e) {
						// TODO: handle exception
						log.error(e.getMessage(), e);
					}
				}
			});
			
			//verificamos si la licencia es valida
			if(! LicenseUtil.isValidLicense()){
				//debo mostrar el cuadro de activacion
				log.info("La licencia no es valida, debemos mostrar el cuadro de activacion");
				
			} else {
				//verificamos la existencia de la conexion a base de datos
				//si no existe debe ser indicada
			}
			
			//verificamos la conexion a base de datos
			
			
			//como es la corrida inicial, debemos mostrar la ventana de login
			new LoginWindow();
		} catch (IOException e) {
			JOptionPane.showMessageDialog(null,
					"Ya existe una instancia corriendo de " + Constants.APP_SOFTWARE_NAME,
					"Sistema ya en ejecución",
					JOptionPane.ERROR_MESSAGE);
			// e.printStackTrace();
		}
	}
}
