package com.fjr.code.gui;

import java.awt.EventQueue;
import java.awt.Rectangle;

import javax.swing.JFrame;
import javax.swing.JTable;

import java.awt.Toolkit;
import javax.swing.JPanel;

import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.gui.tables.JTableTodasBiopsias;
import com.fjr.code.util.Constants;

import java.awt.Color;
import javax.swing.JScrollPane;

public class AppWindow {
	private static AppWindow appWindow;
	private JPanel panelMenu = new JPanel();
	private JPanel panelContenido = new JPanel();
	private JFrame frmSistemaDeGestion;
	private JTable tableTodasBiopsias;
	private JScrollPane scrollPane;
	
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
		frmSistemaDeGestion.setTitle(Constants.APP_WINDOW_TITLE);
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
		frmSistemaDeGestion.toFront();
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
	public void setPanelContenido(JPanel contenido, FasesBiopsia faseABuscar){
		panelContenido.setVisible(false);
		frmSistemaDeGestion.getContentPane().remove(panelContenido);
		frmSistemaDeGestion.getContentPane().validate();
		frmSistemaDeGestion.getContentPane().repaint();
		
		putTableBiopsiasActivas((int) contenido.getSize().getHeight(),
				faseABuscar);
		
		frmSistemaDeGestion.getContentPane().add(contenido);
		panelContenido = contenido;
		panelContenido.repaint();
		panelContenido.validate();
		
		frmSistemaDeGestion.getContentPane().validate();
		frmSistemaDeGestion.getContentPane().repaint();
	}

	/**
	 * Colocamos una guia de las biopsias activas para acceso directo
	 * 
	 * @param startHeight
	 */
	private void putTableBiopsiasActivas(int startHeight, FasesBiopsia faseABuscar){
		if(tableTodasBiopsias != null){
			scrollPane.removeAll();
			frmSistemaDeGestion.getContentPane().remove(scrollPane);
			frmSistemaDeGestion.getContentPane().remove(tableTodasBiopsias);
			tableTodasBiopsias = null;
			scrollPane = null;
			System.gc();
		}
		
		scrollPane = new JScrollPane();
		tableTodasBiopsias = new JTableTodasBiopsias(faseABuscar).getTable();
		
		int factorAjuste = 10;
		Rectangle bounds = new Rectangle(0, 
				startHeight + panelMenu.getHeight(), 
				Constants.APP_WINDOW_MAX_X - factorAjuste, 
				Constants.APP_WINDOW_MAX_Y - (startHeight + panelMenu.getHeight() + (factorAjuste*3)));
		
		scrollPane.setBounds(bounds);
		tableTodasBiopsias.setBounds(0, 
				startHeight + panelMenu.getHeight(), 
				Constants.APP_WINDOW_MAX_X - (factorAjuste*2), 
				Constants.APP_WINDOW_MAX_Y - (startHeight + panelMenu.getHeight() + (factorAjuste*6)));
		
		scrollPane.setViewportView(tableTodasBiopsias);
		
		frmSistemaDeGestion.getContentPane().add(scrollPane);
	}
	
	/**
	 * 
	 * @return
	 */
	public static AppWindow getInstance(){
		return appWindow;
	}

	/**
	 * 
	 * @param extraTitle
	 */
	public void setExtraTitle(String extraTitle){
		frmSistemaDeGestion.setTitle(Constants.APP_WINDOW_TITLE + " - " + extraTitle);
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
