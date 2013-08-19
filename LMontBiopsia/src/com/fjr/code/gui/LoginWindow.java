package com.fjr.code.gui;

import java.awt.Color;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

import com.fjr.code.util.Constants;
import com.fjr.code.util.SystemLogger;

/**
 * 
 * Class: LoginWindow
 * Creation Date: 18/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class LoginWindow extends JDialog implements ActionListener, KeyListener {

	/**
	 * 
	 */
	private static final long serialVersionUID = -7643090828133305660L;
	
	private JButton ok, cancel, help;
	private JTextField usu;
	private JPasswordField cla;
	private JLabel fondo = new JLabel();
	private JLabel name1 = new JLabel(Constants.icoMain);
	private JLabel name2 = new JLabel(Constants.APP_SOFTWARE_NAME + " " + Constants.APP_SOFTWARE_VERSION);
	private JLabel tit1 = new JLabel("Usuario :");
	private JLabel tit2 = new JLabel("Clave :");

	public LoginWindow() {

		Constants.setLookAndFeel();
		setBackground(new Color(1.0F, 1.0F, 1.0F, 0.25F));
		getContentPane().setBackground(new Color(1.0F, 1.0F, 1.0F, 0.25F));
		//com.sun.awt.AWTUtilities.setWindowOpacity(this, 0.9f);
		
		// setTitle("File Manager - Qwebdocuments light version 0.2");
		setSize(500, 272);
		this.setUndecorated(true);
		this.setVisible(true);
		this.setModal(true);
		this.setLocationRelativeTo(null);
		getContentPane().setLayout(null);
		// private Icon icoSave = new
		// ImageIcon(getClass().getResource("/icons/disk.png"));
		fondo.setIcon(new javax.swing.ImageIcon(getClass().getResource("/resources/images/bgStart.jpg")));

		int x = 205;
		int y = 120;

		name1.setBounds(5, 5, 500, 150);
		name1.setFont(new Font("Agency FB", Font.BOLD, 35));
		name1.setForeground(Color.BLACK);
		getContentPane().add(name1);

		name2.setBounds(21, 21, 300, 20);
		name2.setFont(new Font("Dialog", Font.BOLD, 16));
		name2.setForeground(Color.GRAY);
		getContentPane().add(name2);

		tit1.setBounds(x, y, 300, 20);
		tit1.setForeground(Color.GRAY);
		getContentPane().add(tit1);

		usu = new JTextField();
		usu.setBounds(x, y + 20, 285, 30);
		usu.setOpaque(false);
		usu.setFont(new Font("Dialog", Font.BOLD, 19));
		usu.setBorder(BorderFactory.createLineBorder(Color.blue));
		usu.addKeyListener(this);
		getContentPane().add(usu);

		tit2.setBounds(x, y + 50, 200, 20);
		tit2.setForeground(Color.GRAY);
		getContentPane().add(tit2);

		cla = new JPasswordField();
		cla.setBounds(x, y + 70, 285, 30);
		cla.setOpaque(false);
		cla.setFont(new Font("Dialog", Font.BOLD, 19));
		cla.setBorder(BorderFactory.createLineBorder(Color.blue));
		cla.addKeyListener(this);
		getContentPane().add(cla);

		ok = new JButton("Aceptar");
		ok.setActionCommand("aceptar");
		ok.setBounds(x, y + 105, 85, 20);
		ok.setBackground(Color.WHITE);
		ok.addActionListener(this);
		getContentPane().add(ok);

		cancel = new JButton("Cancelar");
		cancel.setActionCommand("cancelar");
		cancel.setBounds(x + 100, y + 105, 85, 20);
		cancel.setBackground(Color.WHITE);
		cancel.addActionListener(this);
		getContentPane().add(cancel);

		help = new JButton("Ayuda");
		help.setActionCommand("ayuda");
		help.setBounds(x + 200, y + 105, 85, 20);
		help.setBackground(Color.WHITE);
		help.addActionListener(this);
		getContentPane().add(help);

		/*
		JButton ayuda = new JButton(new ImageIcon(getClass().getResource("/icons/ayuda.png")));
		ayuda.setBounds(120, 140, 100, 100);
		ayuda.setContentAreaFilled(false);
		ayuda.setBorderPainted(false);
		ayuda.setToolTipText("Cómo iniciar en Qnetfiles ");
		ayuda.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent evt) {
				//openHelp();
			}
		})
		;*/
		// this.add(ayuda);

		fondo.setBounds(0, 0, 500, 272);
		getContentPane().add(fondo);

		usu.requestFocusInWindow();
		
		repaint();
	}
	
	

	public void actionPerformed(ActionEvent e) {
		if (e.getActionCommand().equals("aceptar")) {
			//validamos el login del usuario
			AppWindow.show();
			this.dispose();
		} else if (e.getActionCommand().equals("ayuda")) {
			
		} else {
			this.dispose();
		}
	}

	public void keyPressed(KeyEvent e) {
	
	}

	public void keyReleased(KeyEvent e) {
		Object obj = e.getSource();
		if(obj instanceof JPasswordField) {
			if (e.getKeyCode() == 10) {
				e.consume();
				ok.requestFocus();
				//validar();
			}
		} else if(obj instanceof JTextField) {
			if (e.getKeyCode() == 10) {
				e.consume();
				cla.requestFocus();
			}
		}
	}

	public void keyTyped(KeyEvent e) {
	
	}
}
