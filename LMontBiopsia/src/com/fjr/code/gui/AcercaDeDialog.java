package com.fjr.code.gui;

import java.awt.BorderLayout;

import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.ImageIcon;
import javax.swing.SwingConstants;
import java.awt.Color;
import java.awt.Font;

public class AcercaDeDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5323948543441939454L;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			AcercaDeDialog dialog = new AcercaDeDialog();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public AcercaDeDialog() {
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setModal(true);
		getContentPane().setBackground(Color.WHITE);
		setBounds(200 + (int) getParent().getAlignmentX(), 
				200 + (int) getParent().getAlignmentY(),
				300, 
				300);
		BorderLayout borderLayout = new BorderLayout();
		getContentPane().setLayout(borderLayout);
		{
			JLabel lblNewLabel = new JLabel("");
			lblNewLabel.setVerticalAlignment(SwingConstants.BOTTOM);
			lblNewLabel.setBackground(Color.WHITE);
			lblNewLabel.setHorizontalAlignment(SwingConstants.CENTER);
			lblNewLabel.setIcon(new ImageIcon(AcercaDeDialog.class.getResource("/resources/images/LmontTech.jpg")));
			getContentPane().add(lblNewLabel, BorderLayout.NORTH);
		}
		{
			
			JLabel lblNewLabel_1 = new JLabel("<html>\r\nSistema de Gestion de Biopsias <br />\r\nVersion: 1.0 <br />\r\nBuild id: 20130901 <br />\r\n&copy; Grupo L'Mont Tech.<br /> \r\nTodos los derechos reservados. <br />\r\n</html>");
			lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
			lblNewLabel_1.setHorizontalAlignment(SwingConstants.CENTER);
			getContentPane().add(lblNewLabel_1, BorderLayout.CENTER);
		}
	}

}
