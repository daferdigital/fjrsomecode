package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JMenu;
import javax.swing.SwingConstants;

import com.fjr.code.util.Constants;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.Font;
import javax.swing.JSeparator;

/**
 * Panel que contendra el menu especifico para determinado usuario.
 * 
 * Class: MenuPanel <br />
 * DateCreated: 14/08/2013 <br />
 * @author T&T <br />
 *
 */
public class MenuPanel extends JPanel {
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -844837167828258118L;

	/**
	 * Create the panel.
	 */
	public MenuPanel(boolean isLogged, String user) {
		setLayout(null);
		setSize(Constants.APP_WINDOW_MAX_X, 21);
		
		JMenuBar menuBar = new JMenuBar();
		menuBar.setFont(new Font("Segoe UI", Font.PLAIN, 14));
		menuBar.setBounds(0, 0, Constants.APP_WINDOW_MAX_X, 21);
		add(menuBar);
		
		JMenu menuArchivo = new JMenu("Archivo");
		menuBar.add(menuArchivo);
		
		JMenuItem mntmActivar = new JMenuItem("Activar Licencia");
		mntmActivar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				LicenseDialog.showDialog();
			}
		});
		menuArchivo.add(mntmActivar);
		
		//simple separador
		menuArchivo.add(new JSeparator());
		
		JMenuItem mntmSalir = new JMenuItem("Salir");
		mntmSalir.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				System.exit(0);
			}
		});
		menuArchivo.add(mntmSalir);
		
		setItemsMenu(menuBar, isLogged, user);
		
		JMenu menuAyuda = new JMenu("Ayuda");
		menuBar.add(menuAyuda);
		
		JMenuItem mntmAcercaDe = new JMenuItem("Acerca de ...");
		mntmAcercaDe.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				AcercaDeDialog acercaDe = new AcercaDeDialog();
				acercaDe.setVisible(true);
			}
		});
		
		menuAyuda.add(mntmAcercaDe);
	}
	
	/**
	 * 
	 * @param menuBar
	 */
	private void setItemsMenu(JMenuBar menuBar, boolean isLogged, String user){
		if(isLogged){
			//valido los permisos del usuario para saber a que menus tiene acceso
			JMenu menuRecepcion = new JMenu("Recepci\u00F3n");
			menuRecepcion.setHorizontalAlignment(SwingConstants.LEFT);
			
			JMenuItem mntmIngreso = new JMenuItem("Ingreso");
			mntmIngreso.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					AppWindow.getInstance().setPanelContenido(new IngresoPanel(null));
				}
			});
			menuRecepcion.add(mntmIngreso);
			
			JMenuItem mntmFacturacion = new JMenuItem("Facturaci\u00F3n");
			menuRecepcion.add(mntmFacturacion);
			
			JMenu menuMacroscopica = new JMenu("Macrosc\u00F3pica");
			menuMacroscopica.setHorizontalAlignment(SwingConstants.LEFT);
			
			JMenuItem mntmMacro = new JMenuItem("Macrosc\u00F3pica");
			mntmMacro.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					AppWindow.getInstance().setPanelContenido(new MacroscopicaPanel());
				}
			});
			menuMacroscopica.add(mntmMacro);
			
			
			//agregamos los menus principales
			menuBar.add(menuRecepcion);
			menuBar.add(menuMacroscopica);
		}
	}
}
