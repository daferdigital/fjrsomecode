package com.fjr.code.gui;

import java.awt.EventQueue;

import javax.swing.JDialog;
import java.awt.Toolkit;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JPanel;

import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JMenu;

public class MainDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -9081663524393204077L;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					MainDialog dialog = new MainDialog();
					dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
					dialog.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the dialog.
	 */
	public MainDialog() {
		setTitle("SMSAPPReader (Lector SMS desde USB)");
		setIconImage(Toolkit.getDefaultToolkit().getImage(MainDialog.class.getResource("/resources/images/smsIcon.png")));
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		setLocationRelativeTo(null);
		getContentPane().setLayout(null);
		
		JMenuBar menuBar = new JMenuBar();
		menuBar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		setJMenuBar(menuBar);
		
		JMenu mnArchivo = new JMenu("Archivo");
		mnArchivo.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnArchivo);
		
		JMenuItem mntmSalir = new JMenuItem("Salir");
		mntmSalir.addActionListener(new ActionListener() {
			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				setVisible(false);
				dispose();
			}
		});
		mnArchivo.add(mntmSalir);
		
		JMenu mnMensajes = new JMenu("Mensajes");
		mnMensajes.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnMensajes);
		
		JMenu mnConfiguracion_1 = new JMenu("Configuracion");
		mnConfiguracion_1.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnConfiguracion_1);
		
		JMenuItem mntmSistema = new JMenuItem("Sistema");
		mnConfiguracion_1.add(mntmSistema);
		
		JMenu mnConfiguracion = new JMenu("Base de Datos");
		mnConfiguracion.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnConfiguracion);
		
		JMenuItem mntmLocal = new JMenuItem("Local");
		mntmLocal.setFont(new Font("Tahoma", Font.PLAIN, 12));
		mnConfiguracion.add(mntmLocal);
		
		JMenuItem mntmRemota = new JMenuItem("Remota");
		mntmRemota.setFont(new Font("Tahoma", Font.PLAIN, 12));
		mnConfiguracion.add(mntmRemota);
		
		JMenu mnPuertos = new JMenu("Puertos");
		mnPuertos.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnPuertos);
		
		JMenuItem mntmConfigurar = new JMenuItem("Configurar");
		mnPuertos.add(mntmConfigurar);
		
		JMenu mnLogs = new JMenu("Logs");
		mnLogs.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnLogs);
		
		JMenu mnAcercaDe = new JMenu("Ayuda");
		mnAcercaDe.setFont(new Font("Tahoma", Font.PLAIN, 12));
		menuBar.add(mnAcercaDe);
		
		JMenuItem mntmSmsappreader = new JMenuItem("SMSAPPReader");
		mntmSmsappreader.setFont(new Font("Tahoma", Font.PLAIN, 11));
		mnAcercaDe.add(mntmSmsappreader);
	}
	
	/**
	 * 
	 * @param panelToShow
	 */
	public void refreshContentPane(JPanel panelToShow){
		getContentPane().setVisible(false);
		getContentPane().removeAll();
		getContentPane().repaint();
		
		getContentPane().add(panelToShow);
		getContentPane().setVisible(true);
		getContentPane().repaint();
	}
}
