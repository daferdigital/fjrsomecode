package com.fjr.code.gui;

import java.awt.EventQueue;

import javax.swing.JFrame;
import java.awt.Toolkit;
import javax.swing.JPanel;
import java.awt.Color;

public class AppWindow {
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
		frmSistemaDeGestion.setTitle("Sistema de Gestion de Biopsias");
		frmSistemaDeGestion.setIconImage(Toolkit.getDefaultToolkit().getImage(AppWindow.class.getResource("/resources/images/iconLogo1.jpg")));
		frmSistemaDeGestion.setBounds(100, 100, 800, 550);
		frmSistemaDeGestion.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frmSistemaDeGestion.getContentPane().setLayout(null);
		frmSistemaDeGestion.setResizable(false);
		
		panelMenu.setBackground(Color.WHITE);
		panelMenu.setBounds(0, 0, 800, 22);
		frmSistemaDeGestion.getContentPane().add(panelMenu);
		panelContenido.setBackground(Color.LIGHT_GRAY);
		
		panelContenido.setBounds(0, 23, 800, 525);
		frmSistemaDeGestion.getContentPane().add(panelContenido);
		panelContenido.setLayout(null);
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
		frmSistemaDeGestion.getContentPane().remove(panelContenido);
		frmSistemaDeGestion.getContentPane().add(contenido);
		frmSistemaDeGestion.getContentPane().validate();
	}
}
