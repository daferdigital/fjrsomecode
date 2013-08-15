package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JLabel;
import javax.swing.SwingConstants;
import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class LoginPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 4855186914833326991L;
	private JTextField textField;
	private JPasswordField passwordField;

	/**
	 * Create the panel.
	 */
	public LoginPanel(int boundX, int boundY) {
		setLayout(null);
		setBounds(boundX, boundY, 390, 250);
		
		JLabel lblporFavorIndique = new JLabel("<html>Por favor indique su usuario y clave <br />Para ingresar al Sistema:</html>");
		lblporFavorIndique.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblporFavorIndique.setHorizontalAlignment(SwingConstants.CENTER);
		lblporFavorIndique.setBounds(54, 62, 294, 42);
		add(lblporFavorIndique);
		
		JLabel lblLogin = new JLabel("Login:");
		lblLogin.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblLogin.setBounds(131, 116, 64, 21);
		add(lblLogin);
		
		JLabel lblClave = new JLabel("Clave:");
		lblClave.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblClave.setBounds(131, 148, 64, 21);
		add(lblClave);
		
		textField = new JTextField();
		textField.setBounds(183, 117, 86, 20);
		add(textField);
		textField.setColumns(10);
		
		passwordField = new JPasswordField();
		passwordField.setBounds(183, 149, 86, 20);
		add(passwordField);
		
		JButton btnLoginIngresar = new JButton("Ingresar");
		btnLoginIngresar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				System.out.println("Cancelando");
				getParent().setVisible(false);
			}
		});
		btnLoginIngresar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnLoginIngresar.setBounds(104, 197, 91, 23);
		add(btnLoginIngresar);
		
		JButton btnLoginCancelar = new JButton("Cancelar");
		btnLoginCancelar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				getParent().setVisible(false);
			}
		});
		btnLoginCancelar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnLoginCancelar.setBounds(224, 197, 91, 23);
		add(btnLoginCancelar);
	}
}
