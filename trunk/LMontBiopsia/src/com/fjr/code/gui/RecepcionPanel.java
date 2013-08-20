package com.fjr.code.gui;

import javax.swing.JPanel;

import java.awt.Color;
import javax.swing.JLabel;
import java.awt.Font;

/**
 * 
 * Class: RecepcionPanel
 * Creation Date: 19/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class RecepcionPanel extends JPanel {
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 5763855986388595232L;

	/**
	 * Create the panel.
	 */
	public RecepcionPanel() {
		setBackground(new Color(255, 255, 255));
		setLayout(null);
		
		JLabel lblNewLabel = new JLabel("Datos del Paciente:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblNewLabel.setBounds(10, 11, 196, 20);
		add(lblNewLabel);
		
		//setVisible(true);
		
	}
}
