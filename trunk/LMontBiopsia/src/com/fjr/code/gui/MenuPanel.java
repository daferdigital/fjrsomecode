package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JMenu;
import javax.swing.JTable;
import javax.swing.SwingConstants;

import com.fjr.code.dao.UsuarioDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dao.definitions.ModulosSistema;
import com.fjr.code.dto.PermisosUsuarioDTO;
import com.fjr.code.dto.UsuarioDTO;
import com.fjr.code.gui.maestros.BusquedaCategoriaReactivoPanel;
import com.fjr.code.gui.maestros.BusquedaEspecialidadPanel;
import com.fjr.code.gui.maestros.BusquedaExamenesPanel;
import com.fjr.code.gui.maestros.BusquedaReactivoPanel;
import com.fjr.code.gui.maestros.BusquedaTipoEstudioPanel;
import com.fjr.code.gui.maestros.BusquedaUsuarioPanel;
import com.fjr.code.util.Constants;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.Font;
import java.util.List;

import javax.swing.JSeparator;

import org.apache.log4j.Logger;

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
	private static final Logger log = Logger.getLogger(MenuPanel.class);
	private JMenuBar menuBar;
	
	/**
	 * Create the panel.
	 */
	public MenuPanel(boolean isLogged, String user) {
		setLayout(null);
		setSize(Constants.APP_WINDOW_MAX_X, 21);
		
		menuBar = new JMenuBar();
		menuBar.setFont(new Font("Segoe UI", Font.PLAIN, 14));
		menuBar.setBounds(0, 0, Constants.APP_WINDOW_MAX_X, 21);
		add(menuBar);
		
		setItemsMenu(isLogged, user);
	}
	
	/**
	 * Construye el menu, tomando en cuenta los permisos del usuario indicado (si está logueado)
	 * 
	 * @param menuBar
	 */
	private void setItemsMenu(boolean isLogged, String user){
		addMenuArchivo();
		
		if(isLogged){
			//valido los permisos del usuario para saber a que menus tiene acceso
			UsuarioDTO usuario = UsuarioDAO.getByLogin(user);
			List<PermisosUsuarioDTO> permisos = usuario.getPermisos();
			
			if (permisos != null && permisos.size() > 0) {
				for (PermisosUsuarioDTO permisosUsuarioDTO : permisos) {
					//vemos los permisos uno a uno
					if(ModulosSistema.ENTREGA.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuEntregas();
					} else if(ModulosSistema.INGRESO.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuRecepcion();
					} else if(ModulosSistema.MACROSCOPICA.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuMacroscopica();
					} else if(ModulosSistema.HISTOLOGIA.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuHistologia();
					} else if(ModulosSistema.MICROSCOPICA.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuMicroscopica();
					} else if(ModulosSistema.IHQ.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuHistologiaIHQ();
					} else if(ModulosSistema.INFORME_COMPLEMENTARIO.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuInformeComplementario();
					} else if(ModulosSistema.MAESTROS.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuMaestros();
					} else if(ModulosSistema.BUSQUEDA.getKey().equals(permisosUsuarioDTO.getKeyModulo())){
						addMenuBusquedas();
					} else {
						log.info("Menu de clave '" + permisosUsuarioDTO.getKeyModulo() + "', no fue reconocido.");
					}
				}
			}
		}
		
		addMenuAyuda();
	}
	
	/**
	 * Se agrega el menu de Archivo
	 */
	private void addMenuArchivo(){
		JMenu menuArchivo = new JMenu("Archivo");
		
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
		
		menuBar.add(menuArchivo);
	}
	
	/**
	 * Se agrega el menu de Entregas
	 */
	private void addMenuEntregas(){
		JMenu menuEntrega = new JMenu("Entregas");
		menuEntrega.setHorizontalAlignment(SwingConstants.LEFT);
		
		JMenuItem mntmEntrega = new JMenuItem("De Informes");
		mntmEntrega.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//debemos mostrar el panel de recepcion
				EntregaBiopsiaPanel panel = new EntregaBiopsiaPanel(false);
				AppWindow.getInstance().setPanelContenido(panel, (JTable) null);
				AppWindow.getInstance().setExtraTitle("Entrega de Informes");
			}
		});
		menuEntrega.add(mntmEntrega);
		
		JMenuItem mntmEntregaMaterial = new JMenuItem("De Material");
		mntmEntregaMaterial.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//debemos mostrar el panel de recepcion
				EntregaBiopsiaPanel panel = new EntregaBiopsiaPanel(true);
				AppWindow.getInstance().setPanelContenido(panel, (JTable) null);
				AppWindow.getInstance().setExtraTitle("Entrega de Material");
			}
		});
		menuEntrega.add(mntmEntregaMaterial);
		
		menuBar.add(menuEntrega);
	}
	
	/**
	 * Se agrega el menu de Recepcion
	 */
	private void addMenuRecepcion(){
		JMenu menuRecepcion = new JMenu("Recepci\u00F3n");
		menuRecepcion.setHorizontalAlignment(SwingConstants.LEFT);
		
		JMenuItem mntmIngreso = new JMenuItem("Nuevo Ingreso");
		mntmIngreso.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//debemos mostrar el panel de recepcion
				IngresoPanel panel = new IngresoPanel(true);
				AppWindow.getInstance().setPanelContenido(panel, (FasesBiopsia) null);
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
				AppWindow.getInstance().setPanelContenido(panel, (FasesBiopsia) null);
				AppWindow.getInstance().setExtraTitle("Recepci\u00F3n");
				panel.getTextNroBiopsia().requestFocusInWindow();
			}
		});
		menuRecepcion.add(mntmUpdIngreso);
		
		JMenuItem mntmFacturacion = new JMenuItem("Facturaci\u00F3n");
		menuRecepcion.add(mntmFacturacion);
		
		menuBar.add(menuRecepcion);
	}
	
	/**
	 * Se agrega el menu de Macroscopica
	 */
	private void addMenuMacroscopica(){
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
		
		menuBar.add(menuMacroscopica);
	}
	
	/**
	 * Se agrega el menu de Histologia
	 */
	private void addMenuHistologia(){
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
		
		menuBar.add(menuHistologia);
	}
	
	/**
	 * Se agrega el menu de Microscopica
	 */
	private void addMenuMicroscopica(){
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
		
		menuBar.add(menuMicroscopica);
	}
	
	/**
	 * Se agrega el menu de Histologia IHQ
	 */
	private void addMenuHistologiaIHQ(){
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
		
		menuBar.add(menuIHQ);
	}
	
	/**
	 * Se agrega el menu de Informe Complementario
	 */
	private void addMenuInformeComplementario(){
		JMenu menuComp = new JMenu("Informe Complementario");
		menuComp.setHorizontalAlignment(SwingConstants.LEFT);
		
		JMenuItem mntmComp = new JMenuItem("Crear Informe Complementario");
		mntmComp.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//debemos mostrar el panel de busqueda para crear informes complementarios
				JPanel panel = new InformeComplementarioPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Informe Complementario");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuComp.add(mntmComp);
		
		menuBar.add(menuComp);
	}
	
	/**
	 * Se agrega el menu de Maestros
	 */
	private void addMenuMaestros(){
		JMenu menuMaestros = new JMenu("Maestros");
		menuMaestros.setHorizontalAlignment(SwingConstants.LEFT);
		
		JMenuItem mntmTiposDeEstudio = new JMenuItem("Tipos de Estudio");
		mntmTiposDeEstudio.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaTipoEstudioPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Maestro Tipos de Estudio");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuMaestros.add(mntmTiposDeEstudio);
		
		JMenuItem mntmEspecialidades = new JMenuItem("Especialidades");
		mntmEspecialidades.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaEspecialidadPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Maestro de Especialidades");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuMaestros.add(mntmEspecialidades);
		
		JMenuItem mntmNewMenuItem = new JMenuItem("Examenes");
		mntmNewMenuItem.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaExamenesPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Maestro de Examenes");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuMaestros.add(mntmNewMenuItem);
		
		JMenuItem mntmCategoriaReactivos = new JMenuItem("Categoria Reactivos");
		mntmCategoriaReactivos.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaCategoriaReactivoPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Maestro Categoria Reactivos");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuMaestros.add(mntmCategoriaReactivos);
		
		JMenuItem mntmReactivos = new JMenuItem("Reactivos");
		mntmReactivos.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaReactivoPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Maestro Reactivos");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuMaestros.add(mntmReactivos);
		
		JMenuItem mntmUsuarios = new JMenuItem("Usuarios");
		mntmUsuarios.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaUsuarioPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Maestro Usuarios");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuMaestros.add(mntmUsuarios);
		
		menuBar.add(menuMaestros);
	}
	
	/**
	 * Se agrega el menu de Busquedas
	 */
	private void addMenuBusquedas(){
		JMenu menuBusquedas = new JMenu("Búsquedas");
		menuBusquedas.setHorizontalAlignment(SwingConstants.LEFT);
		
		JMenuItem mntmBiopsias = new JMenuItem("Biopsias");
		mntmBiopsias.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new BusquedaBiopsiaPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Búsquedas");
				AppWindow.getInstance().setPanelContenido(panel, 
						(FasesBiopsia) null);
			}
		});
		menuBusquedas.add(mntmBiopsias);
		
		JMenuItem mntmAuditoria = new JMenuItem("Auditoria");
		mntmAuditoria.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				JPanel panel = new AuditoriaBiopsiaPanel();
				panel.setVisible(true);
				AppWindow.getInstance().setExtraTitle("Auditoria");
				AppWindow.getInstance().setPanelContenido(panel, 
						(JTable) null);
			}
		});
		menuBusquedas.add(mntmAuditoria);
		menuBar.add(menuBusquedas);
	}
	
	/**
	 * Se agrega el menu de Ayuda
	 */
	private void addMenuAyuda(){
		JMenu menuAyuda = new JMenu("Ayuda");
		
		JMenuItem mntmAcercaDe = new JMenuItem("Acerca de ...");
		mntmAcercaDe.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				AppWindow.getInstance().setExtraTitle("");
				AcercaDeDialog acercaDe = new AcercaDeDialog();
				acercaDe.setVisible(true);
			}
		});
		
		menuAyuda.add(mntmAcercaDe);
		menuBar.add(menuAyuda);
	}
}
