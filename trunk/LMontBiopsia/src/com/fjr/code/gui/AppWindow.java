package com.fjr.code.gui;

import java.awt.EventQueue;

import javax.swing.JFrame;
import java.awt.Toolkit;
import javax.swing.JPanel;

import com.fjr.code.util.Constants;

import java.awt.Color;

public class AppWindow {
	private static AppWindow appWindow;
	private JPanel panelMenu = new JPanel();
	private JPanel panelContenido = new JPanel();
	private JFrame frmSistemaDeGestion;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					AppWindow window = new AppWindow();
					window.frmSistemaDeGestion.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public AppWindow() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frmSistemaDeGestion = new JFrame();
		//frmSistemaDeGestion.setExtendedState(JFrame.MAXIMIZED_BOTH); // ventana maximizada
		frmSistemaDeGestion.setTitle("Sistema de Gesti\u00F3n de Biopsias");
		frmSistemaDeGestion.setIconImage(Toolkit.getDefaultToolkit().getImage(AppWindow.class.getResource("/resources/images/iconLogo1.jpg")));
		frmSistemaDeGestion.setSize(Constants.APP_WINDOW_MAX_X, Constants.APP_WINDOW_MAX_Y);
		frmSistemaDeGestion.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frmSistemaDeGestion.getContentPane().setLayout(null);
		frmSistemaDeGestion.setResizable(false);
		
		panelMenu.setBackground(Color.WHITE);
		panelMenu.setBounds(0, 0, Constants.APP_WINDOW_MAX_X, 21);
		frmSistemaDeGestion.getContentPane().add(panelMenu);
		panelContenido.setBackground(Color.LIGHT_GRAY);
		
		panelContenido.setBounds(0, 21, Constants.APP_WINDOW_MAX_X, Constants.APP_WINDOW_MAX_Y - 21);
		frmSistemaDeGestion.getContentPane().add(panelContenido);
		panelContenido.setLayout(null);
		
		frmSistemaDeGestion.setLocationRelativeTo(null);
		frmSistemaDeGestion.requestFocusInWindow();
		frmSistemaDeGestion.setVisible(true);
	}
	
	/**
	 * Retornamos la referencia al panel de menu
	 * 
	 * @return
	 */
	public JPanel getPanelMenu(){
		return panelMenu;
	}
	
	/**
	 * Retornamos la referencia al panel de contenido
	 * 
	 * @return
	 */
	public JPanel getPanelContenido(){
		return panelContenido;
	}
	
	/**
	 * 
	 * @return
	 */
	public JFrame getFrmSistemaDeGestion() {
		return frmSistemaDeGestion;
	}
	
	/**
	 * 
	 * @param contenido
	 */
	public void setPanelMenu(JPanel menu){
		frmSistemaDeGestion.getContentPane().remove(panelMenu);
		frmSistemaDeGestion.getContentPane().add(menu);
		frmSistemaDeGestion.getContentPane().validate();
	}
	
	/**
	 * 
	 * @param contenido
	 */
	public void setPanelContenido(JPanel contenido){
		panelContenido.setVisible(false);
		frmSistemaDeGestion.getContentPane().remove(panelContenido);
		frmSistemaDeGestion.getContentPane().validate();
		frmSistemaDeGestion.getContentPane().repaint();
		
		frmSistemaDeGestion.getContentPane().add(contenido);
		panelContenido = contenido;
		panelContenido.repaint();
		panelContenido.validate();
		
		frmSistemaDeGestion.getContentPane().validate();
		frmSistemaDeGestion.getContentPane().repaint();
	}
	
	/**
	 * 
	 * @return
	 */
	public static AppWindow getInstance(){
		return appWindow;
	}

	public static void show() {
		// TODO Auto-generated method stub
		if(appWindow == null){
			appWindow = new AppWindow();
		}
		
		appWindow.setPanelMenu(new MenuPanel(true, ""));
		//obligamos a la ventana a venir al frente
		appWindow.getFrmSistemaDeGestion().setVisible(true);
	}
}
