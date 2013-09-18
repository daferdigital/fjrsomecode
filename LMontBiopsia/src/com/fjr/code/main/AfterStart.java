package com.fjr.code.main;

import java.io.IOException;
import java.net.ServerSocket;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.gui.DataBaseConfigDialog;
import com.fjr.code.gui.LoginWindow;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBConnectionUtil;
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
	
	static {
		//iniciamos el log para la aplicacion
		SystemLogger.init(Constants.LOGS_PATH);
	}
	
	/**
	 * 
	 * @param args
	 */
	public static void startProgram(String[] args) {
		try {
			final ServerSocket ss = new ServerSocket(7777);
			
			log.info("Directorio base: " + Constants.BASE_PATH);
			
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
			
			//verificamos la conexion a base de datos
			if(DBConnectionUtil.haveValidConnectionConfiguration()){
				//como es la corrida inicial, debemos mostrar la ventana de login
				new LoginWindow();
			} else {
				log.error("No se posee una configuracion valida de base de datos. Debe solicitarse");
				new DataBaseConfigDialog().setVisible(true);
			}
		} catch (IOException e) {
			JOptionPane.showMessageDialog(null,
					"Ya existe una instancia corriendo de " + Constants.APP_SOFTWARE_NAME,
					"Sistema ya en ejecución",
					JOptionPane.ERROR_MESSAGE);
			// e.printStackTrace();
		}
	}
}
