package com.fjr.code.gui;

import java.awt.Color;
import java.awt.Font;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

import com.fjr.code.gui.operations.LoginWindowOperations;
import com.fjr.code.util.Constants;
import com.sun.awt.AWTUtilities;

/**
 * 
 * Class: LoginWindow
 * Creation Date: 18/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class LoginWindow extends JDialog implements KeyListener {

	/**
	 * 
	 */
	private static final long serialVersionUID = -7643090828133305660L;
	
	private JButton ok, cancel, help;
	private JTextField loginTxt;
	private JPasswordField pwdField;
	private JLabel fondo = new JLabel();
	private JLabel name1 = new JLabel(Constants.icoMain);
	private JLabel name2 = new JLabel(Constants.APP_SOFTWARE_NAME + " " + Constants.APP_SOFTWARE_VERSION);
	private JLabel tit1 = new JLabel("Usuario :");
	private JLabel tit2 = new JLabel("Clave :");

	/**
	 * 
	 */
	public LoginWindow() {

		Constants.setLookAndFeel();
		
		// setTitle("File Manager - Qwebdocuments light version 0.2");
		setSize(500, 272);
		this.setUndecorated(true);
		this.setModal(true);
		this.setLocationRelativeTo(null);
		getContentPane().setLayout(null);
		
		AWTUtilities.setWindowOpacity(this, 0.9f);
		setBackground(new Color(1.0F, 1.0F, 1.0F, 0.25F));
		getContentPane().setBackground(new Color(1.0F, 1.0F, 1.0F, 0.25F));
		
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
		tit1.setFont(new Font("Tahoma", Font.BOLD, 12));

		tit1.setBounds(x, y, 300, 20);
		tit1.setForeground(Color.GRAY);
		getContentPane().add(tit1);

		loginTxt = new JTextField();
		loginTxt.setBounds(x, y + 20, 285, 30);
		loginTxt.setOpaque(false);
		loginTxt.setFont(new Font("Dialog", Font.BOLD, 19));
		loginTxt.setBorder(BorderFactory.createLineBorder(Color.blue));
		loginTxt.addKeyListener(this);
		getContentPane().add(loginTxt);
		tit2.setFont(new Font("Tahoma", Font.BOLD, 12));

		tit2.setBounds(x, y + 50, 200, 20);
		tit2.setForeground(Color.GRAY);
		getContentPane().add(tit2);

		pwdField = new JPasswordField();
		pwdField.setBounds(x, y + 70, 285, 30);
		pwdField.setOpaque(false);
		pwdField.setFont(new Font("Dialog", Font.BOLD, 19));
		pwdField.setBorder(BorderFactory.createLineBorder(Color.blue));
		pwdField.addKeyListener(this);
		getContentPane().add(pwdField);

		ok = new JButton("Aceptar");
		ok.setFont(new Font("Tahoma", Font.PLAIN, 12));
		ok.setActionCommand(LoginWindowOperations.ACTION_COMMAND_DO_LOGIN);
		ok.setBounds(x, y + 105, 85, 20);
		ok.setBackground(Color.WHITE);
		getContentPane().add(ok);

		cancel = new JButton("Cancelar");
		cancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		cancel.setActionCommand(LoginWindowOperations.ACTION_COMMAND_CANCEL);
		cancel.setBounds(x + 100, y + 105, 85, 20);
		cancel.setBackground(Color.WHITE);
		getContentPane().add(cancel);

		help = new JButton("Ayuda");
		help.setFont(new Font("Tahoma", Font.PLAIN, 12));
		help.setActionCommand(LoginWindowOperations.ACTION_COMMAND_OPEN_HELP);
		help.setBounds(x + 200, y + 105, 85, 20);
		help.setBackground(Color.WHITE);
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

		LoginWindowOperations listener = new LoginWindowOperations(this);
		ok.addActionListener(listener);
		cancel.addActionListener(listener);
		help.addActionListener(listener);
		
		fondo.setBounds(0, 0, 500, 272);
		getContentPane().add(fondo);

		loginTxt.requestFocusInWindow();

		this.setVisible(true);
		repaint();
	}
	
	
	public void keyPressed(KeyEvent e) {
	
	}

	public void keyReleased(KeyEvent e) {
		Object obj = e.getSource();
		if(obj instanceof JPasswordField) {
			if (e.getKeyCode() == 10) {
				e.consume();
				ok.requestFocus();
				ok.doClick();
				//validar();
			}
		} else if(obj instanceof JTextField) {
			if (e.getKeyCode() == 10) {
				e.consume();
				pwdField.requestFocus();
			}
		}
	}

	public void keyTyped(KeyEvent e) {
	
	}
	
	public JPasswordField getPwdField() {
		return pwdField;
	}
	
	public JTextField getLoginTxt() {
		return loginTxt;
	}
}
