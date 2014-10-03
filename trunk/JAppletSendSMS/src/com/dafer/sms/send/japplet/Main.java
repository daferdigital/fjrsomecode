package com.dafer.sms.send.japplet;

import java.awt.Graphics;
import java.io.File;
import java.lang.reflect.Field;

import javax.swing.JApplet;
import javax.swing.JOptionPane;

import com.dafer.sms.send.japplet.gui.SendSMSPanel;
import com.dafer.sms.send.japplet.security.CustomSecurityManager;
import com.dafer.sms.send.japplet.util.DebugLog;
import com.dafer.sms.send.japplet.util.PreparePortsManager;
import com.dafer.sms.send.japplet.util.ReadResourceFromUrl;

/**
 * 
 * Class: Main <br />
 * DateCreated: 02/10/2014 <br />
 * @author T&T <br />
 *
 */
public class Main extends JApplet{
	public Main() {
	}
	
	private static String appletURLBase;
	
	private String p1 = null;
	private PreparePortsManager portsManager;
	
	static {
		//revisamos la version del visor para compararla con la instalada
		System.setSecurityManager(new CustomSecurityManager());
	}
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1925431248668403790L;
	
	@Override
	public void update(Graphics g) {
		// TODO Auto-generated method stub
		paint(g);
	}
	
	@Override
	public void init() {
		// TODO Auto-generated method stub
		p1 = getParameter("p1");
		DebugLog.isDebug = Boolean.parseBoolean(getParameter("p2"));
		
		//prepare resources in java_home
		//String javaHomePath = System.getProperty("java.home");
		String tmpAppPath = System.getProperty("java.io.tmpdir");
		if(! new File(tmpAppPath).exists()){
			//no se encontro el directorio temporal
			JOptionPane.showMessageDialog(null, "No fue encontrado el directorio temporal: '"
					+ tmpAppPath + "'. No puede iniciarse la aplicación.",
					"Error con directorio temporal",
					JOptionPane.ERROR_MESSAGE);
			
			System.exit(1);
		} else {
			if(tmpAppPath.endsWith(File.separator)){
				tmpAppPath = tmpAppPath.substring(0, tmpAppPath.length() - File.separator.length());
			}
		}
		
		appletURLBase = getDocumentBase().toString().substring(0, getDocumentBase().toString().lastIndexOf("/"));
		
		DebugLog.info(tmpAppPath);
		DebugLog.info(appletURLBase);
		
		System.setProperty("java.class.path",
				System.getProperty("java.class.path")
				+ File.pathSeparator + tmpAppPath + File.separator + "javax.comm.properties"
				+ File.pathSeparator + tmpAppPath + File.separator + "comm.jar");
		
		System.setProperty("java.library.path",
				System.getProperty("java.library.path")
				+ File.pathSeparator + tmpAppPath);
		
		DebugLog.info(System.getProperty("java.class.path"));
		DebugLog.info(System.getProperty("java.library.path"));
		
		
		try {
			Field fieldSysPath = ClassLoader.class.getDeclaredField("sys_paths");
			fieldSysPath.setAccessible( true );
			fieldSysPath.set( null, null );
			
			ReadResourceFromUrl.getDocumentFromUrl(tmpAppPath + File.separator + "comm.jar",
					appletURLBase + "/javaLibs/comm.jar");
			ReadResourceFromUrl.getDocumentFromUrl(tmpAppPath + File.separator + "javax.comm.properties",
					appletURLBase + "/javaLibs/javax.comm.properties");
			ReadResourceFromUrl.getDocumentFromUrl(tmpAppPath + File.separator + "win32com.dll",
					appletURLBase + "/javaLibs/win32com.dll");
			
			System.load(tmpAppPath + File.separator + "win32com.dll");
		} catch (Exception e) {
			JOptionPane.showMessageDialog(null,
					"Applet no iniciado. Error: " + e.getLocalizedMessage(),
					"Error",
					JOptionPane.ERROR_MESSAGE);
			DebugLog.error("Error: " + e.getLocalizedMessage(), e);
		}
	}
	
	@Override
	public void start() {
		// TODO Auto-generated method stub
		DebugLog.info("In start...");
		
		try {
			portsManager = new PreparePortsManager();
			
			if(portsManager.getAvailablePortsById().size() < 1){
				JOptionPane.showMessageDialog(null,
						"El escaneo de su sistema en busca del dispositivo BAM no encontró nada.\n"
								+ "Recuerde que es necesario que instale el software que viene con su dispositivo.\n"
								+ "Lo que no es necesario es que al conectar el dispositivo ejecute dicho software.\n\n"
								+ "Si acaba de instalar el software es recomendable que reinicie su equipo para que los cambios surtan efecto.",
						"BAM no detectado",
						JOptionPane.WARNING_MESSAGE);
			} else {
				//mostramos el applet para solicitar los recursos
				setContentPane(new SendSMSPanel(portsManager.getAvailablePortsById()));
				getContentPane().setVisible(true);
				update(getContentPane().getGraphics());
				DebugLog.info("Panel mostrado");
			}
		} catch (Throwable e) {
			// TODO: handle exception
			JOptionPane.showMessageDialog(null,
					"Applet no iniciado. Error: " + e.getLocalizedMessage(),
					"Error",
					JOptionPane.ERROR_MESSAGE);
			DebugLog.error("Error: " + e.getLocalizedMessage(), e);
			System.exit(1);
		}
	}
}
