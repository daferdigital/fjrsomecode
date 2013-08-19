package com.fjr.code.main;

import java.io.IOException;
import java.net.ServerSocket;

import javax.swing.JOptionPane;
import javax.swing.JPanel;

import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.LoginWindow;
import com.fjr.code.gui.MenuPanel;
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
public class Main {
	public static AppWindow mainWindow = null;
	
	public static void main(String[] args) {
		try {
			final ServerSocket ss = new ServerSocket(7777);
			
			//hook para evitar que al finalizar la instancia de la JVM el server socket quede iniciado
			Runtime.getRuntime().addShutdownHook(new Thread(){
				@Override
				public void run() {
					// TODO Auto-generated method stub
					try {
						ss.close();
					} catch (Exception e) {
						// TODO: handle exception
					}
				}
			});
			
			//iniciamos el log para la aplicacion
			SystemLogger.init();
			
			//verificamos si la licencia es valida
			if(! LicenseUtil.isValidLicense()){
				//debo mostrar el cuadro de activacion
			} else {
				//verificamos la existencia de la conexion a base de datos
				//si no existe debe ser indicada
			}
			
			//verificamos la conexion a base de datos
			
			
			//como es la corrida inicial, debemos mostrar la ventana de login
			LoginWindow login = new LoginWindow();
		} catch (IOException e) {
			JOptionPane.showMessageDialog(null, "Ya existe una instancia corriendo de " + Constants.APP_SOFTWARE_NAME);
			// e.printStackTrace();
		}
	}
}
