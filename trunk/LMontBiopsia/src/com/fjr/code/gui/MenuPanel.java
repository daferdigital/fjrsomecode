package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JMenu;
import javax.swing.SwingConstants;

import com.fjr.code.util.Constants;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

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
		setBounds(0, 0, Constants.APP_WINDOW_MAX_X, 21);
		
		JMenuBar menuBar = new JMenuBar();
		menuBar.setBounds(0, 0, Constants.APP_WINDOW_MAX_X, 21);
		add(menuBar);
		
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
			menuBar.add(menuRecepcion);
			
			JMenuItem mntmNewMenuItem = new JMenuItem("Ingreso");
			menuRecepcion.add(mntmNewMenuItem);
			
			JMenuItem mntmNewMenuItem_1 = new JMenuItem("Facturaci\u00F3n");
			menuRecepcion.add(mntmNewMenuItem_1);
			
			JMenu menuMacroscopica = new JMenu("Macrosc\u00F3pica");
			menuBar.add(menuMacroscopica);
		}
	}
}
