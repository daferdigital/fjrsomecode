package com.fjr.code.main;

import javax.swing.JPanel;

import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.LoginPanel;
import com.fjr.code.gui.MenuPanel;
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
		//iniciamos el log para la aplicacion
		//SystemLogger.init();
		
		//verificamos la conexion a base de datos
		
		
		//como es la corrida inicial, debemos mostrar la ventana de login
		JPanel loginPanel = new LoginPanel(200, 100);
		loginPanel.setVisible(true);
		
		JPanel menuPanel = new MenuPanel(false, "");
		menuPanel.setVisible(true);
		
		mainWindow = new AppWindow();
		mainWindow.setPanelMenu(menuPanel);
		mainWindow.setPanelContenido(loginPanel);
		mainWindow.getFrmSistemaDeGestion().setVisible(true);
	}
}
