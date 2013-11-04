package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JMenu;
import javax.swing.SwingConstants;

import com.fjr.code.dao.definitions.FasesBiopsia;
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
		
		JMenuItem mntmDelTemp = new JMenuItem("Borrar archivos temporales");
		mntmDelTemp.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//LicenseDialog.showDialog();
			}
		});
		menuArchivo.add(mntmDelTemp);
		
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
		
		JMenu menuMaestros = new JMenu("Maestros");
		menuMaestros.setHorizontalAlignment(SwingConstants.LEFT);
		menuBar.add(menuMaestros);
		
		JMenu menuBusquedas = new JMenu("Búsquedas");
		menuBusquedas.setHorizontalAlignment(SwingConstants.LEFT);
		menuBar.add(menuBusquedas);
		
		JMenuItem mntmBiopsias = new JMenuItem("Biopsias");
		mntmBiopsias.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaBiopsiaPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Búsquedas");
				AppWindow.getInstance().setPanelContenido(panel, 
						null);
			}
		});
		menuBusquedas.add(mntmBiopsias);
		
		
		JMenu menuAyuda = new JMenu("Ayuda");
		menuBar.add(menuAyuda);
		
		JMenuItem mntmAcercaDe = new JMenuItem("Acerca de ...");
		mntmAcercaDe.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				AppWindow.getInstance().setExtraTitle("");
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
			
			JMenuItem mntmIngreso = new JMenuItem("Nuevo Ingreso");
			mntmIngreso.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					IngresoPanel panel = new IngresoPanel(true);
					AppWindow.getInstance().setPanelContenido(panel, null);
					AppWindow.getInstance().setExtraTitle("Recepci\u00F3n");
					panel.setFocusAtDefaultElement();
				}
			});
			menuRecepcion.add(mntmIngreso);
			
			JMenuItem mntmUpdIngreso = new JMenuItem("Actualizar Ingreso");
			mntmUpdIngreso.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					IngresoPanel panel = new IngresoPanel(false);
					AppWindow.getInstance().setPanelContenido(panel, null);
					AppWindow.getInstance().setExtraTitle("Recepci\u00F3n");
					panel.getTextNroBiopsia().requestFocusInWindow();
				}
			});
			menuRecepcion.add(mntmUpdIngreso);
			
			JMenuItem mntmFacturacion = new JMenuItem("Facturaci\u00F3n");
			menuRecepcion.add(mntmFacturacion);
			
			JMenu menuMacroscopica = new JMenu("Macrosc\u00F3pica");
			menuMacroscopica.setHorizontalAlignment(SwingConstants.LEFT);
			
			JMenuItem mntmMacro = new JMenuItem("Macrosc\u00F3pica");
			mntmMacro.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					MacroscopicaPanel panel = new MacroscopicaPanel();
					AppWindow.getInstance().setExtraTitle("Macrosc\u00F3pica");
					AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.MACROSCOPICA);
					panel.setFocusAtDefaultElement();
				}
			});
			menuMacroscopica.add(mntmMacro);
			
			
			JMenu menuHistologia = new JMenu("Histologia");
			menuHistologia.setHorizontalAlignment(SwingConstants.LEFT);
			
			JMenuItem mntmHistologia = new JMenuItem("Histologia");
			mntmHistologia.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					HistologiaPanel panel = new HistologiaPanel();
					AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.HISTOLOGIA);
					AppWindow.getInstance().setExtraTitle("Histologia");
					panel.setFocusAtDefaultElement();
				}
			});
			menuHistologia.add(mntmHistologia);
			
			JMenu menuMicroscopica = new JMenu("Microscopica");
			menuMicroscopica.setHorizontalAlignment(SwingConstants.LEFT);
			
			JMenuItem mntmMicroscopica = new JMenuItem("Microscopica");
			mntmMicroscopica.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					MicroscopicaPanel panel = new MicroscopicaPanel();
					AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.MICROSCOPICA);
					AppWindow.getInstance().setExtraTitle("Microscopica");
					panel.setFocusAtDefaultElement();
				}
			});
			menuMicroscopica.add(mntmMicroscopica);
			
			JMenu menuIHQ = new JMenu("IHQ");
			menuIHQ.setHorizontalAlignment(SwingConstants.LEFT);
			
			JMenuItem mntmIHQ = new JMenuItem("IHQ");
			mntmIHQ.addActionListener(new ActionListener() {
				public void actionPerformed(ActionEvent arg0) {
					//debemos mostrar el panel de recepcion
					HistologiaIHQPanel panel = new HistologiaIHQPanel();
					AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.IHQ);
					AppWindow.getInstance().setExtraTitle("IHQ");
					panel.setFocusAtDefaultElement();
				}
			});
			menuIHQ.add(mntmIHQ);
			
			//agregamos los menus principales
			menuBar.add(menuRecepcion);
			menuBar.add(menuMacroscopica);
			menuBar.add(menuHistologia);
			menuBar.add(menuMicroscopica);
			menuBar.add(menuIHQ);
		}
	}
}
