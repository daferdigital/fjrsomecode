package com.fjr.code.gui;

import java.awt.EventQueue;
import java.awt.Font;

import javax.swing.JFrame;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;

import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class MainAppWindow {

	private JFrame frmSmsappreaderlectorSms;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					MainAppWindow window = new MainAppWindow();
					window.frmSmsappreaderlectorSms.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public MainAppWindow() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frmSmsappreaderlectorSms = new JFrame();
		frmSmsappreaderlectorSms.setTitle("SMSAPPReader (Lector SMS desde USB)");
		frmSmsappreaderlectorSms.setIconImage(Toolkit.getDefaultToolkit().getImage(MainAppWindow.class.getResource("/resources/images/smsIcon.png")));
		frmSmsappreaderlectorSms.setBounds(100, 100, 450, 300);
		frmSmsappreaderlectorSms.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frmSmsappreaderlectorSms.getContentPane().setLayout(null);
		
		frmSmsappreaderlectorSms.getContentPane().setLayout(null);
		
		JMenuBar menuBar = new JMenuBar();
		menuBar.setFont(new Font("Tahoma", Font.PLAIN, 11));
		frmSmsappreaderlectorSms.setJMenuBar(menuBar);
		
		JMenu mnArchivo = new JMenu("Archivo");
		mnArchivo.setFont(new Font("Tahoma", Font.PLAIN, 11));
		menuBar.add(mnArchivo);
		
		JMenuItem mntmSalir = new JMenuItem("Salir");
		mntmSalir.addActionListener(new ActionListener() {
			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				frmSmsappreaderlectorSms.setVisible(false);
				frmSmsappreaderlectorSms.dispose();
				System.exit(1);
			}
		});
		mnArchivo.add(mntmSalir);
		
		JMenu mnMensajes = new JMenu("Mensajes");
		mnMensajes.setFont(new Font("Tahoma", Font.PLAIN, 11));
		menuBar.add(mnMensajes);
		
		JMenu mnConfiguracion_1 = new JMenu("Configuracion");
		mnConfiguracion_1.setFont(new Font("Tahoma", Font.PLAIN, 11));
		menuBar.add(mnConfiguracion_1);
		
		JMenuItem mntmBaseDeDatos = new JMenuItem("Base de Datos");
		mnConfiguracion_1.add(mntmBaseDeDatos);
		
		JMenuItem mntmSistema = new JMenuItem("Sistema");
		mnConfiguracion_1.add(mntmSistema);
		
		JMenu mnPuertos = new JMenu("Puertos");
		mnPuertos.setFont(new Font("Tahoma", Font.PLAIN, 11));
		menuBar.add(mnPuertos);
		
		JMenuItem mntmConfigurar = new JMenuItem("Configurar");
		mnPuertos.add(mntmConfigurar);
		
		JMenu mnLogs = new JMenu("Logs");
		mnLogs.setFont(new Font("Tahoma", Font.PLAIN, 11));
		menuBar.add(mnLogs);
		
		JMenu mnAcercaDe = new JMenu("Ayuda");
		mnAcercaDe.setFont(new Font("Tahoma", Font.PLAIN, 11));
		menuBar.add(mnAcercaDe);
		
		JMenuItem mntmSmsappreader = new JMenuItem("SMSAPPReader");
		mntmSmsappreader.setFont(new Font("Tahoma", Font.PLAIN, 11));
		mnAcercaDe.add(mntmSmsappreader);
		
		frmSmsappreaderlectorSms.setLocationRelativeTo(null);
		frmSmsappreaderlectorSms.setResizable(false);
		frmSmsappreaderlectorSms.setVisible(true);
	}
	
	public JFrame getFrmSmsappreaderlectorSms() {
		return frmSmsappreaderlectorSms;
	}
}
