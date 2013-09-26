package com.fjr.code.main;

import java.net.ServerSocket;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.gui.LicenseDialog;
import com.fjr.code.gui.MainDialog;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBConnectionUtil;
import com.fjr.code.util.LicenseUtil;
import com.fjr.code.util.SystemLogger;
import com.fjr.serialport.threads.PortScanManager;

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
	 */
	public static final void startApp(){
		//verificamos la conexion a base de datos
		MainDialog ventana = new MainDialog();
		ventana.setVisible(true);
		
		if(! DBConnectionUtil.haveValidConnectionConfiguration()){
			//en este punto, la licencia y la base de datos son validas, procedemos a iniciar la aplicacion
			JOptionPane.showMessageDialog(ventana, 
					"No fue detectada la configuracion local de base de datos.\n"
					+ "Si desea usar el programa para almacenar los mensajes en una base de datos que no esta en internet,\n"
					+ " debera configurar dicha conexion en el menu correspondiente.", 
					"Conexion local", 
					JOptionPane.WARNING_MESSAGE);
			log.error("No se posee una configuracion valida de base de datos. Debe solicitarse");
		}
		
		//iniciamos ejecucion
		new PortScanManager();
	}
	
	/**
	 * 
	 * @param args
	 */
	public static void startProgram(String[] args) {
		try {
			final ServerSocket ss = new ServerSocket(7770);
			
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
			
			//verificamos la licencia
			if(! LicenseUtil.isValidLicense()){
				//mostramos la ventana para introducir la licencia
				new LicenseDialog().setVisible(true);
			} else {
				startApp();
			}
		} catch (Exception e) {
			JOptionPane.showMessageDialog(null,
					"Ya existe una instancia corriendo de " + Constants.APP_SOFTWARE_NAME,
					"Sistema ya en ejecución",
					JOptionPane.ERROR_MESSAGE);
			log.error(e.getMessage(), e);
		}
	}
}
